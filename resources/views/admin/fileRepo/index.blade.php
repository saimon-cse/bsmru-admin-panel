
@section('title', 'Manage files')

@extends('admin.dashboard')
@section('admin')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>File Reopository</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Files</li>
                    {{-- <li class="breadcrumb-item active">files</li> --}}
                </ol>
            </nav>
            <a style="margin-bottom: 10px" href="{{route('filerepository.create')}}" class="btn btn-primary">Add New Files</a>
        </div><!-- End Page Title -->


        <div class="card">
            <div class="card-body">
                <h5 class="card-title">All Files</h5>
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


                <form method="GET" action="{{ route('filerepository.index') }}" class="mb-3">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Search by Title, Upload Year, Semester, Type or degree. (AND/OR) keyword also support" value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </form>

                <!-- Table with hoverable rows -->
<div style="overflow-x:auto">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Degree</th>
                <th scope="col">Year</th>
                <th scope="col">Semester</th>
                <th scope="col">Session</th>
                <th scope="col">Upload Year</th>
                {{-- <th scope="col">Exam year</th> --}}
                {{-- <th scope="col">File</th> --}}
                <th scope="col">Download</th>
            </tr>
        </thead>
        <tbody>
            @php
                $sl=1;
            @endphp
            @foreach ($files as $file)
                <tr>
                    {{-- cse.bsmru.ac.bd/assets/   notice/notic.pdf --}}
                    <th scope="row">{{$sl++}}</th>
                    <td>{{ $file->title }}</td>
                    <td>
                        @if ( $file->degree_id ==1)
                            Bachelor
                        @elseif( $file->degree_id ==2)
                            Masters
                        @else
                          Doctoral
                        @endif
                    </td>
                    <td>{{ $file->year }}</td>
                    <td>{{ $file->semester }}</td>

                    <td>{{ $file->session }}</td>
                    <td>{{ $file->upload_year }}</td>
                    {{-- <td>{{ $file->exam_year }}</td> --}}

                    {{-- <td><a
                            href="{{ $dept->dept_url . '/assets/Files/files/' . $file->file }}"><strong>[view]</strong></a>
                    </td> --}}
                    <td>

                        {{-- <a class="btn btn-warning btn-sm"  href="{{Storage::url($file->file)}}"><i class="ri-download-2-line"></i></a> --}}
                        <a class="btn btn-warning btn-sm" href="{{ route('download.file', basename($file->file)) }}"><i class="ri-download-2-line"></i></a>


                    </td>

                </tr>
            @endforeach

        </tbody>
    </table>
</div>

                {{-- pagination --}}
                <div class="d-flex justify-content-center">
                    {!! $files->links() !!}
                </div>
                <!-- End Table with hoverable rows -->

            </div>
        </div>
    </main>
@endsection
