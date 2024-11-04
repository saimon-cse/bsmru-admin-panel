<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FileRepositoryRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\File;
use Illuminate\Support\Facades\Storage;
use App\Models\DeptAttributes;
use App\Models\FileRepository;


class FileRepositoryController extends Controller
{


    private function userinfo() {
        return User::find(Auth::user()->id);

    }

    public function index(Request $request){
        $profileData = User::find(Auth::user()->id);
        $dept = DeptAttributes::first();

        $search = $request->input('search');

        $files = FileRepository::query();

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
                        $files->where(function ($query) use ($term) {
                            $query->where('degree_id', 'LIKE', "%{$term}%")
                                ->orWhere('year', 'LIKE', "%{$term}%")
                                ->orWhere('semester', 'LIKE', "%{$term}%")
                                ->orWhere('title', 'LIKE', "%{$term}%")
                                ->orWhere('upload_year',$term)
                                ->orWhere('session', 'LIKE', "%{$term}%");
                        });
                        $firstCondition = false;
                    } else {
                        if ($operator === 'AND') {
                            $files->where(function ($query) use ($term) {
                                $query->where('degree_id', 'LIKE', "%{$term}%")
                                    ->orWhere('year', 'LIKE', "%{$term}%")
                                    ->orWhere('semester', 'LIKE', "%{$term}%")
                                    ->orWhere('title', 'LIKE', "%{$term}%")
                                    ->orWhere('session', 'LIKE', "%{$term}%")
                                    ->orWhere('upload_year',$term);
                            });
                        } elseif ($operator === 'OR') {
                            $files->orWhere(function ($query) use ($term) {
                                $query->where('degree_id', 'LIKE', "%{$term}%")
                                    ->orWhere('year', 'LIKE', "%{$term}%")
                                    ->orWhere('semester', 'LIKE', "%{$term}%")
                                    ->orWhere('title', 'LIKE', "%{$term}%")
                                    ->orWhere('session', 'LIKE', "%{$term}%")
                                    ->orWhere('upload_year',$term );
                            });
                        }
                    }
                }
            }
        }

        $files = $files->orderByDesc('created_at')->paginate(15);

        return view('admin.fileRepo.index', compact('profileData', 'search', 'files', 'dept'));
    }

    public function create(){
        $profileData = $this->userinfo();
        $dept = DeptAttributes::first();
        return view("admin.fileRepo.create",compact("profileData",'dept'));
    }

    public function store(FileRepositoryRequest $request){

        $file = new FileRepository();

        $file->degree_id = $request->degree;
        $file->year = $request->year;
        $file->semester = $request->semester;
        $file->title = $request->title;
        $file->session = $request->session;
        $file->upload_year = $request->uploadYear;
        $file->file = $this->handleFileUpload($request->file('file'));
        if(FileRepository::latest()->first())
             $file->rank = FileRepository::latest()->first()->rank + 1;
        else $file->rank = 1;
        $file->save();

        return redirect()->route('filerepository.index')->with('success','File Added Successfully.');


    }

    Public function show($file){

    }
    public function update(FileRepositoryRequest $request){

    }


    public function destroy(){

    }


    // private function handleFileUpload($file)
    // {
    //     $filename = 'upload/fileRepository/' . date('YmdHis') . "_" . preg_replace('/\s+/', '_', $file->getClientOriginalName());
    //     if (!Storage::disk('local')->put($filename, file_get_contents($file))) {
    //         throw new \Exception('Failed to upload file.');
    //     }
    //     return $filename;
    // }

    private function handleFileUpload($file)
{
    $filename = 'upload/fileRepository/' . date('YmdHis') . "_" . preg_replace('/\s+/', '_', $file->getClientOriginalName());
    if (!Storage::disk('local')->put($filename, file_get_contents($file))) {
        throw new \Exception('Failed to upload file.');
    }
    return $filename;
}


}
