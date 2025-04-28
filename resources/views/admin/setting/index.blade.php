@extends('admin.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card">
                <div class="card-header">Update Profile</div>
                <div class="card-body">
                    <form action="{{ route('admin.setting.update',$admin->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Profile Picture --}}
                        <div class="mb-3 text-center">

                            <img src="{{ Storage::url($admin->avatar) }}" alt="Profile Picture"
                                 class="rounded-circle mb-2" width="150" height="150">
                            <input type="file" class="form-control" name="avatar">
                        </div>


                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
