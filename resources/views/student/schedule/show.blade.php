@extends('student.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12 mb-3">
            <h3>Schedule Details</h3>
            <div class="card shadow-sm p-3">
                <div class="card-body">
                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-md-6 col-12 mb-3">
                            <p><strong>Day:</strong> {{ $student->schedule->day }}</p>
                            <p><strong>Start Time:</strong> {{ date('h:i a', strtotime($student->schedule->start_at)) }}</p>
                            <p><strong>End Time:</strong> {{ date('h:i a', strtotime($student->schedule->end_at)) }}</p>
                            <p><strong>Teacher:</strong> {{ $student->schedule->teacher->last_name }}, {{ $student->schedule->teacher->first_name }} {{ $student->schedule->teacher->middle_name }}</p>
                            <p><strong>Subject:</strong> {{ $student->schedule->subject->name }}</p>
                            <p><strong>Code:</strong> {{ $student->schedule->subject->course->code }}</p>
                            <p><strong>Section:</strong> {{ $student->schedule->section->name }}</p>
                            <p><strong>Year:</strong> {{ $student->schedule->year->name }}</p>
                        </div>

                        <!-- Right Column -->
                        <div class="col-md-6 col-12">
                            <div class="d-flex flex-column align-items-stretch">
                                <!-- Total Modules -->
                                <div class="card mb-3 bg-primary text-white shadow-sm p-3 hover-effect"
                                     data-bs-toggle="collapse" data-bs-target="#collapseModules"
                                     aria-expanded="false" aria-controls="collapseModules">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-book fa-2x me-3"></i>
                                        <div class="text-end w-100">
                                            <h5 class="mb-1">Total Modules</h5>
                                            <h3 class="mb-0">{{ $student->schedule->modules->count() }}</h3>
                                        </div>
                                    </div>
                                </div>

                                <!-- Total Students -->
                                <div class="card mb-3 bg-success text-white shadow-sm p-3 hover-effect"
                                     data-bs-toggle="collapse" data-bs-target="#collapseStudents"
                                     aria-expanded="false" aria-controls="collapseStudents">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-users fa-2x me-3"></i>
                                        <div class="text-end w-100">
                                            <h5 class="mb-1">Total Students</h5>
                                            <h3 class="mb-0">{{ $student->schedule->list->count() }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- row -->
                </div>
            </div>
        </div>

        <!-- Modules List -->
        <div class="col-12" id="accordionContainer">
            <div class="collapse show" id="collapseModules" data-bs-parent="#accordionContainer">
                <div class="card card-body shadow-sm mb-4">
                    <h5>List of Activities</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-primary">
                                <tr>
                                    <th>Title</th>
                                    <th>Contents</th>
                                    <th>Status</th>
                                    <th>Date Expire</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($student->schedule->modules as $module)
                                    <tr>
                                        <td>{{ $module->title }}</td>
                                        <td>{{ $module->list->count() }}</td>
                                        <td>{{ statusAction($module->status) }}</td>
                                        <td>{{ date('M d, Y - h:i a', strtotime($module->created_at)) }}</td>
                                        <td>
                                            <a href="{{ route('student.schedule_module.show',$module->id) }}" class="btn btn-info btn-sm">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Students List -->
            <div class="collapse" id="collapseStudents" data-bs-parent="#accordionContainer">
                <div class="card card-body shadow-sm mb-4">
                    <h5>List of Students</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-success">
                                <tr>
                                    <th>Student ID</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Boarding On Date</th>
                                    <th>Boarding Off Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($student->schedule->list as $student)
                                    <tr>
                                        <td>{{ $student->student->student_id }}</td>
                                        <td>{{ $student->student->last_name }}, {{ $student->student->first_name }} {{ $student->student->middle_name }}</td>
                                        <td>
                                            @if ($student->status)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $student->student->boarding ? date('M d, Y - h:i a', strtotime($student->student->boarding->boarding_on)) : 'N/A' }}
                                        </td>
                                        <td>
                                            {{ $student->student->boarding ? date('M d, Y - h:i a', strtotime($student->student->boarding->boarding_off)) : 'N/A' }}
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Hover & Responsive Table Style -->
<style>
    .hover-effect:hover {
        transform: scale(1.05);
        transition: 0.3s ease-in-out;
        cursor: pointer;
    }

    @media (max-width: 768px) {
        .table td, .table th {
            white-space: nowrap;
        }
    }
</style>
@endsection
