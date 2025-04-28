@extends('teacher.app')

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
                    <form action="{{ route('teacher.setting.update',$teacher->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Profile Picture --}}
                        <div class="mb-3 text-center">

                            <img src="{{ Storage::url($teacher->user->avatar) }}" alt="Profile Picture"
                                 class="rounded-circle mb-2" width="150" height="150">
                            <input type="file" class="form-control" name="avatar">
                        </div>

                        {{-- Personal Details --}}
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label>First Name</label>
                                <input type="text" name="first_name" class="form-control" value="{{ $teacher->first_name }}" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Middle Name</label>
                                <input type="text" name="middle_name" class="form-control" value="{{ $teacher->middle_name }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Last Name</label>
                                <input type="text" name="last_name" class="form-control" value="{{ $teacher->last_name }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Birth Date</label>
                            <input type="date" name="birth_date" class="form-control" value="{{ $teacher->birth_date }}">
                        </div>

                        <div class="mb-3">
                            <label>Contact</label>
                            <input type="text" name="contact" class="form-control" value="{{ $teacher->contact }}">
                        </div>

                        <div class="mb-3">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control" value="{{ $teacher->address }}">
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label>Street</label>
                                <input type="text" name="street" class="form-control" value="{{ $teacher->street }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>City</label>
                                <input type="text" name="city" class="form-control" value="{{ $teacher->city }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Province</label>
                                <input type="text" name="province" class="form-control" value="{{ $teacher->province }}">
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
