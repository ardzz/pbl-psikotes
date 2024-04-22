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
            <a class="sidebar-link" href="{{ route('exam.enrollment') }}" aria-expanded="false">
                  <span>
                    <i class="ti ti-pencil"></i>
                  </span>
                <span class="hide-menu">Add Exam</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('exam.manage') }}" aria-expanded="false">
                  <span>
                    <i class="ti ti-report-analytics"></i>
                  </span>
                <span class="hide-menu">Manage Exam</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('add-user.frontend') }}" aria-expanded="false">
                  <span>
                    <i class="ti ti-user-plus"></i>
                  </span>
                <span class="hide-menu">Add Users</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('manageUser') }}" aria-expanded="false">
                  <span>
                    <i class="ti ti-user-plus"></i>
                  </span>
                <span class="hide-menu">Manage Users</span>
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
