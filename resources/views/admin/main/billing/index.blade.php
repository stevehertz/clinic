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
                <div class="col-12 col-md-12">
                    <div class="card">
                        <form id="createRemmittanceForm">
                            <div class="card-header">
                                <div class="card-tools">
                                    <a href="{{ route('admin.billing.export') }}" class="btn btn-outline-primary btn-sm">
                                        Export
                                    </a>
                                    <button type="submit" class="btn btn-sm btn-outline-primary submitRemmittanceBtn">
                                        Create Remmittance
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
                                            <th>Document Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $bill)
                                            <tr>
                                                <td><input type="checkbox" name="payment_bill_id[]"
                                                        value="{{ $bill->id }}"></td>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $bill->clinic->clinic }}</td>
                                                <td>{{ $bill->appontment->lens_power->frame_prescription->receipt_number }}
                                                </td>
                                                <td>{{ $bill->patient->first_name }} {{ $bill->patient->last_name }}</td>
                                                <td>{{ $bill->invoice_number }}</td>
                                                <td>{{ $bill->patient->phone }}</td>
                                                <td>{{ $bill->payment_detail->insurance_id }}</td>
                                                <td>{{ $bill->payment_detail->scheme }}</td>
                                                <td>{{ $bill->patient->card_number }}</td>
                                                <td>{{ $bill->close_date }}</td>
                                                <td>{{ $bill->paid_amount }}</td>
                                                <td>{{ \DocumentStatus::getName($bill->document_status) }}</td>
                                                <td>
                                                    <a href="javascript:void(0)"
                                                        class="btn btn-outline-primary btn-xs viewBtn">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    @if ($bill->document_status == \DocumentStatus::PHYSICAL_DOCUMENT)
                                                        <a href="javascript:void(0)" data-id="{{ $bill->id }}"
                                                            class="btn btn-outline-primary btn-xs receiveDocumentBtn">
                                                            <i class="fa fa-cog"></i> Receive Document
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer clearfix submitRemmittanceCol">
                                <button type="submit" class="btn btn-sm btn-outline-primary float-right submitRemmittanceBtn">
                                    Create Remmittance
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
                <!--/.col -->
            </div>
            <!--/.row -->
        </div>
        <!--/.container-fluid -->
    </section>
    <!--/.content -->
@endsection

@push('scripts')
    @include('admin.main.billing.scripts.scripts')
@endpush
