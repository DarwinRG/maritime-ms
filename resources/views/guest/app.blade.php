<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/guest.css') }}">
    <link rel="stylesheet" href="{{ asset('css/greeting.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Alice&family=Canva+Sans&family=Dancing+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>{{ config('app.name', 'Maritime Monitoring System') }}</title>
</head>
<body>

<header class="header"  style="background: #4f2cd9 !important; color:white;">
    <div class="logo">
        <h3>{{ config('app.name', 'Maritime Monitoring System') }}</h3>
        {{-- <img src="{{ asset('logos/logo.png') }}" alt="Logo"> --}}
    </div>
</header>



@if (Session::has('success'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            text: "{{ Session::get('success') }}",
            icon: 'success',
            confirmButtonText: 'OK'
        });
    });
</script>
@endif
@if (Session::has('error'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            text: "{{ Session::get('error') }}",
            icon: 'error',
            confirmButtonText: 'OK',
            confirmButtonColor: 'red'
        });
    });
</script>
@endif
@if (Session::has('warning'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            text: "{{ Session::get('warning') }}",
            icon: 'warning',
            confirmButtonText: 'OK'
        });
    });
</script>
@endif

@yield('content')

</body>
</html>
