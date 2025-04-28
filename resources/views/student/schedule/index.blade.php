@extends('student.app')


@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12 mb-3">
           <h3>Schedule</h3>
        </div>

        <div class="col-md-12">
            <div class="table-responsive">

            <table class="table">
                <thead>
                    <tr>
                        <th>Teacher ID</th>
                        <th>Section</th>
                        <th>Teacher</th>
                        <th>Subject</th>
                        <th>Year</th>
                        <th>Day</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Status</th>
                        <th>View</th>


                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td>{{ $student->schedule->teacher->teacher_id }}</td>
                            <td>{{ $student->schedule->section->name }}</td>
                            <td>{{ $student->schedule->teacher->first_name }} {{ $student->schedule->teacher->last_name }}</td>
                            <td>{{ $student->schedule->subject->name }}</td>
                            <td>{{ $student->schedule->year->name }}</td>
                            <td>{{ $student->schedule->day }}</td>
                            <td>{{ \Carbon\Carbon::parse($student->schedule->start_at)->format('h:i A') }}</td>
                            <td>{{ \Carbon\Carbon::parse($student->schedule->end_at)->format('h:i A') }}</td>
                            <td>
                                @if ($student->schedule->status)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('student.schedule.show',$student->schedule->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
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
