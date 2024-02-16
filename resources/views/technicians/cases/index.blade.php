@extends('technicians.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $workshop->name }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('technicians.dashboard.index') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Cases</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Custom Tabs -->
                    <div class="card">
                        <div class="card-header d-flex p-0">
                            <ul class="nav nav-pills ml-auto p-2">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#tab_1" data-toggle="tab">
                                        @lang('labels.technicians.tabs.inventory.cases.stocks')
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#tab_2" data-toggle="tab">
                                        @lang('labels.technicians.tabs.inventory.cases.received.title')
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#tab_3" data-toggle="tab">
                                        @lang('labels.technicians.tabs.inventory.cases.requested')
                                    </a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    @include('technicians.cases.stocks')
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="tab_2">
                                    @include('technicians.cases.received')
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="tab_3">
                                    @include('technicians.cases.requests')
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
        </div>
    </section>
    <!--/.content -->
@endsection


@push('modals')
    @include('technicians.includes.modals.receive_cases_from_hq')
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {

            find_case_stocks();

            function find_case_stocks() {
                let path = '{{ route('technicians.cases.stocks.index') }}';
                $('#caseStocksData').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: path,
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'case_code',
                            name: 'case_code'
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
                            data: 'size',
                            name: 'size'
                        },
                        {
                            data: 'received',
                            name: 'received'
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
                        }
                    ],
                    "autoWidth": false,
                    "responsive": true,
                });
            }

            find_received_cases_hq();

            function find_received_cases_hq() {
                let path = '{{ route('technicians.cases.received.index') }}';
                $('#casesReceivedFromHQData').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: path,
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'receive_date',
                            name: 'receive_date'
                        },
                        {
                            data: 'case_code',
                            name: 'case_code'
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
                        }
                    ],
                    "autoWidth": false,
                    "responsive": true,
                });
            }

            $(document).on('click', '.receiveFromHQBtn', function(e) {
                e.preventDefault();
                $('#receiveFromHQModal').modal('show');
            });

            $("#receiveFromHQForm").submit(function(e) {
                e.preventDefault();
                let form = $(this);
                let formData = new FormData(form[0]);
                let path = '{{ route('technicians.cases.received.store') }}';
                $.ajax({
                    type: "POST",
                    url: path,
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        form.find('button[type=submit]').html(
                            '<i class="fa fa-spinner fa-spin"></i>'
                        );
                        form.find('button[type=submit]').attr('disabled', true);
                    },
                    complete: function() {
                        form.find('button[type=submit]').html('Receive');
                        form.find('button[type=submit]').attr('disabled', false);
                    },
                    success: function(data) {
                        if (data['status']) {
                            toastr.success(data['message']);
                            $('#receiveFromHQModal').modal('hide');
                            $('#receiveFromHQForm').trigger("reset");
                            $('#casesReceivedFromHQData').DataTable().ajax.reload();
                            $('#caseStocksData').DataTable().ajax.reload();
                            // $('#caseRequestedData').DataTable().ajax.reload();
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        }
                    },
                    error: function(data) {
                        if (data.status == 422) {
                            let errors = data.responseJSON.errors;
                            for (var key in errors) {
                                toastr.error(errors[key][0]);
                            }
                        }
                    }
                });
            });

            find_received_cases_workshop();

            function find_received_cases_workshop() {
                let path = '{{ route('technicians.cases.received.from.workshop') }}';
                $('#casesReceivedFromClinicsData').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: path,
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'received_date',
                            name: 'received_date'
                        },
                        {
                            data: 'case_code',
                            name: 'case_code'
                        },
                        {
                            data: 'from_workshop',
                            name: 'from_workshop'
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
                        }
                    ],
                    "autoWidth": false,
                    "responsive": true,
                });
            }

        });
    </script>
@endpush
