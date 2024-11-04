@section('title', 'Administration')

@extends('admin.dashboard')
@section('admin')



<style>
    /* From Uiverse.io by Shoh2008 */
    .checkbox-wrapper-35 .switch {
        display: none;
    }

    .checkbox-wrapper-35 .switch + label {
        -webkit-box-align: center;
        -webkit-align-items: center;
        -ms-flex-align: center;
        align-items: center;
        color: #78768d;
        cursor: pointer;
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
        font-size: 12px;
        line-height: 15px;
        position: relative;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        padding-top: 5px;
    }

    .checkbox-wrapper-35 .switch + label::before,
    .checkbox-wrapper-35 .switch + label::after {
        content: '';
        display: block;
    }

    .checkbox-wrapper-35 .switch + label::before {
        background-color: #05012c;
        border-radius: 500px;
        height: 15px;
        margin-right: 8px;
        -webkit-transition: background-color 0.125s ease-out;
        transition: background-color 0.125s ease-out;
        width: 25px;
    }

    .checkbox-wrapper-35 .switch + label::after {
        background-color: #fff;
        border-radius: 13px;
        box-shadow: 0 3px 1px 0 rgba(37, 34, 71, 0.05), 0 2px 2px 0 rgba(37, 34, 71, 0.1), 0 3px 3px 0 rgba(37, 34, 71, 0.05);
        height: 13px;
        left: 1px;
        position: absolute;
        /*top: 1px;*/
        -webkit-transition: -webkit-transform 0.125s ease-out;
        transition: -webkit-transform 0.125s ease-out;
        transition: transform 0.125s ease-out;
        transition: transform 0.125s ease-out, -webkit-transform 0.125s ease-out;
        width: 13px;
    }

    .checkbox-wrapper-35 .switch + label .switch-x-text {
        display: block;
        margin-right: .3em;
    }

    .checkbox-wrapper-35 .switch + label .switch-x-toggletext {
        display: block;
        font-weight: bold;
        height: 15px;
        overflow: hidden;
        position: relative;
        width: 38px;
    }

    .checkbox-wrapper-35 .switch + label .switch-x-unchecked,
    .checkbox-wrapper-35 .switch + label .switch-x-checked {
        left: 0;
        position: absolute;
        top: 0;
        -webkit-transition: left 0.125s ease-out;
        transition: left 0.125s ease-out;
    }

    .checkbox-wrapper-35 .switch + label .switch-x-checked {
        left: 100%;
        opacity: 0;
    }

    .checkbox-wrapper-35 .switch:checked + label::before {
        background-color: #32cd32;
    }

    .checkbox-wrapper-35 .switch:checked + label::after {
        -webkit-transform: translateX(10px);
        transform: translateX(10px);
    }

    .checkbox-wrapper-35 .switch:checked + label .switch-x-checked {
        left: 0;
        opacity: 1;
    }

    .checkbox-wrapper-35 .switch:checked + label .switch-x-unchecked {
        left: -100%;
        opacity: 0;
    }
