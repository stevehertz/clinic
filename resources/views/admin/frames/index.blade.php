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
                        <a href="{{ route('admin.frame.stocks.index', $clinic->id) }}" class="small-box-footer">More info <i
                                class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
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
                                        aria-selected="true">Frames
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill"
                                        href="#custom-tabs-four-profile" role="tab"
                                        aria-controls="custom-tabs-four-profile" aria-selected="false">
                                        Frame Stocks
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!--.card-header -->
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
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!--.tab-pane -->
                                <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel"
                                    aria-labelledby="custom-tabs-four-profile-tab">
                                    <br>
                                    <div class="table-responsive">
                                        <table id="frameStocksData" class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Frame Code</th>
                                                    <th>Gender</th>
                                                    <th>Color</th>
                                                    <th>Shape</th>
                                                    <th>Opening Stock</th>
                                                    <th>Purchased Stock</th>
                                                    <th>Total Stock</th>
                                                    <th>Sold Stock</th>
                                                    <th>Closing Stock</th>
                                                    <th>Supplier Price</th>
                                                    <th>Price</th>
                                                    <th>Remarks</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                                <!--.tab-pane -->
                            </div>
                            <!--.tab-content -->
                        </div>
                        <!--.card-body -->
                    </div>
                    <!-- /.card -->
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
                            data: 'action',
                            name: 'action',
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

            // Frame Stocks sector (Tab)
            find_frame_stocks();

            function find_frame_stocks() {
                var path = '{{ route('admin.frame.stocks.stocks', $clinic->id) }}';
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
                        }
                    ]
                });
            }


        });
    </script>
@endsection
