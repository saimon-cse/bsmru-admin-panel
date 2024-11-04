@section('title', 'Manage Publication')

@extends('admin.dashboard')
@section('admin')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Publications</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Research</li>
                    <li class="breadcrumb-item active">Publications</li>
                </ol>
            </nav>
            <a href="{{ route('publications.create') }}" class="btn btn-success" style="width: 170px;">Add Publications</a>
        </div><!-- End Page Title -->

        {{-- Display success, error, or info messages --}}
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

        {{-- Display Publications Grouped by Type --}}
        @foreach ($types as $type)
            @php
                // Fetch publications for the current type from the array
                $publications = $publicationsByType[$type->title] ?? collect();
            @endphp

            {{-- Check if the current type has any publications --}}
            @if ($publications->isNotEmpty())
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $type->title }}</h5>
                        <!-- Table with hoverable rows -->
                        <table class="table table-hover ">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($publications as $publication)
                                    <tr>
                                        <th scope="row">{{ $publication->rank }}</th>

                                        <td>@php echo $publication->description @endphp</td>
                                        <td>
                                            <a class="btn btn-info btn-sm" href="{{ route('publications.show', ['publication' => $publication->id]) }}">
                                                <i class="bx bxs-edit"></i>
                                            </a>
                                            <a class="btn btn-success btn-sm" href="{{ route('publications.rankUp', ['id' => $publication->id]) }}">
                                                <i class="bx bxs-upvote"></i>
                                            </a>
                                            <a class="btn btn-primary btn-sm" href="{{ route('publications.rankDown', ['id' => $publication->id]) }}">
                                                <i class="bx bxs-downvote"></i>
                                            </a>
                                            <form action="{{ route('publications.destroy', $publication->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this publications?')">
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

                        <!-- Pagination links specific to each type -->
                        <div class="d-flex justify-content-center">
                            {{ $publications->links() }}
                        </div>
                        <!-- End Table with hoverable rows -->
                    </div>
                </div>
            @endif
        @endforeach
    </main>
@endsection
