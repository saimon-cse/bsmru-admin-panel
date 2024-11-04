<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title> @yield('title')</title>

    <meta content="" name="description">
    <meta content="" name="keywords">
    @include('admin.partials.header')
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

</head>

<body>

    @if (Route::has('login'))
        <!-- ======= Header ======= -->
        @auth

            @include('admin.body.navbar')
        @endauth
        <!-- End Header -->
    @endif

    <!-- ======= Sidebar ======= -->
    @include('admin.body.sidebar')
    <!-- End Sidebar-->

    @yield('admin')
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    @include('admin.body.footer')
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    @include('admin.partials.footerFile')


    <script src="{{asset('assets/js/custom.js')}}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>



</body>

</html>


{{-- ====================     validation        ================================= --}}
{{-- @section('script')
    <script>
        document.getElementById('eventForm').addEventListener('submit', function(event) {
            var date = document.getElementById('date').value;
            var title = document.getElementById('title').value;
            var description = document.getElementById('description').value;
            var fileInput = document.getElementById('file');
            var filePath = fileInput.value;

            if (!date || !title || !description) {
                event.preventDefault();
                alert('Please fill out all required fields.');
                return;
            }

            if (filePath) {
                var fileExtension = filePath.split('.').pop().toLowerCase();
                var allowedExtensions = ['png', 'jpg', 'jpeg'];
                if (!allowedExtensions.includes(fileExtension)) {
                    event.preventDefault();
                    alert('Only PNG and JPG files are allowed.');
                    return;
                }

                // Convert the file extension to lowercase (This does not change the actual file, just the displayed name)
                fileInput.value = filePath.replace(/\.[^/.]+$/, function(ext) {
                    return ext.toLowerCase();
                });
            }
        });
    </script>
@endsection --}}



{{-- =================                Editor          ========= --}}
{{--
@section('script')
    <script>
        // first editor
        ClassicEditor
            .create(document.querySelector('.editor'), {
                ckfinder: {
                    uploadUrl: "ckfileupload.php",
                }
            })
            .then(editor => {

                console.log(editor);

            })
            .catch(error => {
                console.error(error);
            });
    </script>
    <!-- ckeditor5 JS -->
    <script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>
@endsection --}}
