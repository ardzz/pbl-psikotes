<!DOCTYPE html>
<html lang="en">
@include('includes.head')
  <body>
    <!-- Preloader -->
    <div class="preloader">
      <img src="/dist/images/logos/favicon.ico" alt="loader" class="lds-ripple img-fluid" />
    </div>
    <!-- Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
      <!-- Sidebar Start -->
      <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div>
          <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="./index.html" class="text-nowrap logo-img">
              <img src="/dist/images/logos/dark-logo.svg" class="dark-logo" width="180" alt="" />
              <img src="/dist/images/logos/light-logo.svg" class="light-logo"  width="180" alt="" />
            </a>
            <div class="close-btn d-lg-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
              <i class="ti ti-x fs-8 text-muted"></i>
            </div>
          </div>
          <!-- Sidebar navigation-->
            @switch(auth()->user()->getUserType())
                @case('Admin')
                    @include('includes.admin-navbar')
                    @break
                @case('Doctor')
                    @include('includes.doctor-navbar')
                    @break
                @case('Patient')
                    @include('includes.patient-navbar')
                    @break
                @default
                    @include('includes.patient-navbar')
            @endswitch
          <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
      </aside>
      <!-- Sidebar End -->
      <!-- Main wrapper -->
      <div class="body-wrapper">
        <!-- Header Start -->
          <header class="app-header">
              <nav class="navbar navbar-expand-lg navbar-light">
                  <ul class="navbar-nav">
                      <li class="nav-item">
                          <a class="nav-link sidebartoggler nav-icon-hover ms-n3" id="headerCollapse" href="javascript:void(0)">
                              <i class="ti ti-menu-2"></i>
                          </a>
                      </li>
                  </ul>
                  <div class="d-block d-lg-none">
                      <img src="../../dist/images/logos/dark-logo.svg" width="180" alt="" />
                  </div>
                  <button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="p-2">
                <i class="ti ti-dots fs-7"></i>
              </span>
                  </button>
                  <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                      <div class="d-flex align-items-center justify-content-between">
                          <a href="javascript:void(0)" class="nav-link d-flex d-lg-none align-items-center justify-content-center" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenavbar" aria-controls="offcanvasWithBothOptions">
                              <i class="ti ti-align-justified fs-7"></i>
                          </a>
                          <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">
                              <li class="nav-item dropdown">
                                  <a class="nav-link pe-0" href="javascript:void(0)" id="drop1" data-bs-toggle="dropdown" aria-expanded="false">
                                      <div class="d-flex align-items-center">
                                          <div class="user-profile-img">
                                              <img src="/dist/images/profile/user-1.jpg" class="rounded-circle" width="35" height="35" alt="" />
                                          </div>
                                      </div>
                                  </a>
                                  <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop1">
                                      <div class="profile-dropdown position-relative" data-simplebar>
                                          <div class="py-3 px-7 pb-0">
                                              <h5 class="mb-0 fs-5 fw-semibold">User Profile</h5>
                                          </div>
                                          <div class="d-flex align-items-center py-9 mx-7 border-bottom">
                                              <img src="/dist/images/profile/user-1.jpg" class="rounded-circle" width="80" height="80" alt="" />
                                              <div class="ms-3">
                                                  <h5 class="mb-1 fs-3">{{ auth()->user()->name }}</h5>
                                                  <span class="mb-1 d-block text-dark">{{ auth()->user()->getUserType() }}</span>
                                                  <p class="mb-0 d-flex text-dark align-items-center gap-2">
                                                      <i class="ti ti-mail fs-4"></i> {{ auth()->user()->email }}
                                                  </p>
                                              </div>
                                          </div>
                                          <div class="message-body">
                                              <a href="{{ route('profile.edit') }}" class="py-8 px-7 mt-8 d-flex align-items-center">
                            <span class="d-flex align-items-center justify-content-center bg-light rounded-1 p-6">
                              <img src="/dist/images/svgs/icon-account.svg" alt="" width="24" height="24">
                            </span>
                                                  <div class="w-75 d-inline-block v-middle ps-3">
                                                      <h6 class="mb-1 bg-hover-primary fw-semibold"> My Profile </h6>
                                                      <span class="d-block text-dark">Account Settings</span>
                                                  </div>
                                              </a>
                                              <div class="py-8 px-7 d-flex align-items-center">
                                                  <form action="{{ route('logout') }}" method="post">
                                                      @csrf
                                                      <button type="submit" class="btn btn-outline-danger w-100">Logout</button>
                                                  </form>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </li>
                          </ul>
                      </div>
                  </div>
              </nav>
          </header>
          <!-- Header End -->
        <div class="container-fluid">
            @yield('container-fluid')
        </div>
      </div>
    <div class="dark-transparent sidebartoggler"></div>
    <div class="dark-transparent sidebartoggler"></div>
    </div>
    <!--  Mobilenavbar -->
    <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="mobilenavbar" aria-labelledby="offcanvasWithBothOptionsLabel">
      <nav class="sidebar-nav scroll-sidebar">
        <div class="offcanvas-header justify-content-between">
          <img src="/dist/images/logos/favicon.ico" alt="" class="img-fluid">
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body profile-dropdown mobile-navbar" data-simplebar=""  data-simplebar>
          <ul id="sidebarnav">
              <li class="sidebar-item">
                  <a href="#" class="d-flex align-items-center">
                      <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                          <img src="/dist/images/svgs/icon-dd-chat.svg" alt="" class="img-fluid" width="24" height="24">
                      </div>
                      <div class="d-inline-block">
                          <h6 class="mb-1 bg-hover-primary">Chat Application</h6>
                          <span class="fs-2 d-block fw-normal text-muted">New messages arrived</span>
                      </div>
                  </a>
              </li>
              <li class="sidebar-item">
                  <a href="#" class="d-flex align-items-center">
                      <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                          <img src="/dist/images/svgs/icon-dd-invoice.svg" alt="" class="img-fluid" width="24" height="24">
                      </div>
                      <div class="d-inline-block">
                          <h6 class="mb-1 bg-hover-primary">Invoice App</h6>
                          <span class="fs-2 d-block fw-normal text-muted">Get latest invoice</span>
                      </div>
                  </a>
              </li>
              <li class="sidebar-item">
                  <a href="#" class="d-flex align-items-center">
                      <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                          <img src="/dist/images/svgs/icon-dd-mobile.svg" alt="" class="img-fluid" width="24" height="24">
                      </div>
                      <div class="d-inline-block">
                          <h6 class="mb-1 bg-hover-primary">Contact Application</h6>
                          <span class="fs-2 d-block fw-normal text-muted">2 Unsaved Contacts</span>
                      </div>
                  </a>
              </li>
          </ul>
        </div>
      </nav>
    </div>
    <!-- Import Js Files -->
    <script src="/dist/libs/jquery/dist/jquery.min.js"></script>
    <script src="/dist/libs/simplebar/dist/simplebar.min.js"></script>
    <script src="/dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/dist/libs/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="/dist/js/forms/sweet-alert.init.js"></script>
    <!-- core files -->
    <script src="/dist/js/app.min.js"></script>
    <script src="/dist/js/app.init.js"></script>
    <script src="/dist/js/app-style-switcher.js"></script>
    <script src="/dist/js/sidebarmenu.js"></script>
    <script src="/dist/js/custom.js"></script>
    <!-- current page js files -->
    <script src="/dist/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="/dist/js/dashboard2.js"></script>
  @yield('scripts')
  </body>
</html>
