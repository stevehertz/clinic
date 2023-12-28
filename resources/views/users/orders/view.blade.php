@extends('users.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $clinic->clinic  }}</h1>
                    <small>
                        Order Date: {{ date('d-m-Y', strtotime($order->order_date)) }}
                    </small>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('users.dashboard.index') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('users.orders.index') }}">
                                @lang('users.page.orders.title')
                            </a>
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
                <!-- /.card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Workshop
                        </h3>

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
                                    <i class="fa fa-industry"></i>
                                    {{ $order->workshop->name }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fa fa-phone text-warning"></i> {{ $order->workshop->phone }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fa fa-envelope text-primary"></i>
                                    {{ $order->workshop->email }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /.col -->

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
                        </ul>
                    </div><!-- /.card-header -->
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
                            <!-- /.tab-pane -->

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
                            </div>

                            <div class="tab-pane" id="framePrescriptionTab">
                                <strong><i class="fa fa-archive mr-1"></i> Frame Code</strong>

                                <p class="text-muted">
                                    {{ $order->frame_prescription->frame_code }}
                                </p>

                                <hr>

                                <strong><i class="fa fa-user mr-1"></i> Gender</strong>

                                <p class="text-muted">{{ $order->frame_prescription->frame_stock->gender }}</p>

                                <hr>

                                <strong><i class="fa  fa-industry mr-1"></i> Shape</strong>

                                <p class="text-muted">{{ $order->frame_prescription->frame_stock->frame_shape->shape }}</p>

                                <hr>

                                <strong><i class="fa fa-creative-commons mr-1"></i> Color</strong>

                                <p class="text-muted">{{ $order->frame_prescription->frame_stock->frame_color->color }}</p>

                            </div>
                            <!-- /.tab-pane -->

                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6">
                                @if ($order->status == 'APPROVED')
                                    <button type="button" id="sendOrderToWorkshopBtn" data-id="{{ $order->id }}"
                                        data-value="SENT TO WORKSHOP"
                                        class="btn btn-block btn-success orderSentToWorkshopBtn">
                                        <i class="fa fa-send"></i> ORDER SENT TO WORKSHOP
                                    </button>
                                @elseif($order->status == 'SENT TO WORKSHOP')
                                    <button type="button" data-id="{{ $order->id }}"
                                        data-value="FRAME SENT TO WORKSHOP" id="sendFrameSentToWorkshopBtn"
                                        class="btn btn-block btn-primary orderfRAMESentToWorkshopBtn">
                                        <i class="fa fa-send"></i> FRAME SENT TO WORKSHOP
                                    </button>
                                @elseif($order->status == 'SEND TO CLINIC')
                                    <button type="button" data-id="{{ $order->id }}"
                                        data-value="RECEIVED FROM WORKSHOP" id="receivedFromWorkshopBtn"
                                        class="btn btn-block btn-primary receivedFromWorkshopBtn">
                                        <i class="fa fa-send"></i> RECEIVED FROM WORKSHOP
                                    </button>
                                @elseif($order->status == 'RECEIVED FROM WORKSHOP')
                                    <button type="button" data-id="{{ $order->id }}" data-value="CALL FOR COLLECTION"
                                        id="callForCollectionBtn" class="btn btn-block btn-primary callForCollectionBtn">
                                        <i class="fa fa-send"></i> CALL FOR COLLECTION
                                    </button>
                                @elseif($order->status == 'CALL FOR COLLECTION')
                                    <button type="button" data-id="{{ $order->id }}" data-value="FRAME COLLECTED"
                                        id="frameCollectedBtn" class="btn btn-block btn-primary frameCollectedBtn">
                                        <i class="fa fa-send"></i> FRAME COLLECTED
                                    </button>
                                @elseif($order->status == 'FRAME COLLECTED')
                                    <button type="button" data-id="{{ $order->id }}" data-value="CLOSED"
                                        id="closedBtn" class="btn btn-block btn-success closedBtn">
                                        <i class="fa fa-send"></i> CLOSED
                                    </button>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <button id="trackOrderBtn" class="btn btn-secondary btn-block">Track Order</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->

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
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Doctor/ Optimetrist</h3>

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
                <!-- /.card -->

            </div>
            <!-- /.col -->
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
                                    <th>TAT</th>
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
                                        <td>
                                            {{ $track->tat }}
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
    </section>
    <!-- /.content -->
@endsection

@push('scripts')
<script>
    $(document).ready(function() {

        $(document).on('click', '.orderSentToWorkshopBtn', function(e) {
            e.preventDefault();
            var order_id = $(this).data('id');
            var token = '{{ csrf_token() }}';
            var status = $(this).data('value');
            var path = '{{ route('users.orders.update', $order->id) }}';

            Swal.fire({
                title: "Are you sure?",
                text: "You are about to move order to workshop!",
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
                            $('#sendOrderToWorkshopBtn').html(
                                '<i class="fa fa-spinner fa-spin"></i>'
                            );
                            $('#sendOrderToWorkshopBtn').attr('disabled', true);
                        },
                        complete: function() {
                            $('#sendOrderToWorkshopBtn').html(
                                'ORDER SENT TO WORKSHOP'
                            );
                            $('#sendOrderToWorkshopBtn').attr('disabled', false);
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

        $(document).on('click', '.orderfRAMESentToWorkshopBtn', function(e) {
            e.preventDefault();
            var order_id = $(this).data('id');
            var token = '{{ csrf_token() }}';
            var status = $(this).data('value');
            var path = '{{ route('users.orders.update', $order->id) }}';

            Swal.fire({
                title: "Are you sure?",
                text: "You are about to move frame to workshop!",
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
                            $('#sendFrameSentToWorkshopBtn').html(
                                '<i class="fa fa-spinner fa-spin"></i>'
                            );
                            $('#sendFrameSentToWorkshopBtn').attr('disabled', true);
                        },
                        complete: function() {
                            $('#sendFrameSentToWorkshopBtn').html(
                                'FRAME SENT TO WORKSHOP'
                            );
                            $('#sendFrameSentToWorkshopBtn').attr('disabled',
                                false);
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

        $(document).on('click', '.receivedFromWorkshopBtn', function(e) {
            e.preventDefault();
            var order_id = $(this).data('id');
            var token = '{{ csrf_token() }}';
            var status = $(this).data('value');
            var path = '{{ route('users.orders.update', $order->id) }}';

            Swal.fire({
                title: "Are you sure?",
                text: "You have received the order and frame from workshop!",
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
                            $('#receivedFromWorkshopBtn').html(
                                '<i class="fa fa-spinner fa-spin"></i>'
                            );
                            $('#receivedFromWorkshopBtn').attr('disabled', true);
                        },
                        complete: function() {
                            $('#receivedFromWorkshopBtn').html(
                                'RECEIVED FROM WORKSHOP'
                            );
                            $('#receivedFromWorkshopBtn').attr('disabled',
                                false);
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

        $(document).on('click', '.callForCollectionBtn', function(e) {
            e.preventDefault();
            var order_id = $(this).data('id');
            var token = '{{ csrf_token() }}';
            var status = $(this).data('value');
            var path = '{{ route('users.orders.update', $order->id) }}';

            Swal.fire({
                title: "Are you sure?",
                text: "You want to call the patient to collect the order!",
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
                            $('#callForCollectionBtn').html(
                                '<i class="fa fa-spinner fa-spin"></i>'
                            );
                            $('#callForCollectionBtn').attr('disabled', true);
                        },
                        complete: function() {
                            $('#callForCollectionBtn').html(
                                'CALL FOR COLLECTION'
                            );
                            $('#callForCollectionBtn').attr('disabled',
                                false);
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

        $(document).on('click', '.frameCollectedBtn', function(e) {
            e.preventDefault();
            var order_id = $(this).data('id');
            var token = '{{ csrf_token() }}';
            var status = $(this).data('value');
            var path = '{{ route('users.orders.update', $order->id) }}';

            Swal.fire({
                title: "Are you sure?",
                text: "Frame has already been collected!",
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
                            $('#frameCollectedBtn').html(
                                '<i class="fa fa-spinner fa-spin"></i>'
                            );
                            $('#frameCollectedBtn').attr('disabled', true);
                        },
                        complete: function() {
                            $('#frameCollectedBtn').html(
                                'CALL FOR COLLECTION'
                            );
                            $('#frameCollectedBtn').attr('disabled',
                                false);
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

        $(document).on('click', '.closedBtn', function(e) {
            e.preventDefault();
            var order_id = $(this).data('id');
            var token = '{{ csrf_token() }}';
            var status = $(this).data('value');
            var path = '{{ route('users.orders.update', $order->id) }}';

            Swal.fire({
                title: "Are you sure?",
                text: "You want to close this order",
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
                            $('#closedBtn').html(
                                '<i class="fa fa-spinner fa-spin"></i>'
                            );
                            $('#closedBtn').attr('disabled', true);
                        },
                        complete: function() {
                            $('#closedBtn').html(
                                'CLOSED'
                            );
                            $('#closedBtn').attr('disabled',
                                false);
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

        $(document).on('click', '#trackOrderBtn', function(e) {
            e.preventDefault();
            $('#trackOrderModal').modal('show');
        });
    });
</script>
@endpush
