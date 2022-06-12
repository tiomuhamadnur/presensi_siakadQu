<!DOCTYPE html>
<!-- =========================================================
   * Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
   ==============================================================
   
   * Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
   * Created by: ThemeSelection
   * License: You must have a valid license purchased in order to legally use the theme for your project.
   * Copyright ThemeSelection (https://themeselection.com)
   
   =========================================================
    -->
<!-- beautify ignore:start -->
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Presensi</title>
    <meta name="description" content="" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('sneat/assets/vendor/fonts/boxicons.css') }}" />
    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('sneat/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('sneat/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('sneat/assets/css/demo.css') }}" />
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('sneat/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('sneat/assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <!-- Page CSS -->
    <!-- Helpers -->
    <link rel="stylesheet" href="{{ asset('sneat/assets/vendor/libs/toastr/toastr.css') }}" />
    <script src="{{ asset('sneat/assets/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('sneat/assets/js/config.js') }}"></script>

    <style>
        .table-min-height {
            min-height: 500px !important;
        }

    </style>

</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
                @include('admin.layout.asside')
            <!-- / Menu -->
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                    @yield('navbar')
                <!-- / Navbar -->
                <!-- Content wrapper -->
                <div class="content-wrapper">
                    {{-- JQuery --}}
                        <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"
                                                integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous">
                        </script>
                    {{-- End JQuery --}}
                    <!-- Content -->
                        @yield('content')
                    <!-- / Content -->
                    {{-- Delete Modal --}}
                    <div class="modal fade" id="modalDelete" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel2">Yakin Ingin Menghapus ?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="form_delete_id" action="#" method="POST">
                             @csrf
                             @method('DELETE')
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col mb-3">
                                    <input type="text" name="id" id="delete_id" hidden class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                            </div>
                            </form>
                        </div>
                        </div>
                    </div>
                    {{-- END MODAL DELETE --}}
                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                            <div class="mb-2 mb-md-0">
                                ©
                                <script>
                                    document.write(new Date().getFullYear());
                                </script>
                                <span>PRESENSI</span>
                            </div>
                            <div>
                                
                        </div>
                     </div>
                  </footer>
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
      {{-- <div class="buy-now">
         <a
            href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/"
            target="_blank"
            class="btn btn-danger btn-buy-now"
            >Upgrade to Pro</a
            >
      </div> --}}
      <!-- Core JS -->
      <!-- build:js assets/vendor/js/core.js -->
      <script src="{{ asset('sneat/assets/vendor/libs/jquery/jquery.js') }}"></script>
      <script src="{{ asset('sneat/assets/vendor/libs/popper/popper.js') }}"></script>
      <script src="{{ asset('sneat/assets/vendor/js/bootstrap.js') }}"></script>
      <script src="{{ asset('sneat/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
      <script src="{{ asset('sneat/assets/vendor/js/menu.js') }}"></script>
      <!-- endbuild -->
      <!-- Vendors JS -->
      <script src="{{ asset('sneat/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
      <!-- Main JS -->
      <script src="{{ asset('sneat/assets/js/main.js') }}"></script>
      <!-- Page JS -->
      <script src="{{ asset('sneat/assets/js/dashboards-analytics.js') }}"></script>
      <!-- Place this tag in your head or just before your close body tag. -->
      <script async defer src="https://buttons.github.io/buttons.js"></script>
      <link rel="stylesheet" href="{{ asset('sneat/assets/vendor/libs/toastr/toastr.js') }}" />


      {{-- CKEDITOR --}}
      <script type="text/javascript" src="/js/ckfinder/ckfinder.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>

    <script>
        CKFinder.config({
            connectorPath: '/ckfinder/connector'
        });
    </script>
   </body>
</html>
