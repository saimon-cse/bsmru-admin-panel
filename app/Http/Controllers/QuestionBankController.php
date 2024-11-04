<?php

namespace App\Http\Controllers;


use App\Models\Notices;
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
use Exception;
// use app\Models\Notces;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Route;
// use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\File;


class QuestionBankController extends Controller
{
    //


    public function create()
    {

        if (Auth::user()->controller_role == 'General') return back()->with('error', 'Invalid link!');
        $profileData = User::find(Auth::user()->id);
        $types = DB::table('types')->where('category', "=", 'Question Bank')->get();
        $dept = DeptAttributes::first();
        return view('admin.addQuestion', compact('profileData', 'types','dept'));
    }


    // public function store(Request $req)
    // {
    //     QuestionBank::query()->increment('rank');
    //     $question = new QuestionBank;
    //     $question->year = $req->year;
    //     $question->semester = $req->semester;
    //     $question->title = $req->title;
    //     $question->type = $req->type;
    //     $question->session = $req->session;
    //     $question->exam_year = $req->exam_year;
    //     $question->rank = 1;
    //     $question->degree_id = $req->degree;

    //     $dept = DB::table('dept_attributes')->first()->folder_name;

    //     if ($req->file('file')) {
    //         $file = $req->file('file');
    //         $filename = "Question_" . date('YmdHis') . "_" . (QuestionBank::max('id') + 100001) . "." . $file->getClientOriginalExtension();
    //         $file->move(public_path('../../' . $dept . '/assets/Files/questions/'), $filename);
    //         $question->file = $filename;
    //     }

    //     $question->save();
    //     return redirect()->route('questionPaper.index')->with('success', 'Question paper Added');
    // }

    public function store(Request $req)
{
    $req->validate([
        'title' => 'required|string|max:255',
        'session' => 'required|string|max:11',
        'exam_year' => 'required|integer|digits:4|max:'.(date('Y')),
        'file' => 'nullable|file|mimes:pdf,doc,docx,png,jpg|max:10240',
    ]);

    QuestionBank::query()->increment('rank');
    $question = new QuestionBank;

    // Using strip_tags to sanitize inputs
    $question->year = strip_tags($req['year']);
    $question->semester = strip_tags($req['semester']);
    $question->title = strip_tags($req['title']);
    $question->type = strip_tags($req['type']);
    $question->session = strip_tags($req['session']);
    $question->exam_year = strip_tags($req['exam_year']);
    $question->degree_id = strip_tags($req['degree']);
    $question->rank = 1;

    $dept = DB::table('dept_attributes')->first()->folder_name;

    if ($req->file('file')) {
        $file = $req->file('file');
        $filename = "Question_" . date('YmdHis') . "_" . (QuestionBank::max('id') + 100001) . "." . $file->getClientOriginalExtension();
        $file->move(public_path('../../' . $dept . '/assets/Files/questions/'), $filename);
        $question->file = $filename;
    }

    $question->save();
    return redirect()->route('questionPaper.index')->with('success', 'Question paper Added');
}

    public function index(Request $request)
    {
        $profileData = User::find(Auth::user()->id);
        $dept = DB::table('dept_attributes')->first();

        $search = $request->input('search');

        $questions = QuestionBank::query();

        if ($search) {
            // Split the search input by AND/OR using regex
            $searchTerms = preg_split('/\s+(AND|OR)\s+/i', $search, -1, PREG_SPLIT_DELIM_CAPTURE);

            // Initialize variables for constructing the query
            $operator = 'AND'; // Default operator
            $firstCondition = true;

            foreach ($searchTerms as $key => $term) {
                // Trim spaces and uppercase the operator
                $term = trim($term);
                if (strcasecmp($term, 'AND') === 0 || strcasecmp($term, 'OR') === 0) {
                    // Set operator for the next condition
                    $operator = strtoupper($term);
                } else {
                    // Apply condition based on the current operator
                    if ($firstCondition) {
                        $questions->where(function ($query) use ($term) {
                            $query->where('degree_id', 'LIKE', "%{$term}%")
                                ->orWhere('year', 'LIKE', "%{$term}%")
                                ->orWhere('semester', 'LIKE', "%{$term}%")
                                ->orWhere('title', 'LIKE', "%{$term}%")
                                ->orWhere('type', 'LIKE', "%{$term}%");
                        });
                        $firstCondition = false;
                    } else {
                        if ($operator === 'AND') {
                            $questions->where(function ($query) use ($term) {
                                $query->where('degree_id', 'LIKE', "%{$term}%")
                                    ->orWhere('year', 'LIKE', "%{$term}%")
                                    ->orWhere('semester', 'LIKE', "%{$term}%")
                                    ->orWhere('title', 'LIKE', "%{$term}%")
                                    ->orWhere('type', 'LIKE', "%{$term}%");
                            });
                        } elseif ($operator === 'OR') {
                            $questions->orWhere(function ($query) use ($term) {
                                $query->where('degree_id', 'LIKE', "%{$term}%")
                                    ->orWhere('year', 'LIKE', "%{$term}%")
                                    ->orWhere('semester', 'LIKE', "%{$term}%")
                                    ->orWhere('title', 'LIKE', "%{$term}%")
                                    ->orWhere('type', 'LIKE', "%{$term}%");
                            });
                        }
                    }
                }
            }
        }

        $questions = $questions->orderBy('rank')->paginate(15);

        return view('admin.allQuestion', compact('profileData', 'search', 'questions', 'dept'));
    }