</style>





    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Administration</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    {{-- <li class="breadcrumb-item active">Users</li> --}}
                    <li class="breadcrumb-item active">Administration</li>
                </ol>
            </nav>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered">
                Create New User
            </button>
            <br><br>
            <div class="modal fade" id="verticalycentered" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Create New User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            {{-- <div class="card"> --}}
                            {{-- <div class="card-body"> --}}
                            {{-- <h5 class="card-title">No Labels / Placeholders as labels Form</h5> --}}

                            <!-- No Labels Form -->
                            <form class="row g-3" method="POST" action="{{ route('RegisterUser') }}">
                                @csrf
                                <div class="col-md-12">
                                    <input type="text" required class="form-control @error('name') is-invalid @enderror" name="name"
                                        placeholder="User Full Name" value="{{ old('name') }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <input type="email" id="email" required class="form-control @error('email') is-invalid @enderror"
                                           name="email" placeholder="Email" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <input type="password" required class="form-control @error('password') is-invalid @enderror"
                                           name="password" placeholder="Password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <input type="password" required class="form-control @error('password_confirmation') is-invalid @enderror"
                                           name="password_confirmation" placeholder="Confirm Password">
                                    @error('password_confirmation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <input type="text" required class="form-control @error('UserID') is-invalid @enderror"
                                           name="UserID" placeholder="Service ID" value="{{ old('UserID') }}">
                                    @error('UserID')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row mb-3" style="padding-top: 10px">
                                    <label for="inputState" class="col-sm-2 col-form-label">Type:</label>
                                    <div class="col-md-8">
                                        <select id="inputState" name="type" class="form-select @error('type') is-invalid @enderror">
                                            <option value="Teacher" {{ old('type') == 'Teacher' ? 'selected' : '' }}>Teacher</option>
                                            <option value="Staff" {{ old('type') == 'Staff' ? 'selected' : '' }}>Staff</option>
                                        </select>
                                        @error('type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3" style="padding-top: 10px">
                                    <label for="inputState" class="col-sm-2 col-form-label">Role:</label>
                                    <div class="col-md-8">
                                        <select id="inputState" name="role" class="form-select @error('role') is-invalid @enderror">
                                            <option value="General" {{ old('role') == 'General' ? 'selected' : '' }}>General</option>
                                            <option value="Admin Staff" {{ old('role') == 'Admin Staff' ? 'selected' : '' }}>Admin Staff</option>
                                        </select>
                                        @error('role')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Register</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>
                            </form>
                            {{-- </div>
                          </div> --}}
                        </div>
                        {{-- <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                  </div> --}}
                    </div>
                </div><!-- End Vertically centered Modal-->
            </div><!-- End Page Title -->
            <div class="card">

                <div class="card-body">
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
                    <h5 class="card-title">Teachers Table</h5>
                    <!-- Table with hoverable rows -->
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Service ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Role</th>
                                <th scope="col">Rank</th>
                                <th scope="col">Status</th>
                                {{-- <th scope="col">Leave</th> --}}
                                {{-- <th scope="col">Visible</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teacher as $user)
                                <tr>
                                    <th scope="row">{{ $user->rank ?? 'NULL' }}</th>
                                    <td>{{ $user->user_id ?? 'NULL' }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->controller_role ?? 'NULL' }}</td>

                                    <td>
                                        <a class="btn btn-success btn-sm"
                                            href="{{ route('admin.teacherRankUp', ['id' => $user->id]) }}"><i
                                                class="bx bxs-upvote"></i></a>
                                        <a class="btn btn-primary btn-sm"
                                            href="{{ route('admin.teacherRankDown', ['id' => $user->id]) }}"><i
                                                class="bx bxs-downvote"></i></a>
                                    </td>

                                    <!-- Toggle Status -->
                                    <td>
                                        {{-- <label class="switch">
                                            <input type="checkbox" class="status-toggle" data-id="{{ $user->id }}"
                                                {{ $user->status == 'inactive' ? 'checked' : '' }}>
                                            <span class="slider round"></span>
                                        </label>

                                        <label class="switch">
                                            <input type="checkbox" class="visible-toggle" data-id="{{ $user->id }}"
                                                {{ $user->visible ? 'checked' : '' }}>
                                            <span class="slider round"></span>
                                        </label> --}}

                                        <div class="checkbox-wrapper-35">
                                            <input  id="visible-toggle-{{ $user->id }}" type="checkbox" class="visible-toggle switch" data-id="{{ $user->id }}" {{ $user->visible ? 'checked' : '' }}>
                                            <label for="visible-toggle-{{ $user->id }}">
                                                <span class="switch-x-text">Visibility: </span>
                                                <span class="switch-x-toggletext">
                                                    <span class="switch-x-unchecked"><span class="switch-x-hiddenlabel"></span>Off</span>
                                                    <span class="switch-x-checked"><span class="switch-x-hiddenlabel"></span>On</span>
                                                </span>
                                            </label>
                                        </div>

                                        <!-- Custom Leave Toggle -->
                                        <div class="checkbox-wrapper-35">
                                            <input   id="status-toggle-{{ $user->id }}" type="checkbox" class="status-toggle switch" data-id="{{ $user->id }}" {{ $user->status == 'active' ? 'checked' : '' }}>
                                            <label for="status-toggle-{{ $user->id }}">
                                                <span class="switch-x-text">Status: </span>
                                                <span class="switch-x-toggletext">
                                                    <span class="switch-x-unchecked"><span class="switch-x-hiddenlabel"></span>Leave</span>
                                                    <span class="switch-x-checked"><span class="switch-x-hiddenlabel"></span>Active</span>
                                                </span>
                                            </label>
                                        </div>

                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- =================    Stuff          =============== --}}
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Staff Table</h5>
                    <!-- Table with hoverable rows -->
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Service ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Role</th>
                                <th scope="col">Up - Down</th>
                                <th> Leave - Visible</th>
                                {{-- <th scope="col">Leave</th> --}}
                                {{-- <th scope="col">Visible</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($staff as $user)
                                <tr>
                                    <th scope="row">{{ $user->rank ?? 'NULL' }}</th>
                                    <td>{{ $user->user_id ?? 'NULL' }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->controller_role ?? 'NULL' }}</td>

                                    <td>
                                        <a class="btn btn-success btn-sm"
                                            href="{{ route('admin.StaffRankUp', ['id' => $user->id]) }}"><i
                                                class="bx bxs-upvote"></i></a>
                                        <a class="btn btn-primary btn-sm"
                                            href="{{ route('admin.StaffRankDown', ['id' => $user->id]) }}"><i
                                                class="bx bxs-downvote"></i></a>
                                    </td>

                                    <!-- Toggle Status -->
                                    <td>
                                        {{-- <label class="switch">
                                            <input type="checkbox" class="status-toggle" data-id="{{ $user->id }}"
                                                {{ $user->status == 'inactive' ? 'checked' : '' }}>
                                            <span class="slider round"></span>
                                        </label>

                                        <label class="switch">
                                            <input type="checkbox" class="visible-toggle" data-id="{{ $user->id }}"
                                                {{ $user->visible ? 'checked' : '' }}>
                                            <span class="slider round"></span>
                                        </label> --}}

                                        <!-- Custom Visible Toggle -->
<div class="checkbox-wrapper-35">
    <input name="visible-toggle" id="visible-toggle-{{ $user->id }}" type="checkbox" class="switch visible-toggle" data-id="{{ $user->id }}" {{ $user->visible ? 'checked' : '' }}>
    <label for="visible-toggle-{{ $user->id }}">
        <span class="switch-x-text">Visibility: </span>
        <span class="switch-x-toggletext">
            <span class="switch-x-unchecked"><span class="switch-x-hiddenlabel"></span>Off</span>
            <span class="switch-x-checked"><span class="switch-x-hiddenlabel"></span>On</span>
        </span>
    </label>
</div>

<!-- Custom Leave Toggle -->
<div class="checkbox-wrapper-35">
    <input  id="status-toggle-{{ $user->id }}" type="checkbox" class="switch status-toggle" data-id="{{ $user->id }}" {{ ($user->status == 'active') ? 'checked' : ' ' }}>
    <label for="status-toggle-{{ $user->id }}">
        <span class="switch-x-text">Status: </span>
        <span class="switch-x-toggletext">
            <span class="switch-x-unchecked"><span class="switch-x-hiddenlabel"></span>Leave</span>
            <span class="switch-x-checked"><span class="switch-x-hiddenlabel"></span>Active</span>
        </span>
    </label>
</div>

                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script>
        $(document).ready(function() {
            // Status Toggle
            $('.status-toggle').change(function() {
                var status = $(this).prop('checked') ? 'inactive' : 'active';
                var userId = $(this).data('id');

                $.ajax({
                    url: '{{ route('admin.activeStatus') }}',
                    method: 'GET',
                    data: {
                        status: status,
                        id: userId
                    },
                    success: function(response) {
                        console.log('Success:', response);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', xhr.responseText);
                    }
                });
            });

            // Visible Toggle
            $('.visible-toggle').change(function() {
                var visible = $(this).prop('checked') ? 1 : 0; // Send 1 if checked, 0 if unchecked
                var userId = $(this).data('id');

                $.ajax({
                    url: '{{ route('admin.changeVisible') }}', // This will be a new route for handling visible status
                    method: 'GET',
                    data: {
                        visible: visible,
                        id: userId
                    },
                    success: function(response) {
                        console.log('Success:', response);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', xhr.responseText);
                    }
                });
            });

        });
    </script> --}}
