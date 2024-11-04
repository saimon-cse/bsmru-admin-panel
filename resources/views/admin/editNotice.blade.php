@section('title', 'Edit Notice')

@extends('admin.dashboard')
@section('admin')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Notices</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Notices</li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Notice</h5>
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

                <form method="POST" action="{{ route('notice.update', ['notice' => $notice->id]) }}" enctype="multipart/form-data" onsubmit="sanitizeInputs()">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Notice Date <span style="color:brown">*</span></label>
                        <div class="col-sm-2">
                            <input type="date" class="form-control @error('not_date') is-invalid @enderror" name="not_date" value="{{ old('not_date', $notice->not_date) }}" required>
                            @error('not_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Notice Title <span style="color:brown">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('not_title') is-invalid @enderror" id="inputText" name="not_title" value="{{ old('not_title', $notice->not_title) }}" placeholder="Notice Title" required>
                            @error('not_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Notice description</label>
                        <div class="col-sm-10">
                            <textarea name="message" class="form-control editor @error('message') is-invalid @enderror" placeholder="Enter Notice description.">{{ old('message', $notice->not_des) }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Notice Type <span style="color:brown">*</span></label>
                        <div class="col-sm-10">
                            <select class="form-select @error('not_type') is-invalid @enderror" name="not_type" aria-label="Default select example" required>
                                <option value="">Select Type</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->title }}" @if ($notice->not_type == $type->title) selected @endif>
                                        {{ $type->title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('not_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="file" class="col-sm-2 col-form-label">Change File</label>
                        <div class="col-sm-10">
                            @if ($notice->not_file)
                                <input accept=".pdf,.png,.jpg,.doc,.docx" class="form-control @error('not_file') is-invalid @enderror" type="file" id="file" name="not_file">
                            @else
                                <input accept=".pdf,.png,.jpg,.doc,.docx" class="form-control @error('not_file') is-invalid @enderror" type="file" id="file" name="not_file" required>
                            @endif
                            @error('not_file')
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
