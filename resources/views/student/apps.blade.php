<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}"> <!-- This is the CSRF token meta tag -->
<title>{{ config('app.name', 'Maritime Monitoring System') }}</title>
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="theme-color" content="#ffffff">
<!-- Vendors styles-->
<link rel="icon" href="{{ asset('images/sagnu.png') }}">

<!-- Main styles for this application-->
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/js/jquery.min.js') }}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.min.js"></script>

<style>
    .nav-link.active{
        background: rgb(46, 81, 147) !important;
    }
    ul.pagination{
        margin: 10px;
    }

    .page-item.active .page-link{
        background: cornflowerblue !important;
        border: 1px solid cornflowerblue !important;

    }
</style>
<style>
    .ajs-cancel {
  display: none;
}
</style>

</head>
<body>
    <div class="sidebar sidebar-fixed" style="background: #4f2cd9 !important;" id="sidebar">
        <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
            {{-- <li class="nav-title fs-5 mt-0">Hello , {{ Auth::user()->email }}</li> --}}
            <li class="nav-title fs-5 mt-0">
                <i class="fa-solid fa-user-graduate"></i>
                Hello, {{ Auth::user()->student->first_name }} {{ Auth::user()->student->middle_name }} {{ Auth::user()->student->last_name }}
            </li>
            <li class="nav-title fs-6 mt-0">
                <i class="fa-solid fa-id-badge"></i>
                ({{ Auth::user()->role }})
            </li>

            <li class="nav-item w-100">
                <a class="nav-link {{ Route::is('student.dashboard.*') ? 'active' : '' }}" href="{{ route('student.dashboard.index') }}">
                    <span class="flex gap-x-3 items-center">
                        <i class="fa-solid fa-gauge"></i>
                        <span>Dashboard</span>
                    </span>
                </a>
            </li>

            <li class="nav-item w-100">
                <a class="nav-link {{ Route::is('student.schedule.*') || Route::is('student.schedule_module.*') ? 'active' : '' }}" href="{{ route('student.schedule.index') }}">
                    <span class="flex gap-x-3 items-center">
                        <i class="fa-solid fa-calendar-days"></i>
                        <span>Schedule</span>
                    </span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('guest.login.logout') }}">
                    <span class="flex gap-x-3 items-center">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Sign Off</span>
                    </span>
                </a>
            </li>
        </ul>


</div>
<div class="wrapper d-flex flex-column min-vh-100 bg-light">
    <header class="header header-sticky mb-4">

    <div class="header-divider"></div>
    </header>
    <div class="flex-grow-1 px-3 mb-5">
        @if (Session::has('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: 'Success!',
                    text: "{{ Session::get('success') }}",
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            });
        </script>
        @endif
        @if (Session::has('danger'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    text: "{{ Session::get('danger') }}",
                    icon: 'info',
                    confirmButtonText: 'OK',
                    confirmButtonColor: 'darkgoldenrod'
                });
            });
        </script>
        @endif
        @if (Session::has('update'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: 'success!',
                    text: "{{ Session::get('update') }}",
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
                    title: "{{ Session::get('error') }}",

                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
        </script>
        @endif
        @if (Session::has('warning'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: "{{ Session::get('warning') }}",
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
            });
        </script>
        @endif
         @yield('content')
    </div>

  </body>
</html>
