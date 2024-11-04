@section('title', 'Edit Education')

@extends('admin.dashboard')
@section('admin')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Education</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Education</li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Education</h5>
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

                <form method="POST" action="{{ route('educations.update', ['education' => $education->id]) }}" onsubmit="sanitizeInputs()">
                    @csrf
                    @method("PUT")

                    <div class="row mb-3">
                        <label for="degree" class="col-sm-2 col-form-label">Degree</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('degree') is-invalid @enderror" name="degree" required value="{{ old('degree', $education->degree) }}">
                            @error('degree')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="institution" class="col-sm-2 col-form-label">Institution</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('institution') is-invalid @enderror" name="institution" required value="{{ old('institution', $education->institution) }}">
                            @error('institution')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="passYear" class="col-sm-2 col-form-label">Pass Year</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('passYear') is-invalid @enderror" name="passYear" required value="{{ old('passYear', $education->passYear) }}">
                            @error('passYear')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <input type="submit" class="btn btn-primary" value="Submit">
                </form>

            </div>
        </div>
    </main>
@endsection
