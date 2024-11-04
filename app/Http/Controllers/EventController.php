<?php

namespace App\Http\Controllers;

use App\Models\Notices;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\DeptAttributes;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Events;
use Illuminate\Support\Facades\File;

class EventController extends Controller
{
    /*====================================================
            ------ -Events-----
    ====================================================*/

    public function index()
    {
        // Show all events
        if (Auth::user()->controller_role == 'General') abort(404, 'Page not found');

        $profileData = User::find(Auth::user()->id);
        $events = DB::table('events')->orderBy('rank')->paginate(15);
        $dept = DB::table('dept_attributes')->first();
        return view('admin.allEvent', compact('profileData', 'events', 'dept'));
    }

    // Add a new event
    public function create()
    {
        if (Auth::user()->controller_role == 'General') abort(404, 'Page not found');

        $profileData = User::find(Auth::user()->id);
        $dept = DeptAttributes::first();
        return view('admin.addEvents', compact('profileData', 'dept'));
    }

    // Store a new event
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'description' => 'string',
            'file' => 'required|mimes:jpeg,png,jpg,gif|max:1024',
        ], [
            'title.required' => 'The event title is required.',
            'date.required' => 'The event date is required.',
            'file.required' => 'An event file is required.',
            'file.mimes' => 'The file must be a type of jpeg, png, jpg, gif.',
            'file.max' => 'The file size must not exceed 2MB.',
        ]);

        $filename = $this->handleFileUpload($request->file('file'));

        try {
            Events::query()->increment('rank');
            DB::table('events')->insert([
                'date' => $request->date,
                'title' => strip_tags($request->title),
                'description' => $request->description,
                'file' => $filename,
                'rank' => 1
            ]);
        } catch (\Exception $e) {
            Log::error('Error storing event: ' );
            return redirect()->back()->with('error', 'Failed to store event.');
        }

        return redirect()->route('event.index')->with('success', 'Event Added');
    }

    // Edit a single event
    public function show($event)
    {
        if (Auth::user()->controller_role == 'General')  abort(403);

        $profileData = User::find(Auth::user()->id);
        $event = Events::find($event);
        if (!$event) {
            return redirect()->back()->with('error', 'Event not found.');
        }
        $dept = DeptAttributes::first();
        return view('admin.editEvent', compact('profileData', 'event', 'dept'));
    }

    // Store edited event
    public function update(Request $request, $event)
    {
        $events = Events::find($event);
        if (!$events) {
            return redirect()->back()->with('error', 'Event not found.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'file' => 'mimes:png,jpg,gif|max:1024', // Validate file if exists
        ], [
            'title.required' => 'The event title is required.',
            'date.required' => 'The event date is required.',
            'file.mimes' => 'The file must be a type of gif, png or jpg if provided.',
        ]);

        $events->title = strip_tags($request->title);
        $events->date = $request->date;
        $events->description = $request->description;

        if ($request->file('file')) {
            $filename = $this->handleFileUpload($request->file('file'));
            $events->file = $filename;
        }

        try {
            $events->save();
        } catch (\Exception $e) {
            Log::error('Error updating event: ' );
            return redirect()->back()->with('error', 'Failed to update event.');
        }

        return redirect()->route('event.index')->with('success', 'Event updated successfully.');
    }

    // Delete an event
    public function destroy($event)
    {
        $dept = DB::table('dept_attributes')->first()->folder_name;
        if (Auth::user()->controller_role == 'General') return back()->with('error', 'Invalid link!');

        $event = Events::find($event);
        if (!$event) {
            return redirect()->back()->with('error', 'Event not found.');
        }
        try {
            Events::where('rank', ">", $event->rank)->decrement("rank",1);

            if ($event->file && File::exists(public_path('../../' . $dept . '/assets/img/Events/' . $event->file))) {
                File::delete(public_path('../../' . $dept . '/assets/img/Events/' . $event->file));
            }
            $event->delete();
        } catch (\Exception $e) {
            Log::error('Error deleting event: ' );
            return redirect()->back()->with('error', 'Failed to delete event.');
        }

        return redirect()->route('event.index')->with('success', 'Event deleted successfully.');
    }

    public function rankUp($id)
    {
        if (Auth::user()->controller_role == 'General') return back()->with('error', 'Invalid link!');

        $currentEvent = Events::find($id);
        if (!$currentEvent) {
            return back()->with('error', 'Event not found.');
        }

        $previousEvent = Events::where('rank', '<', $currentEvent->rank)->orderBy('rank', 'desc')->first();
        if (!$previousEvent) {
            return back()->with('info', 'This Event is already at the top.');
        }

        $currentRank = $currentEvent->rank;
        $currentEvent->rank = $previousEvent->rank;
        $previousEvent->rank = $currentRank;

        $currentEvent->save();
        $previousEvent->save();

        // Log user action
        Log::channel('custom_log')->info('EventRankUp: User ID ' . Auth::user()->user_id . ' moved up Event ID ' . $id);

        return back()->with('success', 'Event moved up successfully.');
    }

    public function rankDown($id)
    {
        if (Auth::user()->controller_role == 'General') return back()->with('error', 'Invalid link!');

        $currentEvent = Events::find($id);
        if (!$currentEvent) {
            return back()->with('error', 'Event not found.');
        }

        $nextEvent = Events::where('rank', '>', $currentEvent->rank)->orderBy('rank', 'asc')->first();
        if (!$nextEvent) {
            return back()->with('info', 'This Event is already at the bottom.');
        }

        $currentRank = $currentEvent->rank;
        $currentEvent->rank = $nextEvent->rank;
        $nextEvent->rank = $currentRank;

        $currentEvent->save();
        $nextEvent->save();

        // Log user action
        Log::channel('custom_log')->info('EventRankDown: User ID ' . Auth::user()->user_id . ' moved down Event ID ' . $id);

        return back()->with('success', 'Event moved down successfully.');
    }

    // Private method to handle file uploads
    private function handleFileUpload($file)
    {
        $folder = DeptAttributes::first()->folder_name;
        $filename = "events_" . date('YmdHis') . "_" . uniqid() . "." . $file->getClientOriginalExtension();
        if (!$file->move(public_path('../../' . $folder . '/assets/img/Events'), $filename)) {
            throw new \Exception('Failed to upload file.');
        }
        return $filename;
    }
}
