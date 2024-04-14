<nav class="sidebar-nav scroll-sidebar" data-simplebar>
    <ul id="sidebar">
        <!-- ============================= -->
        <!-- Home -->
        <!-- ============================= -->
        <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">Home</span>
        </li>
        <!-- =================== -->
        <!-- Dashboard -->
        <!-- =================== -->
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('guides') }}" aria-expanded="false">
                  <span>
                    <i class="ti ti-book"></i>
                  </span>
                <span class="hide-menu">Guide</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="#" aria-expanded="false">
                  <span>
                    <i class="ti ti-notebook"></i>
                  </span>
                <span class="hide-menu">Exam</span>
                <span class="hide-menu badge rounded-pill bg-success fs-2 py-1 px-2">Coming soon</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="#" aria-expanded="false">
                <span>
                    <i class="ti ti-report-medical"></i>
                </span>
                <span class="hide-menu">Medical Record</span>
                <span class="hide-menu badge rounded-pill bg-success fs-2 py-1 px-2">Coming soon</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('profile.edit') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-user"></i>
                </span>
                <span class="hide-menu">Personal Information</span>
            </a>
    </ul>
</nav>
