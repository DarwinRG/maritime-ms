<div>
    <!-- Main Modal Trigger -->
    <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModalView-{{ $file->id }}">
        <i class="fa fa-users text-primary">  {{ $file->activity_count }} / {{ $file->completedActivities->count() }}</i>
    </a>

    <!-- Main Modal -->
    <div class="modal fade" id="exampleModalView-{{ $file->id }}" tabindex="-1" aria-labelledby="exampleModalViewLabel" aria-hidden="true">
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
                                        <th>Points</th>

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
                                                <a href="{{ route('teacher.module_score.show',$student->id) }}" target="_blank">
                                                    <i class="fa fa-file-pdf text-danger" style="font-size: 20px;"></i>
                                                </a>
                                            </td>
                                            <td>{{ $student->points }}</td>

                                            <td>
                                                <!-- Edit Button (Triggers Upload Modal) -->
                                                <button type="button" class="btn btn-sm btn-primary edit-btn"
                                                        data-student-id="{{ $student->id }}">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                            </td>
                                            <td>{{ date('M d, Y - h:i a', strtotime($student->updated_at)) }}</td>
                                        </tr>

                                        <!-- Upload Modal (Hidden) -->
                                        <div class="modal fade scoreModal" id="scoreModal-{{ $student->id }}" tabindex="-1" aria-labelledby="scoreModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">UPDATE POINTS FOR {{ $student->student->last_name }}, {{ $student->student->first_name }} {{ $student->student->middle_name }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('teacher.module_score.update', $student->id) }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            {{-- <div class="mb-3">
                                                                <label for="fileUpload" class="form-label">Upload File</label>
                                                                <input type="file" class="form-control" name="file" required>
                                                            </div> --}}
                                                            <div class="mb-3">
                                                                <label for="points" class="form-label">Points</label>
                                                                <input type="number" class="form-control" name="points" min="0" value="{{ $student->points }}" required>
                                                            </div>
                                                            <button type="submit" class="btn btn-success">Submit</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to Open Modal Again When Editing -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function () {
                let studentId = this.getAttribute('data-student-id');
                let modal = new bootstrap.Modal(document.getElementById(`scoreModal-${studentId}`));
                modal.show();
            });
        });
    });
</script>
