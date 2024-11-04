@section('title', 'Add Notice')

@extends('admin.dashboard')
@section('admin')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Notice</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Notices</li>
                <li class="breadcrumb-item active">Add</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Add Notice</h5>

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

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('notice.store') }}" onsubmit="sanitizeInputs()" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label for="not_date" class="col-sm-2 col-form-label">Notice Date <span style="color:brown">*</span></label>
                    <div class="col-sm-2">
                        <input type="date" class="form-control" name="not_date" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="not_title" class="col-sm-2 col-form-label">Notice Title <span style="color:brown">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('not_title') is-invalid @enderror" id="not_title" name="not_title" placeholder="Notice Title" required>
                        @error('not_title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="message" class="col-sm-2 col-form-label">Notice Description</label>
                    <div class="col-sm-10">
                        <textarea name="message" class="form-control editor @error('message') is-invalid @enderror" placeholder="Enter Notice Description"></textarea>
                        @error('message')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Notice Type <span style="color:brown">*</span></label>
                    <div class="col-sm-10">
                        <select class="form-select" name="not_type" aria-label="Default select example">
                            @foreach ($types as $type)
                                <option value="{{ $type->title }}">{{ $type->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="not_file" class="col-sm-2 col-form-label">Attachment <span style="color:brown">*</span></label>
                    <div class="col-sm-10">
                        <input class="form-control @error('not_file') is-invalid @enderror" type="file" accept=".pdf,.jpg,.png,.doc,.docx,.jpeg" id="not_file" name="not_file" required>
                        @error('not_file')
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
