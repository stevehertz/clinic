@extends('users.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $clinic->clinic }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('users.dashboard.index') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('users.appointments.index') }}">
                                Appointments
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Appointment Details
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
                <div class="col-md-3">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Patient Details</h3>
                        </div>
                        <div class="card-body">

                            <strong><i class="fas fa-user mr-1"></i> Full Names</strong>

                            <p class="text-muted">
                                {{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }}
                            </p>

                            <hr>

                            <strong><i class="fas fa-phone-square-alt mr-1"></i> Phone Number</strong>

                            <p class="text-muted">
                                {{ $appointment->patient->phone }}
                            </p>

                            <hr>

                            <strong><i class="fas fa-envelope-open-text mr-1"></i> Email Address</strong>

                            <p class="text-muted">
                                {{ $appointment->patient->email }}
                            </p>

                            <hr>

                            <strong><i class="fas fa-calendar-alt mr-1"></i> Date of Birth</strong>

                            <p class="text-muted">
                                {{ $appointment->patient->dob }}
                            </p>

                            <hr>

                            <strong><i class=" fas fa-user-cog mr-1"></i> Gender</strong>

                            <p class="text-muted">
                                {{ $appointment->patient->gender }}
                            </p>

                            <hr>

                            <strong><i class="far fa-address-card mr-1"></i> Address</strong>

                            <p class="text-muted">
                                {{ $appointment->patient->address }}
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
                                    <a class="nav-link active" href="#activity" data-toggle="tab">
                                        Doctor Schedule
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#timeline" data-toggle="tab">
                                        Payment Details
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    @if ($appointment->doctor_schedule)
                                        <div class="callout callout-info">
                                            <h5>
                                                <i class="fa fa-fighter-jet mr-1"></i> Scheduled Day
                                            </h5>

                                            <p>
                                                {{ $appointment->doctor_schedule->day }}
                                            </p>
                                        </div>
                                        <hr>
                                        <div class="callout callout-info">
                                            <h5>
                                                <i class="fa fa-calendar mr-1"></i> Scheduled Dates
                                            </h5>

                                            <p>
                                                {{ $appointment->doctor_schedule->date }}
                                            </p>
                                        </div>

                                        <hr>
                                        <div class="callout callout-info">
                                            <h5>
                                                <i class="fa fa-clock-o mr-1"></i> Scheduled Time
                                            </h5>

                                            <p>
                                                {{ $appointment->doctor_schedule->time }}
                                            </p>
                                        </div>

                                        <hr>
                                        <div class="callout callout-info">
                                            <h5>
                                                <i class="fa fa-user mr-1"></i> Doctor/ Optimetrist
                                            </h5>

                                            <p>
                                                {{ $appointment->doctor_schedule->user->first_name }}
                                                {{ $appointment->doctor_schedule->user->last_name }}
                                            </p>
                                        </div>

                                        @if (Auth::user()->id == $appointment->doctor_schedule->user_id)
                                            <hr>
                                            <a href="{{ route('users.doctor.schedules.view', $appointment->doctor_schedule->id) }}"
                                                class="btn btn-default btn-block">
                                                View Schedule
                                            </a>
                                        @endif
                                    @else
                                        <div class="post">
                                            <p>
                                                No schedule found for this appointment.
                                            </p>

                                            <p>
                                                <a href="javascript:void(0)"
                                                    class="btn btn-block btn-sm btn-outline-primary mr-2 scheduleAppointmentBtn">
                                                    <i class="fas fa-calendar mr-1"></i> Schedule this appointment
                                                </a>
                                            </p>
                                        </div>
                                        <!-- /.post -->
                                    @endif
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="timeline">

                                    <strong><i class="fa fa-hourglass mr-1"></i> Client Type</strong>

                                    <p class="text-muted">
                                        {{ $appointment->payment_detail->client_type->type }}
                                    </p>

                                    <hr>

                                    @if ($appointment->payment_detail->insurance)
                                        <strong><i class="fa fa-building mr-1"></i> Insurance Company</strong>

                                        <p class="text-muted">
                                            {{ $appointment->payment_detail->insurance->title }}
                                        </p>

                                        <hr>

                                        <strong><i class="fa fa-building mr-1"></i> Scheme</strong>

                                        <p class="text-muted">
                                            {{ $appointment->payment_detail->insurance->title }}
                                        </p>

                                        <hr>

                                        <strong><i class="fa fa-user mr-1"></i> Principal Member</strong>

                                        <p class="text-muted">
                                            {{ $appointment->payment_detail->principal }}
                                        </p>

                                        <hr>
                                        <strong><i class="fa fa-phone mr-1"></i> Principal Telephone Number</strong>

                                        <p class="text-muted">
                                            {{ $appointment->payment_detail->phone }}
                                        </p>

                                        <hr>
                                        <strong><i class="fa fa-map-pin mr-1"></i> Principal Workplace</strong>

                                        <p class="text-muted">
                                            {{ $appointment->payment_detail->workplace }}
                                        </p>

                                        <hr>
                                        <strong><i class="fa fa-credit-card mr-1"></i> Insurance Card Number</strong>

                                        <p class="text-muted">
                                            {{ $appointment->payment_detail->card_number }}
                                        </p>

                                        <hr>
                                    @endif

                                    <strong><i class="fa fa-map-pin mr-1"></i> Patient Workplace</strong>

                                    <p class="text-muted">
                                        {{ $appointment->payment_detail->principal_workplace }}
                                    </p>

                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div>
                        <!-- /.card-body -->

                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@push('modals')
    @include('users.includes.modals.schedule_appointment')
@endpush


@push('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.scheduleAppointmentBtn', function(e) {
                e.preventDefault();
                $('#scheduleAppointmentClinicId').val({{ $clinic->id }});
                $('#scheduleAppointmentPatientId').val({{ $appointment->patient->id }});
                $('#scheduleAppointmentAppointmentId').val({{ $appointment->id }});
                $('#scheduleAppointmentModal').modal('show');
            });

            $('#scheduleAppointmentForm').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var form_data = new FormData(form[0]);
                var path = '{{ route('users.doctor.schedules.store') }}';
                $.ajax({
                    url: path,
                    type: 'POST',
                    data: form_data,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#scheduleAppointmentSubmitBtn').html(
                            '<i class="fa fa-spinner fa-spin"></i>');
                        $('#scheduleAppointmentSubmitBtn').attr('disabled', true);
                    },
                    complete: function() {
                        $('#scheduleAppointmentSubmitBtn').html('Schedule');
                        $('#scheduleAppointmentSubmitBtn').attr('disabled', false);
                    },
                    success: function(data) {
                        if (data['status']) {
                            toastr.success(data.message);
                            $('#scheduleAppointmentModal').modal('hide');
                            $('#scheduleAppointmentForm')[0].reset();
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        } else {
                            toastr.error(data.message);
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



        });
    </script>
@endpush
