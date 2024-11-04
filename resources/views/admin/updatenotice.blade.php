
@section('title', 'Manage Notices')

@extends('admin.dashboard')
@section('admin')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Notices</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" >Notices</li>
                    {{-- <li class="breadcrumb-item active">Profile</li> --}}
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">All Notices</h5>
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


                <!-- Table with hoverable rows -->
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Notice Type</th>
                            <th scope="col">Date</th>
                            <th scope="col">File</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($notices as $notice)
                            <tr>
                                {{-- cse.bsmru.ac.bd/assets/   notice/notic.pdf--}}
                                <th scope="row">{{ $notice->rank }}</th>
                                <td>{{ $notice->not_title }}</td>
                                <td>{{ $notice->not_type }}</td>
                                <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $notice->not_date)->format('j M Y') }}</td>
                                <td><a href="{{ $dept->dept_url.'/assets/Files/'.$notice->not_file }}"><strong>[view]</strong></a> </td>
                                <td>
                                    <a class="btn btn-info btn-sm" href="{{ route('notice.show', ['notice' => $notice->id]) }}"><i
                                            class="bx bxs-edit"></i></a>
                                    <a class="btn btn-success btn-sm"
                                        href="{{ route('notice.rankUp', ['id' => $notice->id]) }}"><i
                                            class="bx bxs-upvote"></i></a>
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ route('notice.rankDown', ['id' => $notice->id]) }}"><i
                                            class="bx bxs-downvote"></i></a>

                                    <form action="{{ route('notice.destroy', $notice->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this notice?')">
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
                    {!! $notices->links() !!}
                </div>
                <!-- End Table with hoverable rows -->

            </div>
        </div>
    </main>
@endsection
