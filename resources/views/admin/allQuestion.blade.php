
@section('title', 'Manage Questions')

@extends('admin.dashboard')
@section('admin')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Question Papers</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Academic</li>
                    <li class="breadcrumb-item active">Questions</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">All Question Papers</h5>
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


                <form method="GET" action="{{ route('questionPaper.index') }}" class="mb-3">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Search by Year, Semester, Type or Title. (AND/OR) keyword also support" value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </form>

                <!-- Table with hoverable rows -->
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Degree</th>
                            <th scope="col">Year</th>
                            <th scope="col">Semester</th>
                            <th scope="col">Title</th>
                            <th scope="col">Type</th>
                            <th scope="col">Session</th>
                            <th scope="col">Exam year</th>
                            <th scope="col">File</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($questions as $question)
                            <tr>
                                {{-- cse.bsmru.ac.bd/assets/   notice/notic.pdf --}}
                                <th scope="row">{{ $question->rank }}</th>
                                <td>
                                    @if ( $question->degree_id ==1)
                                        Bachelor
                                    @elseif( $question->degree_id ==2)
                                        Masters
                                    @else
                                      Doctoral
                                    @endif
                                </td>
                                <td>{{ $question->year }}</td>
                                <td>{{ $question->semester }}</td>
                                <td>{{ $question->title }}</td>
                                <td>{{ $question->type }}</td>
                                <td>{{ $question->session }}</td>
                                <td>{{ $question->exam_year }}</td>

                                <td><a
                                        href="{{ $dept->dept_url . '/assets/Files/questions/' . $question->file }}"><strong>[view]</strong></a>
                                </td>
                                <td>
                                    {{-- <a class="btn btn-info" href="{{ route('admin.editnotice', ['id' => $notice->id]) }}"><i
                                            class="bx bxs-edit"></i></a> --}}
                                    <a class="btn btn-info btn-sm"
                                        href="{{route('questionPaper.edit',['questionPaper'=>$question->id])}}"><i
                                            class="bx bxs-edit"></i></a>
                                    <form action="{{ route('questionPaper.destroy', $question->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this question-paper?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bx bxs-trash"></i>
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>

                {{-- pagination --}}
                <div class="d-flex justify-content-center">
                    {!! $questions->links() !!}
                </div>
                <!-- End Table with hoverable rows -->

            </div>
        </div>
    </main>
@endsection
