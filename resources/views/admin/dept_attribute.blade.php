
@section('title', 'Department Attributes')

@extends('admin.dashboard')
@section('admin')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Department Attributes</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    {{-- <li class="breadcrumb-item">Users</li> --}}
                    <li class="breadcrumb-item active">Department Attributes</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"> </h5>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-1"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"aria-label="Close"></button>
                    </div>
                @elseif (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-octagon me-1"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"aria-label="Close"></button>
                    </div>
                @elseif (session('info'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <i class="bi bi-info-circle me-1"></i>
                        {{ session('info') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Failed to upload Notice
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div> -->


                <!-- Horizontal Form -->
                <form method="POST" action="{{ route('DeptInfoStore', ['id' => $dept->id]) }}" onsubmit="sanitizeInputs()" enctype="multipart/form-data">
                    @csrf

                    {{-- <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Dept Code</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputText" name="dept_code"
                                value="{{ $dept->dept_code }}" require>
                        </div>
                    </div> --}}

                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Dept Short Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('dept_short_name') is-invalid @enderror" id="inputText" name="dept_short_name"
                                value="{{ $dept->dept_short_name }}" require>
                                @error('dept_short_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Dept Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('dept_name') is-invalid @enderror" id="inputText" name="dept_name"
                                value="{{ $dept->dept_name }}" require>
                                @error('dept_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">About</label>
                        <div class="col-sm-10">
                            <textarea class="form-control editor @error('about') is-invalid @enderror" name="about" id="about" style="height: 100px" placeholder="">{{ $dept->about }}</textarea>
                            @error('about')
                                    <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Dept Phone</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="inputText" name="phone"
                                value="{{ $dept->phone }}" require>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Dept Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="inputText" name="email"
                                value="{{ $dept->email }}" require>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Footer Address</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('address') is-invalid @enderror" id="inputText" name="address"
                                value="{{ $dept->address }}" require>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                        </div>
                    </div>




                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form><!-- End Horizontal Form -->

            </div>
        </div>
    </main>
@endsection
