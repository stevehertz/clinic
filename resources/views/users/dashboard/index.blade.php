@extends('users.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        {{ $clinic->clinic }}
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('users.dashboard.index') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $patients }}</h3>
                            <p>Patients</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <a href="{{ route('users.patients.index') }}" class="small-box-footer">
                            More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- ./col -->

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $num_appointments }}</h3>

                            <p>Appointments</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-check-square"></i>
                        </div>
                        <a href="{{ route('users.appointments.index') }}" class="small-box-footer">
                            More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- ./col -->

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $schedules }}</h3>

                            <p>Doctor Schedules</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <a href="{{ route('users.doctor.schedules.index') }}" class="small-box-footer">
                            More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- ./col -->

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $orders }}</h3>
                            <p>Orders</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-table"></i>
                        </div>
                        <a href="{{ route('users.orders.index') }}" class="small-box-footer">
                            More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- ./col -->

            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title">
                                Today's Appointments
                            </h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped table-valign-middle">
                                <thead>
                                    <tr>
                                        <th>Patient Names</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Client Type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($appointments as $appointment)
                                        <tr>
                                            <td>
                                                {{ $appointment->first_name }} {{ $appointment->last_name }}
                                            </td>
                                            <td>
                                                {{ $appointment->date }}
                                            </td>
                                            <td>
                                                {{ $appointment->appointment_time }}
                                            </td>
                                            <td>
                                                {{ $appointment->type }}
                                            </td>
                                            <td>
                                                @if ($appointment->status == 0)
                                                    <a href="#" id="{{ $appointment->id }}"
                                                        data-clinic="{{ $appointment->clinic_id }}"
                                                        data-patient="{{ $appointment->patient_id }}"
                                                        class="btn btn-tool btn-sm scheduleAppointment">
                                                        <i class="fa fa-calendar"></i> Schedule
                                                    </a>
                                                @else
                                                    <span class="badge badge-success">Scheduled</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('users.appointments.view', $appointment->id) }}"
                                                    class="btn btn-tool btn-sm">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>

                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">
                                                No Appointments added yet
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->

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
                                        <option value="{{ $doctor->id }}">
                                            {{ $doctor->first_name }} {{ $doctor->last_name }}
                                        </option>
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

    </div>
    <!-- /.content -->
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            $(document).on('click', '.scheduleAppointment', function(e) {
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
                            let url = '{{ route('users.doctor.schedules.view', ':id') }}';
                            url = url.replace(':id', data['schedule_id']);
                            setTimeout(() => {
                                window.location.href = url;
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
@endsection
