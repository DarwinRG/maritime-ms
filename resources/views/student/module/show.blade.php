@extends('student.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12 mb-3">
            <a href="{{ route('student.schedule.show',$scheduleModule->schedule_id) }}" class="btn btn-info text-white"><i class="fa fa-arrow-left"></i> Back to Schedule Details</a>
        </div>
        <div class="col-md-12 mb-3">
            <h3>Schedule Details</h3>
            <div class="card shadow-sm p-3">
                <div class="card-body d-flex justify-content-between">
                   <div>
                        <p><strong>Day:</strong> {{ $scheduleModule->schedule->day }}</p>
                        <p><strong>Start Time:</strong> {{ date('h:i a', strtotime($scheduleModule->schedule->start_at)) }}</p>
                        <p><strong>End Time:</strong> {{ date('h:i a', strtotime($scheduleModule->schedule->end_at)) }}</p>
                        <p><strong>Teacher:</strong> {{ $scheduleModule->schedule->teacher->last_name }}, {{ $scheduleModule->schedule->teacher->first_name }} {{ $scheduleModule->schedule->teacher->middle_name }}</p>
                        <p><strong>Subject:</strong> {{ $scheduleModule->schedule->subject->name }}</p>
                        <p><strong>Code:</strong> {{ $scheduleModule->schedule->subject->course->code }}</p>
                        <p><strong>Section:</strong> {{ $scheduleModule->schedule->section->name }}</p>
                        <p><strong>Year:</strong> {{ $scheduleModule->schedule->year->name }}</p>
                   </div>

                </div>
            </div>
        </div>

        <!-- Module List with Dropdown -->
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5>{{ $scheduleModule->title }}</h5>
                    <ul class="list-group">
                        @if (!empty($module->list))
                            @foreach($module->list as $file)
                            <li class="list-group-item d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2 flex-wrap">
                                <div class="flex-grow-1" style="min-width: 0;">
                                    <button class="btn btn-link text-decoration-none p-0 text-break text-wrap" data-bs-toggle="collapse" data-bs-target="#file{{ $file->id }}">
                                        <i class="fa fa-folder-open"></i> {{ $file->title }}
                                    </button>
                                    <div class="mt-1">
                                        <span class="badge bg-primary text-uppercase">
                                            {{ $file->module_is ? 'Activity' : 'Learning Materials' }}
                                        </span>
                                    </div>
                                </div>

                                @if ($file->module_is)
                                    @include('student.module.view')
                                @endif

                                <div class="d-flex align-items-center flex-wrap text-break">
                                    <span class="badge bg-primary text-wrap">
                                        {{ date('M d, Y - h:i a', strtotime($file->start_at)) }} ~ {{ date('M d, Y - h:i a', strtotime($file->end_at)) }}
                                    </span>
                                </div>
                            </li>

                                <div class="collapse" id="file{{ $file->id }}">
                                    <div class="card card-body mt-2">
                                        @if ($file->module_is)
                                            <p><strong>POINTS:</strong> {{ $file->points }}</p>
                                            <p><strong>DEADLINE:</strong> {{ date('M d, Y - h:i a', strtotime($file->start_at)) }} ~ {{ date('M d, Y - h:i a', strtotime($file->end_at)) }}</p>
                                        @endif
                                        <p>{!! $file->description !!}</p>
                                        @if ($file->file)
                                            <p><strong>Link:</strong> <a target="_blank" href="">{{ $file->file }}</a></p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </ul>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection
