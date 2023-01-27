@extends('technicians.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Orders</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('technicians.dashboard.index') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Orders
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <table id="ordersData" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Receipt Number</th>
                                        <th>Patient</th>
                                        <th>Clinic</th>
                                        <th>Status</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div><!-- /.card-body -->
                    </div><!-- /.card -->
                </div>
                <!--.col-12 -->
            </div>
            <!--.row -->
        </div>
        <!--.container-fluid -->
    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            find_orders();
            function find_orders()
            {
                let path = '{{ route('technicians.orders.index') }}';
                $('#ordersData').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: path,
                    "responsive": true,
                    "autoWidth": false,
                    columns: [{
                            data: 'order_date',
                            name: 'order_date'
                        },
                        {
                            data: 'receipt_number',
                            name: 'receipt_number'
                        },
                        {
                            data: 'patient',
                            name: 'patient'
                        },
                        {
                            data: 'clinic',
                            name: 'clinic'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'view',
                            name: 'view',
                            orderable: false,
                            searchable: false
                        },
                    ]

                });
            }

            $(document).on('click', '.viewOrderBtn', function(e){
                e.preventDefault();
                let order_id = $(this).data('id');
                let path = '{{ route('technicians.orders.show', ':id') }}';
                path = path.replace(':id', order_id);
                let token = '{{ csrf_token() }}';
                $.ajax({
                    type: "POST",
                    url: path,
                    data: {
                        _token:token
                    },
                    dataType: "json",
                    success: function (data) {
                        if(data['status']){
                            let order_url = '{{ route('technicians.orders.view', ':id') }}';
                            order_url = order_url.replace(':id', data['data']['id']);
                            setTimeout(() => {
                                window.location.href = order_url;
                            }, 1000);
                        }
                    }
                });
            });
        });
    </script>
@endsection
