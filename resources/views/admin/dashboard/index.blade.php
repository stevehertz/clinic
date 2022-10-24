@extends('admin.layouts.temp')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ $clinic->clinic }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard.index', $clinic->id) }}">Home</a>
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
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Payments</h3>
                                <a href="{{ route('admin.payments.bills.index', $clinic->id) }}">View Report</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <p class="d-flex flex-column">
                                    <span class="text-bold text-lg">KSHS {{  number_format($payments,2) }}</span>
                                    <span>Total Payments made Over Time</span>
                                </p>
                            </div>
                            <!-- /.d-flex -->

                            <div class="position-relative mb-4">
                                <canvas id="sales-chart" height="200"></canvas>
                            </div>

                            <div class="d-flex flex-row justify-content-end">
                                <span class="mr-2">
                                    <i class="fa fa-square text-primary"></i> This year
                                </span>

                                <span>
                                    <i class="fa fa-square text-gray"></i> Last year
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col-md-6 -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Remittance</h3>
                                <a href="javascript:void(0);">View Report</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <p class="d-flex flex-column">
                                    <span class="text-bold text-lg">KSH {{ number_format($remittances,2) }}</span>
                                    <span>Total Claimed Remittance</span>
                                </p>
                            </div>
                            <!-- /.d-flex -->

                            <div class="position-relative mb-4">
                                <canvas id="visitors-chart" height="200"></canvas>
                            </div>

                            <div class="d-flex flex-row justify-content-end">
                                <span class="mr-2">
                                    <i class="fa fa-square text-primary"></i> This Week
                                </span>

                                <span>
                                    <i class="fa fa-square text-gray"></i> Last Week
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title">Appointments</h3>
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
                                                    <span class="badge badge-danger">Not Scheduled</span>
                                                @else
                                                    <span class="badge badge-success">Scheduled</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="#" data-id="{{ $appointment->id }}" class="btn btn-tool btn-sm viewAppointmentBtn">
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
            </div>
            <!--/.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

@section('scripts')
    <script src="{{ asset('js/pages/dashboard3.js') }}"></script>
    <script>
        $(document).ready(function() {

            $(document).on('click', '.viewAppointmentBtn', function(e){
                e.preventDefault();
                var appointment_id = $(this).data('id');
                var token = '{{ csrf_token() }}';
                var path = '{{ route('admin.appointments.show') }}';
                $.ajax({
                    url: path,
                    type: 'POST',
                    data: {
                        appointment_id: appointment_id,
                        _token: token
                    },
                    dataType: 'json',
                    success: function(data) {
                        if(data['status']){
                            let url = '{{ route('admin.appointments.view', $clinic->id) }}';
                            setTimeout(() => {
                                window.location.href = url;
                            }, 1000);
                        }
                    },
                    error:function(data){
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
