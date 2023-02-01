@extends('technicians.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Orders</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('technicians.dashboard.index') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="{{ route('technicians.orders.index') }}">Orders</a>
                        </li>
                        <li class="breadcrumb-item active">
                            View Order
                        </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Lens Power
                        </h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td></td>
                                    <td>Rigth Eye</td>
                                    <td>Left Eye</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Sphere</td>
                                    <td>{{ $order->lens_power->right_sphere }}</td>
                                    <td>{{ $order->lens_power->left_sphere }}</td>
                                </tr>
                                <tr>
                                    <td>Cylinder</td>
                                    <td>{{ $order->lens_power->right_cylinder }}</td>
                                    <td>{{ $order->lens_power->left_cylinder }}</td>
                                </tr>
                                <tr>
                                    <td>Axis</td>
                                    <td>{{ $order->lens_power->right_axis }}</td>
                                    <td>{{ $order->lens_power->left_axis }}</td>
                                </tr>
                                <tr>
                                    <td>Additional</td>
                                    <td>{{ $order->lens_power->right_add }}</td>
                                    <td>{{ $order->lens_power->left_add }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!--.card -->

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            From Clinic
                        </h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body table-responsive">
                        <strong><i class="fa fa-industry mr-1"></i> Clinic Name</strong>

                        <p class="text-muted">
                            {{ $order->clinic->clinic }}
                        </p>

                        <hr>

                        <strong><i class="fa fa-mobile-phone mr-1"></i> Phone Number</strong>

                        <p class="text-muted">
                            {{ $order->clinic->phone }}
                        </p>

                        <hr>

                        <strong><i class="fa fa-envelope mr-1"></i> Email Address</strong>

                        <p class="text-muted">
                            {{ $order->clinic->email }}
                        </p>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!--.col-md-3 -->

            <div class="col-md-6">
                <div class="card card-outline card-primary">

                    <div class="card-header p-2">
                        <ul class="nav nav-pills">

                            <li class="nav-item">
                                <a class="nav-link active" href="#orderDetailsTab" data-toggle="tab">
                                    Order Details
                                </a>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link" href="#lensPrescriptionTab" data-toggle="tab">
                                    Lens Prescription
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#framePrescriptionTab" data-toggle="tab">
                                    Frame Prescription
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#orderSalesTab" data-toggle="tab">
                                    Sales & Lenses
                                </a>
                            </li>
                        </ul>
                        <!-- .nav .nav-pills -->
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body">
                        <div class="tab-content">

                            <div class="active tab-pane" id="orderDetailsTab">
                                <strong><i class="fa fa-calendar mr-1"></i> Date</strong>

                                <p class="text-muted">
                                    {{ date('d-m-Y', strtotime($order->order_date)) }}
                                </p>

                                <hr>

                                <strong><i class="fa fa-sticky-note mr-1"></i> Order Receipt</strong>

                                <p class="text-muted">
                                    {{ $order->receipt_number }}
                                </p>

                                <hr>

                                <strong><i class="fa fa-cog mr-1"></i> Status</strong>

                                <p class="text-muted">
                                    {{ $order->status }}
                                </p>

                            </div>
                            <!-- / .active .tab-pane -->

                            <div class="tab-pane" id="lensPrescriptionTab">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th>Lens Type</th>
                                                <td>
                                                    {{ $order->lens_prescription->lens_type->type }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Lens Material</th>
                                                <td>
                                                    {{ $order->lens_prescription->lens_material->title }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Lens Index/Thickness</th>
                                                <td>
                                                    {{ $order->lens_prescription->index }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Tint</th>
                                                <td>
                                                    {{ $order->lens_prescription->tint }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Diameter</th>
                                                <td>
                                                    {{ $order->lens_prescription->diameter }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Focal Height</th>
                                                <td>
                                                    {{ $order->lens_prescription->focal_height }}
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <!--.table-responsive -->
                            </div>
                            <!--.tab-pane -->

                            <div class="tab-pane" id="framePrescriptionTab">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th>Frame Code</th>
                                                <td>
                                                    {{ $order->frame_prescription->frame_code }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Frame Brand</th>
                                                <td>
                                                    {{ $order->frame_prescription->frame_stock->frame->frame_brand->title }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Frame Type</th>
                                                <td>
                                                    {{ $order->frame_prescription->frame_stock->frame->frame_type->title }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Frame Size</th>
                                                <td>
                                                    {{ $order->frame_prescription->frame_stock->frame->frame_size->size }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Frame Material</th>
                                                <td>
                                                    {{ $order->frame_prescription->frame_stock->frame->frame_brand->title }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!--.table-responsive -->
                            </div>
                            <!--.tab-pane -->

                            <div class="tab-pane" id="orderSalesTab">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Len Power</th>
                                                <th>Lens Type</th>
                                                <th>Lens Material</th>
                                                <th>Eye</th>
                                                <th>Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($sales as $sale)
                                                <tr>
                                                    <td>{{ $sale->lens->power }}</td>
                                                    <td>{{ $sale->lens->lens_type->type }}</td>
                                                    <td>{{ $sale->lens->lens_material->title }}</td>
                                                    <td>{{ $sale->lens->eye }}</td>
                                                    <td>{{ $sale->quantity }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5">
                                                        <p class="text-center text-muted">No Lenses Added For This Order</p>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!--.tab-content -->
                    </div>
                    <!--.card-body -->
                    <div class="card-footer">

                        <div class="row">
                            <div class="col-md-6">
                                <button type="button" id="trackOrderBtn" class="btn btn-secondary btn-block">
                                    Track Order
                                </button>
                            </div>
                            <div class="col-md-6">
                                @if ($order->status == 'FRAME SENT TO WORKSHOP')
                                    <button type="button" id="orderRceceivedBtn" data-id="{{ $order->id }}"
                                        data-value="ORDER RECEIVED" class="btn btn-block btn-success orderRceceivedBtn">
                                        <i class="fa fa-send"></i> ORDER RECEIVED
                                    </button>
                                @elseif ($order->status == 'ORDER RECEIVED')
                                    <button type="button" id="frameRceceivedBtn" data-id="{{ $order->id }}"
                                        data-value="FRAME RECEIVED" class="btn btn-block btn-success frameRceceivedBtn">
                                        <i class="fa fa-send"></i> FRAME RECEIVED
                                    </button>
                                @elseif ($order->status == 'FRAME RECEIVED')
                                    <button type="button" id="glazingBtn" data-id="{{ $order->id }}"
                                        data-value="GLAZING" class="btn btn-block btn-success glazingBtn">
                                        <i class="fa fa-send"></i> GLAZING
                                    </button>
                                @elseif ($order->status == 'GLAZING')
                                    <button type="button" id="glazingBtn" data-id="{{ $order->id }}"
                                        data-value="GLAZING" class="btn btn-block btn-success glazingBtn">
                                        <i class="fa fa-send"></i> GLAZING
                                    </button>
                                @elseif ($order->status == 'GLAZED')
                                    <button type="button" id="sendToClinicBtn" data-id="{{ $order->id }}"
                                        data-value="SEND TO CLINIC" class="btn btn-block btn-success sendToClinicBtn">
                                        <i class="fa fa-send"></i> SEND TO CLINIC
                                    </button>
                                @endif
                            </div>
                        </div>

                    </div>
                    <!--.card-footer -->
                </div>
                <!--.card card-outline card-primary -->
            </div>
            <!--.col-md-6 -->

            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Order For Patient
                        </h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item active">
                                <a href="#" class="nav-link">
                                    <i class="fa fa-user"></i> {{ $order->patient->first_name }}
                                    {{ $order->patient->last_name }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fa fa-phone"></i> {{ $order->patient->phone }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fa fa-envelope"></i> {{ $order->patient->email }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fa fa-calendar"></i> {{ $order->patient->dob }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fa fa-male"></i> {{ $order->patient->gender }}
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fa fa-map-signs"></i> {{ $order->patient->address }}
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!--.card-body p-0 -->
                </div>
                <!--.card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Doctor/ Optimist</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fa fa-user text-danger"></i>
                                    {{ $order->doctor_schedule->user->first_name }}
                                    {{ $order->doctor_schedule->user->last_name }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fa fa-phone text-warning"></i> {{ $order->doctor_schedule->user->phone }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fa fa-envelope text-primary"></i>
                                    {{ $order->doctor_schedule->user->email }}
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!--.card -->
            </div>
            <!--.col-md-3 -->

        </div>
        <!-- /.row -->

        <div class="modal fade" id="trackOrderModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            Track Order
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Doctor</th>
                                    <th>Status</th>
                                    <th>Workshop</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($order->order_track as $track)
                                    <tr>
                                        <td>
                                            {{ date('d-m-Y', strtotime($track->track_date)) }}
                                        </td>
                                        <td>
                                            {{ $track->user->first_name }} {{ $track->user->last_name }}
                                        </td>
                                        <td>
                                            {{ $track->track_status }}
                                        </td>
                                        <td>
                                            {{ $track->workshop->name }}
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <div class="modal fade" id="salesModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            Glazing
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="salesForm" method="POST">
                        <div class="modal-body table-responsive">
                            <div class="row">
                                <div class="col-md-12">
                                    @csrf
                                    <input type="hidden" name="order_id" id="salesOrderId" class="form-control">
                                    <input type="hidden" name="" id="" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="salesLens">Lens</label>
                                        <select id="salesLens" name="lens_id"
                                            class="form-control select2 select2-primary"
                                            data-dropdown-css-class="select2-primary" style="width: 100%;">
                                            <option disabled="disabled" selected="selected">
                                                Choose Lens To Use in this order
                                            </option>
                                            @forelse ($lenses as $lens)
                                                <option value="{{ $lens->id }}">{{ $lens->code }} :
                                                    {{ $lens->power }} : {{ $lens->lens_type->type }} :
                                                    {{ $lens->lens_material->title }} : {{ $lens->lens_index }} :
                                                    {{ $lens->eye }}
                                                </option>
                                            @empty
                                                <option disabled="disabled">NOT TRANSFERED</option>
                                            @endforelse


                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="salesStatus">Job Status</label>
                                        <select id="salesLens" name="status"
                                            class="form-control select2 select2-primary"
                                            data-dropdown-css-class="select2-primary" style="width: 100%;">
                                            <option disabled="disabled" selected="selected">
                                                Select Status
                                            </option>
                                            <option value="GLAZING">GLAZING</option>
                                            <option value="GLAZED">GLAZED</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="submit" id="salesSubmitBtn" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                Close
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
    <!-- /.content -->
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', '#trackOrderBtn', function(e) {
                e.preventDefault();
                $('#trackOrderModal').modal('show');
            });

            $(document).on('click', '.orderRceceivedBtn', function(e) {
                e.preventDefault();
                var order_id = $(this).data('id');
                var token = '{{ csrf_token() }}';
                var status = $(this).data('value');
                var path = '{{ route('technicians.orders.update', ':id') }}';
                path = path.replace(':id', order_id);
                Swal.fire({
                    title: "Are you sure?",
                    text: "Order has been received from clinic!",
                    icon: "success",
                    buttons: true,
                    dangerMode: true,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $.ajax({
                            url: path,
                            type: 'POST',
                            data: {
                                order_id: order_id,
                                status: status,
                                _token: token
                            },
                            dataType: "json",
                            beforeSend: function() {
                                $('#orderRceceivedBtn').html(
                                    '<i class="fa fa-spinner fa-spin"></i>'
                                );
                                $('#orderRceceivedBtn').attr('disabled', true);
                            },
                            complete: function() {
                                $('#orderRceceivedBtn').html(
                                    'ORDER RECEIVED'
                                );
                                $('#orderRceceivedBtn').attr('disabled', false);
                            },
                            success: function(data) {
                                if (data['status']) {
                                    toastr.success(data['message']);
                                    setTimeout(() => {
                                        window.location.reload();
                                    }, 1000);
                                }
                            },

                        });
                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info');
                    }
                });
            });

            $(document).on('click', '.frameRceceivedBtn', function(e) {
                e.preventDefault();
                var order_id = $(this).data('id');
                var token = '{{ csrf_token() }}';
                var status = $(this).data('value');
                var path = '{{ route('technicians.orders.update', ':id') }}';
                path = path.replace(':id', order_id);
                Swal.fire({
                    title: "Are you sure?",
                    text: "Frame has been received from clinic!",
                    icon: "success",
                    buttons: true,
                    dangerMode: true,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $.ajax({
                            url: path,
                            type: 'POST',
                            data: {
                                order_id: order_id,
                                status: status,
                                _token: token
                            },
                            dataType: "json",
                            beforeSend: function() {
                                $('#frameRceceivedBtn').html(
                                    '<i class="fa fa-spinner fa-spin"></i>'
                                );
                                $('#frameRceceivedBtn').attr('disabled', true);
                            },
                            complete: function() {
                                $('#frameRceceivedBtn').html(
                                    'FRAME RECEIVED'
                                );
                                $('#frameRceceivedBtn').attr('disabled', false);
                            },
                            success: function(data) {
                                if (data['status']) {
                                    toastr.success(data['message']);
                                    setTimeout(() => {
                                        window.location.reload();
                                    }, 1000);
                                }
                            },

                        });
                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info');
                    }
                });
            });

            $(document).on('click', '.glazingBtn', function(e) {
                e.preventDefault();
                let order_id = $(this).data('id');
                let token = '{{ csrf_token() }}';
                let path = '{{ route('technicians.orders.show', ':id') }}';
                path = path.replace(':id', order_id);
                $.ajax({
                    type: "POST",
                    url: path,
                    data: {
                        _token: token
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data['status']) {
                            $('#salesModal').modal('show');
                            $('#salesOrderId').val(data['data']['id']);
                        }
                    }
                });

            });

            $('#salesForm').submit(function(e) {
                e.preventDefault();
                let form = $(this);
                var formData = new FormData(form[0]);
                var path = '{{ route('technicians.sales.store') }}';
                $.ajax({
                    url: path,
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    beforeSend: function() {
                        $('#salesSubmitBtn').html(
                            '<i class="fa fa-spinner fa-spin"></i>'
                        );
                        $('#salesSubmitBtn').attr('disabled', true);
                    },
                    complete: function() {
                        $('#salesSubmitBtn').html('Save');
                        $('#salesSubmitBtn').attr('disabled', false);
                    },
                    success: function(data) {
                        if (data['status']) {
                            toastr.success(data['message']);
                            $('#salesForm')[0].reset();
                            $('#salesModal').modal('hide');
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        }
                    },
                    error: function(data) {
                        var errors = data.responseJSON;
                        var errorsHtml = '<ul>';
                        $.each(errors['errors'], function(key, value) {
                            errorsHtml += '<li>' + value + '</li>';
                        });
                        errorsHtml += '</ul>';
                        toastr.error(errorsHtml);
                    }
                });
            });

            $(document).on('click', '.sendToClinicBtn', function(e) {
                e.preventDefault();
                var order_id = $(this).data('id');
                var token = '{{ csrf_token() }}';
                var status = $(this).data('value');
                var path = '{{ route('technicians.orders.update', ':id') }}';
                path = path.replace(':id', order_id);
                Swal.fire({
                    title: "Are you sure?",
                    text: "Job To be Send Back to Clinic!",
                    icon: "success",
                    buttons: true,
                    dangerMode: true,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $.ajax({
                            url: path,
                            type: 'POST',
                            data: {
                                order_id: order_id,
                                status: status,
                                _token: token
                            },
                            dataType: "json",
                            beforeSend: function() {
                                $('#sendToClinicBtn').html(
                                    '<i class="fa fa-spinner fa-spin"></i>'
                                );
                                $('#sendToClinicBtn').attr('disabled', true);
                            },
                            complete: function() {
                                $('#sendToClinicBtn').html(
                                    'SEND TO CLINIC'
                                );
                                $('#sendToClinicBtn').attr('disabled', false);
                            },
                            success: function(data) {
                                if (data['status']) {
                                    toastr.success(data['message']);
                                    setTimeout(() => {
                                        window.location.reload();
                                    }, 1000);
                                }
                            },

                        });
                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info');
                    }
                });
            });
        });
    </script>
@endsection