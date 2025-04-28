@extends('teacher.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12 mb-3">
            <h3>Schedule Details</h3>
            <div class="card shadow-sm p-3">
                <div class="card-body d-flex flex-column flex-md-row justify-content-between">
                    <div>
                        <p><strong>Day:</strong> {{ $schedule->day }}</p>
                        <p><strong>Start Time:</strong> {{ date('h:i a', strtotime($schedule->start_at)) }}</p>
                        <p><strong>End Time:</strong> {{ date('h:i a', strtotime($schedule->end_at)) }}</p>
                        <p><strong>Teacher:</strong> {{ $schedule->teacher->last_name }}, {{ $schedule->teacher->first_name }} {{ $schedule->teacher->middle_name }}</p>
                        <p><strong>Subject:</strong> {{ $schedule->subject->name }}</p>
                        <p><strong>Code:</strong> {{ $schedule->subject->course->code }}</p>
                        <p><strong>Section:</strong> {{ $schedule->section->name }}</p>
                        <p><strong>Year:</strong> {{ $schedule->year->name }}</p>
                    </div>

                    <div class="mt-3 mt-md-0">
                        <div class="mb-3 d-flex flex-column flex-sm-row" style="gap: 10px;">
                           <div class="mb-2 mb-sm-0">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                New Module
                            </button>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <form enctype="multipart/form-data" action="{{ route('teacher.module.store') }}" method="POST">
                                        @csrf
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">New Activity</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Title -->
                                                    <div class="form-group">
                                                        <label for="title" class="control-label">Title</label>
                                                        <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                                                    </div>

                                                    <!-- Description -->
                                                    <div class="form-group">
                                                        <label for="description" class="control-label">Description</label>
                                                        <textarea name="description" id="description" rows="4" class="form-control" required>
                                                            {{ old('description') }}
                                                        </textarea>
                                                    </div>

                                                      <!-- Date End -->
                                                    <div class="form-group">
                                                        <label for="end_date" class="control-label">Date End</label>
                                                        <input type="datetime-local" class="form-control" name="end_date" value="{{ old('end_date') }}">
                                                    </div>

                                                </div>

                                                <!-- Modal Footer -->
                                                <div class="modal-footer">
                                                    <input type="hidden" value="{{ $schedule->id }}" name="schedule_id">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                           </div>
                           <div class="mb-2 mb-sm-0">
                            <button type="button" class="btn btn-success text-white" data-bs-toggle="modal" data-bs-target="#exampleModalStudent">
                                New Student
                            </button>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalStudent" tabindex="-1" aria-labelledby="exampleModalStudentLabel" aria-hidden="true">
                                    <form  action="{{ route('teacher.student.store') }}" method="POST">
                                        @csrf
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalStudentLabel">New Student</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">

                                                    <div class="form-group position-relative">
                                                        <label for="studentSearch" class="control-label">Search Student</label>
                                                        <input type="search" id="studentSearch" class="form-control" placeholder="Student ID, Last name, First name, Middle name">
                                                        <ul id="studentResults" class="list-group position-absolute w-100 mt-1 shadow" style="z-index: 1000; display: none;">
                                                            {{-- Results will be added here --}}
                                                        </ul>
                                                    </div>
                                                    <input type="hidden" name="student_id" id="addStudentToClass">
                                                    <script>
                                                        $(document).ready(function () {
                                                            $('#studentSearch').on('keyup', function () {
                                                                let query = $(this).val().trim();

                                                                if (query.length < 2) {
                                                                    $('#studentResults').hide().empty();
                                                                    return;
                                                                }

                                                                $.ajax({
                                                                    url: "{{ route('teacher.student.index') }}",
                                                                    type: "GET",
                                                                    data: { search: query },
                                                                    dataType: "json",
                                                                    success: function (response) {
                                                                        let dropdown = '';

                                                                        if (response.students.length > 0) {
                                                                            response.students.forEach(function (student) {
                                                                                dropdown += `
                                                                                    <li class="list-group-item list-group-item-action student-item" data-id="${student.id}">
                                                                                        ${student.last_name}, ${student.first_name} ${student.middle_name}
                                                                                        <small class="text-muted d-block">ID: ${student.student_id}</small>
                                                                                    </li>`;
                                                                            });
                                                                        } else {
                                                                            dropdown = '<li class="list-group-item text-muted">No students found.</li>';
                                                                        }

                                                                        $('#studentResults').html(dropdown).show();
                                                                    },
                                                                    error: function () {
                                                                        $('#studentResults').html('<li class="list-group-item text-danger">Error loading students.</li>').show();
                                                                    }
                                                                });
                                                            });

                                                            $(document).on('click', '.student-item', function () {
                                                                let studentName = $(this).text().trim();
                                                                $('#studentSearch').val(studentName);
                                                                $('#studentResults').hide().empty();

                                                                let studentId = $(this).data('id');
                                                                $('#addStudentToClass').val(studentId)

                                                            });

                                                            $(document).on('click', function (e) {
                                                                if (!$(e.target).closest('.form-group').length) {
                                                                    $('#studentResults').hide();
                                                                }
                                                            });
                                                        });
                                                    </script>

                                                </div>

                                                <!-- Modal Footer -->
                                                <div class="modal-footer">
                                                    <input type="hidden" value="{{ $schedule->id }}" name="schedule_id">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                           </div>
                       </div>

                        <div class="d-flex flex-column">
                            <!-- Total Modules (Clickable) -->
                            <div class="card mb-3 bg-primary text-white shadow-sm d-flex align-items-center p-3 hover-effect"
                                 data-bs-toggle="collapse" data-bs-target="#collapseModules"
                                 aria-expanded="false" aria-controls="collapseModules">
                                <div class="d-flex w-100 align-items-center">
                                    <i class="fas fa-book fa-3x me-3"></i>
                                    <div class="text-end flex-grow-1">
                                        <h5 class="mb-1">Total Modules</h5>
                                        <h2 class="mb-0">{{ $schedule->modules->count() }}</h2>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Students (Clickable) -->
                            <div class="card mb-3 bg-success text-white shadow-sm d-flex align-items-center p-3 hover-effect"
                                 data-bs-toggle="collapse" data-bs-target="#collapseStudents"
                                 aria-expanded="false" aria-controls="collapseStudents">
                                <div class="d-flex w-100 align-items-center">
                                    <i class="fas fa-users fa-3x me-3"></i>
                                    <div class="text-end flex-grow-1">
                                        <h5 class="mb-1">Total Students</h5>
                                        <h2 class="mb-0">{{ $schedule->list->count() }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button id="printTableBtn" class="btn btn-info mb-3 text-white">Print Record</button>
                        <script>
                            document.getElementById('printTableBtn').addEventListener('click', function() {
                                $('#ListSTudent').printThis({
                                    importCSS: true,        // Import page CSS
                                    importStyle: true,      // Import style tags
                                    loadCSS: "",            // Load additional CSS if needed
                                    pageTitle: "Student List", // Title for print
                                    removeInline: false,    // Keep inline styles
                                });
                            });
                        </script>
                    </div>

                </div>
            </div>
        </div>

        <!-- Accordion Container for Auto Close Feature -->
        <div class="col-12" id="accordionContainer">
            <!-- Collapsible List of Modules -->
            <div class="collapse show" id="collapseModules" data-bs-parent="#accordionContainer">
                <div class="card card-body shadow-sm">
                    <h5>List of Module</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-primary">
                                <tr>
                                    <th>Title</th>
                                    <th>Contents</th>
                                    <th>Status</th>
                                    <th>Date Expire</th>
                                    <th>View</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($schedule->modules as $module)
                                    <tr>
                                        <td>{{ $module->title }}</td>
                                        <td>{{ $module->list->count() }}</td>
                                        <td>{{ statusAction($module->status) }}</td>
                                        <td> {{ date('M d, Y - h:i a', strtotime($module->end_at)) }}</td>
                                        <td>
                                            <a href="{{ route('teacher.schedule_module.show',$module->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                        </td>
                                        <td>
                                            @include('teacher.schedule.action')
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Collapsible List of Students -->
            <div class="collapse" id="collapseStudents" data-bs-parent="#accordionContainer">
                <div class="card card-body shadow-sm">
                    <h5>List of Students</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="ListSTudent">
                            <thead class="table-success">
                                <tr>
                                    <th>Student ID</th>
                                    <th>Name</th>
                                    <th class="no-print">Status</th>
                                    <th>Boarding On Date</th>
                                    <th>Boarding Off Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($schedule->list as $student)
                                    <tr>
                                        <td>{{ $student->student->student_id }}</td>
                                        <td>{{ $student->student->last_name }}, {{ $student->student->first_name }} {{ $student->student->middle_name }}</td>
                                        <td class="no-print">
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

<!-- CSS for Hover Effects -->
<style>
    .hover-effect:hover {
        transform: scale(1.05);
        transition: 0.3s ease-in-out;
        cursor: pointer;
    }
</style>
<style>
    @media print {
        .no-print {
            display: none !important;
        }
    }
</style>
@endsection
