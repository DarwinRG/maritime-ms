@extends('student.app')

@section('content')
<div class="container mt-4">
    <div class="row g-4">

        <!-- Card: Total Schedules -->
        <div class="col-md-4">
            <div class="card shadow-sm text-center">
                <div class="card-header bg-primary text-white">
                    <i class="fa fa-calendar-alt fa-2x"></i>
                </div>
                <div class="card-body">
                    <h5 class="card-title mt-2">My Schedules</h5>
                    <p class="card-text">{{ number_format($studentCount) }}</p>
                </div>
            </div>
        </div>

        <!-- Card: Total Modules -->
        <div class="col-md-4">
            <div class="card shadow-sm text-center">
                <div class="card-header bg-success text-white">
                    <i class="fa fa-book fa-2x"></i>
                </div>
                <div class="card-body">
                    <h5 class="card-title mt-2">My Modules</h5>
                    <p class="card-text">{{ number_format($moduleCount) }}</p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection