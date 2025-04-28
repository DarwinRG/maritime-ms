@extends('admin.app')


@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12 mb-3">
            <!-- Button to trigger modal -->
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addScheduleModal">
                Add Schedule
            </button>

            <!-- Add Schedule Modal -->
            <div class="modal fade" id="addScheduleModal" tabindex="-1" aria-labelledby="addScheduleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <form action="{{ route('admin.schedule.store') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addScheduleModalLabel">Add Schedule</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                        <label for="section_id" class="form-label">Section</label>
                        <select name="section_id" id="section_id" class="form-select @error('section_id') is-invalid @enderror">
                            <option value="">-- Select Section --</option>
                            @foreach ($sections as $section)
                            <option value="{{ $section->id }}">{{ $section->name }}</option>
                            @endforeach
                        </select>
                        @error('section_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>

                        <div class="mb-3">
                        <label for="teacher_id" class="form-label">Teacher</label>
                        <select name="teacher_id" id="teacher_id" class="form-select @error('teacher_id') is-invalid @enderror">
                            <option value="">-- Select Teacher --</option>
                            @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->last_name }}, {{ $teacher->first_name }} {{ $teacher->middle_name }}</option>
                            @endforeach
                        </select>
                        @error('teacher_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>

                        <div class="mb-3">
                        <label for="subject_id" class="form-label">Subject</label>
                        <select name="subject_id" id="subject_id" class="form-select @error('subject_id') is-invalid @enderror">
                            <option value="">-- Select Subject --</option>
                            @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endforeach
                        </select>
                        @error('subject_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>

                        <div class="mb-3">
                        <label for="year_id" class="form-label">Year</label>
                        <select name="year_id" id="year_id" class="form-select @error('year_id') is-invalid @enderror">
                            <option value="">-- Select Year --</option>
                            @foreach ($years as $year)
                            <option value="{{ $year->id }}">{{ $year->name }}</option>
                            @endforeach
                        </select>
                        @error('year_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>

                        <div class="mb-3">
                        <label for="day" class="form-label">Day</label>
                        <select name="day" id="day" class="form-select @error('day') is-invalid @enderror">
                            <option value="">-- Select Day --</option>
                            @foreach (['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'] as $day)
                            <option value="{{ $day }}">{{ $day }}</option>
                            @endforeach
                        </select>
                        @error('day')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>

                        <div class="mb-3">
                        <label for="start_at" class="form-label">Start Time</label>
                        <input type="time" class="form-control @error('start_at') is-invalid @enderror" name="start_at" id="start_at">
                        @error('start_at')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>

                        <div class="mb-3">
                        <label for="end_at" class="form-label">End Time</label>
                        <input type="time" class="form-control @error('end_at') is-invalid @enderror" name="end_at" id="end_at">
                        @error('end_at')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>

                        <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="status" id="status" value="1" checked>
                        <label class="form-check-label" for="status">
                            Active
                        </label>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Schedule</button>
                    </div>
                    </div>
                </form>
                </div>
            </div>

        </div>
        <div class="col-md-12 mb-3">
           <h3> Manage Schedule</h3>
        </div>
{{--
        <div class="col-md-12 my-3">
            <form action="" method="GET">
               <div class="row">
                <div class="col-md-9">
                    <div class="form-group">
                        <input type="search" name="search" placeholder="Search Item" class="form-control" value="{{ request('search') }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <button type="submit" class="btn btn-info text-white">Search</button>
                    </div>
                </div>
               </div>
            </form>
        </div> --}}
        <div class="col-md-12">
            <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Teacher ID</th>
                        <th>Section</th>
                        <th>Teacher</th>
                        <th>Subject</th>
                        <th>Code</th>
                        <th>Year</th>
                        <th>Day</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Status</th>
                        <th>Total Students</th>
                        <th>View</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($schedules as $schedule)
                        <tr>
                            <td>{{ $schedule->teacher->teacher_id }}</td>
                            <td>{{ $schedule->section->name }}</td>
                            <td>{{ $schedule->teacher->first_name }} {{ $schedule->teacher->last_name }}</td>
                            <td>{{ $schedule->subject->name }}</td>
                            <td>{{ $schedule->subject->code }}</td>
                            <td>{{ $schedule->year->name }}</td>
                            <td>{{ $schedule->day }}</td>
                            <td>{{ \Carbon\Carbon::parse($schedule->start_at)->format('h:i A') }}</td>
                            <td>{{ \Carbon\Carbon::parse($schedule->end_at)->format('h:i A') }}</td>
                            <td>
                                @if ($schedule->status)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                {{ $schedule->list_count }}
                            </td>
                            <td>
                                <a href="{{ route('admin.schedule.show',$schedule->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                            </td>
                            <td class="d-flex align-items-start" style="gap: 5px;">
                                <button type="button" class="btn btn-sm btn-primary" style="margin: 0px !important;" data-bs-toggle="modal" data-bs-target="#modalEdit-{{ $schedule->id }}">
                                    <i class="fa fa-pencil"></i>
                                </button>

                                <div class="modal fade" id="modalEdit-{{ $schedule->id }}" tabindex="-1" aria-labelledby="editScheduleModalLabel" aria-hidden="true">
                                    <form action="{{ route('admin.schedule.update', $schedule->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Schedule</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="form-group">
                                                        <label for="subject_id">Select Subject</label>
                                                        <select class="form-control" name="subject_id">
                                                            @foreach ($subjects as $subject)
                                                                <option value="{{ $subject->id }}" {{ $schedule->subject_id == $subject->id ? 'selected' : '' }}>
                                                                    {{ $subject->name }} ({{ $subject->course->name }} - {{ $subject->course->code }})
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="section_id">Select Section</label>
                                                        <select class="form-control" name="section_id">
                                                            @foreach ($sections as $section)
                                                                <option value="{{ $section->id }}" {{ $schedule->section_id == $section->id ? 'selected' : '' }}>
                                                                    {{ $section->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="year_id">Select Year</label>
                                                        <select class="form-control" name="year_id">
                                                            @foreach ($years as $year)
                                                                <option value="{{ $year->id }}" {{ $schedule->year_id == $year->id ? 'selected' : '' }}>
                                                                    {{ $year->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="teacher_id">Select Teacher</label>
                                                        <select class="form-control" name="teacher_id">
                                                            @foreach ($teachers as $teacher)
                                                                <option value="{{ $teacher->id }}" {{ $schedule->teacher_id == $teacher->id ? 'selected' : '' }}>
                                                                    {{ $teacher->last_name }}, {{ $teacher->first_name }} {{ $teacher->middle_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="day" class="form-label">Day</label>
                                                        <select name="day" id="day" class="form-select @error('day') is-invalid @enderror">
                                                            <option value="">-- Select Day --</option>
                                                            @foreach (['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'] as $day)
                                                                <option value="{{ $day }}" {{ old('day', $schedule->day ?? '') == $day ? 'selected' : '' }}>
                                                                    {{ $day }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('day')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>


                                                    <div class="form-group">
                                                        <label for="start_at">Start Time</label>
                                                        <input type="time" class="form-control" name="start_at" value="{{ $schedule->start_at }}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="end_at">End Time</label>
                                                        <input type="time" class="form-control" name="end_at" value="{{ $schedule->end_at }}">
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update Schedule</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>


                                    <form action="{{ route('admin.schedule.destroy', $schedule->id) }}" method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger text-white btn-sm  delete-btn">
                                            <i class="fa fa-archive"></i>
                                        </button>
                                    </form>

                                    <script>
                                        document.addEventListener("DOMContentLoaded", function () {
                                            document.querySelectorAll('.delete-btn').forEach(button => {
                                                button.addEventListener('click', function (event) {
                                                    event.preventDefault();
                                                    let form = this.closest('.delete-form');

                                                    Swal.fire({
                                                        title: "Are you sure?",
                                                        text: "This action cannot be undone!",
                                                        icon: "warning",
                                                        showCancelButton: true,
                                                        confirmButtonColor: "#d33",
                                                        cancelButtonColor: "#3085d6",
                                                        confirmButtonText: "Yes, Archive it!"
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            form.submit();
                                                        }
                                                    });
                                                });
                                            });
                                        });
                                    </script>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
              <div>
                {{-- {{ $categories->links('pagination::bootstrap-4') }} --}}

              </div>
        </div>
    </div>
</div>
@endsection
