@extends('admin.dashboard')

@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <style>
        .imagePreview {
            width: 100%;
            height: 180px;
            background-position: center center;
            background: url();
            background-color: #fff;
            background-size: cover;
            background-repeat: no-repeat;
            display: inline-block;
            box-shadow: 0px -3px 6px 2px rgba(0, 0, 0, 0.2);
        }

        .btn-primary {
            display: block;
            border-radius: 0px;
            box-shadow: 0px 4px 6px 2px rgba(0, 0, 0, 0.2);
            margin-top: -5px;
        }

        .imgUp {
            margin-bottom: 15px;
            position: relative;
        }

        .del {
            position: absolute;
            top: 0px;
            right: 15px;
            width: 30px;
            height: 30px;
            text-align: center;
            line-height: 30px;
            background-color: rgba(255, 255, 255, 0.6);
            cursor: pointer;
        }

        .imgAdd {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #4bd7ef;
            color: #fff;
            box-shadow: 0px 0px 2px 1px rgba(0, 0, 0, 0.2);
            text-align: center;
            line-height: 30px;
            margin-top: 0px;
            cursor: pointer;
            font-size: 15px;
        }
    </style>

    <main id="main" class="main">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Carousel Images</h5>
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

                <h6 class="card-title">Only show Rank(1-3) images</h6>
                <form method="POST" action="{{ route('image.update') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="container">
                        <div class="row" id="imageRow">
                            {{-- @foreach ($images as $image)
                        <div class="col-sm-2 imgUp">
                            <div class="imagePreview" style="background-image: url('{{ asset('upload/events/' . $image->image) }}');"></div>
                            <label class="btn btn-primary">
                                Change<input type="file" class="changeFile img" name="images[]" style="width: 0px;height: 0px;overflow: hidden;">
                            </label>
                            Rank: <input type="text" name="ranks[]" style="width: 70px" value="{{ $image->rank }}">
                            <input type="hidden" name="ids[]" value="{{ $image->id }}">

                        </div><!-- col-2 -->
                      @endforeach --}}



                            @foreach ($images as $image)
                                <div class="col-sm-2 imgUp">
                                    <div class="imagePreview"
                                        style="background-image: url('{{ asset('upload/events/' . $image->image) }}');">
                                    </div>
                                    <label class="btn btn-primary">
                                        Change<input type="file" class="changeFile img" name="images[]"
                                            style="width: 0px;height: 0px;overflow: hidden;" accept=".png,.jpg">
                                    </label>
                                    Rank: <input type="text" name="ranks[]" style="width: 70px"
                                        value="{{ $image->rank }}">
                                    <input type="hidden" name="ids[]" value="{{ $image->id }}">
                                    Delete Image<input type="checkbox" name="delete_ids[]" value="{{ $image->id }}">
                                </div>
                            @endforeach




                            <i class="fa fa-plus imgAdd"></i>
                        </div><!-- row -->
                    </div><!-- container -->
                    <br><br>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </main>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $(".imgAdd").click(function() {
                let numItems = $('.imgUp').length + 1; // Ensure unique index if needed
                $(this).before(`
        <div class="col-sm-2 imgUp">
            <div class="imagePreview"></div>
            <label class="btn btn-primary">
                Change<input type="file" class="changeFile img" name="new_images[]" style="width:0;height:0;overflow:hidden;">
            </label>
            Rank: <input type="text" name="new_ranks[]" style="width: 70px" value="${numItems}">
            <i class="fa fa-times del"></i>
        </div>`);
            });
            $('form').submit(function(e) {
                let allRanksFilled = true;
                $('input[name="ranks[]"], input[name="new_ranks[]"]').each(function() {
                    if ($(this).val().trim() === '') {
                        allRanksFilled = false;
                    }
                });

                if (!allRanksFilled) {
                    e.preventDefault(); // Stop form submission
                    alert('Please fill in all rank fields before submitting.');
                }
            });



            $(document).on("click", "i.del", function() {
                var $parent = $(this).parent();
                var $checkbox = $parent.find('.delete-checkbox');
                $checkbox.prop('checked', true); // Mark the hidden checkbox as checked
                $parent.hide(); // Hide the image block from the DOM
            });

            $(document).on("change", ".changeFile", function() {
                var changeFile = $(this);
                var files = !!this.files ? this.files : [];
                if (!files.length || !window.FileReader)
                    return; // no file selected, or no FileReader support

                if (/^image/.test(files[0].type)) { // only image file
                    var reader = new FileReader(); // instance of the FileReader
                    reader.readAsDataURL(files[0]); // read the local file

                    reader.onloadend = function() {
                        changeFile.closest(".imgUp").find('.imagePreview').css("background-image",
                            "url(" + this.result + ")");
                    }
                }
            });
        });
    </script>
@endsection
