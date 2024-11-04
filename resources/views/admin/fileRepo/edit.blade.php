
@section('title', 'Edit Question')

@extends('admin.dashboard')

@section('admin')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Questions papers</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Academic</li>
                    <li class="breadcrumb-item">Question</li>

                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Question</h5>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-1"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-octagon me-1"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif (session('info'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <i class="bi bi-info-circle me-1"></i>
                        {{ session('info') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('questionPaper.update', ['questionPaper'=>$question->id]) }}" enctype="multipart/form-data" onsubmit="sanitizeInputs()">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <label for="degree" class="col-sm-2 col-form-label">Degree</label>
                        <div class="col-sm-2">
                            <select class="form-select" name="degree" aria-label="Select Degree">
                                <option value="1" @if( $question->degree_id== 1) selected @endif> Bachelor</option>
                                <option value="2" @if( $question->degree_id== 2) selected @endif>Masters</option>
                                <option value="3" @if( $question->degree_id== 3) selected @endif>Postdoctoral</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="year" class="col-sm-2 col-form-label">Year</label>
                        <div class="col-sm-2">
                            <select class="form-select" name="year" aria-label="Select Year">
                                <option value="First Year" @if( $question->year=='First Year') selected @endif >First Year</option>
                                <option value="Second Year" @if( $question->year=='Second Year') selected @endif>Second Year</option>
                                <option value="Third Year" @if( $question->year=='Third Year') selected @endif>Third Year</option>
                                <option value="Fourth Year" @if( $question->year=='Fourth Year') selected @endif>Fourth Year</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="semester" class="col-sm-2 col-form-label">Semester</label>
                        <div class="col-sm-2">
                            <select class="form-select" name="semester" aria-label="Select Semester">
                                <option value="Semester-1" @if( $question->semester=='Semester-1') selected @endif>Semester-1</option>
                                <option value="Semester-2" @if( $question->semester=='Semester-2') selected @endif>Semester-2</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="title" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ $question->title }}" name="title" placeholder="Enter Title" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="type" class="col-sm-2 col-form-label">Type</label>
                        <div class="col-sm-10">
                            <select class="form-select" name="type" aria-label="Select Type">
                                @foreach ($types as $type)
                                    <option value="{{ $type->title }}" @if( $question->type==$type->title) selected @endif>{{ $type->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="session" class="col-sm-2 col-form-label">Session</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{ $question->session }}" name="session" placeholder="Enter Session" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="exam_year" class="col-sm-2 col-form-label">Exam Year</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="exam_year" value="{{ $question->exam_year }}" placeholder="Enter Exam Year" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="file" class="col-sm-2 col-form-label">Change File</label>
                        <div class="col-sm-10">
                            @if ($question->file)
                                {{-- <p>{{ $question->file }}</p> --}}
                                <input accept=".pdf, .doc, .docx" class="form-control" type="file" id="file" name="file">
                            @else
                                <input accept=".pdf, .doc, .docx" class="form-control" type="file" id="file" name="file" required>
                            @endif
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
