<aside class="main-sidebar elevation-4 sidebar-light-primary">
    <!-- Brand Logo -->
    <a href="{{ route('admin.organization.index') }}" class="brand-link navbar-primary">
        <img src="{{ asset('storage/logo/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Clinic App</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('storage/admin/' . Auth::guard()->user()->profile) }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('admin.personal.profile') }}" class="d-block">
                    {{ Auth::guard('admin')->user()->first_name }}
                    {{ Auth::guard('admin')->user()->last_name }}
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fa fa-dashboard"></i>
                        <p>
                            Dashboard
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.organization.index') }}" class="nav-link active">
                                <i class="fa fa-circle nav-icon"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-database"></i>
                        <p>
                            Clinics
                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.clinics.index') }}" class="nav-link">
                                <i class="fa fa-circle nav-icon"></i>
                                <p>Clinics</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-area-chart"></i>
                        <p>
                            Workshops
                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.workshop.index') }}" class="nav-link">
                                <i class="fa fa-circle nav-icon"></i>
                                <p>Workshops</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            Admins
                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.admins.index') }}" class="nav-link">
                                <i class="fa fa-circle nav-icon"></i>
                                <p>admins</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}


                <li class="nav-header">REPORTS</li>

                <li class="nav-item">
                    <a href="{{ route('admin.clinics.reports.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-line-chart"></i>
                        <p>
                            Clinic Reports
                        </p>
                    </a>
                </li>

                <li class="nav-header">SETTINGS</li>

                <li class="nav-item">
                    <a href="{{ route('admin.organization.view') }}" class="nav-link">
                        <i class="nav-icon fa fa-bank"></i>
                        <p>
                            Organizaton
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.settings.index') }}"
                        class="nav-link @if ($page_title == trans('pages.settings.page_title')) active @endif">
                        <i class="nav-icon fa fa-gear"></i>
                        <p>
                            @lang('pages.settings.page_title')
                        </p>
                    </a>
                </li>

                {{-- <li class="nav-item">
                    <a href="{{ route('admin.settings.workshops.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-gear"></i>
                        <p>
                            Workshop Settings
                        </p>
                    </a>
                </li> --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
