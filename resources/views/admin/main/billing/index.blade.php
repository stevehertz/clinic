@extends('admin.layouts.app')

@section('content')
    @include('admin.includes.partials.main.breadcrumbs')

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">
                                Closed Bills
                            </span>
                            <span class="info-box-number text-center text-muted mb-0">
                                {{ count($closedBills) }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">
                                Documents Sent To HQ
                            </span>
                            <span class="info-box-number text-center text-muted mb-0">
                                {{ count($sentToHQ) }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">
                                Documents Received From Clinic
                            </span>
                            <span class="info-box-number text-center text-muted mb-0">
                                {{ count($receivedDOC) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <!--/.row -->

            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-tools">
                                <a href="{{ route('admin.billing.export') }}"
                                    class="btn btn-block btn-outline-primary btn-sm">
                                    <i class="fas fa-file-excel"></i> Export
                                </a>
                            </div>
                            <!--/.card-tools -->
                        </div>
                        <div class="card-body table-responsive">
                            <table id="data" class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Clinic</th>
                                        <th>Receipt Number</th>
                                        <th>Patient Names</th>
                                        <th>Invoice Number</th>
                                        <th>Phone Number</th>
                                        <th>Insurance</th>
                                        <th>Scheme Name</th>
                                        <th>Card Number</th>
                                        <th>Closed Date</th>
                                        <th>Amount Billed</th>
                                        <th>Document Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <!--/.col -->
            </div>
            <!--/.row -->
        </div>
        <!--/.container-fluid -->
    </section>
    <!--/.content -->
@endsection

@push('scripts')
    @include('admin.main.billing.scripts.scripts')
@endpush
