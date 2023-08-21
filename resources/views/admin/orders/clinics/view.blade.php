@extends('admin.layouts.temp')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>View Order</h1>
                    <small>{{ $clinic->clinic }}</small>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard.index', $clinic->id) }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.patients.orders', [$clinic->id, $order->patient->id]) }}">
                                Patient Profile
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.orders.index', $clinic->id) }}">Orders</a>
                        </li>
                        <li class="breadcrumb-item active">View Order</li>
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
                            Workshop Sent To
                        </h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body table-responsive">
                        <p>
                            {{ $order->workshop->name }}
                        </p>
                        <p>
                            {{ $order->workshop->phone }}
                        </p>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div><!-- /.col -->

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
                                    {{ date('d, F, Y', strtotime($order->order_date)) }}
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

                                <hr>

                                <strong><i class="fa  fa-map-signs mr-1"></i> Workshop</strong>

                                <p class="text-muted">{{ $order->workshop->name }}</p>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-12">
                                <button id="trackOrderBtn" class="btn btn-secondary btn-block">Track Order</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.nav-tabs-custom -->
            </div><!-- /.col -->

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
                                    <i class="fa fa-calendar"></i> {{ date('d, F, Y', strtotime($order->patient->dob)) }}
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
                <!-- /.card -->

            </div><!-- /.col -->
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

                    <div class="modal-body table-responsive p-0">
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
                                            {{ date('d, F, Y', strtotime($track->track_date)) }}
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

@section('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', '#trackOrderBtn', function(e) {
                e.preventDefault();
                $('#trackOrderModal').modal('show');
            });
        });
    </script>
@endsection
