<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Maritime Monitoring System') }}</title>

  <link rel="icon" href="{{ asset('images/sagnu.png') }}">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>

  <style>
    .nav-link.active {
      background: rgb(46, 81, 147) !important;
    }

    ul.pagination {
      margin: 10px;
    }

    .page-item.active .page-link {
      background: cornflowerblue !important;
      border: 1px solid cornflowerblue !important;
    }

    .ajs-cancel {
      display: none;
    }

    @media (max-width: 768px) {
      .sidebar {
        position: fixed;
        top: 0;
        bottom: 0;
        left: -100%;
        width: 250px;
        z-index: 1040;
        transition: left 0.3s ease-in-out;
      }

      .sidebar.show {
        left: 0;
      }

      .overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1039;
      }

      .overlay.active {
        display: block;
      }

      .mobile-toggle {
        display: block;
      }
    }

    @media (min-width: 769px) {
      .mobile-toggle {
        display: none;
      }
    }

    .sidebar-nav {
      max-height: 90vh;
      overflow-y: auto;
    }
  </style>
  <script>
    $(document).ready(function () {
      $('.summernote').summernote({
        height: 300,
        minHeight: 200,
        maxHeight: 500,
        focus: true,
        placeholder: "Write your description here...",
        toolbar: [
          ['style', ['bold', 'italic', 'underline', 'clear']],
          ['font', ['strikethrough', 'superscript', 'subscript']],
          ['fontsize', ['fontsize']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
      });
    });
  </script>

</head>

<body>
  <!-- Sidebar -->
  <div class="sidebar sidebar-fixed bg-primary text-white" id="sidebar">
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
      <li class="nav-title fs-5 mt-0 d-flex flex-column align-items-center gap-2">
        <img src="{{ Auth::user()->avatar ? Storage::url(Auth::user()->avatar) : asset('default-avatar.png') }}"
          alt="Avatar" class="rounded-circle" style="width: 90px; height: 90px; object-fit: cover;">

        <div class="text-center">
          <div>
            <span class="fs-5" style="font-size: 0.7rem !important;"> <span
                style="font-size: 1rem !important;">Hello</span>, {{ Auth::user()->teacher->first_name }}
              {{ Auth::user()->teacher->middle_name }} {{ Auth::user()->teacher->last_name }}</span>
          </div>
          <div class="fs-6">
            <i class="fa-solid fa-id-badge"></i> ({{ Auth::user()->role }})
          </div>
        </div>
      </li>


      <li class="nav-item w-100">
        <a class="nav-link {{ Route::is('teacher.dashboard.*') ? 'active' : '' }}"
          href="{{ route('teacher.dashboard.index') }}">
          <span class="flex gap-x-3 items-center">
            <i class="fa-solid fa-gauge"></i>
            <span>Dashboard</span>
          </span>
        </a>
      </li>

      <li class="nav-item w-100">
        <a class="nav-link {{ Route::is('teacher.schedule.*') || Route::is('teacher.schedule_module.*') ? 'active' : '' }}"
          href="{{ route('teacher.schedule.index') }}">
          <span class="flex gap-x-3 items-center">
            <i class="fa-solid fa-calendar-days"></i>
            <span>Schedule</span>
          </span>
        </a>
      </li>

      <li class="nav-item w-100">
        <a class="nav-link {{ Route::is('teacher.setting.*') || Route::is('teacher.setting.*') ? 'active' : '' }}"
          href="{{ route('teacher.setting.index') }}">
          <span class="flex gap-x-3 items-center">
            <i class="fa-solid fa-cog"></i>
            <span>Setting</span>
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

  <!-- Overlay for mobile -->
  <div class="overlay" id="sidebarOverlay"></div>

  <!-- Wrapper -->
  <div class="wrapper d-flex flex-column min-vh-100 bg-light">
    <!-- Header -->
    <header class="header header-sticky mb-4 bg-primary">
      <div class="d-flex align-items-center px-3 py-2  text-white">
        <button class="btn btn-light mobile-toggle me-3" id="toggleSidebar">
          <i class="fa fa-bars"></i>
        </button>
        <h5 class="mb-0">{{ config('app.name', 'Maritime Monitoring System') }}
        </h5>
      </div>
      <div class="header-divider"></div>
    </header>

    <!-- Content -->
    <div class="flex-grow-1 px-3 mb-5">
      @if ($errors->any())
      <script>
      document.addEventListener('DOMContentLoaded', function () {
        let errorMessages = '';
        @foreach ($errors->all() as $error)
      errorMessages += '{{ $error }}\n';
    @endforeach
        Swal.fire({
        title: 'Validation Errors',
        text: errorMessages,
        icon: 'error',
        confirmButtonText: 'OK'
        });
      });
      </script>
    @endif

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
        title: 'Success!',
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
  </div>

  <!-- Sidebar Toggle Script -->
  <script>
    document.getElementById('toggleSidebar').addEventListener('click', function () {
      document.getElementById('sidebar').classList.toggle('show');
      document.getElementById('sidebarOverlay').classList.toggle('active');
    });

    document.getElementById('sidebarOverlay').addEventListener('click', function () {
      document.getElementById('sidebar').classList.remove('show');
      document.getElementById('sidebarOverlay').classList.remove('active');
    });
  </script>
</body>

</html>