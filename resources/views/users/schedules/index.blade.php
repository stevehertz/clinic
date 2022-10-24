@extends('users.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Doctor Schedules</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('users.dashboard.index') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Schedules</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <table id="schedulesData" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Patient</th>
                                        <th>Day</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Doctor</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div><!-- /.card-body -->
                    </div><!-- /.card -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section><!-- /.content -->
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            find_doctor_schedules();
            function find_doctor_schedules() {
                var path = '{{ route('users.doctor.schedules.index') }}';
                $('#schedulesData').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: path,
                    columns: [{
                            data: 'patient_name',
                            name: 'patient_name'
                        },
                        {
                            data: 'day',
                            name: 'day'
                        },
                        {
                            data: 'date',
                            name: 'date'
                        },
                        {
                            data: 'time',
                            name: 'time'
                        },
                        {
                            data: 'dr_name',
                            name: 'dr_name'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ],
                    'responsive': true,
                    'autoWidth': false,
                    'paging': true,
                });
            }

            $(document).on('click', '.viewDoctorSchedule', function(e){
                e.preventDefault();
                var schedule_id = $(this).attr('data-id');
                var path = '{{ route('users.doctor.schedules.show') }}';
                var token = '{{ csrf_token() }}';
                $.ajax({
                    url: path,
                    type: 'POST',
                    data: {
                        _token: token,
                        schedule_id: schedule_id
                    },
                    success: function(data) {
                        if(data['status']){
                            let url = '{{ route('users.doctor.schedules.view', ':id') }}';
                            schedule_url = url.replace(':id', data['data']['id']);
                            setTimeout(() => {
                                window.location.href = schedule_url;
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


        });
    </script>
@endsection
