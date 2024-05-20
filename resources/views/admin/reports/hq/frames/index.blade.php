@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Clinic Reports</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.organization.index') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Clinic Reports</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">
                                Total Frames
                            </span>
                            <span class="info-box-number text-center text-muted mb-0">
                                2300
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">
                                Total Purchased
                            </span>
                            <span class="info-box-number text-center text-muted mb-0">
                                2300
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">
                                Total Transfered
                            </span>
                            <span class="info-box-number text-center text-muted mb-0">
                                2300
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body table-responsive">
                            <table id="reportsData" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Frame Code</th>
                                        <th>Gender</th>
                                        <th>Color</th>
                                        <th>Shape</th>
                                        <th>Opening</th>
                                        <th>Transfered</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div><!-- /.card-body -->
                    </div><!-- /.card -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
    </section>
@endsection

@push('scripts')
    @include('admin.reports.hq.scripts.frames')
@endpush
