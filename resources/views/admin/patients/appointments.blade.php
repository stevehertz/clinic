@extends('admin.layouts.temp')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $patient->first_name }} {{ $patient->last_name }} Profile</h1>
                    <small>Added By: {{ $patient->user->first_name }} {{ $patient->user->last_name }}</small><br>
                    <small>Clinic: {{ $clinic->clinic }}</small>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard.index', $clinic->id) }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.patients.index', $clinic->id) }}">Patients</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Appointments
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
                @include('admin.includes.patients.sidebar')
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-info  card-outline">
                                <div class="card-body">
                                    <div class="table-responsive">
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
                                                            {{ date('d, F, Y', strtotime($appointment->date)) }}
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
                                                        <td colspan="5">
                                                            <p class="text-center">
                                                                No Appointments
                                                            </p>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    <!--/.table-responsive -->

                                </div>
                                <!--/.card-body -->
                            </div>
                            <!--/.card -->
                        </div>
                        <!--/.col -->
                    </div>
                    <!--/.row -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

        });
    </script>
@endpush
