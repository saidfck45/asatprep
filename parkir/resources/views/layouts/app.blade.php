<!--
=========================================================
* Soft UI Dashboard - v1.0.7
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2023 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
  <title>
    Aplikasi Parkir Kendaraan
  </title>
  
  <!-- Fonts and icons: Plus Jakarta Sans & Outfit for Anthropic-like high-end design -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  
  <style>
    body {
      font-family: 'Plus Jakarta Sans', sans-serif !important;
    }
    h1, h2, h3, h4, h5, h6, .navbar-brand span {
      font-family: 'Outfit', sans-serif !important;
    }
    
    /* Sidebar Item Styles based on User Photo */
    .sidenav {
      background-color: #f8f9fa !important;
    }
    .sidenav .nav-link {
      margin-left: 1rem !important;
      margin-right: 1rem !important;
      padding-top: 0.6rem !important;
      padding-bottom: 0.6rem !important;
      border-radius: 0.75rem !important;
      font-weight: 600 !important;
      color: #252f40 !important;
      display: flex;
      align-items: center;
      transition: all 0.2s ease;
    }
    .sidenav .nav-link:hover {
      background-color: rgba(255,255,255,0.5);
    }
    .sidenav .nav-link.active {
      background-color: #ffffff !important;
      box-shadow: 0 20px 27px 0 rgba(0,0,0,0.05) !important;
    }
    
    /* Icon square container */
    .sidenav .nav-link .icon-box {
      width: 32px;
      height: 32px;
      background-color: #ffffff;
      box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
      border-radius: 0.5rem;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 0.75rem;
      transition: all 0.2s ease;
    }
    .sidenav .nav-link.active .icon-box {
      background: linear-gradient(310deg, #7928CA, #B80075) !important;
      color: #ffffff !important;
      box-shadow: 0 4px 10px rgba(121, 40, 202, 0.2) !important;
    }
    .sidenav .nav-link.active .icon-box i {
      color: #ffffff !important;
    }
    .sidenav .nav-link .icon-box i {
      color: #252f40;
      font-size: 0.8rem;
    }
  </style>
  
  <!-- Nucleo Icons -->
  <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  
  <!-- Font Awesome 6 Free (reliable CDN) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('assets/css/soft-ui-dashboard.css?v=1.0.7') }}" rel="stylesheet" />
  
  <!-- Sweet Alert -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  
  @yield('styles')
</head>

<body class="g-sidenav-show bg-gray-100">
  
  <!-- Sidebar -->
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3" id="sidenav-main">
    <div class="sidenav-header d-flex align-items-center pb-2">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0 d-flex align-items-center gap-2" href="{{ route('transactions.index') }}">
        <!-- Custom Brand SVG Logo matching the photo precisely -->
        <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#252f40" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-top: -3px;">
            <!-- Top-left box with up arrow -->
            <rect x="2" y="2" width="8" height="8" rx="1.5" />
            <path d="M4 7l2-2 2 2" />
            <!-- Top-right box with up arrow -->
            <rect x="14" y="2" width="8" height="8" rx="1.5" />
            <path d="M16 7l2-2 2 2" />
            <!-- Bottom-center box with down arrow -->
            <rect x="8" y="14" width="8" height="8" rx="1.5" />
            <path d="M10 17l2 2 2-2" />
        </svg>
        <span class="ms-1 font-weight-bold text-dark text-lg" style="color: #252f40 !important;">Parkir System</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        
        <!-- Dashboard / Transaction link -->
        <li class="nav-item">
          <a class="nav-link {{ Route::is('transactions.index') ? 'active' : '' }}" href="{{ route('transactions.index') }}">
            <div class="icon-box">
              <i class="fa-solid fa-desktop"></i>
            </div>
            <span class="nav-link-text">Dashboard Parkir</span>
          </a>
        </li>
        
        <!-- Locations CRUD link -->
        <li class="nav-item">
          <a class="nav-link {{ Route::is('locations.*') ? 'active' : '' }}" href="{{ route('locations.index') }}">
            <div class="icon-box">
              <i class="fa-solid fa-map-location-dot"></i>
            </div>
            <span class="nav-link-text">Data Location</span>
          </a>
        </li>
        
        <!-- Vehicle Types CRUD link -->
        <li class="nav-item">
          <a class="nav-link {{ Route::is('vehicle-types.*') ? 'active' : '' }}" href="{{ route('vehicle-types.index') }}">
            <div class="icon-box">
              <i class="fa-solid fa-car-side"></i>
            </div>
            <span class="nav-link-text">Vehicle Types</span>
          </a>
        </li>
        
        <!-- Transactions history link -->
        <li class="nav-item">
          <a class="nav-link {{ Route::is('transactions.view-all') ? 'active' : '' }}" href="{{ route('transactions.view-all') }}">
            <div class="icon-box">
              <i class="fa-solid fa-list-check"></i>
            </div>
            <span class="nav-link-text">All Transactions</span>
          </a>
        </li>

      </ul>
    </div>
  </aside>

  <!-- Main Content Wrapper -->
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Halaman</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">
              @if(Route::is('transactions.index')) Dashboard @elseif(Route::is('locations.*')) Location @elseif(Route::is('vehicle-types.*')) Vehicle Type @else History @endif
            </li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Sistem Parkir Kendaraan</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center"></div>
          <ul class="navbar-nav justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <span class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-calendar me-sm-1"></i>
                <span class="d-sm-inline d-none">{{ date('l, d F Y') }}</span>
              </span>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->

    <!-- Main Container -->
    <div class="container-fluid py-4">
      @yield('content')
      
      <!-- Footer -->
      <footer class="footer pt-3">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © {{ date('Y') }} ASAT Praktek SMKN 1 Cibinong - Web & Mobile Development
              </div>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </main>

  <!-- Core JS Files -->
  <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
  
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('assets/js/soft-ui-dashboard.min.js?v=1.0.7') }}"></script>

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  @yield('scripts')
</body>

</html>
