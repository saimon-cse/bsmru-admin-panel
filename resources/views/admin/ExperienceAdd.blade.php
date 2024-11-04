@extends('admin.dashboard')

@section('title', 'Add Experience')

@section('admin')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Experiences</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Experience</li>
                    <li class="breadcrumb-item active">Add</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Add Experience</h5>

                <!-- Success or Error Messages -->
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
                @endif

                <!-- Experience Form -->
                <form method="POST" action="{{ route('StoreExperience') }}" enctype="multipart/form-data">
                    @csrf
                    <!-- Title Input -->
                    <div class="row mb-3">
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" required
                                   placeholder="Title of experience" value="{{ old('title') }}">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Organization Input -->
                    <div class="row mb-3">
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('organization') is-invalid @enderror" name="organization"
                                   placeholder="Name of Organization" required value="{{ old('organization') }}">
                            @error('organization')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- From Date Input -->
                    <div class="row mb-3">
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('fromDate') is-invalid @enderror" name="fromDate"
                                   placeholder="From Date" required value="{{ old('fromDate') }}">
                            @error('fromDate')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- To Date Input -->
                    <div class="row mb-3">
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('toDate') is-invalid @enderror" name="toDate"
                                   placeholder="To Date" required value="{{ old('toDate') }}">
                            @error('toDate')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Hidden User Field -->
                    <input type="hidden" name="user" value="{{ $profileData->user_id }}">

                    <!-- Submit and Reset Buttons -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
