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
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill"
                                        href="#custom-tabs-four-settings" role="tab"
                                        aria-controls="custom-tabs-four-settings" aria-selected="false">
                                        Transfer Stocks From
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-five-settings-tab" data-toggle="pill"
                                        href="#custom-tabs-five-settings" role="tab"
                                        aria-controls="custom-tabs-five-settings" aria-selected="false">
                                        Transfer Stocks To
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
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel"
                                    aria-labelledby="custom-tabs-four-settings-tab">
                                    <div class="table-responsive">
                                        <table id="lensTransferDataFrom"
                                            class="table table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Transfered Date</th>
                                                    <th>Transfer From</th>
                                                    <th>Transfered To</th>
                                                    <th>Lens Code</th>
                                                    <th>Lens Power</th>
                                                    <th>Units</th>
                                                    <th>Status</th>
                                                    <th>Condition</th>
                                                    <th>Technician</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="custom-tabs-five-settings" role="tabpanel"
                                    aria-labelledby="custom-tabs-five-settings-tab">
                                    <div class="table-responsive">
                                        <table id="lensTransferDataTo"
                                            class="table table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Transfered Date</th>
                                                    <th>Transfer From</th>
                                                    <th>Transfered To</th>
                                                    <th>Lens Code</th>
                                                    <th>Lens Power</th>
                                                    <th>Units</th>
                                                    <th>Status</th>
                                                    <th>Condition</th>
                                                    <th>Technician</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
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

        <div class="modal fade" id="newLensModal">
            <div class="modal-dialog modal-lg" role="dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            New Lens
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="newLensForm" role="form">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="newLensPower">Lens Power</label>
                                        <input type="text" class="form-control" name="power" id="newLensPower"
                                            placeholder="Enter Lens Power">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="newLensType">
                                            Lens Type
                                        </label>
                                        <select id="newLensType" name="lens_type_id"
                                            class="form-control select2 select2-primary"
                                            data-dropdown-css-class="select2-primary" style="width: 100%;">
                                            <option disabled="disabled" selected="selected">Choose Lens Type</option>
                                            @forelse ($types as $type)
                                                <option value="{{ $type->id }}">
                                                    {{ $type->type }}
                                                </option>
                                            @empty
                                                <option disabled>No Lens Type Added</option>
                                            @endforelse

                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="newLensMaterial">
                                            Lens Material
                                        </label>
                                        <select id="newLensMaterial" name="lens_material_id"
                                            class="form-control select2 select2-primary"
                                            data-dropdown-css-class="select2-primary" style="width: 100%;">
                                            <option disabled="disabled" selected="selected">Choose Lens Material</option>
                                            @forelse ($materials as $material)
                                                <option value="{{ $material->id }}">
                                                    {{ $material->title }}
                                                </option>
                                            @empty
                                                <option disabled>No Lens Material Added</option>
                                            @endforelse

                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="newLensIndex">Lens Index</label>
                                        <input type="text" class="form-control" name="lens_index" id="newLensIndex"
                                            placeholder="Enter Lens Index">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="newLensEye">Eye</label>
                                        <select id="newLensEye" name="eye"
                                            class="form-control select2 select2-danger"
                                            data-dropdown-css-class="select2-danger" style="width: 100%;">
                                            <option disabled="disabled" selected="selected">Choose Eye</option>
                                            <option value="RIGHT">RIGHT</option>
                                            <option value="LEFT">LEFT</option>
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="newLensOpeningStocks">Opening Stocks</label>
                                        <input type="text" class="form-control" name="opening"
                                            id="newLensOpeningStocks" placeholder="Enter Opening Stocks">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" id="newLensSubmitBtn" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <div class="modal fade" id="updateLensModal">
            <div class="modal-dialog modal-lg" role="dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            Update Lens
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="updateLensForm" role="form">
                        <div class="modal-body">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" name="lens_id" id="updateLensId" class="form-control" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="updateLensPower">Lens Power</label>
                                        <input type="text" class="form-control" name="power" id="updateLensPower"
                                            placeholder="Enter Lens Power">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="updateLensType">
                                            Lens Type
                                        </label>
                                        <select id="updateLensType" name="lens_type_id"
                                            class="form-control select2 select2-primary"
                                            data-dropdown-css-class="select2-primary" style="width: 100%;">
                                            <option disabled="disabled" selected="selected">Choose Lens Type</option>
                                            @forelse ($types as $type)
                                                <option value="{{ $type->id }}">
                                                    {{ $type->type }}
                                                </option>
                                            @empty
                                                <option disabled>No Lens Type Added</option>
                                            @endforelse

                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="updateLensMaterial">
                                            Lens Material
                                        </label>
                                        <select id="updateLensMaterial" name="lens_material_id"
                                            class="form-control select2 select2-primary"
                                            data-dropdown-css-class="select2-primary" style="width: 100%;">
                                            <option disabled="disabled" selected="selected">Choose Lens Material</option>
                                            @forelse ($materials as $material)
                                                <option value="{{ $material->id }}">
                                                    {{ $material->title }}
                                                </option>
                                            @empty
                                                <option disabled>No Lens Material Added</option>
                                            @endforelse

                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="updateLensIndex">Lens Index</label>
                                        <input type="text" class="form-control" name="lens_index"
                                            id="updateLensIndex" placeholder="Enter Lens Index">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="updateLensEye">Eye</label>
                                        <select id="updateLensEye" name="eye"
                                            class="form-control select2 select2-danger"
                                            data-dropdown-css-class="select2-danger" style="width: 100%;">
                                            <option disabled="disabled" selected="selected">Choose Eye</option>
                                            <option value="RIGHT">RIGHT</option>
                                            <option value="LEFT">LEFT</option>
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                            </div>

                            {{-- <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="updateLensOpeningStocks">Opening Stocks</label>
                                        <input type="text" class="form-control" name="opening" id="updateLensOpeningStocks"
                                            placeholder="Enter Opening Stocks">
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" id="updateLensSubmitBtn" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

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
        $(document).ready(function() {

            find_lens();

            function find_lens() 
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
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]

                });
            }

            $(document).on('click', '#newLensPurchasesBtn', function(e) {
                e.preventDefault();
                $('#newLensPurchasesModal').modal('show');
                $('#newLensPurchasesForm')[0].reset();
            });

            $('#newLensPurchasesForm').submit(function(e){
                e.preventDefault();
                var form = $(this);
                var formData = new FormData(form[0]);
                var path = '{{ route('technicians.lens.purchase.store') }}';
                $.ajax({
                    url: path,
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#newLensPurchasesSubmitBtn').html(
                            '<i class="fa fa-spinner fa-spin"></i>');
                        $('#newLensPurchasesSubmitBtn').attr('disabled', true);
                    },
                    complete: function() {
                        $('#newLensPurchasesSubmitBtn').html('Save');
                        $('#newLensPurchasesSubmitBtn').attr('disabled', false);
                    },
                    success: function(data) {
                        if (data['status']) {
                            toastr.success(data['message']);
                            find_num_lenses();
                            $('#newLensPurchasesModal').modal('hide');
                            $('#newLensPurchasesForm')[0].reset();
                            $('#lensData').DataTable().ajax.reload();
                            $('#lensPurchasesData').DataTable().ajax.reload();
                            location.reload();
                        }
                    },
                    error: function(data) {
                        console.log(data.responseJSON.errors);
                        var errors = data.responseJSON.errors;
                        if (errors) {
                            $.each(errors, function(key, value) {
                                toastr.error(value);
                            });
                        }
                    },
                });
            });

            $(document).on('click', '.deleteLensPurchaseBtn', function(e){
                e.preventDefault();
                var lens_purchase_id = $(this).data('id');
                var path = '{{ route('technicians.lens.purchase.delete', ':id') }}';
                var path = path.replace(':id', lens_purchase_id);
                var token = '{{ csrf_token() }}';
                Swal.fire({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this record!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: path,
                            type: 'DELETE',
                            data: {
                                _token: token
                            },
                            dataType: 'json',
                            success: function(data) {
                                if (data['status']) {
                                    Swal.fire(data['message'], '', 'success')
                                    $('#lensData').DataTable().clear().destroy();
                                    $('#lensPurchasesData').DataTable().ajax.reload();
                                    find_lens();
                                    location.reload();
                                }
                            },
                            error: function(data) {
                                var errors = data.responseJSON;
                                var errorsHtml = '<ul>';
                                $.each(errors['errors'], function(key, value) {
                                    errorsHtml += '<li>' + value + '</li>';
                                });
                                errorsHtml += '</ul>';
                                Swal.fire(errorsHtml, '', 'info');
                            }
                        });
                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info');
                    }
                });
            });

            find_lens_transfer_from();

            function find_lens_transfer_from()
            {
                var path = '{{ route('technicians.lens.transfer.index') }}';
                $('#lensTransferDataFrom').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: path,
                    "responsive": true,
                    "autoWidth": false,
                    columns: [{
                            data: 'transfered_date',
                            name: 'transfered_date'
                        },
                        {
                            data: 'from_workshop',
                            name: 'from_workshop'
                        },
                        {
                            data: 'to_workshop',
                            name: 'to_workshop'
                        },
                        {
                            data: 'lens_code',
                            name: 'lens_code'
                        },
                        {
                            data: 'lens_power',
                            name: 'lens_power'
                        },
                        {
                            data: 'quantity',
                            name: 'quantity'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'condition',
                            name: 'condition'
                        },
                        {
                            data: 'technician',
                            name: 'technician'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]

                });
            }

            find_lens_transfer_to();
            function find_lens_transfer_to()
            {
                var path = '{{ route('technicians.lens.transfer.to') }}';
                $('#lensTransferDataTo').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: path,
                    "responsive": true,
                    "autoWidth": false,
                    columns: [{
                            data: 'transfered_date',
                            name: 'transfered_date'
                        },
                        {
                            data: 'from_workshop',
                            name: 'from_workshop'
                        },
                        {
                            data: 'to_workshop',
                            name: 'to_workshop'
                        },
                        {
                            data: 'lens_code',
                            name: 'lens_code'
                        },
                        {
                            data: 'lens_power',
                            name: 'lens_power'
                        },
                        {
                            data: 'quantity',
                            name: 'quantity'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'condition',
                            name: 'condition'
                        },
                        {
                            data: 'technician',
                            name: 'technician'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]

                });
            }

            $(document).on('click', '#newLensTransferBtn', function(e){
                e.preventDefault();
                $('#newLensTransferModal').modal('show');
                $('#newLensTransferForm')[0].reset();
            })
        });
    </script>
@endsection
