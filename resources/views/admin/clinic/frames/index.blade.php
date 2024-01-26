@extends('admin.layouts.temp')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $clinic->clinic }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard.index', $clinic->id) }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            {{ $page_title }}
                        </li>
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

                    <div class="info-box">
                        <span class="info-box-icon bg-primary"><i class="fas fa-address-card"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">
                                Frame Stocks
                            </span>
                            <span class="info-box-number">
                                {{ $clinic->frame_stock()->count() }}
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->

                </div>
                <!-- /.col -->

                <div class="col-md-3 col-sm-6 col-12">

                    <div class="info-box">
                        <span class="info-box-icon bg-primary"><i class="fas fa-address-card"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">
                                Frame stocks
                                <br>
                                Received from HQ
                            </span>
                            <span class="info-box-number">
                                {{ $clinic->frame_received()->where('is_hq', 1)->count() }}
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->

                </div>
                <!-- /.col -->

                <div class="col-md-3 col-sm-6 col-12">

                    <div class="info-box">
                        <span class="info-box-icon bg-primary"><i class="fas fa-address-card"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">
                                Frame stocks
                                <br>
                                received from clinic
                            </span>
                            <span class="info-box-number">
                                {{ $clinic->frame_received()->where('is_hq', 0)->count() }}
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->

                </div>
                <!-- /.col -->

                <div class="col-md-3 col-sm-6 col-12">

                    <div class="info-box">
                        <span class="info-box-icon bg-primary"><i class="fas fa-address-card"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">
                                Frame requests
                            </span>
                            <span class="info-box-number">
                                {{ $clinic->frame_received()->where('is_hq', 0)->count() }}
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-12">
                    <!-- Custom Tabs -->
                    <div class="card">
                        <div class="card-header d-flex p-0">
                            <ul class="nav nav-pills ml-auto p-2">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#tab_1" data-toggle="tab">
                                        @lang('admin.clinics.page.frames.sub_page.stocks')
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#tab_2" data-toggle="tab">
                                        @lang('admin.clinics.page.frames.sub_page.received')
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#tab_3" data-toggle="tab">
                                        @lang('admin.clinics.page.frames.sub_page.request')
                                    </a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    @include('admin.clinic.frames.stocks')
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_2">
                                    @include('admin.clinic.frames.received')
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_3">
                                    @include('admin.clinic.frames.requests')
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- ./card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->

    </section><!-- /.content -->
@endsection

@push('modals')
    @include('admin.includes.partials.modals.new_clinic_frame_stock')
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {

            // Frame Stocks sector (Tab)
            find_frame_stocks();

            function find_frame_stocks() {
                let path = '{{ route('admin.clinic.inventory.frames.stocks.index', $clinic->id) }}';
                $('#frameStocksData').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: path,
                    'responsive': true,
                    'autoWidth': false,
                    columns: [{
                            data: 'code',
                            name: 'code'
                        },
                        {
                            data: 'gender',
                            name: 'gender'
                        },
                        {
                            data: 'color',
                            name: 'color'
                        },
                        {
                            data: 'shape',
                            name: 'shape'
                        },
                        {
                            data: 'opening',
                            name: 'opening'
                        },
                        {
                            data: 'received',
                            name: 'received'
                        },
                        {
                            data: 'transfered',
                            name: 'transfered'
                        },
                        {
                            data: 'total',
                            name: 'total'
                        },
                        {
                            data: 'sold',
                            name: 'sold'
                        },
                        {
                            data: 'closing',
                            name: 'closing'
                        },
                        {
                            data: 'supplier_price',
                            name: 'supplier_price'
                        },
                        {
                            data: 'price',
                            name: 'price'
                        },
                        {
                            data: 'remarks',
                            name: 'remarks'
                        },
                        {
                            data: 'actions',
                            name: 'actions',
                            orderable: false,
                            searchable: false
                        },
                    ]
                });
            }

            find_frame_hq_received();

            function find_frame_hq_received() {
                let path = '{{ route('admin.clinic.inventory.frames.received.index', $clinic->id) }}';
                $('#frameReceivedFromHQStocksData').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: path,
                    'responsive': true,
                    'autoWidth': false,
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'received_date',
                            name: 'received_date'
                        },
                        {
                            data: 'code',
                            name: 'code'
                        },
                        {
                            data: 'quantity',
                            name: 'quantity'
                        },
                        {
                            data: 'condition',
                            name: 'condition'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'remarks',
                            name: 'remarks'
                        },
                        {
                            data: 'received_by',
                            name: 'received_by'
                        },
                    ]
                });
            }

            find_frame_clinic_received();

            function find_frame_clinic_received() {
                let path = '{{ route('admin.clinic.inventory.frames.received.from.clinic', $clinic->id) }}';
                $('#frameReceivedFromClinicsStocksData').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: path,
                    'responsive': true,
                    'autoWidth': false,
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'received_date',
                            name: 'received_date'
                        },
                        {
                            data: 'code',
                            name: 'code'
                        },
                        {
                            data: 'from_clinic',
                            name: 'from_clinic'
                        },
                        {
                            data: 'quantity',
                            name: 'quantity'
                        },
                        {
                            data: 'condition',
                            name: 'condition'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'remarks',
                            name: 'remarks'
                        },
                        {
                            data: 'received_by',
                            name: 'received_by'
                        },
                    ]
                });
            }

            find_frame_requests();
            function find_frame_requests() {
                let path = '{{ route('admin.clinic.inventory.frames.requests.index', $clinic->id) }}';
                $('#framesRequestedData').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: path,
                    'responsive': true,
                    'autoWidth': false,
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'request_date',
                            name: 'request_date'
                        },
                        {
                            data: 'clinic',
                            name: 'clinic'
                        },
                        {
                            data: 'frame_code',
                            name: 'frame_code'
                        },
                        
                        {
                            data: 'quantity',
                            name: 'quantity'
                        },
                        {
                            data: 'gender',
                            name: 'gender'
                        },
                        {
                            data: 'color',
                            name: 'color'
                        },
                        {
                            data: 'shape',
                            name: 'shape'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'remarks',
                            name: 'remarks'
                        },
                        {
                            data: 'requested_by',
                            name: 'requested_by'
                        },
                    ]
                });
            }

        });
    </script>
@endpush