    public function edit($questionPaper)
    {
        if (Auth::user()->controller_role == 'General') return back()->with('error', 'Invalid link!');
      try{
        $profileData = User::find(Auth::user()->id);

        $question = QuestionBank::find($questionPaper);
        $types = DB::table('types')->where('category', "=", 'Question Bank')->get();
        $dept = DeptAttributes::first();
        return view('admin.editQuestion', compact('profileData', 'question', 'types','dept'));
      }catch(Exception $e){
        return back();
      }
    }

    // public function update(Request $req, $questionPaper)
    // {
    //     $question = QuestionBank::find($questionPaper);

    //     $question->year = $req->year;
    //     $question->semester = $req->semester;
    //     $question->title = $req->title;
    //     $question->degree_id = $req->degree;
    //     $question->session = $req->session;
    //     $question->exam_year = $req->exam_year;
    //     $dept = DB::table('dept_attributes')->first()->folder_name;
    //     if ($req->file('file')) {
    //         $file = $req->file('file');
    //         $filename = "Question_" . date('YmdHis') . "_" . (QuestionBank::max('id') + 100001) . "." . $file->getClientOriginalExtension();
    //         $file->move(public_path('../../' . $dept . '/assets/Files/questions/'), $filename);
    //         $question->file = $filename;
    //     }

    //     $question->save();

    //     return redirect()->route('questionPaper.index')->with('success', 'Successfully Edited!');
    // }



    public function update(Request $req, $questionPaper)
{
     $req->validate([
        'title' => 'required|string|max:255',
        'session' => 'required|string|max:11',
        'exam_year' => 'required|integer|digits:4|max:'.(date('Y')),
        'file' => 'required|file|mimes:pdf,doc,docx,jpg,png|max:10240',
    ]);

    $question = QuestionBank::find($questionPaper);

    // Using strip_tags to sanitize inputs
    $question->year = strip_tags($req['year']);
    $question->semester = strip_tags($req['semester']);
    $question->title = strip_tags($req['title']);
    $question->type = strip_tags($req['type']);
    $question->session = strip_tags($req['session']);
    $question->exam_year = strip_tags($req['exam_year']);
    $question->degree_id = strip_tags($req['degree']);

    $dept = DB::table('dept_attributes')->first()->folder_name;
    if ($req->file('file')) {
        $file = $req->file('file');
        $filename = "Question_" . date('YmdHis') . "_" . (QuestionBank::max('id') + 100001) . "." . $file->getClientOriginalExtension();
        $file->move(public_path('../../' . $dept . '/assets/Files/questions/'), $filename);
        $question->file = $filename;
    }

    $question->save();

    return redirect()->route('questionPaper.index')->with('success', 'Successfully Edited!');
}

    public function destroy($questionPaper)
    {
        $dept = DB::table('dept_attributes')->first()->folder_name;
        if (Auth::user()->controller_role == 'General')  abort(403);

        $question = QuestionBank::find($questionPaper);

        if (!$question) {
            return redirect()->back()->with('error', 'Question not found.');
        }
        QuestionBank::where('rank', ">", $question->rank)->decrement("rank",1);

        if ($question->file && File::exists(public_path('../../' . $dept . '/assets/Files/questions/' . $question->file))) {
            File::delete(public_path('../../' . $dept . '/assets/Files/questions/' . $question->file));
        }

        $question->delete();
        // $remainingquestions = QuestionBank::orderBy('rank', 'asc')->get();

        // foreach ($remainingquestions as $index => $remainingquestion) {
        //     $remainingquestion->rank = $index + 1;
        //     $remainingquestion->save();
        // }



        // Log user action
        Log::channel('custom_log')->info('QuestionDelete: User ID ' . Auth::user()->user_id . ' deleted Question ID ' . $questionPaper);

        return redirect()->back()->with('success', 'Question successfully deleted.');
    }




}
