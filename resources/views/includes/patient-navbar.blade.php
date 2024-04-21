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
            <a class="sidebar-link" href="{{ route('mmpi2') }}" aria-expanded="false">
                  <span>
                    <i class="ti ti-notebook"></i>
                  </span>
                <span class="hide-menu">Exam</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('mmpi2.request') }}" aria-expanded="false">
                  <span>
                    <i class="ti ti-pencil-plus"></i>
                  </span>
                <span class="hide-menu">Request Exam</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('examHistory') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-report-medical"></i>
                </span>
                <span class="hide-menu">Medical Record</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('personal.edit') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-user"></i>
                </span>
                <span class="hide-menu">Personal Information</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('guides') }}" aria-expanded="false">
                  <span>
                    <i class="ti ti-book"></i>
                  </span>
                <span class="hide-menu">Guide</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('about-mmpi2') }}" aria-expanded="false">
                  <span>
                    <i class="ti ti-book-2"></i>
                  </span>
                <span class="hide-menu">About MMPI-2</span>
            </a>
        </li>
    </ul>
</nav>
