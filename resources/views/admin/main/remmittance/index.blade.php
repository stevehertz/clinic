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
                                {{ \RemmittanceStatus::getName(RemmittanceStatus::PENDING)  }}
                            </span>
                            <span class="info-box-number text-center text-muted mb-0">
                                0
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="info-box bg-light">
                        <div class="info-box-content">
                            <span class="info-box-text text-center text-muted">
                                {{ \RemmittanceStatus::getName(RemmittanceStatus::SUBMITTED) }}
                            </span>
                            <span class="info-box-number text-center text-muted mb-0">
                                0
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <!--/.row -->

            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <form id="submitRemmittanceForm">
                            <div class="card-header">
                                <div class="card-tools">
                                    <a href="{{ route('admin.remmittance.export') }}" class="btn btn-outline-primary btn-sm">
                                        Export
                                    </a>
                                    <button type="submit" class="btn btn-sm btn-outline-primary submitCreatedRemmittanceBtn">
                                        Submit Remmittance
                                    </button>
                                </div>
                                <!--/.card-tools -->
                            </div>
                            <div class="card-body table-responsive">
                                <table id="data" class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th></th>
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
                                            <th>Remmittance Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $remmittance)
                                            <tr>
                                                <td><input type="checkbox" name="remmittance_id[]"
                                                        value="{{ $remmittance->id }}"></td>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $remmittance->paymentBill->clinic->clinic }}</td>
                                                <td>{{ $remmittance->paymentBill->appontment->lens_power->frame_prescription->receipt_number }}
                                                </td>
                                                <td>{{ $remmittance->paymentBill->patient->first_name }} {{ $remmittance->paymentBill->patient->last_name }}</td>
                                                <td>{{ $remmittance->paymentBill->invoice_number }}</td>
                                                <td>{{ $remmittance->paymentBill->patient->phone }}</td>
                                                <td>{{ $remmittance->paymentBill->payment_detail->insurance_id }}</td>
                                                <td>{{ $remmittance->paymentBill->payment_detail->scheme }}</td>
                                                <td>{{ $remmittance->paymentBill->patient->card_number }}</td>
                                                <td>{{ $remmittance->paymentBill->close_date }}</td>
                                                <td>{{ $remmittance->paymentBill->paid_amount }}</td>
                                                <td>{{ \RemmittanceStatus::getName($remmittance->status) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer clearfix submitRemmittanceCol">
                                <button type="submit" class="btn btn-sm btn-outline-primary float-right submitCreatedRemmittanceBtn">
                                    Submit Remmittance
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
                <!--/.col -->
            </div>
        </div>
        <!--/.container-fluid -->
    </section>
    <!--/.content -->
@endsection

@push('scripts')
    @include('admin.main.remmittance.scripts.scripts')
@endpush
