<aside class="main-sidebar elevation-4 sidebar-light-primary">
    <!-- Brand Logo -->
    <a href="{{ route('technicians.dashboard.index') }}" class="brand-link navbar-primary">
        <img src="{{ asset('storage/logo/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('storage/technicians/' . Auth::guard('technician')->user()->profile) }}"
                    class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('technicians.technicians.index') }}"
                    class="d-block">{{ Auth::guard('technician')->user()->first_name }}
                    {{ Auth::guard('technician')->user()->last_name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview">
                    <a href="{{ route('technicians.dashboard.index') }}" class="nav-link  @if ($page_title == trans('pages.technicians.dashboard')) active @endif ">
                        <i class="nav-icon fa fa-dashboard"></i>
                        <p>
                            @lang('pages.technicians.dashboard')
                        </p>
                    </a>
                </li>

                <li class="nav-item has-treeview @if ($page_title == trans('pages.technicians.inventory.title')) menu-open @endif">
                    <a href="#" class="nav-link @if ($page_title == trans('pages.technicians.inventory.title')) active @endif">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            @lang('pages.technicians.inventory.title')
                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="{{ route('technicians.lens.index') }}"
                                class="nav-link  @if (isset($lens_pages) && $lens_pages == trans('pages.technicians.inventory.lens')) active @endif">
                                <i class="fa fa-circle nav-icon"></i>
                                <p>@lang('pages.technicians.inventory.lens')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa fa-circle nav-icon"></i>
                                <p>@lang('pages.technicians.inventory.cases')</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link @if ($page_title == trans('pages.technicians.assets.title')) active  @endif">
                        <i class="nav-icon fa fa-database"></i>
                        <p>
                            @lang('pages.technicians.assets.title')
                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('technicians.assets.index') }}" class="nav-link @if ($page_title == trans('pages.technicians.assets.title')) active  @endif">
                                <i class="fa fa-circle nav-icon"></i>
                                <p>@lang('pages.technicians.assets.title')</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('technicians.assets.transfer.index') }}" class="nav-link @if ($page_title == trans('pages.technicians.assets.transfered')) active  @endif">
                                <i class="fa fa-circle nav-icon"></i>
                                <p>@lang('pages.technicians.assets.transfered')</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="{{ route('technicians.orders.index') }}" class="nav-link @if ($page_title == trans('pages.technicians.orders.title')) active  @endif">
                        <i class="nav-icon fa fa-check-square"></i>
                        <p>
                            @lang('pages.technicians.orders.title')
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!--.sidebar-->
</aside>
