<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
      <meta name="csrf-token" content="{{ csrf_token() }}" />
      <title>
       Webeesocial Bigin Dashboard 
      </title>
      <meta name="description" content="" />
      <link rel="icon" type="image/x-icon" href="{{ asset('admin') }}/img/favicon/wbs_fav.png" />
      <link rel="preconnect" href="https://fonts.googleapis.com" />
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
      <!--- Fonts Family !---->
      <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="{{ asset('admin') }}/vendor/fonts/boxicons.css" />
      <link rel="stylesheet" href="{{ asset('admin') }}/vendor/css/core.css" class="template-customizer-core-css" />
      <link rel="stylesheet" href="{{ asset('admin') }}/vendor/css/theme-default.css" class="template-customizer-theme-css" />
      <link rel="stylesheet" href="{{ asset('admin') }}/css/demo.css" />
      <link rel="stylesheet" href="{{ asset('admin') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
      <script src="{{ asset('admin') }}/vendor/js/helpers.js"></script>
      <script src="{{ asset('admin') }}/js/config.js"></script>
      <link href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
      <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js">
      @yield('styles')
   </head>
   <body>
      <div class="full-screen-loader">
         <img height="250" width="280" src="https://lovely2cu.files.wordpress.com/2020/05/bee-gif.gif" alt="">
      </div>
      <!-- Layout wrapper -->
      <div class="layout-wrapper layout-content-navbar">
         <div class="layout-container">
            <div class="layout-page">
               <x-admin.navbar />
               <!-- Content wrapper -->
               <div class="content-wrapper">
                  <div class="container-xxl flex-grow-1 container-p-y">
                     @yield('content')
                  </div>
                  <x-admin.footer />
                  <div class="content-backdrop fade"></div>
               </div>
            </div>
         </div>
         <div class="layout-overlay layout-menu-toggle"></div>
         <div>
            <div class="bs-toast toast toast-placement-ex m-2 fade  top-0 end-0 hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
                <div class="toast-header">
                    <i class="bx bx-bell me-2"></i>
                    <div class="me-auto fw-semibold" id="toastHead"></div>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" id="toastBody"></div>
            </div>
          </div>
      </div>
      <!--- Js---->
      <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
      <script src="{{ asset('admin') }}/vendor/libs/jquery/jquery.js"></script>
      <script src="{{ asset('admin') }}/vendor/libs/popper/popper.js"></script>
      <script src="{{ asset('admin') }}/vendor/js/bootstrap.js"></script>
      <script src="{{ asset('admin') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
      <script src="{{ asset('admin') }}/vendor/js/menu.js"></script>
      <script src="{{ asset('admin') }}/js/main.js"></script>
      <script src="{{ asset('admin') }}/js/dashboards-analytics.js"></script>
      <script src="{{ asset('admin') }}/js/ui-toasts.js"></script>
      <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      @if(session()->has('alert'))
        @php
            $alert = Session::get('alert');
            $toastHead = $alert['msg'];
            $toastBody = $alert['body'];
            $toastType = $alert['type'];
        @endphp
        <script>
          $(document).ready(function() {
            toast('{{ $toastHead }}','{{ $toastBody }}','{{ $toastType }}');
          });
        </script>
      @endif
      @yield('scripts')
      <script>
         $(document).ready(function() {
            $('.full-screen-loader').fadeOut('slow');
         });
      </script>
   </body>
</html>