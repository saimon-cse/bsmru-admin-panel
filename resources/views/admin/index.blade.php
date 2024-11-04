
@section('title', 'Dashboard')
@extends('admin.dashboard')
@section('admin')

<main id="main" class="main">

    <div class="dept" style="margin-top:20%; margin-left:8%; margin-bottom:20%">
        <h3>Welcome to the </h3>
        <h1>Department of {{$dept->dept_name}}</h1>

    </div>

</main>


@endsection
