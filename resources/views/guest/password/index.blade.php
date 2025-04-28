@extends('guest.app')

@section('content')

<style>
 .login-wrapper {
    height: 100vh;
    background: linear-gradient(
        rgba(30, 64, 175, 0.7), /* Soft rich blue overlay */
        rgba(30, 64, 175, 0.7)
    ),
    url('https://wallpapers.com/images/hd/teacher-background-2tdjqh0pgbvtelo1.jpg'); /* Blue-themed ocean background */
    background-size: cover;
    background-position: center;
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
}

    .login-card {
        background-color: white;
        padding: 2rem;
        border-radius: 1rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        width: 100%;
        max-width: 400px;
    }

    .labels {
        text-align: center;
        position: absolute;
        top: 20px;
        width: 100%;
        display: flex;
        justify-content: space-between;
        padding: 0 2rem;
        font-weight: bold;
        color: white;
        font-size: 1.2rem;
    }
</style>

<div class="login-wrapper position-relative">
    <div class="labels">
        <span>Student Portal</span>
        <span>Teacher Portal</span>
    </div>

    <div class="login-card">
        <form method="POST" action="{{ route('guest.password.store') }}">
            @csrf
            <div class="form-group mb-3" style="color:black !important;">
                <div>
                    Enter your email address we will reset your password
                </div>
                <hr>
                <label for="email">Email address</label>
                <input type="text" name="email" class="form-control" value="teacher1@example.com" placeholder="Enter email" required>
                @error('email')
                    <div style="color:red;">{{ $message }}</div>
                @enderror
                <small class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <button type="submit" class="btn btn-primary w-100">Reset Password</button>
        </form>
    </div>
</div>

@endsection
