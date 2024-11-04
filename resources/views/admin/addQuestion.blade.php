@section('title', 'Add Questions')

@extends('admin.dashboard')
@section('admin')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Question Papers</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Academic</li>
                    <li class="breadcrumb-item">Question</li>
                    <li class="breadcrumb-item active">Add</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Add Question Papers</h5>
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

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

                <form method="POST" action="{{ route('questionPaper.store') }}" enctype="multipart/form-data" onsubmit="return validateFormAndSanitize()">
                    @csrf

                    <div class="row mb-3">
                        <label for="degree" class="col-sm-2 col-form-label">Degree <span style="color:brown">*</span></label>
                        <div class="col-sm-2">
                            <select class="form-select" required="" name="degree" id="degree" aria-label="Default select example">
                                <option value="" selected disabled>__Select Degree__</option>
                                <option value="1">Bachelor</option>
                                <option value="2">Masters</option>
                                <option value="3">Doctoral</option>
                            </select>
                            <span id="degree-error" style="color: red; display: none;">Please select a degree.</span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="year" class="col-sm-2 col-form-label">Year <span style="color:brown">*</span></label>
                        <div class="col-sm-2">
                            <select class="form-select" required="" name="year" id="year" aria-label="Default select example">
                                <option value="" selected disabled>__Select Year__</option>
                                <option value="First Year">First Year</option>
                                <option value="Second Year">Second Year</option>
                                <option value="Third Year">Third Year</option>
                                <option value="Fourth Year">Fourth Year</option>
                            </select>
                            <span id="year-error" style="color: red; display: none;">Please select a year.</span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="semester" class="col-sm-2 col-form-label">Semester <span style="color:brown">*</span></label>
                        <div class="col-sm-2">
                            <select class="form-select" required="" name="semester" id="semester" aria-label="Default select example">
                                <option value="" selected disabled>__Select Semester__</option>
                                <option value="Semester-1">Semester-1</option>
                                <option value="Semester-2">Semester-2</option>
                            </select>
                            <span id="semester-error" style="color: red; display: none;">Please select a semester.</span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Title <span style="color:brown">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('title') is-invalid @enderror" value="{{old('title')}}" name="title" placeholder="enter Question Title here" required>
                            @error('title')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Type <span style="color:brown">*</span></label>
                        <div class="col-sm-10">
                            <select class="form-select" name="type" aria-label="Default select example">
                                @foreach ($types as $type)
                                    <option value="{{ $type->title }}">{{ $type->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Session <span style="color:brown">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('session') is-invalid @enderror" name="session" value="{{ old('session') }}" placeholder="e.g. 2021-2022" required>
                            @error('session')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Exam year <span style="color:brown">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('exam_year') is-invalid @enderror" name="exam_year" placeholder="e.g. 2023" required value="{{ old('exam_year') }}">
                            @error('exam_year')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Attachment <span style="color:brown">*</span></label>
                        <div class="col-sm-10">
                            <div class="col-sm-12"><input accept=".pdf, .doc,.docx" class="form-control" type="file" id="formFile" name='file' required></div>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form><!-- End Horizontal Form -->

                <script>
                    function validateFormAndSanitize() {
                        var isValid = validateForm();
                        if (isValid) {
                            sanitizeInputs();
                        }
                        return isValid;
                    }

                    function validateForm() {
                        var isValid = true;

                        var degree = document.getElementById('degree').value;
                        var degreeError = document.getElementById('degree-error');
                        if (degree === "__Select Degree__") {
                            degreeError.style.display = 'block';
                            isValid = false;
                        } else {
                            degreeError.style.display = 'none';
                        }

                        var year = document.getElementById('year').value;
                        var yearError = document.getElementById('year-error');
                        if (year === "__Select Year__") {
                            yearError.style.display = 'block';
                            isValid = false;
                        } else {
                            yearError.style.display = 'none';
                        }

                        var semester = document.getElementById('semester').value;
                        var semesterError = document.getElementById('semester-error');
                        if (semester === "__Select Semester__") {
                            semesterError.style.display = 'block';
                            isValid = false;
                        } else {
                            semesterError.style.display = 'none';
                        }

                        return isValid;
                    }

                    function sanitizeInputs() {
                        const inputs = document.querySelectorAll('input[type="text"]');
                        inputs.forEach(input => {
                            input.value = input.value.replace(/<[^>]*>?/gm, '');
                        });
                    }
                </script>
            </div>
        </div>
    </main>
@endsection
