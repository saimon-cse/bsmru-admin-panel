<?php

namespace App\Http\Controllers;

use App\Models\Award;
use App\Models\DeptAttributes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AwardController extends Controller
{
    /*====================================================
                ------ -Awards-----
    ====================================================*/

    // Add award page
    public function create()
    {
        $profileData = User::find(Auth::user()->id);
        $dept = DeptAttributes::first();
        return view('admin.awardAdd', compact('profileData', 'dept'));
    }

    // Show all awards
    public function index()
    {
        $profileData = User::find(Auth::user()->id);
        $awards = Award::orderBy('rank')->where('user', Auth::user()->user_id)->paginate(10);
        $dept = DeptAttributes::first();
        return view('admin.awardAll', compact('profileData', 'awards', 'dept'));
    }

    // Store award
    public function store(Request $req)
    {
        // Validate and sanitize inputs
        $req->validate([
            'type' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'year' => 'required|digits:4|integer|min:1900|max:' . (date('Y')),
            'country' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        try {
            // Increment rank for existing awards
            Award::where('user', "=", Auth::user()->user_id)->increment('rank');

            // Create new award
            $award = new Award;
            $award->type = htmlspecialchars($req->type);
            $award->title = htmlspecialchars($req->title);
            $award->year = $req->year;
            $award->country = htmlspecialchars($req->country);
            $award->user = Auth::user()->user_id; // Ensuring correct user assignment
            $award->description = htmlspecialchars($req->description);
            $award->rank = 1;
            $award->save();

            return redirect()->route('awards.index')->with('success', 'Award added successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to add award: ' );
            return redirect()->back()->with('error', 'Failed to add award.');
        }
    }

    // Edit award
    public function edit($award)
    {
        $profileData = User::find(Auth::user()->id);
        $award = Award::find($award);

        if (!$award || $award->user != Auth::user()->user_id) {
            return redirect()->back()->with('error', 'Award not found.');
        }

        $dept = DeptAttributes::first();
        return view('admin.awardSingle', compact('award', 'profileData', 'dept'));
    }

    // Update edited award
    public function update(Request $request, $award)
    {
        // Validate and sanitize inputs
        $request->validate([
            'type' => 'required|string|max:255|min:4',
            'title' => 'required|string|max:255|min:4',
            'year' => 'required|digits:4|integer|min:1900|max:' . (date('Y')),
            'country' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        try {
            $award = Award::find($award);

            if (!$award || $award->user != Auth::user()->user_id) {
                return redirect()->back()->with('error', 'Award not found.');
            }

            $award->title = htmlspecialchars($request->title);
            $award->type = htmlspecialchars($request->type);
            $award->year = $request->year;
            $award->country = htmlspecialchars($request->country);
            $award->description = htmlspecialchars($request->description);
            $award->save();

            return redirect()->route('awards.index')->with('success', 'Award updated successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to update award: ' );
            return redirect()->back()->with('error', 'Failed to update award.');
        }
    }

    // Delete award
    public function destroy($award)
    {
        try {
            $award = Award::find($award);
            if (!$award || $award->user != Auth::user()->user_id) {
                return redirect()->back()->with('error', 'Award not found.');
            }

            // Decrement rank of all awards ranked higher than the one being deleted
            Award::where('user', "=", Auth::user()->user_id)->where('rank', ">", $award->rank)->decrement('rank', 1);
            $award->delete();

            return redirect()->back()->with('success', 'Award deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to delete award: ' );
            return redirect()->back()->with('error', 'Failed to delete award.');
        }
    }

    // Rank up
    public function rankUp($id)
    {
        $current = Award::find($id);
        if (!$current) {
            return back()->with('error', 'Award not found.');
        }

        $previous = Award::orderBy('rank', 'desc')
            ->where('user', "=", Auth::user()->user_id)
            ->where('rank', "<", $current->rank)
            ->first();

        if (!$previous) {
            return back()->with('info', 'This Award is already at the top.');
        }

        // Swap ranks
        $rank = $current->rank;
        $current->rank = $previous->rank;
        $previous->rank = $rank;

        $current->save();
        $previous->save();

        Log::info('AwardRankUp: User ID ' . Auth::user()->user_id . ' moved up Award ID ' . $id);

        return back()->with('success', 'Award moved up successfully.');
    }

    // Rank down
    public function rankDown($id)
    {
        $current = Award::find($id);
        if (!$current) {
            return back()->with('error', 'Award not found.');
        }

        $next = Award::orderBy('rank', 'asc')
            ->where('user', "=", Auth::user()->user_id)
            ->where('rank', ">", $current->rank)
            ->first();

        if (!$next) {
            return back()->with('info', 'This Award is already at the bottom.');
        }

        // Swap ranks
        $rank = $current->rank;
        $current->rank = $next->rank;
        $next->rank = $rank;

        $current->save();
        $next->save();

        Log::info('AwardRankDown: User ID ' . Auth::user()->user_id . ' moved down Award ID ' . $id);

        return back()->with('success', 'Award moved down successfully.');
    }
}
