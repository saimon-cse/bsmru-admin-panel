
@section('title', 'Research Profiles')

@extends('admin.dashboard')
@section('admin')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Research Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Research</li>
                    <li class="breadcrumb-item active">profile</li>
                </ol>
            </nav>
            <a href="{{ route('AddResearchProfile') }}" class="btn btn-success"
            style="width: 190px;  margin-bottom:20px">Add Research profile
        </a>
        </div><!-- End Page Title -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Research Profile</h5>
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
                            <th scope="col"> </th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($researchProfile as $research)
                            <tr>
                                @php
                                    $str = $research->title;
                                @endphp

                                <th scope="row"> {{$research->rank}} </th>
                                <td>
                                    @php
                                        echo $str;
                                    @endphp
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-info"
                                        href="{{ route('EditResearcProfile', ['id' => $research->id]) }}"><i
                                            class="bx bxs-edit"></i></a>
                                    <a class="btn btn-sm btn-success"
                                        href="{{ route('admin.ResearchProfileRankup', ['id' => $research->id]) }}"><i
                                            class="bx bxs-upvote"></i></a>
                                    <a class="btn btn-sm btn-primary"
                                        href="{{ route('admin.ResearchProfileRankDown', ['id' => $research->id]) }}"><i
                                            class="bx bxs-downvote"></i></a>
                                    <a class="delete-link btn btn-sm btn-danger"
                                        href="{{ route('DeleteResearchProfile', ['id' => $research->id]) }}"><i
                                            class="bx bxs-trash"></i> </a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>





                {{-- pagination --}}
                <div class="d-flex justify-content-center">
                    {!! $researchProfile->links() !!}
                </div>
                <!-- End Table with hoverable rows -->

            </div>
        </div>
    </main>
@endsection
