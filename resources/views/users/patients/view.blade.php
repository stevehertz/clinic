@extends('users.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $patient->first_name }} {{ $patient->last_name }} Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('users.dashboard.index') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('users.patients.index') }}">Patients</a>
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

                            <strong><i class="fa fa-edit mr-1"></i> ID Number</strong>

                            <p class="text-muted">
                                {{ $patient->id_number }}
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
                                                        <th>Status</th>
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
                                                            @if($appointment->payment_detail)

                                                            @else

                                                            @endif
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
                                                            <td>
                                                                @if ($appointment->status == 0)
                                                                    <a href="#" id="{{ $appointment->id }}"
                                                                        data-clinic="{{ $appointment->clinic_id }}"
                                                                        data-patient="{{ $appointment->patient_id }}"
                                                                        class="btn btn-info btn-sm scheduleAppointment">
                                                                        Schedule Appointment
                                                                    </a>
                                                                @else
                                                                    <span class="badge badge-success">
                                                                        Scheduled
                                                                    </span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="8">
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
                                                            {{ $schedule->date }}
                                                        </td>
                                                        <td>
                                                            {{ date('h:i A', strtotime($schedule->time)) }}
                                                        </td>
                                                        <td>
                                                            @if (Auth::user()->id == $schedule->user_id)
                                                                <a href="#" data-id="{{ $schedule->id }}"
                                                                    class="btn btn-success viewScheduleBtn">
                                                                    <i class="fa fa-eye"></i> View
                                                                </a>
                                                            @else
                                                                SCHEDULED
                                                            @endif
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
        <div class="modal fade" id="scheduleAppointmentModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Schedule Appointment</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="scheduleAppointmentForm">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" id="scheduleAppointmentClinicId" name="clinic_id"
                                    class="form-control" />
                            </div>
                            <div class="form-group">
                                <input type="hidden" id="scheduleAppointmentPatientId" name="patient_id"
                                    class="form-control" />
                            </div>
                            <div class="form-group">
                                <input type="hidden" id="scheduleAppointmentAppointmentId" name="appointment_id"
                                    class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="scheduleAppointmentUserId">
                                    Doctor / Optometrist
                                </label>
                                <select id="scheduleAppointmentUserId" name="user_id" class="form-control select2"
                                    style="width: 100%;">
                                    <option selected="selected" disabled="disabled">Choose a Doctor / Optometrist</option>
                                    @forelse ($doctors as $doctor)
                                        <option value="{{ $doctor->id }}">{{ $doctor->first_name }}
                                            {{ $doctor->last_name }}</option>
                                    @empty
                                        <option selected="selected" disabled="disabled">
                                            No Doctors / Optometrists
                                        </option>
                                    @endforelse
                                </select>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" id="scheduleAppointmentSubmitBtn" class="btn btn-primary">
                                Schedule
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
            $('.scheduleAppointment').click(function(e) {
                e.preventDefault();
                $('#scheduleAppointmentClinicId').val($(this).data('clinic'));
                $('#scheduleAppointmentPatientId').val($(this).data('patient'));
                $('#scheduleAppointmentAppointmentId').val($(this).attr('id'));
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

            $(document).on('click', '.viewScheduleBtn', function(e) {
                e.preventDefault();
                var schedule_id = $(this).data('id');
                var path = '{{ route('users.doctor.schedules.show') }}';
                var token = '{{ csrf_token() }}';
                $.ajax({
                    url: path,
                    type: 'POST',
                    data: {
                        schedule_id: schedule_id,
                        _token: token
                    },
                    dataType: 'json',
                    success: function(data) {
                        let url = '{{ route('users.doctor.schedules.view', ':id') }}';
                        url = url.replace(':id', data['data']['id']);
                        setTimeout(() => {
                            window.location.href = url;
                        }, 1000);
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
@endsection
