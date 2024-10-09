@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    @include('admin.includes.partials.main.breadcrumbs')
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            @if (Auth::guard('admin')->user()->hasRole('super-admin'))
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ count($clinics) }}</h3>

                                <p>Clinics</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-database"></i>
                            </div>
                            <a href="{{ route('admin.clinics.index') }}" class="small-box-footer">
                                More info <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ count($workshops) }}</h3>

                                <p>Workshops</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-area-chart"></i>
                            </div>
                            <a href="{{ route('admin.workshop.index') }}" class="small-box-footer">
                                More info <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-primary card-outline card-outline-tabs">

                            <div class="card-header p-0 border-bottom-0">
                                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill"
                                            href="#custom-tabs-four-home" role="tab"
                                            aria-controls="custom-tabs-four-home" aria-selected="true">
                                            Clinics
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill"
                                            href="#custom-tabs-four-profile" role="tab"
                                            aria-controls="custom-tabs-four-profile" aria-selected="false">
                                            Workshops
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!---.card-header p-0 border-bottom-0-->
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-four-tabContent">
                                    <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel"
                                        aria-labelledby="custom-tabs-four-home-tab">

                                        <div class="table-responsive">
                                            <table id="clinicData"
                                                class="table table-striped table-bordered table-valign-middle">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>Name</th>
                                                        <th>Initials</th>
                                                        <th>Logo</th>
                                                        <th>Email</th>
                                                        <th>Phone</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>

                                    <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel"
                                        aria-labelledby="custom-tabs-four-profile-tab">

                                        <div class="table-responsive">
                                            <table id="workshopsData"
                                                class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>Name</th>
                                                        <th>Initials</th>
                                                        <th>Logo</th>
                                                        <th>Phone</th>
                                                        <th>Email</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>

                                    </div>

                                </div>
                                <!--.tab-content-->
                            </div>
                            <!-- /.card-body -->

                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
            @endif

            @if (Auth::guard('admin')->user()->hasRole('Billing'))
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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="data" class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>Clinic</th>
                                                <th>Receipt Number</th>
                                                <th>Patient Names</th>
                                                <th>Invoice Number</th>
                                                <th>Insurance</th>
                                                <th>Scheme Name</th>
                                                <th>Card Number</th>
                                                <th>Closed Date</th>
                                                <th>Amount Billed</th>
                                                <th>ETIMS Number</th>
                                                <th>Document Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($billings as $bill)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $bill->clinic->clinic }}</td>
                                                    <td>{{ $bill->appontment->lens_power->frame_prescription->receipt_number }}
                                                    </td>
                                                    <td>{{ $bill->patient->first_name }} {{ $bill->patient->last_name }}
                                                    </td>
                                                    <td>{{ $bill->invoice_number }}</td>
                                                    <td>
                                                        @isset($bill->payment_detail->insurance)
                                                            {{ $bill->payment_detail->insurance->title }}
                                                        @endisset
                                                    </td>
                                                    <td>{{ $bill->payment_detail->scheme }}</td>
                                                    <td>{{ $bill->patient->card_number }}</td>
                                                    <td>{{ $bill->close_date }}</td>
                                                    <td>{{ $bill->paid_amount }}</td>
                                                    <td>{{ $bill->kra_number }}</td>
                                                    <td>{{ \DocumentStatus::getName($bill->document_status) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if (Auth::guard('admin')->user()->hasRole('Banking'))
                <div class="row">
                    <div class="col-12 col-sm-4">
                        <div class="info-box bg-light">
                            <div class="info-box-content">
                                <span class="info-box-text text-center text-muted">
                                    Total Amount Submitted
                                </span>
                                <span class="info-box-number text-center text-muted mb-0">
                                    {{ $totalSubmittedAmount }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="info-box bg-light">
                            <div class="info-box-content">
                                <span class="info-box-text text-center text-muted">
                                    Total Amount Received
                                </span>
                                <span class="info-box-number text-center text-muted mb-0">
                                    {{ $totalPaid }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="info-box bg-light">
                            <div class="info-box-content">
                                <span class="info-box-text text-center text-muted">
                                    Total Balances
                                </span>
                                <span class="info-box-number text-center text-muted mb-0">
                                    {{ $totalBalance }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/.row -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="paymentsData" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>Date received</th>
                                                <th>Transaction code</th>
                                                <th>Transaction mode</th>
                                                <th>Insurance</th>
                                                <th>Total amount</th>
                                                <th>Total paid</th>
                                                <th>Total balance</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($bankings as $banking)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $banking->date_received }}</td>
                                                    <td>{{ $banking->transaction_code }}</td>
                                                    <td>
                                                        {{ \TransactionModes::getName($banking->transaction_mode) }}
                                                    </td>
                                                    <td>{{ $banking->insurance->title }}</td>
                                                    <td>{{ $banking->amount }}</td>
                                                    <td>{{ $banking->paid }}</td>
                                                    <td>{{ $banking->balance }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('admin.banking.view', $banking->id) }}"
                                                            class="btn btn-primary btn-sm">
                                                            <i class="fas fa-eye fa-sm"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                </div>
            @endif


        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            find_clinics();

            function find_clinics() {
                var path = '{{ route('admin.organization.clinics') }}';
                $('#clinicData').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: path,
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'clinic',
                            name: 'clinic'
                        },
                        {
                            data: 'initials',
                            name: 'initials'
                        },
                        {
                            data: 'logo',
                            name: 'logo',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'phone',
                            name: 'phone'
                        },
                        {
                            data: 'actions',
                            name: 'actions',
                            orderable: false,
                            searchable: false
                        },
                    ],
                    "autoWidth": false,
                    "responsive": true,
                    "searching": false,
                    "lengthChange": false,
                    "ordering": true,
                    "info": true,
                    "paging": true,
                });
            }

            $(document).on('click', '.selectBtn', function(e) {
                e.preventDefault();
                let clinic_id = $(this).attr('id');
                let path = '{{ route('admin.clinics.show', ':clinic') }}';
                path = path.replace(':clinic', clinic_id)
                $.ajax({
                    url: path,
                    type: 'GET',
                    success: function(data) {
                        if (data['status']) {
                            setTimeout(() => {
                                window.location.href =
                                    '{{ route('admin.dashboard.index', ':clinic') }}'
                                    .replace(':clinic',
                                        data.data.id);
                            }, 500);
                        }
                    }
                });
            });

            find_workshops();

            function find_workshops() {
                var path = '{{ route('admin.workshop.index') }}';
                $('#workshopsData').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: path,
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        }, {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'initials',
                            name: 'initials'
                        },
                        {
                            data: 'logo',
                            name: 'logo',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'phone',
                            name: 'phone'
                        },
                        {
                            data: 'email',
                            name: 'email'
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
                    "searching": false,
                    "lengthChange": false,
                    "ordering": true,
                    "info": true,
                    "paging": true,
                });
            }

            $(document).on('click', '.selectWorkshopBtn', function(e) {
                e.preventDefault();
                var workshop_id = $(this).attr('data-id');
                var path = '{{ route('admin.workshop.show') }}';
                var token = '{{ csrf_token() }}';
                $.ajax({
                    url: path,
                    type: 'POST',
                    data: {
                        _token: token,
                        workshop_id: workshop_id
                    },
                    success: function(data) {
                        if (data['status']) {
                            let workshop_url =
                                '{{ route('admin.dashboard.workshop.index', ':id') }}'.replace(
                                    ':id', data.data.id);
                            window.location.href = workshop_url;
                        } else {
                            console.log(data);
                        }
                    }
                });
            });

        });
    </script>
@endsection
