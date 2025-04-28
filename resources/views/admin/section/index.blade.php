@extends('admin.app')


@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12 mb-3">
           <h3> Manage Section</h3>
        </div>
        <div class="col-md-12">
                <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                New Section
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <form action="{{ route('admin.section.store') }}" method="POST">
                    @csrf
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="">Section Name</label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
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
        </div>
        <div class="col-md-12">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Date Added</th>
                    <th>Section Name </th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $program)
                        <tr>
                            <td>{{ date('M d ,Y',strtotime($program->created_at)) }}</td>
                            <td>{{ $program->name }}</td>
                            <td>
                                @if ($program->status)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td class="d-flex align-items-center" style="gap: 5px;">
                                <div>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $program->id }}">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal-{{ $program->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <form action="{{ route('admin.section.update',$program->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="">Section Name</label>
                                                            <input type="text" value="{{ $program->name }}" class="form-control" name="name">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                 <div>
                                    <form action="{{ route('admin.section.destroy', $program->id) }}" method="POST" class="delete-form">
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
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
              <div>
                {{ $categories->links('pagination::bootstrap-4') }}

              </div>
        </div>
    </div>
</div>
@endsection
