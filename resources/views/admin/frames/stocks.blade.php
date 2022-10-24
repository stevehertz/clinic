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
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.frames.index', $clinic->id) }}">
                            Frames
                        </a>
                    </li>
                    <li class="breadcrumb-item active">
                        Frame Stocks
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
            <div class="col-lg-6 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $num_frames }}</h3>

                        <p>Frame Stocks</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer newFrameStockBtn">New Frame <i class="fa fa-plus"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!--.row -->

        <div class="row">
            <div class="col-12">
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Frame Stocks
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!--.card-header -->
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-four-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
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
                                                <th>Action</th>
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
    </div>
    <!--.container-fluid -->

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
                                    <select name="frame_id" id="newFrameStockCode" class="form-control select2" style="width: 100%;">
                                        <option disabled='disabled' selected="selected">
                                            Choose Frame Code
                                        </option>
                                        @forelse ($clinic_frames as $clinic_frame)
                                        <option value="{{ $clinic_frame->id }}">
                                            {{ $clinic_frame->code }} - {{ $clinic_frame->frame_brand->title }}
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
                                    <select id="newFrameStockGender" name="gender" class="form-control select2" style="width: 100%;">
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
                                    <select id="newFrameStockColorId" name="color_id" class="form-control select2" style="width: 100%;">
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
                                    <select id="newFrameStockShapeId" name="shape_id" class="form-control select2" style="width: 100%;">
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
                                    <input type="number" id="newFrameStockOpeningStock" name="opening_stock" class="form-control" placeholder="Enter Opening Stock" />
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
                                    <input type="text" id="newFrameStockPrice" name="price" class="form-control" placeholder="Enter Price" />
                                </div>
                            </div>
                            <!-- /.col-md-6 -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="newFrameStockManufacturerPrice">
                                        Suppliers Price
                                    </label>
                                    <input type="text" id="newFrameStockManufacturerPrice" name="supplier_price" class="form-control" placeholder="Enter Suppliers Price" />
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


</section>
<!--.content -->
@endsection

@section('scripts')
<script>
    $(document).ready(function() {

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
                                Swal.fire(data['message'], '', 'success')
                                $('#frameStocksData').DataTable().ajax.reload();
                            }
                        }
                    });
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info');
                }
            });
        });
    });
</script>
@endsection
