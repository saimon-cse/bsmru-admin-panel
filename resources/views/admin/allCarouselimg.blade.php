
@section('title', 'Manage Carousel Images')

@extends('admin.dashboard')
@section('admin')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Homepage Images</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Homepage Images</li>
                    {{-- <li class="breadcrumb-item active">Profile</li> --}}
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Homepage Images</h5>
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
                            {{-- <th scope="col">Title</th> --}}
                            {{-- <th scope="col">Description</th> --}}
                            <th scope="col">Photo</th>
                            {{-- <th scope="col">Date</th> --}}
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carousels as $carousel)
                            <tr>
                                <th scope="row">{{$carousel->rank}}</th>
                                {{-- <td>{{ $event->title }}</td> --}}
                                                                          {{-- @php $print= $event->description  @endphp --}}
                                {{-- <td>@php echo $print @endphp</td> --}}
                                <td><img src="{{ $dept->dept_url.'/assets/img/' . $carousel->image }}" style="height: 100px"alt=""></td>
                                {{-- {{'https://cse.bsmru.ac.bd/assets/img/Events/'.$event->file}} --}}
                                {{-- <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $event->date)->format('j M Y') }}</td> --}}
                                <td>
                                    <a class="btn btn-info" href="{{route('admin.carousel-img.edit',['id'=>$carousel->id])}}"><i class="bx bxs-edit"></i></a>
                                    <a class="btn btn-success" href="{{route('admin.carousel-rank-up',['id'=>$carousel->id])}}"><i class="bx bxs-upvote"></i></a>
                                    <a class="btn btn-primary" href="{{route('admin.carousel-rank-down',['id'=>$carousel->id])}}"><i class="bx bxs-downvote"></i></a>
                                    <a href="{{route('admin.carousel-img-delete',['id'=>$carousel->id])}}" class="delete-link btn btn-danger"><i class="bx bxs-trash "></i> </a>
                                    {{-- {{ route('admin.noticeRankDown', ['id' => $notice->id]) }} --}}
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

                <div class="d-flex justify-content-center">
                    {{-- pagination  --}}
                    {{ $carousels->links() }}
                    {{-- end  --}}
                </div>


                <!-- End Table with hoverable rows -->

            </div>
        </div>
    </main>
@endsection
