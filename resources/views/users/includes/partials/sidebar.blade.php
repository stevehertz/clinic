<aside class="main-sidebar elevation-4 sidebar-light-primary">
    <!-- Brand Logo -->
    <a href="{{ route('users.dashboard.index') }}" class="brand-link navbar-primary">
        <img src="{{ asset('storage/clinics/' . $clinic->logo) }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">
            {{ config('app.name') }}
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('storage/users/noimage.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('users.users.index') }}" class="d-block">{{ Auth::user()->first_name }}
                    {{ Auth::user()->last_name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('users.dashboard.index') }}"
                        class="nav-link {{ Route::is('users.dashboard.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            @lang('users.page.dashboard.title')
                        </p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            Patients
                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('users.patients.index') }}" class="nav-link">
                                <i class="fa fa-circle nav-icon"></i>
                                <p>Patients</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-check-square"></i>
                        <p>
                            Appointments
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('users.appointments.index') }}" class="nav-link">
                                <i class="fa fa-circle nav-icon"></i>
                                <p>Appointments</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li
                    class="nav-item has-treeview  
                    @if (Route::is('users.doctor.schedules.index') || Route::is('users.doctor.schedules.personal')) menu-open @endif 
                    @if (isset($page_title) && $page_title == trans('users.page.schedules.sub_page.view')) menu-open @endif 
                    @if (isset($page_title) && $page_title == trans('users.page.schedules.sub_page.view_personal')) menu-open @endif
                    ">
                    <a href="#"
                        class="nav-link 
                        @if (Route::is('users.doctor.schedules.index') || Route::is('users.doctor.schedules.personal')) active @endif 
                        @if (isset($page_title) && $page_title == trans('users.page.schedules.sub_page.view')) active @endif 
                        @if (isset($page_title) && $page_title == trans('users.page.schedules.sub_page.view_personal')) active @endif">
                        <i class="nav-icon fa fa-calendar"></i>
                        <p>
                            @lang('users.page.schedules.title')
                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('users.doctor.schedules.index') }}"
                                class="nav-link 
                                @if (Route::is('users.doctor.schedules.index')) active @endif 
                                @if (isset($page_title) && $page_title == trans('users.page.schedules.sub_page.view')) active @endif">
                                <i class="fa fa-circle nav-icon"></i>
                                <p>@lang('users.page.schedules.sub_page.schedules')</p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="{{ route('users.doctor.schedules.personal') }}"
                                class="nav-link 
                                @if (Route::is('users.doctor.schedules.personal')) active @endif 
                                @if (isset($page_title) && $page_title == trans('users.page.schedules.sub_page.view_personal')) active @endif">
                                <i class="fa fa-circle nav-icon"></i>
                                <p>@lang('users.page.schedules.sub_page.my_schedules')</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li
                    class="nav-item has-treeview 
                @if (Route::is('users.payments.bills.index')) menu-open @endif
                @if (isset($page_title) && $page_title == trans('users.page.payments.sub_page.view')) menu-open @endif
                @if (isset($page_title) && $page_title == trans('users.page.payments.sub_page.edit')) menu-open @endif
                @if (Route::is('users.payments.close.bills.index')) menu-open @endif
                @if (isset($page_title) && $page_title == trans('users.page.payments.sub_page.view_closed')) menu-open @endif
                ">
                    <a href="#"
                        class="nav-link
                    @if (Route::is('users.payments.bills.index')) active @endif
                    @if (isset($page_title) && $page_title == trans('users.page.payments.sub_page.view')) active @endif
                    @if (isset($page_title) && $page_title == trans('users.page.payments.sub_page.edit')) active @endif
                    @if (Route::is('users.payments.close.bills.index')) active @endif
                    @if (isset($page_title) && $page_title == trans('users.page.payments.sub_page.view_closed')) active @endif
                    ">
                        <i class="nav-icon fa fa-money"></i>
                        <p>
                            @lang('users.page.payments.title')
                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('users.payments.bills.index') }}"
                                class="nav-link
                            @if (Route::is('users.payments.bills.index')) active @endif
                            @if (isset($page_title) && $page_title == trans('users.page.payments.sub_page.view')) active @endif
                            @if (isset($page_title) && $page_title == trans('users.page.payments.sub_page.edit')) active @endif
                            ">
                                <i class="fa fa-circle nav-icon"></i>
                                <p>@lang('users.page.payments.sub_page.payments')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('users.payments.close.bills.index') }}" class="nav-link
                            @if (Route::is('users.payments.close.bills.index')) active @endif
                            @if (isset($page_title) && $page_title == trans('users.page.payments.sub_page.view_closed')) active @endif
                            ">
                                <i class="fa fa-circle nav-icon"></i>
                                <p>@lang('users.page.payments.sub_page.closed')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('users.payments.remittance.index') }}" class="nav-link">
                                <i class="fa fa-circle nav-icon"></i>
                                <p>@lang('users.page.payments.sub_page.remittance')</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-table"></i>
                        <p>
                            Orders
                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('users.orders.index') }}" class="nav-link">
                                <i class="fa fa-circle nav-icon"></i>
                                <p>Orders</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-balance-scale"></i>
                        <p>
                            Inventory
                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('users.frame.stocks.index') }}" class="nav-link">
                                <i class="nav-icon fa fa-circle"></i>
                                <p>
                                    Frames
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
