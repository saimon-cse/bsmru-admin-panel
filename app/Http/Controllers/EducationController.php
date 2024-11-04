<?php

namespace App\Http\Controllers;

use App\Models\Educations;
use App\Models\User;
use App\Models\DeptAttributes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EducationController extends Controller
{
    /*====================================================
                ------Education-----
    ====================================================*/

    // Add Education page
    public function create()
    {
        $profileData = User::find(Auth::user()->id);
        $dept = DeptAttributes::first();
        return view('admin.EducationAdd', compact('profileData', 'dept'));
    }

    // Show all education
    public function index()
    {
        $profileData = User::find(Auth::user()->id);
        $educations = Educations::where('user', Auth::user()->user_id)->orderBy('rank')->paginate(10);
        $dept = DeptAttributes::first();
        return view('admin.educationAll', compact('profileData', 'educations', 'dept'));
    }

    // Store education
    public function store(Request $request)
    {
        // Validate and sanitize inputs
        $request->validate([
            'degree' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'passYear' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
        ]);

        try {
            Educations::where('user', Auth::user()->user_id)->increment('rank');

            $education = new Educations;
            $education->degree = htmlspecialchars($request->degree);
            $education->institution = htmlspecialchars($request->institution);
            $education->passYear = $request->passYear;
            $education->user = Auth::user()->user_id; // Ensuring correct user assignment
            $education->rank = 1;
            $education->save();

            return redirect()->route('educations.index')->with('success', 'Education added successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to add education: ' );
            return redirect()->back()->with('error', 'Failed to add education.');
        }
    }

    // Edit education
    public function edit($education)
    {
        $profileData = User::find(Auth::user()->id);
        $education = Educations::find($education);

        if (!$education || $education->user != Auth::user()->user_id) {
            return redirect()->back()->with('error', 'Education not found.');
        }

        $dept = DeptAttributes::first();
        return view('admin.educationEdit', compact('profileData', 'education', 'dept'));
    }

    // Update edited education
    public function update(Request $request, $education)
    {
        // Validate and sanitize inputs
        $request->validate([
            'degree' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'passYear' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
        ]);

        try {
            $education = Educations::find($education);

            if (!$education || $education->user != Auth::user()->user_id) {
                return redirect()->back()->with('error', 'Education not found.');
            }

            $education->degree = htmlspecialchars($request->degree);
            $education->institution = htmlspecialchars($request->institution);
            $education->passYear = $request->passYear;
            $education->save();

            return redirect()->route('educations.index')->with('success', 'Education updated successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to update education: ' );
            return redirect()->back()->with('error', 'Failed to update education.');
        }
    }

    // Delete education
    public function destroy($education)
    {
        try {
            $education = Educations::find($education);

            if (!$education || $education->user != Auth::user()->user_id) {
                return redirect()->back()->with('error', 'Education not found.');
            }

            // Decrement rank of all educations ranked higher than the one being deleted
            Educations::where('user', Auth::user()->user_id)->where('rank', ">", $education->rank)->decrement('rank', 1);
            $education->delete();

            return redirect()->back()->with('success', 'Education deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to delete education: ' );
            return redirect()->back()->with('error', 'Failed to delete education.');
        }
    }

    public function rankUp($id)
    {
        $current = Educations::find($id);
        if (!$current) {
            return back()->with('error', 'Education not found.');
        }

        $previous = Educations::orderBy('rank', 'desc')
            ->where('user', Auth::user()->user_id)
            ->where('rank', "<", $current->rank)
            ->first();

        if (!$previous) {
            return back()->with('info', 'This Education is already at the top.');
        }

        // Swap ranks
        $rank = $current->rank;
        $current->rank = $previous->rank;
        $previous->rank = $rank;

        $current->save();
        $previous->save();

        // Log user action
        Log::info('EducationRankUp: User ID ' . Auth::user()->user_id . ' moved up Education ID ' . $id);

        return back()->with('success', 'Education moved up successfully.');
    }

    public function rankDown($id)
    {
        $current = Educations::find($id);
        if (!$current) return back()->with('error', 'Education not found.');

        $next = Educations::orderBy('rank', 'asc')
            ->where('user', Auth::user()->user_id)
            ->where('rank', ">", $current->rank)
            ->first();

        if (!$next) return back()->with('info', 'This education is already at the bottom.');

        // Swap ranks
        $rank = $current->rank;
        $current->rank = $next->rank;
        $next->rank = $rank;

        $current->save();
        $next->save();

        // Log user action
        Log::info('EducationRankDown: User ID ' . Auth::user()->user_id . ' moved down Education ID ' . $id);

        return back()->with('success', 'Education moved down successfully.');
    }
}
