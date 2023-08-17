@extends('users.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Orders</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('users.dashboard.index') }}">Home</a>
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
                    <div class="form-group">
                        <select id="orderStatusSelect" class="form-control select2" style="width: 100%;">
                            <option selected="selected" disabled="disabled">
                                Select status
                            </option>
                            <option value="APPROVED">APPROVED</option>
                            <option value="SENT TO WORKSHOP">SENT TO WORKSHOP</option>
                            <option value="FRAME SENT TO WORKSHOP">FRAME SENT TO WORKSHOP
                            </option>
                            <option value="ORDER RECEIVED">ORDER RECEIVED</option>
                            <option value="FRAME RECEIVED">FRAME RECEIVED</option>
                            <option value="GLAZING">GLAZING</option>
                            <option value="RIGHT LENS GLAZED">RIGHT LENS GLAZED</option>
                            <option value="GLAZED">GLAZED</option>
                            <option value="SEND TO CLINIC">SEND TO CLINIC</option>
                            <option value="RECEIVED FROM WORKSHOP">RECEIVED FROM WORKSHOP
                            </option>
                            <option value="CALL FOR COLLECTION">CALL FOR COLLECTION</option>
                            <option value="FRAME COLLECTED">FRAME COLLECTED</option>
                            <option value="CLOSED">CLOSED</option>
                        </select>
                    </div>
                    <!-- /.form-group -->
                </div>
                <!--/.col -->

                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <table id="ordersData" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Patient</th>
                                        <th>Clinic</th>
                                        <th>Status</th>
                                        <th>Workshop</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div><!-- /.card-body -->
                    </div><!-- /.card -->
                </div>
                <!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section><!-- /.content -->
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            find_orders();

            function find_orders(status) {
                var path = '{{ route('users.orders.index') }}';
                $('#ordersData').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url:path,
                        data:{
                            status:status
                        }
                    },
                    columns: [{
                            data: 'order_date',
                            name: 'order_date'
                        },
                        {
                            data: 'full_names',
                            name: 'full_names',
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
                            data: 'workshop',
                            name: 'workshop'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ],
                    "autoWidth": false,
                    "responsive": true,
                });
            }

            $(document).on('change', '#orderStatusSelect', function(e){
                e.preventDefault();
                let status = $(this).val();
                if(status != null)
                {
                    $('#ordersData').DataTable().destroy();
                    find_orders(status);
                }
            });

            $(document).on('click', '.viewOrderBtn', function(e) {
                e.preventDefault();
                var order_id = $(this).data('id');
                var token = '{{ csrf_token() }}';
                var path = '{{ route('users.orders.show') }}';
                $.ajax({
                    type: "POST",
                    url: path,
                    data: {
                        order_id: order_id,
                        _token: token
                    },
                    dataType: "json",
                    success: function(data) {
                        if(data['status']){
                            setTimeout(() => {
                                var order_path = '{{ route('users.orders.view', ':id') }}';
                                order_path = order_path.replace(':id', data['data']['id']);
                                window.location.href = order_path;
                            }, 1000);
                        }
                    }
                });
            });

        });
    </script>
@endsection
