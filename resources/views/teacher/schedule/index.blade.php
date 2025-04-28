@extends('teacher.app')


@section('content')
<div class="container mt-4">
    <div class="row">
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
                        <th>Year</th>
                        <th>Day</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Status</th>
                        <th>Total Students</th>
                        <th>View</th>


                    </tr>
                </thead>
                <tbody>
                    @foreach ($schedules as $schedule)
                        <tr>
                            <td>{{ $schedule->teacher->teacher_id }}</td>
                            <td>{{ $schedule->section->name }}</td>
                            <td>{{ $schedule->teacher->first_name }} {{ $schedule->teacher->last_name }}</td>
                            <td>{{ $schedule->subject->name }}</td>
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
                                <a href="{{ route('teacher.schedule.show',$schedule->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
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
