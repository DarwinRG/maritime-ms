@extends('admin.app')

@section('content')
<div class="container mt-4">
    <a href="{{ route('admin.student.index') }}" class="btn btn-info text-white my-2">Back</a>
    <div class="card w-100">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">Add New student</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.student.store') }}" method="POST">
                @csrf

                <!-- Student -->
                   <div class="form-group">
                    <label>Student ID</label>
                    <input type="text" name="student_id" class="form-control @error('student_id') is-invalid @enderror" value="{{ old('student_id') }}">
                    @error('student_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <!-- Email -->
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <!-- Passwords -->
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <hr>

                <h4>Personal Information</h4>

                <!-- First Name -->
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}">
                    @error('first_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <!-- Middle Name -->
                <div class="form-group">
                    <label>Middle Name</label>
                    <input type="text" name="middle_name" class="form-control @error('middle_name') is-invalid @enderror" value="{{ old('middle_name') }}">
                    @error('middle_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <!-- Last Name -->
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}">
                    @error('last_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <hr>

                <h4>Address Information</h4>

                <!-- Address -->
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}">
                    @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <!-- Street -->
                <div class="form-group">
                    <label>Street</label>
                    <input type="text" name="street" class="form-control @error('street') is-invalid @enderror" value="{{ old('street') }}">
                    @error('street') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <!-- City -->
                <div class="form-group">
                    <label>City</label>
                    <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" value="{{ old('city') }}">
                    @error('city') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <!-- Province -->
                <div class="form-group">
                    <label>Province</label>
                    <input type="text" name="province" class="form-control @error('province') is-invalid @enderror" value="{{ old('province') }}">
                    @error('province') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <hr>

                <h4>Other Details</h4>

                <!-- Birth Date -->
                <div class="form-group">
                    <label>Birth Date</label>
                    <input type="date" name="birth_date" class="form-control @error('birth_date') is-invalid @enderror" value="{{ old('birth_date') }}">
                    @error('birth_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <!-- Contact -->
                <div class="form-group">
                    <label>Contact Number</label>
                    <input type="text" name="contact" class="form-control @error('contact') is-invalid @enderror" value="{{ old('contact') }}">
                    @error('contact') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary mt-3">Save student</button>
            </form>
        </div>
    </div>
</div>
@endsection
