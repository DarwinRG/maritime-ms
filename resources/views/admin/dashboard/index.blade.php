@extends('admin.app')

@section('content')
<div class="container mt-4">
    <div class="row g-4">
        <!-- Card 1: Students -->
        <div class="col-md-3">
            <div class="card shadow-sm text-center">
                <div class="card-header bg-primary text-white">
                    <i class="fa fa-users fa-2x"></i>
                </div>
                <div class="card-body">
                    <h5 class="card-title mt-2">Total Students</h5>
                    <p class="card-text">{{ number_format($studentCount) }}</p>
                </div>
            </div>
        </div>

        <!-- Card 2: Courses (Schedules) -->
        <div class="col-md-3">
            <div class="card shadow-sm text-center">
                <div class="card-header bg-danger text-white">
                    <i class="fa fa-book fa-2x"></i>
                </div>
                <div class="card-body">
                    <h5 class="card-title mt-2">Total Schedules</h5>
                    <p class="card-text">{{ number_format($schedules) }}</p>
                </div>
            </div>
        </div>

        <!-- Card 3: Modules -->
        <div class="col-md-3">
            <div class="card shadow-sm text-center">
                <div class="card-header bg-warning text-white">
                    <i class="fa fa-calendar fa-2x"></i>
                </div>
                <div class="card-body">
                    <h5 class="card-title mt-2">Total Modules</h5>
                    <p class="card-text">{{ number_format($moduleCount) }}</p>
                </div>
            </div>
        </div>

        <!-- Card 4: Messages -->
        <div class="col-md-3">
            <div class="card shadow-sm text-center">
                <div class="card-header bg-success text-white">
                    <i class="fa fa-file fa-2x"></i>
                </div>
                <div class="card-body">
                    <h5 class="card-title mt-2">Total Content</h5>
                    <p class="card-text">{{ number_format($moduleListCount) }}</p>
                </div>
            </div>
        </div>


        <!-- Second Row -->
<div class="row g-4 mt-1">
    <!-- Card: Teachers -->
    <div class="col-md-3">
        <div class="card shadow-sm text-center">
            <div class="card-header bg-secondary text-white">
                <i class="fa fa-chalkboard-teacher fa-2x"></i>
            </div>
            <div class="card-body">
                <h5 class="card-title mt-2">Total Teachers</h5>
                <p class="card-text">{{ number_format($teacherCount) }}</p>
            </div>
        </div>
    </div>

    <!-- Card: Subjects -->
    <div class="col-md-3">
        <div class="card shadow-sm text-center">
            <div class="card-header bg-info text-white">
                <i class="fa fa-book-open fa-2x"></i>
            </div>
            <div class="card-body">
                <h5 class="card-title mt-2">Total Subjects</h5>
                <p class="card-text">{{ number_format($subjectCount) }}</p>
            </div>
        </div>
    </div>

    <!-- Card: Courses -->
    <div class="col-md-3">
        <div class="card shadow-sm text-center">
            <div class="card-header bg-dark text-white">
                <i class="fa fa-graduation-cap fa-2x"></i>
            </div>
            <div class="card-body">
                <h5 class="card-title mt-2">Total Courses</h5>
                <p class="card-text">{{ number_format($courseCount) }}</p>
            </div>
        </div>
    </div>
</div>


    </div>


</div>
@endsection