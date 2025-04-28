@extends('teacher.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12 mb-3">
            <a href="{{ route('teacher.schedule.show',$scheduleModule->schedule_id) }}" class="btn btn-info text-white"><i class="fa fa-arrow-left"></i> Back to Schedule Details</a>
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
                   <div>
                     <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        New Content
                      </button>
                      <!-- Modal -->
                      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <form enctype="multipart/form-data" action="{{ route('teacher.schedule_module.store') }}" method="POST">
                            @csrf
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ $scheduleModule->title }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Title -->
                                        <div class="form-group">
                                            <label for="title" class="control-label">Title</label>
                                            <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="title" class="control-label">Content Type</label>
                                            <select name="module_is" class="form-control" id="module_is">
                                                <option selected disabled>Select Content</option>
                                                <option value="0">Learning Materials</option>
                                                <option value="1">Activity</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="points" class="control-label">Points / Score</label>
                                            <input type="number" class="form-control" name="points" value="{{ old('points') }}">
                                        </div>


                                        <!-- File Link (Optional) -->
                                        <div class="form-group">
                                            <label for="file_link" class="control-label">Link File (Optional)</label>
                                            <input type="text" class="form-control" name="file_link" value="{{ old('file_link') }}">
                                        </div>

                                        <!-- Date Start -->
                                        <div class="form-group">
                                            <label for="start_date" class="control-label">Date Start</label>
                                            <input type="datetime-local" class="form-control" name="start_date" value="{{ old('start_date') }}">
                                        </div>

                                        <!-- Date End -->
                                        <div class="form-group">
                                            <label for="end_date" class="control-label">Date End</label>
                                            <input type="datetime-local" class="form-control" name="end_date" value="{{ old('end_date') }}">
                                        </div>

                                        <!-- Description -->
                                        <div class="form-group">
                                            <label for="description" class="control-label">Description</label>
                                            <textarea name="description" id="description" rows="4" class="form-control summernote" required>
                                                {{ old('description') }}
                                            </textarea>
                                        </div>
                                    </div>

                                    <!-- Modal Footer -->
                                    <div class="modal-footer">
                                        <input type="hidden" value="{{ $scheduleModule->schedule_id }}" name="schedule_id">
                                        <input type="hidden" value="{{ $scheduleModule->id }}" name="module_id">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

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
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div style="max-width: 500px;">
                                    <button class="btn btn-link text-decoration-none" data-bs-toggle="collapse" data-bs-target="#file{{ $file->id }}">
                                        <i class="fa fa-folder-open"></i> {{ $file->title }}
                                    </button>
                                    @if (!$file->module_is)
                                    <span class="badge bg-primary text-uppercase">Learning Materials</span>
                                    @else
                                    <span class="badge bg-primary text-uppercase">Activity</span>
                                    @endif
                                </div>

                                @if ($file->module_is)
                                @include('teacher.module.view')

                                @endif

                                @include('teacher.module.action')

                            </li>
                            <div class="collapse" id="file{{ $file->id }}">
                                <div class="card card-body">
                                    @if ($file->module_is)
                                    <p><strong>POINTS : </strong> {{ $file->points }}</p>
                                    <p><strong>DEADLINE : </strong> {{ date('M d, Y - h:i a', strtotime($file->start_at)) }} ~ {{ date('M d, Y - h:i a', strtotime($file->end_at)) }}</p>
                                    @endif
                                    <p>{!! $file->description  !!}</p>
                                    @if ($file->file)
                                     <p><strong>LINK : </strong> <a target="_blank" href="">{{ $file->file }}</a></p>
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
