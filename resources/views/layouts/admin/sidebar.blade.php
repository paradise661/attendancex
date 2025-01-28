    <aside class="app-sidebar" id="sidebar">

        <div class="main-sidebar-header">
            <a class="header-logo" href="{{ url('/dashboard') }}">
                <img class="desktop-logo" src="{{ asset('assets/images/logo.png') }}" alt="logo" style="height: 40px">
                <img class="toggle-logo" src="{{ asset('assets/images/logo.png') }}" alt="logo" style="height: 40px">
                <img class="desktop-dark" src="{{ asset('assets/images/white-logo.png') }}" alt="logo"
                    style="height: 40px">
                <img class="toggle-dark" src="{{ asset('assets/images/logo.png') }}" alt="logo"
                    style="height: 40px">
                <img class="desktop-white" src="{{ asset('assets/images/logo.png') }}" alt="logo"
                    style="height: 40px">
                <img class="toggle-white" src="{{ asset('assets/images/logo.png') }}" alt="logo"
                    style="height: 40px">
            </a>
        </div>

        <div class="main-sidebar" id="sidebar-scroll">

            <nav class="main-menu-container nav nav-pills flex-column sub-open">
                <div class="slide-left" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                        width="24" height="24" viewBox="0 0 24 24">
                        <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                    </svg></div>
                <ul class="main-menu">
                    <li class="slide__category"><span class="category-name">Main</span></li>

                    <li class="slide">
                        <a class="side-menu__item {{ Request::segment(1) == 'dashboard' ? 'active' : '' }}"
                            href="{{ url('dashboard') }}">
                            <i class="bx bx-home side-menu__icon"></i>
                            <span class="side-menu__label">Dashboard </span>
                        </a>
                    </li>

                    <li class="slide__category"><span class="category-name">Web Apps</span></li>

                    <li class="slide has-sub @if (Request::segment(index: 1) == 'branches' ||
                            Request::segment(index: 1) == 'departments' ||
                            Request::segment(index: 1) == 'site-setting' ||
                            Request::segment(index: 1) == 'shifts') {{ 'active open' }} @endif">
                        <a class="side-menu__item @if (Request::segment(index: 1) == 'branches' ||
                                Request::segment(index: 1) == 'departments' ||
                                Request::segment(index: 1) == 'site-setting' ||
                                Request::segment(index: 1) == 'shifts') {{ 'active' }} @endif"
                            href="javascript:void(0);">
                            <i class="bx bx-fingerprint side-menu__icon"></i>
                            <span class="side-menu__label">Configuration</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide">
                                <a class="side-menu__item {{ Request::segment(1) == 'branches' ? 'active' : '' }}"
                                    href="{{ route('branches.index') }}">Branches</a>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item {{ Request::segment(1) == 'departments' ? 'active' : '' }}"
                                    href="{{ route('departments.index') }}">Departments</a>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item {{ Request::segment(1) == 'shifts' ? 'active' : '' }}"
                                    href="{{ route('shifts.index') }}">Shifts</a>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item {{ Request::segment(1) == 'site-setting' ? 'active' : '' }}"
                                    href="{{ route('site.setting') }}">Settings</a>
                            </li>
                        </ul>
                    </li>

                    <li class="slide">
                        <a class="side-menu__item {{ Request::segment(1) == 'employees' ? 'active' : '' }}"
                            href="{{ route('employees.index') }}">
                            <i class="bx bxs-user-account side-menu__icon"></i>
                            <span class="side-menu__label">Employees <span
                                    class="text-danger text-[0.75em] rounded-sm badge !py-[0.25rem] !px-[0.45rem] !bg-danger/10 ms-2">New</span></span>
                        </a>
                    </li>

                    <li class="slide">
                        <a class="side-menu__item {{ Request::segment(1) == 'notices' ? 'active' : '' }}"
                            href="{{ route('notices.index') }}">
                            <i class="bx bx-bell side-menu__icon"></i>
                            <span class="side-menu__label">Notices <span
                                    class="text-danger text-[0.75em] rounded-sm badge !py-[0.25rem] !px-[0.45rem] !bg-danger/10 ms-2">New</span></span>
                        </a>
                    </li>

                    <li class="slide has-sub @if (Request::segment(1) == 'attendances' || Request::segment(1) == 'attendance') {{ 'active open' }} @endif">
                        <a class="side-menu__item @if (Request::segment(1) == 'attendances' || Request::segment(1) == 'attendance') {{ 'active' }} @endif"
                            href="javascript:void(0);">
                            <i class="bx bx-qr-scan side-menu__icon"></i>
                            <span class="side-menu__label">Attendance</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide">
                                <a class="side-menu__item {{ Request::segment(1) == 'attendances' ? 'active' : '' }}"
                                    href="{{ route('attendance.index') }}">All Employees</a>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item {{ Request::segment(1) == 'attendance' ? 'active' : '' }}"
                                    href="{{ route('attendance.individual') }}">Individual</a>
                            </li>

                        </ul>
                    </li>
                </ul>
                <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                        width="24" height="24" viewBox="0 0 24 24">
                        <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
                    </svg>
                </div>
            </nav>

        </div>
    </aside>
