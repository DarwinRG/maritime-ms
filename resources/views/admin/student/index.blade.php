@extends('admin.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex flex-wrap justify-content-between align-items-center">
            <h2 class="mb-2 mb-md-0">STUDENT LIST</h2>
            <a class="btn btn-info text-white" href="{{ route('admin.student.create') }}">
                <i class="fa fa-plus me-1"></i> New Student
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Student ID</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>Contact</th>
                            {{-- <th>Status</th> --}}
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $student)
                            <tr>
                                <td>{{ $student->student_id }}</td>
                                <td>{{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}</td>
                                <td>{{ $student->user->email }}</td>
                                <td>{{ $student->address }}</td>
                                <td>{{ $student->city }}</td>
                                <td>{{ $student->contact }}</td>
                                {{-- <td>
                                    <span class="badge bg-{{ $student->status ? 'success' : 'danger' }}">
                                        {{ $student->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td> --}}
                                <td class="d-flex flex-wrap gap-1">
                                    <a href="{{ route('admin.student.edit', $student->id) }}" class="btn btn-sm btn-info text-white">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>

                                    <form action="{{ route('admin.student.destroy', $student->id) }}" method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-danger text-white delete-btn">
                                            <i class="fa fa-archive"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No students found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- SweetAlert Delete Confirmation --}}
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
@endsection
