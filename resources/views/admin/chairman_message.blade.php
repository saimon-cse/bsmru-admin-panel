
@section('title', 'Department Attributes')

@extends('admin.dashboard')
@section('admin')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Message from Chaiman</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    {{-- <li class="breadcrumb-item">Users</li> --}}
                    <li class="breadcrumb-item active">Chairman Message</li>
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
                <form method="POST" action="{{ route('chairmanInfo', ['id' => $dept->id]) }}" onsubmit="sanitizeInputs()" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3">
                        <label for="Chairman" class="col-sm-2 col-form-label">Select Chairman</label>
                        <div class="col-sm-4">
                            <select class="form-select" name="chair_id" aria-label="Default select example">
                                <option value="0" @if($dept->chair_id == 0) selected @endif disabled>Select Chairman...</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" @if($user->id == $dept->chair_id) selected @endif>{{ $user->name}} ( {{ $user->user_id }} )</option>
                                @endforeach
                            </select>
                            @error('chair_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Chairman Message</label>
                        <div class="col-sm-10">
                            <textarea class="form-control editor" name="chair_message" id="about" style="height: 100px" placeholder="Message from Chairman">{{ old('chair_message', $dept->chair_message) }}</textarea>
                            @error('chair_message')
                                <div class="text-danger">{{ $message }}</div>
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
