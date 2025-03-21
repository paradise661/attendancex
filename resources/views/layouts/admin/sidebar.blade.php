    <aside class="app-sidebar" id="sidebar">

        <div class="main-sidebar-header">
            <a class="header-logo" href="{{ url('/dashboard') }}">
                {{-- <img class="desktop-logo" src="{{ asset('assets/images/logo.png') }}" alt="logo" style="height: 80px">
                <img class="toggle-logo" src="{{ asset('assets/images/logo.png') }}" alt="logo" style="height: 80px">
                <img class="desktop-dark" src="{{ asset('assets/images/white-logo.png') }}" alt="logo"
                    style="height: 80px">
                <img class="toggle-dark" src="{{ asset('assets/images/logo.png') }}" alt="logo"
                    style="height: 80px">
                <img class="desktop-white" src="{{ asset('assets/images/logo.png') }}" alt="logo"
                    style="height: 80px"> --}}
                <img class="" src="{{ asset('assets/images/logo.png') }}" alt="logo"
                    style="height: 60px">
                {{-- <span class="fw-bold company_name text-white" style="font-size: 17px;">SAJILO ATTENDANCE</span> --}}
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
                    @can('view configuration')
                        <li class="slide has-sub @if (Request::segment(index: 1) == 'branches' ||
                                Request::segment(index: 1) == 'departments' ||
                                Request::segment(index: 1) == 'site-setting' ||
                                Request::segment(index: 1) == 'leavetypes' ||
                                Request::segment(index: 1) == 'designations' ||
                                Request::segment(index: 1) == 'publicholidays' ||
                                Request::segment(index: 1) == 'roles' ||
                                Request::segment(index: 1) == 'shifts') {{ 'active open' }} @endif">
                            <a class="side-menu__item @if (Request::segment(index: 1) == 'branches' ||
                                    Request::segment(index: 1) == 'departments' ||
                                    Request::segment(index: 1) == 'site-setting' ||
                                    Request::segment(index: 1) == 'leavetypes' ||
                                    Request::segment(index: 1) == 'designations' ||
                                    Request::segment(index: 1) == 'publicholidays' ||
                                    Request::segment(index: 1) == 'shifts') {{ 'active' }} @endif"
                                href="javascript:void(0);">
                                <i class="bx bx-cog side-menu__icon"></i>
                                <span class="side-menu__label">Configuration</span>
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">
                                @can('view branch')
                                    <li class="slide">
                                        <a class="side-menu__item {{ Request::segment(1) == 'branches' ? 'active' : '' }}"
                                            href="{{ route('branches.index') }}">Branches</a>
                                    </li>
                                @endcan

                                @can('view department')
                                    <li class="slide">
                                        <a class="side-menu__item {{ Request::segment(1) == 'departments' ? 'active' : '' }}"
                                            href="{{ route('departments.index') }}">Departments</a>
                                    </li>
                                @endcan

                                @can('view shift')
                                    <li class="slide">
                                        <a class="side-menu__item {{ Request::segment(1) == 'shifts' ? 'active' : '' }}"
                                            href="{{ route('shifts.index') }}">Shifts</a>
                                    </li>
                                @endcan

                                @can('view leavetype')
                                    <li class="slide">
                                        <a class="side-menu__item {{ Request::segment(1) == 'leavetypes' ? 'active' : '' }}"
                                            href="{{ route('leavetypes.index') }}">Leave Types</a>
                                    </li>
                                @endcan

                                @can('view designation')
                                    <li class="slide">
                                        <a class="side-menu__item {{ Request::segment(1) == 'designations' ? 'active' : '' }}"
                                            href="{{ route('designations.index') }}">Designations</a>
                                    </li>
                                @endcan

                                @can('view publicholiday')
                                    <li class="slide">
                                        <a class="side-menu__item {{ Request::segment(1) == 'publicholidays' ? 'active' : '' }}"
                                            href="{{ route('publicholidays.index') }}">Public Holidays</a>
                                    </li>
                                @endcan

                                @can('view role')
                                    <li class="slide">
                                        <a class="side-menu__item {{ Request::segment(1) == 'roles' ? 'active' : '' }}"
                                            href="{{ route('roles.index') }}">Roles</a>
                                    </li>
                                @endcan

                                @can('view setting')
                                    <li class="slide">
                                        <a class="side-menu__item {{ Request::segment(1) == 'site-setting' ? 'active' : '' }}"
                                            href="{{ route('site.setting') }}">Settings</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan

                    @can('view employee')
                        <li class="slide">
                            <a class="side-menu__item {{ Request::segment(1) == 'employees' ? 'active' : '' }}"
                                href="{{ route('employees.index') }}">
                                <i class="bx bxs-group side-menu__icon"></i>
                                <span class="side-menu__label">Employees <span
                                        class="text-danger text-[0.75em] rounded-sm badge !py-[0.25rem] !px-[0.45rem] !bg-danger/10 ms-2">New</span></span>
                            </a>
                        </li>
                    @endcan

                    @can('view appnotice')
                        <li class="slide">
                            <a class="side-menu__item {{ Request::segment(1) == 'notices' ? 'active' : '' }}"
                                href="{{ route('notices.index') }}">
                                <i class="ti ti-bell-ringing side-menu__icon"></i>
                                <span class="side-menu__label">App Notices </span>
                            </a>
                        </li>
                    @endcan

                    @can('view attendancerequest')
                        <li class="slide">
                            <a class="side-menu__item {{ Request::segment(1) == 'request' ? 'active' : '' }}"
                                href="{{ route('attendance.request') }}">
                                <i class="bx bx-time side-menu__icon"></i>
                                <span class="side-menu__label">Attendance Request</span>
                            </a>
                        </li>
                    @endcan

                    @can('view leaverequest')
                        <li class="slide">
                            <a class="side-menu__item {{ Request::segment(1) == 'leaves' ? 'active' : '' }}"
                                href="{{ route('leaves') }}">
                                <i class="bx bx-calendar-minus side-menu__icon"></i>
                                <span class="side-menu__label">Leave Request</span>
                            </a>
                        </li>
                    @endcan

                    @can('view notification')
                        <li class="slide">
                            <a class="side-menu__item {{ Request::segment(1) == 'notifications' ? 'active' : '' }}"
                                href="{{ route('notification.index') }}">
                                <i class="bx bx-bell side-menu__icon"></i>
                                <span class="side-menu__label">Notifications </span>
                            </a>
                        </li>
                    @endcan

                    @can('view attendance')
                        <li class="slide has-sub @if (Request::segment(1) == 'attendances' || Request::segment(1) == 'attendance') {{ 'active open' }} @endif">
                            <a class="side-menu__item @if (Request::segment(1) == 'attendances' || Request::segment(1) == 'attendance') {{ 'active' }} @endif"
                                href="javascript:void(0);">
                                <i class="bx bx-fingerprint side-menu__icon"></i>
                                <span class="side-menu__label">Attendance</span>
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">
                                @can('view allemployeesattendance')
                                    <li class="slide">
                                        <a class="side-menu__item {{ Request::segment(1) == 'attendances' ? 'active' : '' }}"
                                            href="{{ route('attendance.index') }}">All Employees</a>
                                    </li>
                                @endcan

                                @can('view individualemployeeattendance')
                                    <li class="slide">
                                        <a class="side-menu__item {{ Request::segment(1) == 'attendance' ? 'active' : '' }}"
                                            href="{{ route('attendance.individual') }}">Individual</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                </ul>
                <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                        width="24" height="24" viewBox="0 0 24 24">
                        <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
                    </svg>
                </div>
            </nav>

        </div>
    </aside>
