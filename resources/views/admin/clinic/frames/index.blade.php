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

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $clinic->frame_stock()->count() }}</h3>

                            <p>Frame Stocks</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer newFrameStockBtn">
                            New Frame Stock <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-12">


                    <div class="card card-default">

                        <div class="card-body">
                            <div class="table-responsive">

                                <table id="frameStocksData" class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Frame Code</th>
                                            <th>Gender</th>
                                            <th>Color</th>
                                            <th>Shape</th>
                                            <th>Opening</th>
                                            <th>Transfered</th>
                                            <th>Total</th>
                                            <th>Sold</th>
                                            <th>Closing</th>
                                            <th>Supplier Price</th>
                                            <th>Price</th>
                                            <th>Remarks</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>

                            </div>
                        </div>

                    </div>

                </div><!-- /.col -->
            </div><!-- /.row -->
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
                let path = '{{ route('admin.frame.stocks.index', $clinic->id) }}';
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

            $(document).on('click', '.newFrameStockBtn', function(e) {
                e.preventDefault();
                $('#newFrameStockModal').modal('show');
                $('#newFrameStockForm').trigger("reset");
            });

            $('#newFrameStockForm').submit(function(e) {
                e.preventDefault();
                let form = $(this);
                let formData = new FormData(form[0]);
                let path = '{{ route('admin.frame.stocks.store', $clinic->id) }}';
                $.ajax({
                    url: path,
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#newFrameStockSubmitBtn').html(
                            '<i class="fa fa-spinner fa-spin"></i>'
                        );
                        $('#newFrameStockSubmitBtn').attr('disabled', true);
                    },
                    complete: function() {
                        $('#newFrameStockSubmitBtn').html('Save');
                        $('#newFrameStockSubmitBtn').attr('disabled', false);
                    },
                    success: function(data) {
                        if (data['status']) {
                            toastr.success(data['message']);
                            $('#newFrameStockForm')[0].reset();
                            $('#newFrameStockModal').modal('hide');
                            $('#frameStocksData').DataTable().ajax.reload();
                            setTimeout(() => {
                                location.reload();
                            }, 500);
                            
                        }
                    },
                    error: function(error) {
                        if (error.status == 422) {
                            $.each(error.responseJSON.errors, function(i, error) {
                                toastr.error(error);
                            });
                        } else {
                            toastr.error(error.responseJSON.message);
                        }
                    }
                });
            });
        });
    </script>
@endpush
