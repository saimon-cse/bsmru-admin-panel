<?php

namespace App\Http\Controllers;

use App\Models\Notices;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\DeptAttributes;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;

class NoticeController extends Controller
{
    /*=================================================
    ----------          Notices          -----------
    ===================================================*/

    // Add Notice
    public function create(Request $request)
    {
        if (Auth::user()->controller_role == 'General') abort(404, 'Page not found');

        $types = DB::table('types')->where('category', "=", 'notice')->orderBy('rank')->get();
        $id = Auth::user()->id;
        $profileData = User::find($id);
        $dept = DeptAttributes::first();
        return view('admin.addnotice', compact('profileData', 'types', 'dept'));
    }

    // Store Notice
    public function store(Request $request)
    {
        $id = Auth::user()->user_id;

        $request->validate([
            'not_date' => 'required|date',
            'not_title' => 'required|max:150|string',
            'not_type' => 'required|string',
            'not_file' => 'nullable|file|mimes:pdf,png,jpg,doc,docx|max:2048', // Validate file types and size
            'message' => 'nullable|string|max:500'
        ]);

        Notices::query()->increment('rank');

        $notices = new Notices();
        $notices->not_date = $request->not_date;
        $notices->not_title = strip_tags($request->not_title);
        $notices->not_type = $request->not_type;
        $notices->not_des = $request->message;  // Ensure the notice description is saved
        $notices->rank = 1;

        // Call the file upload handler
        $notices->not_file = $this->handleFileUpload($request->file('not_file'));

        $notices->save();

        // Log user action
        Log::channel('custom_log')->info('AdminNoticeStore: User ID ' . $id . ' added a new notice.');

        return redirect()->route('notice.index')->with('success', 'Notice Added');
    }

    // Update Notice
    public function index(Request $request)
    {
        if (Auth::user()->controller_role == 'General') abort(404, 'Page not found');

        $id = Auth::user()->id;
        $profileData = User::find($id);
        $dept = DB::table('dept_attributes')->first();

        $notices = DB::table('notices')->orderBy('rank')->paginate(15);
        return view('admin.updatenotice', compact('profileData', 'notices', 'dept'));
    }

    // Edit Notice
    public function show($notice)
    {
        if (Auth::user()->controller_role == 'General') return back()->with('error', 'Invalid link!');

        $types = DB::table('types')->where('category', "=", 'notice')->orderBy('rank')->get();
        $profileData = User::find(Auth::user()->id);

        $notice = DB::table('notices')->find($notice);
        $dept = DeptAttributes::first();
        if (!$notice) {
            return redirect()->back()->with('error', 'Notice not found.');
        }

        return view('admin.editNotice', compact('profileData', 'notice', 'types', 'dept'));
    }

    // Store Edited Notice
    public function update(Request $request, $noticeId)
    {
        $notice = Notices::find($noticeId);
        if (!$notice) {
            return redirect()->back()->with('error', 'Notice not found.');
        }

        $request->validate([
            'not_date' => 'required|date',
            'not_title' => 'required|max:150|string',
            'not_type' => 'required|string',
            'not_file' => 'nullable|file|mimes:pdf,png,jpg,doc,docx|max:2048', // Validate file types and size
            'message' => 'nullable|string|max:500'
        ]);

        // Update fields
        $notice->not_date = $request->not_date;
        $notice->not_title = strip_tags($request->not_title);
        $notice->not_type = $request->not_type;
        $notice->not_des = $request->message;

        // Handle file upload only if a new file is provided
        if ($request->file('not_file')) {
            $notice->not_file = $this->handleFileUpload($request->file('not_file'));
        }

        $notice->save();

        Log::channel('custom_log')->info('AdminNoticeEdited: User ID ' . Auth::user()->user_id . ' edited notice ID ' . $notice->id);

        return redirect()->route('notice.index')->with('success', 'Notice Edited');
    }

    // Delete Notice
    public function destroy($notice)
    {
        $dept = DB::table('dept_attributes')->first()->folder_name;
        if (Auth::user()->controller_role == 'General')  abort(403);

        $notice = Notices::find($notice);
        if (!$notice) {
            return redirect()->back()->with('error', 'Notice not found.');
        }

        Notices::where('rank', ">", $notice->rank)->decrement("rank",1);

        if ($notice->not_file && File::exists(public_path('../../' . $dept . '/assets/Files/' . $notice->not_file))) {
            File::delete(public_path('../../' . $dept . '/assets/Files/' . $notice->not_file));
        }

        $notice->delete();
        // $remainingNotices = Notices::orderBy('rank', 'asc')->get();

        // foreach ($remainingNotices as $index => $remainingNotice) {
        //     $remainingNotice->rank = $index + 1;
        //     $remainingNotice->save();
        // }

        // Log user action
        Log::channel('custom_log')->info('NoticeDelete: User ID ' . Auth::user()->user_id . ' deleted notice ID ' . $notice->id);

        return redirect()->back()->with('success', 'Notice successfully deleted and ranks updated.');
    }

    // Move Notice Rank Up
    public function rankUp($id)
    {
        if (Auth::user()->controller_role == 'General') return back()->with('error', 'Invalid link!');

        $currentNotice = Notices::find($id);
        if (!$currentNotice) {
            return back()->with('error', 'Notice not found.');
        }

        $previousNotice = Notices::where('rank', '<', $currentNotice->rank)->orderBy('rank', 'desc')->first();
        if (!$previousNotice) {
            return back()->with('info', 'This notice is already at the top.');
        }

        $currentRank = $currentNotice->rank;
        $currentNotice->rank = $previousNotice->rank;
        $previousNotice->rank = $currentRank;

        $currentNotice->save();
        $previousNotice->save();

        // Log user action
        Log::channel('custom_log')->info('noticeRankUp: User ID ' . Auth::user()->user_id . ' moved up notice ID ' . $id);

        return back()->with('success', 'Notice moved up successfully.');
    }

    // Move Notice Rank Down
    public function rankDown($id)
    {
        if (Auth::user()->controller_role == 'General') return back()->with('error', 'Invalid link!');

        $currentNotice = Notices::find($id);
        if (!$currentNotice) {
            return back()->with('error', 'Notice not found.');
        }

        $nextNotice = Notices::where('rank', '>', $currentNotice->rank)->orderBy('rank', 'asc')->first();
        if (!$nextNotice) {
            return back()->with('info', 'This notice is already at the bottom.');
        }

        $currentRank = $currentNotice->rank;
        $currentNotice->rank = $nextNotice->rank;
        $nextNotice->rank = $currentRank;

        $currentNotice->save();
        $nextNotice->save();

        // Log user action
        Log::channel('custom_log')->info('noticeRankDown: User ID ' . Auth::user()->user_id . ' moved down notice ID ' . $id);

        return back()->with('success', 'Notice moved down successfully.');
    }

    // Handle File Upload
    private function handleFileUpload($file)
    {
        $folder = DeptAttributes::first()->folder_name;
        $filename = "notice_" . date('YmdHis') . "_" . uniqid() . "." . $file->getClientOriginalExtension();
        if (!$file->move(public_path('../../' . $folder . '/assets/Files'), $filename)) {
            throw new \Exception('Failed to upload file.');
        }
        return $filename;
    }
}
