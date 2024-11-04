
@section('title', 'Special News')

@extends('admin.dashboard')
@section('admin')
    <main id="main" class="main">
        <div class="pagetitle">
        <h1>Special News</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Special News</li>
                {{-- <li class="breadcrumb-item active">Profile</li> --}}
            </ol>
        </nav>
    </div><!-- End Page Title -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">                     </h5>
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

                <!-- Horizontal Form -->
                <form method="POST" action="{{ route('admin.specialNewsStore') }}" onsubmit="sanitizeInputs()" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3">
                        {{-- <label for="inputEmail3" class="col-sm-2 col-form-label">Passing Year</label> --}}
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('news') is-invalid @enderror" id="inputText" name="news"
                                placeholder="Enter Special News"  value="{{$dept->special_event}}">
                                @error('news')
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
