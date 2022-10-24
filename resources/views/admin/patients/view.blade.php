@extends('admin.layouts.temp')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $patient->first_name }} {{ $patient->last_name }} Profile</h1>
                    <small>Added By: {{ $patient->user->first_name }} {{ $patient->user->last_name }}</small><br>
                    <small>{{ $clinic->clinic }}</small>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard.index', $clinic->id) }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.patients.index', $clinic->id) }}">Patients</a>
                        </li>
                        <li class="breadcrumb-item active">Patient Profile</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-body">
                            <strong><i class="fa fa-user mr-1"></i> Full Names</strong>

                            <p class="text-muted">
                                {{ $patient->first_name }} {{ $patient->last_name }}
                            </p>

                            <hr>

                            <strong><i class="fa fa-phone mr-1"></i> Telephone Number</strong>

                            <p class="text-muted">
                                {{ $patient->phone }}
                            </p>

                            <hr>

                            <strong><i class="fa fa-envelope mr-1"></i> Email Address</strong>

                            <p class="text-muted">
                                {{ $patient->email }}
                            </p>

                            <hr>

                            <strong><i class="fa fa-calendar mr-1"></i> Date of Birth</strong>

                            <p class="text-muted">
                                {{ $patient->dob }}
                            </p>

                            <hr>

                            <strong><i class="fa fa-user-secret mr-1"></i> Gender</strong>

                            <p class="text-muted">
                                {{ $patient->gender }}
                            </p>

                            <hr>

                            <strong><i class="fa fa-map-signs mr-1"></i> Address</strong>

                            <p class="text-muted">
                                {{ $patient->address }}
                            </p>


                            <hr>

                            <strong><i class="fa fa-user-plus mr-1"></i> Next of Kin</strong>

                            <p class="text-muted">
                                {{ $patient->next_of_kin }}
                            </p>

                            <hr>

                            <strong><i class="fa fa-phone mr-1"></i> Next of Kin Contacts</strong>

                            <p class="text-muted">{{ $patient->next_of_kin_contact }}</p>

                            <hr>

                            <strong><i class="fa fa-plus-circle mr-1"></i> Added By</strong>

                            <p class="text-muted">
                                {{ $patient->user->first_name }} {{ $patient->user->last_name }}
                            </p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#appointmentsTab" data-toggle="tab">
                                        Appointments
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#doctorScheduleTab" data-toggle="tab">
                                        Previous Schedules
                                    </a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="appointmentsTab">
                                    <div class="row">
                                        <div class="col-md-12 table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Time</th>
                                                        <th>Client Type</th>
                                                        <th>Insurance</th>
                                                        <th>Scheme Name</th>
                                                        <th>Insurance No.</th>
                                                        <th>Workplace</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($appointments as $appointment)
                                                        <tr>
                                                            <td>
                                                                {{ $appointment->date }}
                                                            </td>
                                                            <td>
                                                                {{ date('h:i A', strtotime($appointment->appointment_time)) }}
                                                            </td>
                                                            <td>
                                                                {{ $appointment->payment_detail->client_type->type }}
                                                            </td>

                                                            <td>
                                                                @if ($appointment->payment_detail->insurance)
                                                                    {{ $appointment->payment_detail->insurance->title }}
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($appointment->payment_detail->insurance)
                                                                    {{ $appointment->payment_detail->scheme }}
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($appointment->payment_detail->insurance)
                                                                    {{ $appointment->payment_detail->card_number }}
                                                                @endif
                                                            </td>

                                                            <td>
                                                                {{ $appointment->payment_detail->principal_workplace }}
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="4">
                                                                <p class="text-center">
                                                                    No Appointments
                                                                </p>
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="doctorScheduleTab">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Doctor</th>
                                                    <th>Schedule Day</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($schedules as $schedule)
                                                    <tr>
                                                        <td>
                                                            {{ $schedule->user->first_name }}
                                                            {{ $schedule->user->last_name }}
                                                        </td>
                                                        <td>
                                                            {{ $schedule->day }}
                                                        </td>
                                                        <td>
                                                            {{ date('d-M-Y', strtotime($schedule->date))}}
                                                        </td>
                                                        <td>
                                                            {{ date('h:i A', strtotime($schedule->time)) }}
                                                        </td>
                                                        <td>
                                                            <a href="#" data-id="{{ $schedule->id }}"
                                                                class="btn btn-success viewScheduleBtn">
                                                                <i class="fa fa-eye"></i> View
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="5">
                                                            <p class="text-center">
                                                                No Schedules
                                                            </p>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->

                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {});
    </script>
@endsection
