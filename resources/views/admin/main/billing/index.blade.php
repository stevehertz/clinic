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
                    <!-- Custom Tabs -->
                    <div class="card">
                        <div class="card-header d-flex p-0">
                            <h3 class="card-title p-3">Tabs</h3>
                            <ul class="nav nav-pills ml-auto p-2">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#tab_1" data-toggle="tab">
                                        All
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#tab_2" data-toggle="tab">
                                        {{ \DocumentStatus::getName(\DocumentStatus::PHYSICAL_DOCUMENT) }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#tab_3" data-toggle="tab">
                                        {{ \DocumentStatus::getName(\DocumentStatus::RECEIVED_DOCUMENT) }}
                                    </a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    <div class="table-responsive">
                                        <table id="data" class="table table-bordered table-striped table-sm">
                                            <thead>
                                                <tr>
                                                    <th></th>
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
                                                @foreach ($data as $bill)
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
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_2">
                                    <form>
                                        <div class="table-responsive">
                                            <span class="receiveDocumentSpan">
                                                <button type="submit" class="btn btn-outline-primary btn-block">
                                                    Receive Document
                                                </button>
                                            </span>
                                            <br>
                                            
                                            <table id="sentToHqData" class="table table-bordered table-striped table-sm">
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
                                                    @foreach ($sentToHQ as $bill)
                                                        <tr>
                                                            <td>
                                                                <input type="checkbox" name="payment_bill_id[]"
                                                                    value="{{ $bill->id }}">
                                                            </td>
                                                            <td>
                                                                {{ $loop->iteration }}
                                                            </td>
                                                            <td>{{ $bill->clinic->clinic }}</td>
                                                            <td>{{ $bill->appontment->lens_power->frame_prescription->receipt_number }}
                                                            </td>
                                                            <td>{{ $bill->patient->first_name }}
                                                                {{ $bill->patient->last_name }}</td>
                                                            <td>{{ $bill->invoice_number }}</td>
                                                            <td>{{ $bill->patient->phone }}</td>
                                                            <td>
                                                                @isset($bill->payment_detail->insurance)
                                                                    {{ $bill->payment_detail->insurance->title }}
                                                                @endisset
                                                            </td>
                                                            <td>{{ $bill->payment_detail->scheme }}</td>
                                                            <td>{{ $bill->patient->card_number }}</td>
                                                            <td>{{ $bill->close_date }}</td>
                                                            <td>{{ $bill->paid_amount }}</td>
                                                            <td>{{ \DocumentStatus::getName($bill->document_status) }}</td>
                                                            <td>
                                                                @if ($bill->document_status == \DocumentStatus::PHYSICAL_DOCUMENT)
                                                                    <a href="javascript:void(0)"
                                                                        data-id="{{ $bill->id }}"
                                                                        class="btn btn-outline-primary btn-xs receiveDocumentBtn">
                                                                        <i class="fa fa-cog"></i> Receive Document
                                                                    </a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>

                                            <br>
                                            <span class="receiveDocumentSpan">
                                                <button type="submit" class="btn btn-outline-primary btn-block">
                                                    Receive Document
                                                </button>
                                            </span>
                                        </div>
                                    </form>

                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_3">
                                    <form id="createRemmittanceForm">
                                        <button type="submit"
                                            class="btn btn-block btn-sm btn-outline-primary submitRemmittanceBtn">
                                            Create Remmittance
                                        </button>
                                        <br>
                                        <div class="table-responsive">
                                            <table id="receivedData" class="table table-bordered table-striped table-sm">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>SN</th>
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
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($receivedDOC as $bill)
                                                        <tr>
                                                            <td>
                                                                <input type="checkbox" name="payment_bill_id[]"
                                                                    value="{{ $bill->id }}">
                                                            </td>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $bill->clinic->clinic }}</td>
                                                            <td>{{ $bill->appontment->lens_power->frame_prescription->receipt_number }}
                                                            </td>
                                                            <td>{{ $bill->patient->first_name }}
                                                                {{ $bill->patient->last_name }}</td>
                                                            <td>{{ $bill->invoice_number }}</td>
                                                            <td>{{ $bill->patient->phone }}</td>
                                                            <td>
                                                                @isset($bill->payment_detail->insurance)
                                                                    {{ $bill->payment_detail->insurance->title }}
                                                                @endisset
                                                            </td>
                                                            <td>{{ $bill->payment_detail->scheme }}</td>
                                                            <td>{{ $bill->patient->card_number }}</td>
                                                            <td>{{ $bill->close_date }}</td>
                                                            <td>{{ $bill->paid_amount }}</td>
                                                            <td>{{ \DocumentStatus::getName($bill->document_status) }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- ./card -->
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
