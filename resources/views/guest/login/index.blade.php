@extends('guest.app')
@section('content')

<div class="container-fluid d-flex" style=" height:50vh; justify-content: center; align-items:center;">

    <div class=""  style="">
        <form method="POST" action="{{ route('guest.login.index') }}">
            @csrf
            <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="text" name="email" class="form-control" value="admin@example.com" placeholder="Enter email" required>
            @error('email')
                <div style="color:red;">{{ $message }}</div>
            @enderror
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password" value="password" class="form-control" placeholder="Enter Password" required>
            @error('password')
                <div style="color:red;">{{ $message }}</div>
            @enderror
            </div>
            <div class="form-check">
                <a href="{{ route('password.request') }}" id="forgot">Forgot Password?</a>
                <p id="acc">Don't have an account? <a href="{{ route('guest.register.index') }}">Sign Up</a></p>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

@endsection
