@extends('admin.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12 mb-3">
            <h3>Schedule Details</h3>
            <div class="card shadow-sm p-3">
                <div class="card-body">
                    <p><strong>Day:</strong> {{ $schedule->day }}</p>
                    <p><strong>Start Time:</strong> {{ $schedule->start_at }}</p>
                    <p><strong>End Time:</strong> {{ $schedule->end_at }}</p>
                    <p><strong>Teacher:</strong> {{ $schedule->teacher->last_name }}, {{ $schedule->teacher->first_name }} {{ $schedule->teacher->middle_name }}</p>
                    <p><strong>Subject:</strong> {{ $schedule->subject->name }}</p>
                    <p><strong>Code:</strong> {{ $schedule->subject->code }}</p>
                    <p><strong>Section:</strong> {{ $schedule->section->name }}</p>
                    <p><strong>Year:</strong> {{ $schedule->year->name }}</p>
                    <p><strong>Others:</strong> {{ $schedule->others }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3>List of Students</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Contact</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($schedule->list as $item)
                        <tr>
                            <td>{{ $item->student->student_id }}</td>
                            <td>{{ $item->student->last_name }}</td>
                            <td>{{ $item->student->first_name }}</td>
                            <td>{{ $item->student->middle_name }}</td>
                            <td>{{ $item->student->contact }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
