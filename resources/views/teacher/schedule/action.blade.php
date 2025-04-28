<div class="d-flex align-items-center" style="gap: 10px;">
    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $module->id }}">
        <i class="fa fa-pencil"></i>
      </button>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal-{{ $module->id }}" tabindex="-1" aria-labelledby="exampleModal-{{ $module->id }}Label" aria-hidden="true">
            <form enctype="multipart/form-data" action="{{ route('teacher.module.update',$module->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Module</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- status -->
                            <div class="form-group">
                              <label for="status" class="control-label">Status</label>
                              <select name="status" class="form-control">
                                  <option value="1" {{ old('status', $module->status) == 1 ? 'selected' : '' }}>Active</option>
                                  <option value="2" {{ old('status', $module->status) == 2 ? 'selected' : '' }}>Ended</option>
                              </select>
                            </div>
                          <!-- Title -->
                          <div class="form-group">
                              <label for="title" class="control-label">Title</label>
                              <input type="text" class="form-control" name="title"
                                     value="{{ old('title', $module->title) }}">
                          </div>

                          <!-- Date End -->
                          <div class="form-group">
                              <label for="end_date" class="control-label">Date End</label>
                              <input type="datetime-local" class="form-control" name="end_date"
                                     value="{{ old('end_date', date('Y-m-d\TH:i', strtotime($schedule->end_at))) }}">
                          </div>

                          <!-- Description -->
                          <div class="form-group">
                              <label for="description" class="control-label">Description</label>
                              <textarea name="description" id="description" rows="4" class="form-control" required>
                                  {{ old('description', $module->description) }}
                              </textarea>
                          </div>
                      </div>

                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <input type="hidden" value="{{ $module->id }}" name="schedule_id">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <form action="{{ route('teacher.module.destroy', $module->id) }}" method="POST" class="delete-form">
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
