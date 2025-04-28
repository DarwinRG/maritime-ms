@extends('student.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card">
                <div class="card-header">Update Profile</div>
                <div class="card-body">
                    <form action="{{ route('student.setting.update',$student->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Profile Picture --}}
                        <div class="mb-3 text-center">

                            <img src="{{ Storage::url($student->user->avatar) }}" alt="Profile Picture"
                                 class="rounded-circle mb-2" width="150" height="150">
                            <input type="file" class="form-control" name="avatar">
                        </div>

                        <div class="row">
                            <div class="mb-3">
                                <label>Email Address</label>
                                <input type="text" disabled class="form-control" value="{{ $student->user->email }}">
                            </div>
                            <div class="mb-3">
                                <label>Address</label>
                                <input type="text" name="address" class="form-control" value="{{ $student->address }}">
                            </div>
                        </div>


                    {{-- Barko Details --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Ship On Boarding Date</label>
                            <input type="date" name="board_on" class="form-control" value="{{ $student->boarding->boarding_on??'' }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Ship Off Boarding Date</label>
                            <input type="date" name="board_off" class="form-control" value="{{ $student->boarding->boarding_off??'' }}" required>
                        </div>
                    </div>

                        {{-- Personal Details --}}
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label>First Name</label>
                                <input type="text" name="first_name" class="form-control" value="{{ $student->first_name }}" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Middle Name</label>
                                <input type="text" name="middle_name" class="form-control" value="{{ $student->middle_name }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Last Name</label>
                                <input type="text" name="last_name" class="form-control" value="{{ $student->last_name }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Birth Date</label>
                            <input type="date" name="birth_date" class="form-control" value="{{ $student->birth_date }}">
                        </div>

                        <div class="mb-3">
                            <label>Contact</label>
                            <input type="text" name="contact" class="form-control" value="{{ $student->contact }}">
                        </div>

                        <div class="mb-3">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control" value="{{ $student->address }}">
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label>Street</label>
                                <input type="text" name="street" class="form-control" value="{{ $student->street }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>City</label>
                                <input type="text" name="city" class="form-control" value="{{ $student->city }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Province</label>
                                <input type="text" name="province" class="form-control" value="{{ $student->province }}">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
