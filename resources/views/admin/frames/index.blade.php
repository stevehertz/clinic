@extends('admin.layouts.temp')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Frames</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard.index', $clinic->id) }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Frames
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
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $num_frames }}</h3>

                            <p>Frames</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer newFrameBtn">New Frame <i class="fa fa-plus "></i></a>
                    </div>
                </div>
                <!-- ./col -->

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $num_stocks }}</h3>

                            <p>Frame Stocks</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer newFrameStockBtn">
                            New Frame <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
                <!-- ./col -->

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $num_purchases }}</h3>

                            <p>Stock Purchases</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-briefcase"></i>
                        </div>
                        <a href="#" class="small-box-footer purchaseStockBtn">
                            Purchase Stock <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
                <!-- ./col -->

                {{-- <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3>{{ $num_transfers }}</h3>

                            <p>Transfered Stocks</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-document-text"></i>
                        </div>
                        <a href="#" class="small-box-footer transferStockBtn">
                            Transfer Stock <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div> --}}
                <!-- ./col -->
            </div>

            <div class="row">
                <div class="col-12">

                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header p-0 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill"
                                        href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home"
                                        aria-selected="true">
                                        Frames
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill"
                                        href="#custom-tabs-four-profile" role="tab"
                                        aria-controls="custom-tabs-four-profile" aria-selected="false">
                                        Frame Stocks
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill"
                                        href="#custom-tabs-four-messages" role="tab"
                                        aria-controls="custom-tabs-four-messages" aria-selected="false">
                                        Stock Purchases
                                    </a>
                                </li>

                                {{-- <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill"
                                        href="#custom-tabs-four-settings" role="tab"
                                        aria-controls="custom-tabs-four-settings" aria-selected="false">Transfer Stocks</a>
                                </li> --}}
                            </ul>
                        </div>
                        <!---.card-header p-0 border-bottom-0-->
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-four-tabContent">
                                <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel"
                                    aria-labelledby="custom-tabs-four-home-tab">

                                    <div class="table-responsive">
                                        <table id="framesData" class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Code</th>
                                                    <th>Brand</th>
                                                    <th>Size</th>
                                                    <th>Type</th>
                                                    <th>Material</th>
                                                    <th>Photo</th>
                                                    <th>Status</th>
                                                    <th>Update</th>
                                                    <th>Delete</th>
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
                                        <table id="frameStocksData" class="table table-striped table-hover">
                                            <thead>
                                                <tr>
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
                                                    <th>Supplier Price</th>
                                                    <th>Price</th>
                                                    <th>Remarks</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>

                                </div>

                                <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel"
                                    aria-labelledby="custom-tabs-four-messages-tab">

                                    <div class="table-responsive">
                                        <table id="purchasedStocks" class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Receipt #</th>
                                                    <th>Frame Code</th>
                                                    <th>Gender</th>
                                                    <th>Color</th>
                                                    <th>Shape</th>
                                                    <th>Units</th>
                                                    <th>Price </th>
                                                    <th>Total Price</th>
                                                    <th>Supplier</th>
                                                    <th>Receipt</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>

                                </div>

                                {{-- <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel"
                                    aria-labelledby="custom-tabs-four-settings-tab">
                                    <div class="table-responsive">
                                        <table id="frameTransferData" class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Frame Code</th>
                                                    <th>From Clinic</th>
                                                    <th>To Clinic</th>
                                                    <th>Quantity</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Condition</th>
                                                    <th>Remarks</th>
                                                    <th>Doctor/Optimetrist</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div> --}}
                            </div>
                            <!--.tab-content-->
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!--.card card-primary card-outline card-outline-tabs -->

                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->

        <!-- Frames Modal -->
        <div class="modal fade" id="newFrameModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">New Frame</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="newFrameForm">
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" name="clinic_id" value="{{ $clinic->id }}" />
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="newFrameCode">Frame Code </label>
                                        <input type="text" name="code" class="form-control" id="newFrameCode"
                                            placeholder="Enter Frame Code">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="newFrameType">
                                            Frame Type
                                        </label>
                                        <select id="newFrameTypeId" name="type_id" class="form-control select2"
                                            style="width: 100%;">
                                            <option disabled='disabled' selected="selected">
                                                Choose Frame Type
                                            </option>
                                            @forelse ($frame_types as $frame_type)
                                                <option value="{{ $frame_type->id }}">
                                                    {{ $frame_type->title }}
                                                </option>
                                            @empty
                                                <option disabled="disabled">No Frame Types Found</option>
                                            @endforelse
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="newFrameType">
                                            Frame Size
                                        </label>
                                        <select id="newFrameSizeId" name="size_id" class="form-control select2"
                                            style="width: 100%;">
                                            <option disabled='disabled' selected="selected">
                                                Choose Frame Size
                                            </option>
                                            @forelse ($frame_sizes as $size)
                                                <option value="{{ $size->id }}">
                                                    {{ $size->size }}
                                                </option>
                                            @empty
                                                <option disabled="disabled">
                                                    No Frame Size found..
                                                </option>
                                            @endforelse
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="newFrameMaterialId">
                                            Frame Material
                                        </label>
                                        <select id="newFrameMaterialId" name="material_id" class="form-control select2"
                                            style="width: 100%;">
                                            <option disabled='disabled' selected="selected">
                                                Choose Frame Material
                                            </option>
                                            @forelse ($frame_materials as $material)
                                                <option value="{{ $material->id }}">
                                                    {{ $material->title }}
                                                </option>
                                            @empty
                                                <option disabled="disabled">
                                                    No Frame Materials Found..
                                                </option>
                                            @endforelse
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="newFrameBrandId">
                                            Frame Brand
                                        </label>
                                        <select id="newFrameBrandId" name="brand_id" class="form-control select2"
                                            style="width: 100%;">
                                            <option disabled='disabled' selected="selected">
                                                Choose Frame Brand
                                            </option>
                                            @forelse ($frame_brands as $brand)
                                                <option value="{{ $brand->id }}">
                                                    {{ $brand->title }}
                                                </option>
                                            @empty
                                                <option disabled="disabled">No Frame Brand Found..</option>
                                            @endforelse
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="newFramePhoto">Photo</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="photo" class="custom-file-input"
                                                    id="newFramePhoto" />
                                                <label class="custom-file-label" for="newFramePhoto">Choose
                                                    file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="newFrameStatus">
                                            Frame Status
                                        </label>
                                        <select id="newFrameStatus" name="status" class="form-control select2"
                                            style="width: 100%;">
                                            <option disabled='disabled' selected="selected">
                                                Choose Frame Status
                                            </option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" id="newFrameSubmitBtn" class="btn btn-primary">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <div class="modal fade" id="updateFrameModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Frame</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="updateFrameForm">
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" name="clinic_id" value="{{ $clinic->id }}" />
                            <input type="hidden" name="frame_id" id="updateFrameId" />
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="updateFrameCode">Frame Code </label>
                                        <input type="text" name="code" class="form-control" id="updateFrameCode"
                                            placeholder="Enter Frame Code">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="updateFrameTypeId">
                                            Frame Type
                                        </label>
                                        <select id="updateFrameTypeId" name="type_id" class="form-control select2"
                                            style="width: 100%;">
                                            <option disabled='disabled' selected="selected">
                                                Choose Frame Type
                                            </option>
                                            @forelse ($frame_types as $frame_type)
                                                <option value="{{ $frame_type->id }}">
                                                    {{ $frame_type->title }}
                                                </option>
                                            @empty
                                                <option disabled="disabled">No Frame Types Found</option>
                                            @endforelse
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="updateFrameSizeId">
                                            Frame Size
                                        </label>
                                        <select id="updateFrameSizeId" name="size_id" class="form-control select2"
                                            style="width: 100%;">
                                            <option disabled='disabled' selected="selected">
                                                Choose Frame Size
                                            </option>
                                            @forelse ($frame_sizes as $size)
                                                <option value="{{ $size->id }}">
                                                    {{ $size->size }}
                                                </option>
                                            @empty
                                                <option disabled="disabled">
                                                    No Frame Size found..
                                                </option>
                                            @endforelse
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="updateFrameMaterialId">
                                            Frame Material
                                        </label>
                                        <select id="updateFrameMaterialId" name="material_id"
                                            class="form-control select2" style="width: 100%;">
                                            <option disabled='disabled' selected="selected">
                                                Choose Frame Material
                                            </option>
                                            @forelse ($frame_materials as $material)
                                                <option value="{{ $material->id }}">
                                                    {{ $material->title }}
                                                </option>
                                            @empty
                                                <option disabled="disabled">
                                                    No Frame Materials Found..
                                                </option>
                                            @endforelse
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="updateFrameBrandId">
                                            Frame Brand
                                        </label>
                                        <select id="updateFrameBrandId" name="brand_id" class="form-control select2"
                                            style="width: 100%;">
                                            <option disabled='disabled' selected="selected">
                                                Choose Frame Brand
                                            </option>
                                            @forelse ($frame_brands as $brand)
                                                <option value="{{ $brand->id }}">
                                                    {{ $brand->title }}
                                                </option>
                                            @empty
                                                <option disabled="disabled">No Frame Brand Found..</option>
                                            @endforelse
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="updateFramePhoto">Photo</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="photo" class="custom-file-input"
                                                    id="updateFramePhoto" />
                                                <label class="custom-file-label" for="updateFramePhoto">Choose
                                                    file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="updateFrameStatus">
                                            Frame Status
                                        </label>
                                        <select id="updateFrameStatus" name="status" class="form-control select2"
                                            style="width: 100%;">
                                            <option disabled='disabled' selected="selected">
                                                Choose Frame Status
                                            </option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" id="updateFrameSubmitBtn" class="btn btn-primary">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <!-- Frame Stocks Modal -->
        <div class="modal fade" id="newFrameStockModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">New Frame Stock</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="newFrameStockForm">
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" name="clinic_id" value="{{ $clinic->id }}" />
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="newFrameStockCode">Frame Code</label>
                                        <select name="frame_id" id="newFrameStockCode" class="form-control select2"
                                            style="width: 100%;">
                                            <option disabled='disabled' selected="selected">
                                                Choose Frame Code
                                            </option>
                                            @forelse ($clinic_frames as $clinic_frame)
                                                <option value="{{ $clinic_frame->id }}">
                                                    {{ $clinic_frame->code }} -
                                                    {{ $clinic_frame->frame_brand->title }}
                                                </option>
                                            @empty
                                                <option disabled="disabled">No Frame Code Found..</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="newFrameStockGender">
                                            Gender
                                        </label>
                                        <select id="newFrameStockGender" name="gender" class="form-control select2"
                                            style="width: 100%;">
                                            <option disabled='disabled' selected="selected">
                                                Choose Gender
                                            </option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Unisex">Unisex</option>
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col-md-6 -->

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="newFrameStockColorId">
                                            Color
                                        </label>
                                        <select id="newFrameStockColorId" name="color_id" class="form-control select2"
                                            style="width: 100%;">
                                            <option disabled='disabled' selected="selected">
                                                Choose Frame Color
                                            </option>
                                            @forelse ($frame_colors as $color)
                                                <option value="{{ $color->id }}">
                                                    {{ $color->color }}
                                                </option>
                                            @empty
                                                <option disabled="disabled">No Frame Colors Found</option>
                                            @endforelse
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col-md-6 -->
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="newFrameStockShapeId">
                                            Frame Shape
                                        </label>
                                        <select id="newFrameStockShapeId" name="shape_id" class="form-control select2"
                                            style="width: 100%;">
                                            <option disabled='disabled' selected="selected">
                                                Choose Frame Shape
                                            </option>
                                            @forelse ($frame_shapes as $shape)
                                                <option value="{{ $shape->id }}">
                                                    {{ $shape->shape }}
                                                </option>
                                            @empty
                                                <option disabled="disabled">No Frame Shapes Found</option>
                                            @endforelse

                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="newFrameStockOpeningStock">
                                            Opening Stock
                                        </label>
                                        <input type="number" id="newFrameStockOpeningStock" name="opening_stock"
                                            class="form-control" placeholder="Enter Opening Stock" />
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col-md-6 -->
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="newFrameStockPrice">
                                            Price
                                        </label>
                                        <input type="text" id="newFrameStockPrice" name="price"
                                            class="form-control" placeholder="Enter Price" />
                                    </div>
                                </div>
                                <!-- /.col-md-6 -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="newFrameStockManufacturerPrice">
                                            Suppliers Price
                                        </label>
                                        <input type="text" id="newFrameStockManufacturerPrice" name="supplier_price"
                                            class="form-control" placeholder="Enter Suppliers Price" />
                                    </div>
                                </div>
                                <!-- /.col-md-6 -->
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="newFrameStockRemarks">
                                            Remarks
                                        </label>
                                        <textarea id="newFrameStockRemarks" name="remarks" class="form-control" placeholder="Enter Remarks"></textarea>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col-md-12 -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" id="newFrameStockSubmitBtn" class="btn btn-primary">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <!-- Purchase Stock -->
        <div class="modal fade" id="purchasedStockModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            Purchase Stock
                        </h4>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="purchasedStockForm">
                        <div class="modal-body">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <small class="text-center" style="text-align: center;">Make Purchases based on the
                                            available stocks</small>
                                        <input type="hidden" class="form-control" name="clinic_id"
                                            value="{{ $clinic->id }}" />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="purchasedStockId">Frame Stock Code</label>
                                        <select name="stock_id" id="purchasedStockId" class="form-control select2"
                                            style="width: 100%;">
                                            <option disabled='disabled' selected="selected">
                                                Choose from available stocks Stock
                                            </option>
                                            @forelse ($stocks as $stock)
                                                <option value="{{ $stock->id }}">
                                                    {{ $stock->frame->code }} -
                                                    {{ $stock->gender }} - {{ $stock->frame_color->color }} -
                                                    {{ $stock->frame_shape->shape }}
                                                </option>
                                            @empty
                                                <option disabled="disabled">No Stocks Available</option>
                                                <option>
                                                    <a href="#" class="btn btn-link">
                                                        <i class="fa fa-plus"></i> Add Stock
                                                    </a>
                                                </option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="purchasedStockDate">
                                            Purchase Date
                                        </label>
                                        <input type="text" id="purchasedStockDate" name="purchase_date"
                                            class="form-control datepicker" placeholder="Purchased Date" />
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                            </div>
                            <!--.row -->

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="purchasedStockReceiptNumber">
                                            Receipt Number
                                        </label>
                                        <input type="text" id="purchasedStockReceiptNumber" name="receipt_number"
                                            class="form-control" placeholder="Receipt Number" />
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-md-6">
                                    <label for="purchasedStockReceipt">Receipt</label>
                                    <div class="input-group">
                                        <div class="custom-file">   
                                            <input type="file" name="receipt" class="custom-file-input"
                                                id="purchasedStockReceipt">
                                            <label class="custom-file-label" for="purchasedStockReceipt">Attach Receipt</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--.row -->

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="purchasedStockUnits">
                                            Units
                                        </label>
                                        <input type="number" id="purchasedStockUnits" name="quantity"
                                            class="form-control" placeholder="Number of units purchased" />
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                            </div>
                            <!--.row -->

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="purchasedStockPrice">
                                            Price
                                        </label>
                                        <input type="number" id="purchasedStockPrice" name="price"
                                            class="form-control" placeholder="Price per unit" />
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                            </div>
                            <!--.row -->

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="purchasedStockSupplier">
                                            Supplier
                                        </label>
                                        <input type="text" id="purchasedStockSupplier" name="supplier"
                                            class="form-control" placeholder="Enter Supplier" />
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col-md-6 -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" id="purchasedStockSubmitBtn" class="btn btn-primary">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!--.modal -->

        <!-- Transfer Stock -->
        <div class="modal fade" id="transferStockModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            Transfer Stock
                        </h4>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="transferStockForm">
                        <div class="modal-body">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="hidden" value="{{ $clinic->id }}" name="from_clinic_id"
                                            class="form-control" />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="transferStockFrameCode">Frame Code</label>
                                        <select name="stock_id" id="transferStockFrameCode" class="form-control select2">
                                            <option disabled selected>Choose Stock</option>
                                            @forelse ($transfer_stocks as $transfer_stock)
                                                <option value="{{ $transfer_stock->id }}">
                                                    {{ $transfer_stock->frame->code }} -
                                                    {{ $transfer_stock->gender }} -
                                                    {{ $transfer_stock->frame_color->color }} -
                                                    {{ $transfer_stock->frame_shape->shape }}
                                                </option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="transferStockClinicId">Transfer To</label>
                                        <select name="to_clinic_id" id="transferStockClinicId"
                                            class="form-control select2" style="width: 100%;">
                                            <option disabled='disabled' selected="selected">
                                                Choose clinic to transfer to
                                            </option>
                                            @forelse ($transfer_clinics as $transfer_clinic)
                                                <option value="{{ $transfer_clinic->id }}">
                                                    {{ $transfer_clinic->clinic }}
                                                </option>
                                            @empty
                                                <option disabled="disabled">No Clinics available at the moment</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="transferStockDate">
                                            Transfer Date
                                        </label>
                                        <input type="text" id="transferStockDate" name="transfer_date"
                                            class="form-control datepicker" placeholder="Transfer Date" />
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="transferStockQuantity">
                                            Quantity
                                        </label>
                                        <input type="text" id="transferStockQuantity" name="quantity"
                                            class="form-control" placeholder="Quantity Transfered" />
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                            </div>
                            <!--.row -->

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="transferStockStatus">
                                            Transfer Status
                                        </label>
                                        <select name="transfer_status" id="transferStockStatus"
                                            class="form-control select2">
                                            <option disabled='disabled' selected="selected">Transfer Status</option>
                                            <option value="Transfered">Transfered</option>
                                            <option value="Not Transfered">Not Transfered</option>
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="transferStockCondition">
                                            Stock Condition
                                        </label>
                                        <select name="condition" id="transferStockCondition"
                                            class="form-control select2">
                                            <option disabled='disabled' selected="selected">Transfered Stock Condition
                                            </option>
                                            <option value="Broken">Broken</option>
                                            <option value="Irrepairable">Irrepairable</option>
                                            <option value="Working">Working</option>
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                            </div>
                            <!--.row -->

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="transferStockRemarks">
                                            Remarks
                                        </label>
                                        <textarea name="remarks" id="transferStockRemarks" class="form-control" placeholder="Remarks"></textarea>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                            </div>
                            <!--.row -->

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="transferStockUserId">Doctor/ Optimetrist Confirmed Transfer</label>
                                        <select name="transfer_user_id" id="transferStockUserId"
                                            class="form-control select2">
                                            @forelse ($transfer_doctors as $doctor)
                                                <option value="{{ $doctor->id }}">
                                                    {{ $doctor->first_name }} {{ $doctor->last_name }}
                                                </option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!--.row -->
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" id="transferStockSubmitBtn" class="btn btn-primary">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!--.modal -->

    </section><!-- /.content -->
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            // Frames sector (Tab)
            find_frames();

            function find_frames() {
                var path = '{{ route('admin.frames.index', $clinic->id) }}';
                $('#framesData').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: path,
                    'responsive': true,
                    'autoWidth': false,
                    columns: [{
                            data: 'code',
                            name: 'code'
                        },
                        {
                            data: 'brand',
                            name: 'brand'
                        },
                        {
                            data: 'size',
                            name: 'size'
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
                            data: 'photo',
                            name: 'photo',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'update',
                            name: 'update',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'delete',
                            name: 'delete   ',
                            orderable: false,
                            searchable: false
                        },
                    ]
                });
            }

            $(document).on('click', '.newFrameBtn', function(e) {
                e.preventDefault();
                $('#newFrameModal').modal('show');
            });

            $('#newFrameForm').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var formData = new FormData(form[0]);
                var path = '{{ route('admin.frames.store') }}';
                $.ajax({
                    url: path,
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#newFrameSubmitBtn').html('<i class="fa fa-spinner fa-spin"></i>');
                        $('#newFrameSubmitBtn').attr('disabled', true);
                    },
                    complete: function() {
                        $('#newFrameSubmitBtn').html('Save');
                        $('#newFrameSubmitBtn').attr('disabled', false);
                    },
                    success: function(data) {
                        if (data['status']) {
                            toastr.success(data['message']);
                            $('#newFrameModal').modal('hide');
                            $('#newFrameForm')[0].reset();
                            $('#framesData').DataTable().ajax.reload();
                            $('#frameStocksData').DataTable().reload();
                            location.reload();
                        }
                    },
                    error: function(error) {
                        if (error.status == 422) {
                            $.each(error.responseJSON.errors, function(i, error) {
                                toastr.error(error);
                            });
                        } else {
                            toastr.error(error.responseJSON.message);
                        }
                    }
                });
            });

            $(document).on('click', '.editFrame', function(e) {
                e.preventDefault();
                var frame_id = $(this).data('id');
                var path = '{{ route('admin.frames.show') }}';
                $.ajax({
                    url: path,
                    type: 'POST',
                    data: {
                        'frame_id': frame_id,
                        '_token': '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data['status']) {
                            $('#updateFrameModal').modal('show');
                            $('#updateFrameId').val(data['data']['id']);
                            $('#updateFrameCode').val(data['data']['code']);
                            $('#updateFrameBrandId').val(data['data']['brand_id']);
                            $('#updateFrameSizeId').val(data['data']['size']);
                            $('#updateFrameTypeId').val(data['data']['type_id']);
                            $('#updateFrameMaterialId').val(data['data']['material_id']);
                            $('#updateFramePhoto').val(data['data']['photo']);
                            $('#updateFrameStatus').val(data['data']['status']);
                        }
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            });

            $('#updateFrameForm').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var formData = new FormData(form[0]);
                var path = '{{ route('admin.frames.update') }}';
                $.ajax({
                    url: path,
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#updateFrameSubmitBtn').html(
                            '<i class="fa fa-spinner fa-spin"></i>');
                        $('#updateFrameSubmitBtn').attr('disabled', true);
                    },
                    complete: function() {
                        $('#updateFrameSubmitBtn').html('Update');
                        $('#updateFrameSubmitBtn').attr('disabled', false);
                    },
                    success: function(data) {
                        if (data['status']) {
                            toastr.success(data['message']);
                            $('#updateFrameModal').modal('hide');
                            $('#updateFrameForm')[0].reset();
                            $('#framesData').DataTable().ajax.reload();
                            location.reload();
                        }
                    },
                    error: function(error) {
                        var errors = data.responseJSON;
                        var errorsHtml = '<ul>';
                        $.each(errors['errors'], function(key, value) {
                            errorsHtml += '<li>' + value + '</li>';
                        });
                        errorsHtml += '</ul>';
                        toastr.error(errorsHtml);
                        console.log(errorsHtml);
                    }
                });
                $.ajaxSetup({
                    statusCode: {
                        401: function() {
                            toastr.error("There is an error");
                        }
                    }
                });
            });

            $(document).on('click', '.deleteFrame', function(e){
                e.preventDefault();
                let frame_id = $(this).data('id');
                let token = '{{ csrf_token() }}';
                let path = '{{ route('admin.frames.delete') }}';
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
                            type: "DELETE",
                            data: {
                                _token: token,
                                frame_id: frame_id
                            },
                            dataType: "json",
                            success: function(data) {
                                if (data['status']) {
                                    Swal.fire(data['message'], '', 'success');
                                    $('#framesData').DataTable().ajax.reload();
                                    $('#frameStocksData').DataTable().ajax.reload();
                                    $('#purchasedStocks').DataTable().ajax.reload();
                                    location.reload();
                                }
                            }
                        });
                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info');
                    }
                });
            });

            // Frame Stocks sector (Tab)
            find_frame_stocks();

            function find_frame_stocks() {
                var path = '{{ route('admin.frame.stocks.index', $clinic->id) }}';
                $('#frameStocksData').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: path,
                    'responsive': true,
                    'autoWidth': false,
                    columns: [{
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
                        },
                        {
                            data: 'supplier_price',
                            name: 'supplier_price'
                        },
                        {
                            data: 'price',
                            name: 'price'
                        },
                        {
                            data: 'remarks',
                            name: 'remarks'
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

            $(document).on('click', '.newFrameStockBtn', function(e) {
                e.preventDefault();
                $('#newFrameStockModal').modal('show');
            });

            $('#newFrameStockForm').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var formData = new FormData(form[0]);
                var path = '{{ route('admin.frame.stocks.store') }}';
                $.ajax({
                    url: path,
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#newFrameStockSubmitBtn').html(
                            '<i class="fa fa-spinner fa-spin"></i>'
                        );
                        $('#newFrameStockSubmitBtn').attr('disabled', true);
                    },
                    complete: function() {
                        $('#newFrameStockSubmitBtn').html('Save');
                        $('#newFrameStockSubmitBtn').attr('disabled', false);
                    },
                    success: function(data) {
                        if (data['status']) {
                            toastr.success(data['message']);
                            $('#newFrameStockForm')[0].reset();
                            $('#newFrameStockModal').modal('hide');
                            $('#frameStocksData').DataTable().ajax.reload();
                            location.reload();
                        }
                    },
                    error: function(error) {
                        if (error.status == 422) {
                            $.each(error.responseJSON.errors, function(i, error) {
                                toastr.error(error);
                            });
                        } else {
                            toastr.error(error.responseJSON.message);
                        }
                    }
                });
            });

            $(document).on('click', '.deleteFrameStock', function(e) {
                e.preventDefault();
                var stock_id = $(this).data('id');
                var token = "{{ csrf_token() }}";
                var path = "{{ route('admin.frame.stocks.delete') }}";
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
                            type: "DELETE",
                            data: {
                                _token: token,
                                stock_id: stock_id
                            },
                            dataType: "json",
                            success: function(data) {
                                if (data['status']) {
                                    Swal.fire(data['message'], '', 'success');
                                    $('#framesData').DataTable().ajax.reload();
                                    $('#frameStocksData').DataTable().ajax.reload();
                                    $('#purchasedStocks').DataTable().ajax.reload();
                                    location.reload();
                                }
                            }
                        });
                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info');
                    }
                });
            });

            // Stock Purchases 
            // view all purchases
            find_all_purchases();

            function find_all_purchases() {
                var path = '{{ route('admin.frame.purchases.index', $clinic->id) }}';
                $('#purchasedStocks').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: path,
                    'responsive': true,
                    'autoWidth': false,
                    columns: [{
                            data: 'receipt_number',
                            name: 'receipt_number'
                        },
                        {
                            data: 'code',
                            name: 'code'
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
                            data: 'quantity',
                            name: 'quantity'
                        },
                        {
                            data: 'price',
                            name: 'price'
                        },
                        {
                            data: 'total',
                            name: 'total'
                        },
                        {
                            data: 'supplier',
                            name: 'supplier'
                        },
                        {
                            data: 'receipt',
                            name: 'receipt'
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

            $(document).on('click', '.purchaseStockBtn', function(e) {
                e.preventDefault();
                $('#purchasedStockModal').modal('show');
            });

            $('#purchasedStockForm').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var formData = new FormData(form[0]);
                var path = '{{ route('admin.frame.purchases.store') }}';
                $.ajax({
                    url: path,
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#purchasedStockSubmitBtn').html(
                            '<i class="fa fa-spinner fa-spin"></i>'
                        );
                        $('#purchasedStockSubmitBtn').attr('disabled', true);
                    },
                    complete: function() {
                        $('#purchasedStockSubmitBtn').html('Save');
                        $('#purchasedStockSubmitBtn').attr('disabled', false);
                    },
                    success: function(data) {
                        if (data['status']) {
                            toastr.success(data['message']);
                            $('#purchasedStockForm')[0].reset();
                            $('#purchasedStockModal').modal('hide');
                            $('#purchasedStocks').DataTable().ajax.reload();
                            $('#frameStocksData').DataTable().ajax.reload();
                            $('#frameStocksData').DataTable().ajax.reload();
                            $('#framesData').DataTable().ajax.reload();
                            location.reload();
                        }
                    },
                    error: function(error) {
                        if (error.status == 422) {
                            $.each(error.responseJSON.errors, function(i, error) {
                                toastr.error(error);
                            });
                        } else {
                            toastr.error(error.responseJSON.message);
                        }
                    }
                });
            });

            $(document).on('click', '.deleteFramePurchase', function(e) {
                e.preventDefault();
                var purchase_id = $(this).data('id');
                var token = "{{ csrf_token() }}";
                var path = "{{ route('admin.frame.purchases.delete') }}";
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
                            type: "DELETE",
                            data: {
                                _token: token,
                                purchase_id: purchase_id
                            },
                            dataType: "json",
                            success: function(data) {
                                if (data['status']) {
                                    Swal.fire(data['message'], '', 'success')
                                    $('#frameStocksData').DataTable().ajax.reload();
                                    $('#purchasedStocks').DataTable().ajax.reload();
                                    location.reload();
                                }
                            }
                        });
                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info');
                    }
                });

            });


            // Transfered Stocks
            // view all transfered stocks
            find_all_transfers();

            function find_all_transfers() {
                var path = '{{ route('admin.frame.transfers.index', $clinic->id) }}';
                $('#frameTransferData').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: path,
                    'responsive': true,
                    'autoWidth': false,
                    columns: [{
                            data: 'frame_code',
                            name: 'frame_code'
                        },
                        {
                            data: 'from_clinic',
                            name: 'from_clinic'
                        },
                        {
                            data: 'to_clinic',
                            name: 'to_clinic'
                        },
                        {
                            data: 'quantity',
                            name: 'quantity'
                        },
                        {
                            data: 'transfer_date',
                            name: 'transfer_date'
                        },
                        {
                            data: 'transfer_status',
                            name: 'transfer_status'
                        },
                        {
                            data: 'condition',
                            name: 'condition'
                        },
                        {
                            data: 'remarks',
                            name: 'remarks'
                        },
                        {
                            data: 'doctor',
                            name: 'doctor'
                        }
                    ]
                });
            }

            // Transfer Stock 
            $(document).on('click', '.transferStockBtn', function(e) {
                e.preventDefault();
                $('#transferStockModal').modal('show');
            });

            $('#transferStockForm').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var formData = new FormData(form[0]);
                var path = '{{ route('admin.frame.transfers.store') }}';
                $.ajax({
                    url: path,
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#transferStockSubmitBtn').html(
                            '<i class="fa fa-spinner fa-spin"></i>'
                        );
                        $('#transferStockSubmitBtn').attr('disabled', true);
                    },
                    complete: function() {
                        $('#transferStockSubmitBtn').html('Save');
                        $('#transferStockSubmitBtn').attr('disabled', false);
                    },
                    success: function(data) {
                        if (data['status']) {
                            toastr.success(data['message']);
                            $('#transferStockForm')[0].reset();
                            $('#transferStockModal').modal('hide');
                            $('#purchasedStocks').DataTable().ajax.reload();
                            $('#frameStocksData').DataTable().ajax.reload();
                            $('#framesData').DataTable().ajax.reload();
                            $('#frameTransferData').DataTable().ajax.reload();
                            location.reload();
                        }
                    },
                    error: function(error) {
                        if (error.status == 422) {
                            $.each(error.responseJSON.errors, function(i, error) {
                                toastr.error(error);
                            });
                        } else {
                            toastr.error(error.responseJSON.message);
                        }
                    }
                });
            });
        });
    </script>
@endsection
