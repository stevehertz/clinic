@extends('technicians.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Lenses</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('technicians.dashboard.index') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Lenses</li>
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
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header p-0 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill"
                                        href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home"
                                        aria-selected="true">
                                        Lens Stocks
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill"
                                        href="#custom-tabs-four-profile" role="tab"
                                        aria-controls="custom-tabs-four-profile" aria-selected="false">
                                        Stock Purchases
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
                                        <table id="lensData" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Date Added</th>
                                                    <th>Lens Code</th>
                                                    <th>Lens Power</th>
                                                    <th>Lens Type</th>
                                                    <th>Lens Material</th>
                                                    <th>Lens Index</th>
                                                    <th>Eye</th>
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
                                    </div>

                                </div>

                                <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel"
                                    aria-labelledby="custom-tabs-four-profile-tab">

                                    <div class="table-responsive">
                                        <table id="lensPurchasesData"
                                            class="table table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Purchased Date</th>
                                                    <th>Lens Code</th>
                                                    <th>Lens Power</th>
                                                    <th>Vendor</th>
                                                    <th>Received Date</th>
                                                    <th>Units</th>
                                                    <th>Price</th>
                                                    <th>Total Price</th>
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
                    <!--.card card-primary card-outline card-outline-tabs -->

                </div><!-- /.col -->
            </div><!-- /.row -->

        </div>
        <!--.container-fluid -->

        <div class="modal fade" id="newLensPurchasesModal">
            <div class="modal-dialog modal-lg" role="dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            New Lens Purchase
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="newLensPurchasesForm" role="form">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="newLensPurchasesLens">Lens</label>
                                        <select id="newLensPurchasesLens" name="lens_id"
                                            class="form-control select2 select2-primary"
                                            data-dropdown-css-class="select2-primary" style="width: 100%;">
                                            <option disabled="disabled" selected="selected">Choose Lens</option>
                                            @forelse ($lenses as $lens)
                                                <option value="{{ $lens->id }}">
                                                    {{ $lens->code }} : {{ $lens->power }} : {{ $lens->lens_type->type }} : {{ $lens->lens_material->title }} : {{ $lens->eye }}
                                                </option>
                                            @empty
                                                <option disabled>No Lens Found</option>
                                            @endforelse

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="newLensPurchasesVendor">
                                            Vendor
                                        </label>
                                        <select id="newLensPurchasesVendor" name="vendor_id"
                                            class="form-control select2 select2-primary"
                                            data-dropdown-css-class="select2-primary" style="width: 100%;">
                                            <option disabled="disabled" selected="selected">Choose Vendor</option>
                                            @forelse ($vendors as $vendor)
                                                <option value="{{ $vendor->id }}">
                                                    {{ $vendor->first_name }} {{ $vendor->last_name }} - {{ $vendor->company }}
                                                </option>
                                            @empty
                                                <option disabled>No Vendors Found</option>
                                            @endforelse

                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="newLensPurchasesDate">
                                            Purchased Date
                                        </label>
                                        <input type="text" id="newLensPurchasesDate" name="purchased_date" placeholder="Enter Placeholder" class="form-control datepicker">
                                    </div>
                                    <!-- /.form-group -->
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="newLensReceivedDate">
                                            Received Date
                                        </label>
                                        <input type="text" id="newLensReceivedDate" name="received_date" placeholder="Enter Placeholder" class="form-control datepicker">
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="newLensPurchasesQuantity">Units</label>
                                        <input type="text" class="form-control" name="quantity"
                                            id="newLensPurchasesQuantity" placeholder="Enter Units">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="newLensPurchasesPrice">Price</label>
                                        <input type="text" class="form-control" name="price"
                                            id="newLensPurchasesPrice" placeholder="Enter Stock Price">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" id="newLensPurchasesSubmitBtn" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <div class="modal fade" id="newLensTransferModal">
            <div class="modal-dialog modal-lg" role="dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            Make Transfer
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="newLensTransferForm" role="form">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="newLensTransferLens">Lens</label>
                                        <select id="newLensTransferLens" name="lens_id"
                                            class="form-control select2 select2-primary"
                                            data-dropdown-css-class="select2-primary" style="width: 100%;">
                                            <option disabled="disabled" selected="selected">Choose Lens</option>
                                            @forelse ($lenses as $lens)
                                                <option value="{{ $lens->id }}">
                                                    {{ $lens->code }} : {{ $lens->power }} : {{ $lens->lens_type->type }} : {{ $lens->lens_material->title }} : {{ $lens->eye }}
                                                </option>
                                            @empty
                                                <option disabled>No Lens Found</option>
                                            @endforelse

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="newLensTransferWorkshop">
                                            Transfer To
                                        </label>
                                        <select id="newLensTransferWorkshop" name="to_workshop_id"
                                            class="form-control select2 select2-primary"
                                            data-dropdown-css-class="select2-primary" style="width: 100%;">
                                            <option disabled="disabled" selected="selected">Choose Workshop Transfer To</option>
                                            @forelse ($transfer_workshops as $transfer_w)
                                                <option value="{{ $transfer_w->id }}">
                                                    {{ $transfer_w->name }} 
                                                </option>
                                            @empty
                                                <option disabled>No Workshop Found</option>
                                            @endforelse
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="newLensTransferDate">
                                            Transfered Date
                                        </label>
                                        <input type="text" id="newLensTransferDate" name="transfer_date" placeholder="Enter Transfered Date" class="form-control datepicker">
                                    </div>
                                    <!-- /.form-group -->
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="newLensTransfeQuantity">
                                            Units
                                        </label>
                                        <input type="number" id="newLensTransfeQuantity" name="quantity" placeholder="Enter Units Transfered" class="form-control">
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="newLensTransfeCondition">Condition</label>
                                        <select id="newLensTransfeCondition" name="condition"
                                            class="form-control select2 select2-primary"
                                            data-dropdown-css-class="select2-primary" style="width: 100%;">
                                            <option disabled="disabled" selected="selected">Choose Lens Condition</option>
                                            <option value="BROKEN">BROKEN</option>
                                            <option value="WORKING">WORKING</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="newLensTransfeStatus">Status</label>
                                        <select id="newLensTransfeStatus" name="status"
                                            class="form-control select2 select2-primary"
                                            data-dropdown-css-class="select2-primary" style="width: 100%;">
                                            <option disabled="disabled" selected="selected">Choose Transfer Status</option>
                                            <option value="TRANSFERED">TRANSFERED</option>
                                            <option value="NOT TRANSFERED">NOT TRANSFERED</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="newLensTransfeRemarks">Remarks</label>
                                        <textarea name="remarks" id="newLensTransfeRemarks" placeholder="Enter Your Remarks" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" id="newLensTransfeSubmitBtn" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

    </section>
    <!-- /.content -->
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            
            find_lens();
            function find_lens() {
                var path = '{{ route('technicians.lens.index') }}';
                $('#lensData').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: path,
                    "responsive": true,
                    "autoWidth": false,
                    columns: [{
                            data: 'date_added',
                            name: 'date_added'
                        },
                        {
                            data: 'code',
                            name: 'code'
                        },
                        {
                            data: 'power',
                            name: 'power'
                        },
                        {
                            data: 'type',
                            name: 'type'
                        },
                        {
                            data: 'material',
                            name: 'material'
                        },
                        {
                            data: 'lens_index',
                            name: 'lens_index'
                        },
                        {
                            data: 'eye',
                            name: 'eye'
                        },
                        {
                            data: 'opening',
                            name: 'opening'
                        },
                        {
                            data: 'purchased',
                            name: 'purchased'
                        },
                        {
                            data: 'transfered',
                            name: 'transfered'
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
                        },
                    ]

                });
            }

            find_lens_purchases();
            function find_lens_purchases() {
                var path = '{{ route('technicians.lens.purchase.index') }}';
                $('#lensPurchasesData').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: path,
                    "responsive": true,
                    "autoWidth": false,
                    columns: [{
                            data: 'purchased_date',
                            name: 'purchased_date'
                        },
                        {
                            data: 'lens_code',
                            name: 'lens_code'
                        },
                        {
                            data: 'power',
                            name: 'power'
                        },
                        {
                            data: 'vendor',
                            name: 'vendor'
                        },
                        {
                            data: 'received_date',
                            name: 'received_date'
                        },
                        {
                            data: 'quantity',
                            name: 'quantity'
                        },
                        {
                            data: 'price',
                            name: 'price'
                        },
                        {
                            data: 'total_price',
                            name: 'total_price'
                        },
                    ]

                });
            }

        });
    </script>
@endsection
