
@section('title', 'Add Carousel')

@extends('admin.dashboard')
@section('admin')
    <main id="main" class="main">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Homepage Image Add</h5>
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
                <form method="POST" action="{{ route('admin.carousel-img.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3">
                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Homepage Image</label>
                        <div class="col-md-8 col-lg-9">
                            <img id="imagePreview"
                                src="{{  url('upload/no_image.png') }}" alt="Profile" style="width: 150px; height: 150px;">
                            <div class="pt-2">
                                <div class="col-sm-4">
                                    <input class="form-control @error('description') is-invalid @enderror" required type="file" id="formFile" accept=".jpg, .png,.jpeg" name="img" onchange="previewImage();">
                                    @error('img')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Insert</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form><!-- End Horizontal Form -->

            </div>
        </div>
    </main>

    <script>
        function previewImage() {
            var file = document.getElementById("formFile").files[0];
            var reader = new FileReader();

            reader.onloadend = function() {
                document.getElementById("imagePreview").src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                document.getElementById("imagePreview").src = "{{ url('upload/no_image.png') }}";
            }
        }
    </script>
@endsection
