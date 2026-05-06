<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{{ $title ?? 'Sistem Kendaraan' }}</title>

    <meta name="description" content="" />

    <!-- Favicon -->

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet" />


    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/add.css')}}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

     <!-- Helpers -->
     
     <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
     <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
     {{-- <script src="{{ asset('assets/js/main.js') }}"></script> --}}
     
     <script src="{{ asset('assets/js/config.js') }}"></script>

     <style>
        .paginate p, .paginate ul {
            margin:0;
        }
        .menu .ps__thumb-y, .menu .ps__rail-y {
            width: 0.4rem !important;
        }
        .ps__rail-y {
          opacity: 1;
        }
        @media(max-width:832px){
            .only-icon {
                display: none;
            }
        }
        .img-icons{
          height: 50px;
          width: 50px;
          border: 1px solid #dfdf;
          border-radius: 50%;
        }
        .over-notif{
          max-height: 87vh;
          overflow-y: auto;
          scrollbar-width: thin;
        }
        .sticky-header {
          position: sticky;
          top: 0;
          background: white; /* Sesuaikan agar tidak transparan */
          box-shadow: 0 2px 8px 0 rgba(67, 89, 113, 0.12);
          z-index: 10;
        }
        .sticky-footer {
          position: sticky;
          bottom: 0;
          background: white; /* Sesuaikan agar tidak transparan */
          box-shadow: 0 -2px 4px 0 rgba(67, 89, 113, 0.12);
          z-index: 10;
        }
        .dropdown-menu.show {
            padding-top: 0;
            padding-bottom: 0;
        }
        .dropdown-head{
          padding: 0.700rem 1.25rem;
        }
        @media (min-width: 767.98px) {
          .layout-navbar .navbar-nav .nav-item.dropdown .dropdown-menu.notif {
              min-width: 365px;
          }
        }
        .bg-notif{
          background: #F0F3F7;
        }
     </style>

     @stack('css')
    
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

       @include('partials.sidebar')
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          @include('partials.navbar')

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                {{-- flash message --}}
                @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ Session::get('success') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>    
                @endif
                @if(Session::has('success-danger'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ Session::get('success-danger') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>    
                @endif             
                @if(Session::has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ Session::get('error') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>    
                @endif             

               @yield('content')
            </div>
            <!-- / Content -->

            <!-- Footer -->
            @include('partials.footer')
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

     <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{ asset('assets/vendor/js/menu.js')}}"></script>

    <!-- endbuild -->


    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js')}}"></script>

    <!-- Page JS -->
    <!-- Place this tag in your head or just before your close body tag. -->
    {{-- <script async defer src="https://buttons.github.io/buttons.js"></script> --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('assets/js/ui-toasts.js') }}"></script>

    <script>
      toastr.options = {
        "progressBar": true,
        "showDuration": "300",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      }
    </script>
    @if(Session::has('success-toast'))
      <script>
        toastr.success("{{ Session::get('success-toast') }}");
      </script>
    @endif
    @if(Session::has('info-info'))
     <script>
        toastr.info("{{ Session::get('info-toast') }}");
      </script>
    @endif
    @if(Session::has('success-danger-toast'))
     <script>
        toastr.error("{{ Session::get('success-danger-toast') }}");
      </script>
    @endif

    

    @stack('js')
  </body>
</html>