@extends('guest.app')
@section('content')

<div class="container-fluid p-5">
    <div class="card card-outline-secondary">
        <div class="card-header">
            <h3 class="mb-0">ALUMNI REGISTRATION FORM</h3>
        </div>
        <div class="card-body">
            <form class="form" role="form" autocomplete="off">
               <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="">School Information</h1>
                </div>
                <div class="col-md-3">
                <div class="form-group">
                    <label for="studentNumber">Student Number (ALUMNI)</label>
                    <input type="text" name="student_number" class="form-control" id="studentNumber" placeholder="Enter student number">
                </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="yearStarted">Year Started</label>
                        <input type="text" name="year_started" class="form-control" id="yearStarted" placeholder="Enter the year you started" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="yearGraduated">Year Graduated</label>
                        <input type="text" name="year_graduated" class="form-control" id="yearGraduated" placeholder="Enter the year you graduated" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="employmentStatus">Course Completed</label>
                        <select name="employment_status" class="form-control" id="employmentStatus">
                            <option value="" selected disabled>Select your course completed</option>
                            <option value="Employed">Employed</option>
                            <option value="Unemployed">Unemployed</option>
                            <option value="Self-employed">Self-employed</option>
                            <option value="Student">Student</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <hr style="height: 1.2px; background-color: rgb(218, 197, 197); border: none;">
                    <h1 class="">Student Information</h1>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <input type="text" name="first_name" class="form-control" id="firstName" placeholder="Enter first name">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="middleName">Middle Name</label>
                        <input type="text" name="middle_name" class="form-control" id="middleName" placeholder="Enter middle name">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="lastName">Last Name</label>
                        <input type="text" name="last_name" class="form-control" id="lastName" placeholder="Enter last name">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="suffix">Suffix</label>
                        <input type="text" name="suffix" class="form-control" id="suffix" placeholder="e.g., Jr., Sr., III (if applicable)">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" name="address" class="form-control" id="address" placeholder="Enter your full address">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="street">Street</label>
                        <input type="text" name="street" class="form-control" id="street" placeholder="Enter your street name">
                    </div>
                </div>
                <div class="col-md-3">

                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" name="city" class="form-control" id="city" placeholder="Enter your city">
                </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="province">Province</label>
                        <input type="text" name="province" class="form-control" id="province" placeholder="Enter your province">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="dob">Date of Birth</label>
                        <input type="date" name="dob" class="form-control" id="dob">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="contact">Contact Number</label>
                        <input type="date" name="contact" class="form-control" id="contact">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="employmentStatus">Employment Status</label>
                        <select name="employment_status" class="form-control" id="employmentStatus">
                            <option value="" selected disabled>Select your employment status</option>
                            <option value="Employed">Employed</option>
                            <option value="Unemployed">Unemployed</option>
                            <option value="Self-employed">Self-employed</option>
                            <option value="Student">Student</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                </div>
            </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-lg float-right">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
