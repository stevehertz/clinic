@extends('users.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Frame Stocks</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('users.dashboard.index') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Available Frames
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
                            <table id="frameStocksData" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Frame Code</th>
                                        <th>Gender</th>
                                        <th>Color</th>
                                        <th>Shape</th>
                                        <th>Opening</th>
                                        <th>Purchased</th>
                                        <th>Transfered</th>
                                        <th>Total</th>
                                        <th>Sold</th>
                                        <th>Closing</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div><!-- /.card-body -->
                    </div><!-- /.card -->

                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section><!-- /.content -->
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            find_frame_stocks();
            function find_frame_stocks()
            {
                var path = '{{ route('users.frame.stocks.index') }}';
                $('#frameStocksData').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: path,
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'frame_code',
                            name: 'frame_code'
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
                            data: 'opening_stock',
                            name: 'opening_stock'
                        },
                        {
                            data: 'purchase_stock',
                            name: 'purchase_stock'
                        },
                        {
                            data: 'transfered_stock',
                            name: 'transfered_stock'
                        },
                        {
                            data: 'total_stock',
                            name: 'total_stock'
                        },
                        {
                            data: 'sold_stock',
                            name: 'sold_stock'
                        },
                        {
                            data: 'closing_stock',
                            name: 'closing_stock'
                        }
                    ],
                    "autoWidth": false,
                    "responsive": true,
                });
            }

        });
    </script>
@endsection
