<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <title>{{ config('app.name') }} | Admin</title>
    @include('admin.components.styles')
</head>

<body class="hold-transition sidebar-mini accent-primary">
    <div class="wrapper">
        <!-- Navbar -->
        @include('admin.components.main_nav')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('admin.components.main_sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2022.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->
    <!-- REQUIRED SCRIPTS -->
    @include('admin.components.scripts')
    @yield('scripts')
    @stack('scripts')
</body>

</html>