<script>
    $(document).ready(function() {
        // Status Toggle
        $('.status-toggle').change(function() {
    var status = $(this).prop('checked') ? 'active' : 'inactive';
    var userId = $(this).data('id');

    $.ajax({
        url: '{{ route('admin.activeStatus') }}',
        method: 'GET',
        data: {
            status: status,
            id: userId
        },
        success: function(response) {
            console.log('Success:', response);
        },
        error: function(xhr, status, error) {
            console.error('Error:', xhr.responseText);
        }
    });
});


        // Visible Toggle
        $('.visible-toggle').change(function() {
            var visible = $(this).prop('checked') ? 1 : 0; // Send 1 if checked, 0 if unchecked
            var userId = $(this).data('id');

            $.ajax({
                url: '{{ route('admin.changeVisible') }}',
                method: 'GET',
                data: {
                    visible: visible,
                    id: userId
                },
                success: function(response) {
                    console.log('Success:', response);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', xhr.responseText);
                }
            });
        });
    });
</script>

<script>
    // When the page loads, check if there are validation errors
    window.onload = function() {
        @if ($errors->any())
            // Show the modal if there are validation errors
            var myModal = new bootstrap.Modal(document.getElementById('verticalycentered'));
            myModal.show();
        @endif
    };
</script>



@endsection
