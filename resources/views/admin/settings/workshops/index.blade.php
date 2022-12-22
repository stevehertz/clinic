@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Workshop Settings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.organization.index') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Settings</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                
                <div class="col-md-3 col-sm-6 col-12">
                    <a href="#">
                        <div class="info-box">
                            <span class="info-box-icon bg-info">
                                <i class="fa fa-lastfm"></i>
                            </span>

                            <div class="info-box-content">
                                <span class="info-box-text">
                                    Lens Type
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>

                </div>
                <!-- /.col -->

                <div class="col-md-3 col-sm-6 col-12">
                    <a href="#">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning">
                                <i class="fa fa-simplybuilt"></i>
                            </span>

                            <div class="info-box-content">
                                <span class="info-box-text">
                                    Lens Material
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>

                </div>
                <!-- /.col -->

                <div class="col-md-3 col-sm-6 col-12">
                    <a href="#">
                        <div class="info-box">
                            <span class="info-box-icon bg-info">
                                <i class="fa fa-slideshare"></i>
                            </span>

                            <div class="info-box-content">
                                <span class="info-box-text">
                                    Lens Coating
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>

                </div>
                <!-- /.col -->

                <div class="col-md-3 col-sm-6 col-12">
                    <a href="#">
                        <div class="info-box">
                            <span class="info-box-icon bg-secondary">
                                <i class="fa fa-viacoin"></i>
                            </span>

                            <div class="info-box-content">
                                <span class="info-box-text">
                                    Lens Index  
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>

                </div>
                <!-- /.col -->

            </div>
            <!-- /.row -->
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

        });
    </script>
@endsection
