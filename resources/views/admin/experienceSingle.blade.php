
@section('title', 'Experiences')

@extends('admin.dashboard')
@section('admin')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Experiences</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Experience</li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Experiences</h5>
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

                <form action="{{ route('EditedExperience', ['id' => $experience->id]) }}" onsubmit="sanitizeInputs()">
                    @csrf
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="title" value="{{ $experience->title }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Organization</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="org"
                                value="{{ $experience->organization }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">From date </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="from" value="{{ $experience->from_date }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">To Date</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="to" value="{{ $experience->to_date }}">
                        </div>
                    </div>
                    {{--
                        <input type="text" name="org" value="{{$experience->organization}}">
                        <input type="text" name="from" value="{{$experience->from_date}}">
                        <input type="text" name="to" value="{{$experience->to_date}}"> --}}

                    <input type="submit" class="btn btn-primary" value="Submit">

                </form>



            </div>
        </div>
    </main>
@endsection
