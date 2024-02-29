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
                            <a href="{{ route('admin.dashboard.index', $clinic->id) }}">
                                Home
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            {{ $page_title }}
                        </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <button id="filterByDatesBtn" class="btn btn-outline-primary"> 
                                Filter By Dates 
                            </button>
                            <button id="filterByStatusBtn" class="btn btn-outline-primary"> 
                                Filter By Status 
                            </button>
                            <button id="refreshReportsAllReports" class="btn btn-outline-primary">
                                <i class="fa fa-refresh"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!--/.row_-->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <table id="schemeDetailsReportData" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Date</th>
                                        <th>Clinic</th>
                                        <th>Patient Names</th>
                                        <th>Patient Phone</th>
                                        <th>Bill Status</th>
                                        <th>Insurance</th>
                                        <th>Scheme </th>
                                        <th>Claimed Amount</th>
                                        <th>Approval Status</th>
                                        <th>Approved Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div><!-- /.card-body -->
                    </div><!-- /.card -->
                </div>
            </div>
        </div>
        <!--/.container-fluid -->
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            find_scheme_details();
            function find_scheme_details(from_date = '', to_date = '', bill_status='')
            {
                let path  = '{{ route('admin.scheme.details.reports.index', $clinic->id) }}';
                $('#schemeDetailsReportData').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: path,
                        data:{
                            from_date : from_date ,
                            to_date :to_date,
                            bill_status: bill_status
                        }
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'appointment_date',
                            name: 'appointment_date'
                        },
                        {
                            data: 'clinic',
                            name: 'clinic'
                        },
                        {
                            data: 'patient_names',
                            name: 'patient_names'
                        },
                        {
                            data: 'patient_phone',
                            name: 'patient_phone',
                        },
                        {
                            data: 'bill_status',
                            name: 'bill_status',
                        },
                        {
                            data: 'insurance',
                            name: 'insurance',
                        },
                        {
                            data: 'scheme',
                            name: 'scheme'
                        },
                        {
                            data: 'claimed_amount',
                            name: 'claimed_amount'
                        },
                        {
                            data: 'approval_status',
                            name: 'approval_status'
                        },
                        {
                            data: 'agreed_amount',
                            name: 'agreed_amount'
                        },
                    ],
                    "autoWidth": false,
                    "responsive": true,
                });
            }

        });
    </script>
@endpush
