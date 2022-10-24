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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.clinics.reports.export') }}" method="GET">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="from_date" id="fromDate"
                                                placeholder="Enter From Date" class="form-control datepicker">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="to_date" id="toDate"
                                                placeholder="Enter Date Date" class="form-control datepicker">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" name="filter" id="filter"
                                            class="btn btn-primary">Filter</button>
                                        <button type="button" name="refresh" id="refresh"
                                            class="btn btn-default">Refresh</button>

                                        <button type="submit" class="btn btn-primary">
                                            Get Excel
                                        </button>
                                    </div>

                                </div>
                            </form>
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
                                        <th>Clinic</th>
                                        <th>Patient</th>
                                        <th>Appointment Date</th>
                                        <th>Client Type</th>
                                        <th>Scheduled Date</th>
                                        <th>Doctor</th>
                                        <th>Consultation Fee</th>
                                        <th>Agreed Amount</th>
                                        <th>Paid Amount</th>
                                        <th>Order Date</th>
                                        <th>Order Status</th>
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

            find_reports();

            function find_reports(from_date = '', to_date = '') {
                var path = '{{ route('admin.clinics.reports.index') }}';
                $('#reportsData').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: path,
                        data: {
                            from_date: from_date,
                            to_date: to_date
                        }
                    },
                    columns: [
                        {
                            data:"clinic",
                            name: "clinic",
                        },
                        {
                            data: 'full_name',
                            name: 'full_name'
                        },
                        {
                            data: 'appointment_date',
                            name: 'appointment_date'
                        },
                        {
                            data: 'type',
                            name: 'type'
                        },
                        {
                            data: 'scheduled_date',
                            name: 'scheduled_date'
                        },
                        {
                            data: 'doctor_full_name',
                            name: 'doctor_full_name'
                        },
                        {
                            data: 'consultation_fee',
                            name: 'consultation_fee'
                        },
                        {
                            data: 'agreed_amount',
                            name: 'agreed_amount'
                        },
                        {
                            data: 'paid_amount',
                            name: 'paid_amount'
                        },
                        {
                            data: 'order_date',
                            name: 'order_date'
                        },
                        {
                            data: 'order_status',
                            name: 'order_status'
                        }
                    ],
                    'responsive': true,
                    'autoWidth': false,
                });
            }

            $(document).on('click', '#filter', function(e) {
                e.preventDefault();
                var from_date = $('#fromDate').val();
                var to_date = $('#toDate').val();
                if (from_date != '' && to_date != '') {
                    $('#reportsData').DataTable().destroy();
                    find_reports(from_date, to_date);
                } else {
                    toastr.error('Both Date is required');
                }
            });

            $(document).on('click', '#refresh', function(e) {
                e.preventDefault();
                $('#fromDate').val('');
                $('#toDate').val('')
                $('#reportsData').DataTable().destroy();
                find_reports();
            });



        });
    </script>
@endsection
