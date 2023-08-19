<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <title>{{ config('app.name') }} | Admin</title>

    @include('admin.components.styles')
</head>
<body class="hold-transition sidebar-mini accent-primary">
    <div class="wrapper">
        @include('admin.components.clinic_nav')

        <!-- Main Sidebar Container -->
        @include('admin.components.clinic_sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        @include('admin.components.clinic_footer')
    </div>
    <!-- ./wrapper -->
    <!-- REQUIRED SCRIPTS -->
    @include('admin.components.scripts')
    @yield('scripts')
    @stack('scripts')
    @stack('patients_script')
</body>

</html>
