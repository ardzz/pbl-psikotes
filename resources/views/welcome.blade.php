<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('includes.head')
<head>
    <!--  Title -->
    <title>Mordenize</title>
    <!--  Required Meta Tag -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="handheldfriendly" content="true" />
    <meta name="MobileOptimized" content="width" />
    <meta name="description" content="Mordenize" />
    <meta name="author" content="" />
    <meta name="keywords" content="Mordenize" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!--  Favicon -->
    <link rel="shortcut icon" type="image/png" href="../../dist/images/logos/favicon.ico" />
    
    <!-- Core Css -->
    <link  id="themeColors"  rel="stylesheet" href="../../dist/css/style.min.css" />
</head>
<body>
    <!-- Preloader -->
    <div class="preloader">
        <img src="../../dist/images/logos/favicon.ico" alt="loader" class="lds-ripple img-fluid" />
    </div>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <div class="position-relative overflow-hidden radial-gradient min-vh-100">
            <div class="position-relative z-index-5">
                <div class="row">
                    <div class="col-lg-6 col-xl-8 col-xxl-9">
                        <a href="./index.html" class="text-nowrap logo-img d-block px-4 py-9 w-100">
                            <img src="../../dist/images/logos/as.png" width="180" alt="">
                        </a>
                        <div class="d-none d-lg-flex align-items-center justify-content-center" style="height: calc(100vh - 80px);">
                            <img src="../../dist/images/backgrounds/as.png" alt="" class="img-fluid" width="1000  ">
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-4 col-xxl-3">
    <div class="card mb-0 shadow-none rounded-0 min-vh-100 h-100">
        <div class="d-flex align-items-center justify-content-between w-100 h-100">
            <div class="card-body">
                <div class="text-center">
                <img src="../../dist/images/backgrounds/foto.png" alt="" class="img-fluid" width="200">
                    <h1 class="fw-bolder fs-7 mb-3">Welcome Psikotest Rumah sakit</h1>
                    <p>Silahkan pilih menu yang tersedia</p>
                    <div class="d-flex gap-3">
                        <a href="javascript:void(0)" class="btn btn-primary py-3 flex-grow-1">Login</a>
                        <a href="./authentication-login.html" class="btn btn-light-primary text-primary py-3 flex-grow-1">Sign Up</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

                </div>
            </div>
        </div>
    </div>
    
    <!--  Import Js Files -->
    <script src="../../dist/libs/jquery/dist/jquery.min.js"></script>
    <script src="../../dist/libs/simplebar/dist/simplebar.min.js"></script>
    <script src="../../dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!--  core files -->
    <script src="../../dist/js/app.min.js"></script>
    <script src="../../dist/js/app.init.js"></script>
    <script src="../../dist/js/app-style-switcher.js"></script>
    <script src="../../dist/js/sidebarmenu.js"></script>
    
    <script src="../../dist/js/custom.js"></script>
</body>
</html>
