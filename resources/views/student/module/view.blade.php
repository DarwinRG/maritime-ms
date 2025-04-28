<div>

    <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModalView-{{ $file->id }}">
        <i class="fa fa-users text-primary"> {{ $file->activity_count }} / {{ $file->completedActivities->count() }}</i>
    </a>

    <!-- Main Modal for Viewing Students -->
    <div class="modal fade" id="exampleModalView-{{ $file->id }}" tabindex="-1" aria-labelledby="exampleModalViewLabel-{{ $file->id }}" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $file->title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="card card-body shadow-sm">
                        <h5>List of Students</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-success">
                                    <tr>
                                        <th>Student ID</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>File</th>
                                        <th>Action</th>
                                        <th>Date Submitted</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($file->activity as $student)
                                        <tr>
                                            <td>{{ $student->student->student_id }}</td>
                                            <td>{{ $student->student->last_name }}, {{ $student->student->first_name }} {{ $student->student->middle_name }}</td>
                                            <td>{{ statusActivity($student->status) }}</td>
                                            <td>
                                                @can('view', $student)
                                                @if($student->status !== 2 && $student->file == null)

                                                @else
                                                <a href="{{ route('student.module_score.show',$student->id) }}" target="_blank">
                                                    <i class="fa fa-file-pdf text-danger" style="font-size: 20px;"></i>
                                                </a>
                                                @endif
                                             @endcan
                                            </td>

                                            <td>
                                                @can('view', $student)
                                                @if($student->status !== 2 && $student->file == null)
                                                    @include('student.module.action')
                                                @else
                                                    @include('student.module.update')
                                                @endif
                                             @endcan
                                            </td>
                                            <td>{{ date('M d, Y - h:i a', strtotime($student->updated_at)) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Main Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Upload Modals (OUTSIDE the Loop to Prevent Nesting Issues) -->
@foreach($file->activity as $student)
    <div class="modal fade" id="uploadModal-{{ $file->id }}-{{ $student->id }}" tabindex="-1" aria-labelledby="uploadModalLabel-{{ $file->id }}-{{ $student->id }}" aria-hidden="true">
        <form action="{{ route('student.module.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><strong>NOTE ONLY ACCEPT PDF/JPG/JPEG/PNG</strong></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 text-center">
                            <img src="" alt="Preview" class="img-fluid rounded" style="max-height: 200px; display: none;">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">UPLOAD IMAGE / PDF FILE</label>
                            <input class="form-control" type="file" name="file" accept=".pdf, .jpeg, .png, .jpg">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="module_id" value="{{ $module->id }}">
                        <input type="hidden" name="module_list_id" value="{{ $file->id }}">
                        <input type="hidden" name="module_list_student_id" value="{{ $student->id }}">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <div class="modal fade" id="updateModal-{{ $file->id }}-{{ $student->id }}" tabindex="-1" aria-labelledby="updateModalLabel-{{ $file->id }}-{{ $student->id }}" aria-hidden="true">
        <form action="{{ route('student.module.update',$student->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><strong>NOTE ONLY ACCEPT PDF/JPG/JPEG/PNG</strong></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 text-center">
                            <img src="" alt="Preview" class="img-fluid rounded" style="max-height: 200px; display: none;">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">UPDATE IMAGE / PDF FILE</label>
                            <input class="form-control" type="file" name="file" accept=".pdf, .jpeg, .png, .jpg">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="module_id" value="{{ $module->id }}">
                        <input type="hidden" name="module_list_id" value="{{ $file->id }}">
                        <input type="hidden" name="module_list_student_id" value="{{ $student->id }}">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endforeach
