<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use app\Models\User;
use App\Models\Events;
use App\Models\Carousel;
use App\Models\Educations;
use App\Models\Award;
use App\Models\Experience;
use App\Models\OtherExperience;
use App\Models\ResearchProfile;
use App\Models\Publications;
use App\Models\QuestionBank;
use App\Models\DeptAttributes;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
// use app\Models\Notces;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Route;
// use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\File;

class PublicationController extends Controller
{
  /*====================================================
    ------ -publication-----
    ====================================================*/

    //Add publication page ----> Journal Article


    // Add a new publication
    public function create()
    {
        // if (Auth::user()->controller_role == 'Staff') return back()->with('error', 'Invalid link!');

        $profileData = User::find(Auth::user()->id);
        $types = DB::table('types')->where('category', "=", 'publication')->get();
        $dept = DeptAttributes::first();
        return view('admin.addPublication', compact('profileData', 'types','dept'));
    }

    // Store a new publication
    public function store(Request $request)
    {
        try {
            Publications::where('user', "=", Auth::user()->user_id)->where('type', "=", $request->paperType)->increment('rank');
            $publication = new Publications();
            // $P_id = User::find(Auth::user()->user_id); //profile id
            $publication->user = $request->user;
            $publication->description = $request->message;
            $publication->type = $request->paperType;
            $publication->rank = 1;
            $publication->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to store publication.');
        }

        return redirect()->route('publications.index')->with('success', 'Publication added successfully.');
    }

    // Edit a publication
    public function show($publication)
    {
        // if (Auth::user()->controller_role == 'Staff') return back()->with('error', 'Invalid link!');

        $profileData = User::find(Auth::user()->id);
        $types = DB::table('types')->where('category', "=", 'publication')->get();

        $publication = Publications::find($publication);
        if (!$publication) {
            return redirect()->back()->with('error', 'Publication not found.');
        }
        if ($publication->user != Auth::user()->user_id) {
            return redirect()->back();
        }
        $dept = DeptAttributes::first();

        return view('admin.updatePublication', compact('profileData', 'publication','dept','types'));
    }

    // Edit a publication
    public function update(Request $request, $publication)
    {
        $publication = Publications::find($publication);
        if (!$publication) {
            return redirect()->back()->with('error', 'Publication not found.');
        }

        $publication->description = $request->message;
        $publication->user = Auth::user()->user_id;
        // $publication->type = $request->paperType;

        try {
            $publication->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update publication.');
        }

        return redirect()->route('publications.index')->with('success', 'Publication updated successfully.');
    }

    // Delete a publication
    public function destroy($publications)
    {
        // if (Auth::user()->controller_role == 'Staff') return back()->with('error', 'Invalid link!');

        $publication = Publications::find($publications);
        if (!$publication) {
            return redirect()->back()->with('error', 'Publication not found.');
        }

        try {

            Publications::where('user', "=", Auth::user()->user_id)->where('type', "=", $publication->type)
                ->where('rank', ">", $publication->rank)->decrement('rank');
            $publication->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e);
        }

        return redirect()->back()->with('success', 'Publication deleted successfully.');
    }

    // // Show all publications
    // public function AllPublication()
    // {
    //     // if (Auth::user()->controller_role == 'Staff') return back()->with('error', 'Invalid link!');

    //     $profileData = User::find(Auth::user()->id);
    //     $types = DB::table('types')->where('category', "=", 'publication')->get();
    //     $publications = DB::table('publications')->where('user', "=", Auth::user()->user_id)->orderBy('rank')->paginate(20);
    //     $size = sizeof($types);

    //     foreach($types as $type){
    //         $publications = DB::table('publications')->where('user', "=", Auth::user()->user_id)->where('type',"=",$type)->orderBy('rank')->paginate(20);
    //     }
    //     $dept = DeptAttributes::first();
    //     // $conferences = DB::table('publications')->where('user', "=", Auth::user()->user_id)->where('type', "=",'conference')->orderByDesc('created_at')->paginate(10);
    //     return view('admin.allPublication', compact('profileData', 'publications', 'types','dept'));
    // }


    public function index()
    {
        // Retrieve the logged-in user's data
        $profileData = User::find(Auth::user()->id);

        // Fetch all types where the category is 'publication'
        $types = DB::table('types')->where('category', "=", 'publication')->get();

        // Create an empty array to hold publications grouped by their types
        $publicationsByType = [];

        // Loop through each type and fetch publications for that specific type
        $sl=1;
        foreach ($types as $type) {
            // Paginate each type's publications separately
            $publicationsByType[$type->title] = DB::table('publications')
                ->where('user', "=", Auth::user()->user_id)
                ->where('type', "=", $type->title)
                ->orderBy('rank')
                ->paginate(15, ['*'], 'page_' . $sl++); // Use a unique pagination parameter for each type
        }

        // Fetch the department attributes (if any)
        $dept = DeptAttributes::first();

        // Return the view with grouped publications and other data
        return view('admin.allPublication', compact('profileData', 'publicationsByType', 'types', 'dept'));
    }




    public function rankUp($id)
    {
        // if (Auth::user()->controller_role == 'Staff') return back()->with('error', 'Invalid link!');

        $current = Publications::find($id);;
        if (!$current) {
            return back()->with('error', 'Publication not found.');
        }

        $previous = Publications::orderBy('rank', 'desc')->where('type', "=", $current->type)
            ->where('user', "=", Auth::user()->user_id)->where('rank', "<", $current->rank)->first();
        if (!$previous) {
            return back()->with('info', 'This Publication is already at the top.');
        }

        $rank = $current->rank;
        $current->rank = $previous->rank;
        $previous->rank = $rank;
        $current->save();
        $previous->save();

        // Log user action
        Log::channel('custom_log')->info('PublicationRankUp: User ID ' . Auth::user()->user_id . ' moved up Publication ID ' . $id);

        return back()->with('success', 'Publication moved up successfully.');
    }


    public function rankDown($id)
    {
        // if (Auth::user()->controller_role == 'Staff') return back()->with('error', 'Invalid link!');

        $current = Publications::find($id);
        if (!$current) {
            return back()->with('error', 'Publication not found.');
        }

        $next = Publications::where('rank', ">", $current->rank)->where('type', "=", $current->type)
            ->where('user', "=", Auth::user()->user_id)->orderBy('rank', 'asc')->first();
        if (!$next) {
            return back()->with('info', 'This Publication is already at the bottom.');
        }

        $rank = $current->rank;
        $current->rank = $next->rank;
        $next->rank = $rank;
        $current->save();
        $next->save();

        // Log user action
        Log::channel('custom_log')->info('PublicationRankDown: User ID ' . Auth::user()->user_id . ' moved down Publication ID ' . $id);

        return back()->with('success', 'Publication moved down successfully.');
    }



}
