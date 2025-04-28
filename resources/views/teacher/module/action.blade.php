<div class="d-flex align-items-center" style="gap: 10px;">
    {{ statusAction($file->status) }}
    <span class="badge bg-primary">{{ date('M d, Y - h:i a', strtotime($file->start_at)) }} ~ {{ date('M d, Y - h:i a', strtotime($file->end_at)) }}</span>

    <!--modal-->

    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $file->id }}">
        <i class="fa fa-pencil text-white"></i>
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal-{{ $file->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form enctype="multipart/form-data" action="{{ route('teacher.schedule_module.update', $file->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Ensure update method is used -->

            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ $file->title }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                          <!-- status -->
                          <div class="form-group">
                            <label for="status" class="control-label">Status</label>
                            <select name="status" class="form-control">
                                <option value="1" {{ old('status', $file->status) == 1 ? 'selected' : '' }}>Active</option>
                                <option value="2" {{ old('status', $file->status) == 2 ? 'selected' : '' }}>Ended</option>
                            </select>
                          </div>
                        <!-- Title -->
                        <div class="form-group">
                            <label for="title" class="control-label">Title</label>
                            <input type="text" class="form-control" name="title"
                                   value="{{ old('title', $file->title) }}">
                        </div>

                        <div class="form-group">
                            <label for="title" class="control-label">Content Type</label>
                            <select name="module_is" class="form-control" id="module_is">
                                <option value="0" {{ $file->module_is == 0 ? 'selected' : '' }}>Learning Materials</option>
                                <option value="1" {{ $file->module_is == 1 ? 'selected' : '' }}>Activity</option>
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="points" class="control-label">Points / Score</label>
                            <input type="number" class="form-control" name="points" value="{{ old('points', $file->points) }}">
                        </div>


                        <!-- File Link (Optional) -->
                        <div class="form-group">
                            <label for="file_link" class="control-label">Link File (Optional)</label>
                            <input type="text" class="form-control" name="file_link"
                                   value="{{ old('file_link', $file->file) }}">
                        </div>

                        <!-- Date Start -->
                        <div class="form-group">
                            <label for="start_date" class="control-label">Date Start</label>
                            <input type="datetime-local" class="form-control" name="start_date"
                                   value="{{ old('start_date', date('Y-m-d\TH:i', strtotime($file->start_at))) }}">
                        </div>

                        <!-- Date End -->
                        <div class="form-group">
                            <label for="end_date" class="control-label">Date End</label>
                            <input type="datetime-local" class="form-control" name="end_date"
                                   value="{{ old('end_date', date('Y-m-d\TH:i', strtotime($file->end_at))) }}">
                        </div>

                        <!-- Description -->
                        <div class="form-group">
                            <label for="description" class="control-label">Description</label>
                            <textarea name="description" id="description" rows="4" class="form-control summernote" required>
                                {{ old('description', $file->description) }}
                            </textarea>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <input type="hidden" value="{{ $file->module_id }}" name="module_id">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <!--modal-->


    <form action="{{ route('teacher.schedule_module.destroy', $file->id) }}" method="POST" class="delete-form">
        @csrf
        @method('DELETE')
        <button type="button" class="btn btn-danger text-white btn-sm my-1 delete-btn">
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
</div>
