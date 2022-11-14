@extends('users.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Schedule</h1>
                    <small>
                        {{ $schedule->day }} || {{ $schedule->date }} || {{ $schedule->time }}
                    </small>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('users.dashboard.index') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('users.doctor.schedules.index') }}">
                                Doctor Schedules
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Doctor Schedule</li>
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
                            Patient Details
                        </h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!--.card-header -->
                    <div class="card-body p-0">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item active">
                                <a href="#" class="nav-link">
                                    <i class="fa fa-user"></i> {{ $patient->first_name }} {{ $patient->last_name }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fa fa-phone"></i> {{ $patient->phone }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fa fa-envelope"></i> {{ $patient->email }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fa fa-calendar"></i> {{ $patient->dob }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fa fa-male"></i> {{ $patient->gender }}
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fa fa-map-signs"></i> {{ $patient->address }}
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!--.card -->

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
                                    {{ $doctor->first_name }} {{ $doctor->last_name }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fa fa-phone text-warning"></i> {{ $doctor->phone }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fa fa-envelope text-primary"></i>
                                    {{ $doctor->email }}
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!--.col-md-3 -->
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header p-2">
                        <ul id="myTab" class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link active" href="#diagnosisTab" data-toggle="tab">
                                    Diagnosis
                                </a>
                            </li>
                            @if ($diagnosis)
                                <li class="nav-item">
                                    <a class="nav-link" href="#treatmentTab" data-toggle="tab">
                                        Treatment
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#medicineTab" data-toggle="tab">
                                        Medicine
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#procedureTab" data-toggle="tab">
                                        Procedure
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="diagnosisTab">
                                <!-- The timeline -->
                                <div class="timeline timeline-inverse">

                                    <!-- timeline time label -->
                                    <div class="time-label">
                                        <span class="bg-primary">
                                            Patient Diagnosis
                                        </span>
                                    </div>

                                    <!-- /.timeline-label -->
                                    @if ($diagnosis)
                                        <!-- timeline item -->
                                        <div>
                                            <i class="fa fa-warning bg-primary"></i>

                                            <div class="timeline-item">
                                                <h3 class="timeline-header">
                                                    <a href="#">Patient's</a> Stated Signs
                                                </h3>

                                                <div class="timeline-body">
                                                    {!! $diagnosis->signs !!}
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END timeline item -->

                                        <!-- timeline item -->
                                        <div>
                                            <i class="fa fa-sellsy bg-warning"></i>

                                            <div class="timeline-item">

                                                <h3 class="timeline-header">
                                                    <a href="#">Patient's</a> Symptoms
                                                </h3>

                                                <div class="timeline-body">
                                                    {!! $diagnosis->symptoms !!}
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END timeline item -->

                                        <!-- timeline item -->
                                        <div>
                                            <i class="fa fa-comments bg-purple"></i>

                                            <div class="timeline-item">
                                                <h3 class="timeline-header">
                                                    <a href="#">Doctor's</a> Diagnosis
                                                </h3>

                                                <div class="timeline-body">
                                                    {!! $diagnosis->diagnosis !!}
                                                </div>

                                                <div class="timeline-footer">
                                                    <a href="#" data-id="{{ $diagnosis->id }}"
                                                        class="btn btn-secondary btn-block btn-sm editDiagnosisBtn">
                                                        <i class="fa fa-edit"></i> Edit Diagnosis
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END timeline item -->
                                    @else
                                        <!-- timeline item -->
                                        <div>
                                            <i class="fa  fa-plus-square bg-danger"></i>

                                            <div class="timeline-item">
                                                <h3 class="timeline-header">
                                                    <a href="#">Patient's</a> Diagnosis
                                                </h3>

                                                <div class="timeline-body">
                                                    Please perform this patients diagnosis first.
                                                </div>

                                                <div class="timeline-footer">
                                                    <a href="#" id="{{ $schedule->id }}"
                                                        class="btn btn-primary btn-block btn-sm addDiagnosisBtn">
                                                        <i class="fa fa-plus"></i> Perform Diagnosis
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END timeline item -->
                                    @endif

                                    <div>
                                        <i class="fa fa-clock-o bg-gray"></i>
                                    </div>
                                </div>
                                <!--.timeline .timeline-inverse -->
                            </div>
                            <!--.active .tab-pane -->

                            <div class="tab-pane" id="treatmentTab">
                                <div class="lensPowerDiv">
                                    @if ($lens_power)
                                        <!-- The timeline -->
                                        <div class="timeline timeline-inverse">
                                            <!-- timeline time label -->
                                            <div class="time-label">
                                                <span class="bg-primary">
                                                    Lens Power
                                                </span>
                                            </div>
                                            <!-- /.timeline-label -->

                                            <!-- timeline item -->
                                            <div>
                                                <i class="fa fa-eye bg-danger"></i>
                                                <div class="timeline-item">

                                                    <h3 class="timeline-header">
                                                        <a href="#">Right</a> eye
                                                    </h3>

                                                    <div class="timeline-body table-responsive">
                                                        <table class="table table-bordered">
                                                            <tbody>
                                                                <tr>
                                                                    <th>Sphere</th>
                                                                    <td>
                                                                        {{ $lens_power->right_sphere }}
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <th>Cylinder</th>
                                                                    <td>
                                                                        {{ $lens_power->right_cylinder }}
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <th>Axis</th>
                                                                    <td>
                                                                        {{ $lens_power->right_axis }}
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <th>Additional</th>
                                                                    <td>
                                                                        {{ $lens_power->right_add }}
                                                                    </td>
                                                                </tr>
                                                            </tbody>

                                                        </table>
                                                    </div>
                                                    <!--.timeline-body .table-responsive -->
                                                </div>
                                                <!--.timeline-item -->
                                            </div>

                                            <!-- timeline item -->
                                            <div>
                                                <i class="fa fa-eye bg-warning"></i>
                                                <div class="timeline-item">
                                                    <h3 class="timeline-header">
                                                        <a href="#">Left </a> Eye
                                                    </h3>
                                                    <div class="timeline-body table-responsive">

                                                        <table class="table table-bordered">
                                                            <tbody>
                                                                <tr>
                                                                    <th>Sphere</th>
                                                                    <td>
                                                                        {{ $lens_power->left_sphere }}
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <th>Cylinder</th>
                                                                    <td>
                                                                        {{ $lens_power->left_cylinder }}
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <th>Axis</th>
                                                                    <td>
                                                                        {{ $lens_power->left_axis }}
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <th>Additional</th>
                                                                    <td>
                                                                        {{ $lens_power->left_add }}
                                                                    </td>
                                                                </tr>
                                                            </tbody>

                                                        </table>

                                                    </div>
                                                    <!--.timeline-body .table-responsive -->
                                                </div>
                                                <!--.timeline-item -->
                                            </div>
                                            <!-- END timeline item -->

                                            <!-- timeline time label -->
                                            <div class="time-label">
                                                <span class="bg-success">
                                                    Additional Information
                                                </span>
                                            </div>
                                            <!-- /.timeline-label -->

                                            <!-- timeline item -->
                                            <div>
                                                <i class="fa fa-info-circle bg-purple"></i>
                                                <div class="timeline-item">

                                                    <div class="timeline-body">
                                                        {{ $lens_power->notes }}
                                                    </div>

                                                    @if (!$lens_prescription)
                                                        <div class="timeline-footer">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <a href="#" data-id="{{ $lens_power->id }}"
                                                                        class="btn btn-block btn-warning btn-flat btn-sm newLensPrescriptionBtn">
                                                                        Add Lens Prescription
                                                                    </a>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <a href="#" data-id="{{ $lens_power->id }}"
                                                                        class="btn btn-block btn-sm btn-secondary editLensPowerBtn">
                                                                        Edit Lens Power
                                                                    </a>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    @else
                                                        <div class="timeline-footer">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <a href="#"
                                                                        data-id="{{ $lens_prescription->id }}"
                                                                        class="btn btn-block btn-primary btn-flat btn-sm viewLensPrescription">
                                                                        Lens Prescription
                                                                    </a>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <a href="#" data-id="{{ $lens_power->id }}"
                                                                        class="btn btn-block btn-sm btn-secondary editLensPowerBtn">
                                                                        Edit Lens Power
                                                                    </a>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    @endif
                                                </div>
                                                <!--.timeline-item -->
                                            </div>
                                            <!-- END timeline item -->
                                            <div>
                                                <i class="fa fa-stop bg-gray"></i>
                                            </div>
                                        </div>
                                        <!--.timeline .timeline-inverse -->
                                    @else
                                        <form id="lensPowerForm">
                                            @csrf
                                            @if ($diagnosis)
                                                <input type="hidden" value="{{ $diagnosis->id }}" name="diagnosis_id">
                                            @endif
                                            <p>Right Eye</p>
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">

                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="lensPowerRightSphere">Sphere</label>
                                                                <input type="text" name="right_sphere"
                                                                    class="form-control" id="lensPowerRightSphere"
                                                                    placeholder="Sphere">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="lensPowerRightCylinder">Cylinder</label>
                                                                <input type="text" name="right_cylinder"
                                                                    class="form-control" id="lensPowerRightCylinder"
                                                                    placeholder="Cylinder">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="lensPowerRightAxis">Axis</label>
                                                                <input type="text" name="right_axis"
                                                                    class="form-control" id="lensPowerRightAxis"
                                                                    placeholder="Axis">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="lensPowerRightAdditional">Additional</label>
                                                                <input type="text" name="right_add"
                                                                    class="form-control" id="lensPowerRightAdditional"
                                                                    placeholder="Additional">
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <!--row -->
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                            <!--card-->

                                            <p>Left Eye</p>
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">

                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="lensPowerLeftSphere">Sphere</label>
                                                                <input type="text" name="left_sphere"
                                                                    class="form-control" id="lensPowerLeftSphere"
                                                                    placeholder="Sphere">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="lensPowerLeftCylinder">Cylinder</label>
                                                                <input type="text" name="left_cylinder"
                                                                    class="form-control" id="lensPowerLeftCylinder"
                                                                    placeholder="Cylinder">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="lensPowerLeftAxis">Axis</label>
                                                                <input type="text" name="left_axis"
                                                                    class="form-control" id="lensPowerLeftAxis"
                                                                    placeholder="Axis">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="lensPowerLeftAdditional">Additional</label>
                                                                <input type="text" name="left_add"
                                                                    class="form-control" id="lensPowerLeftAdditional"
                                                                    placeholder="Additional">
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <!--row -->
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                            <!--card-->

                                            <div class="form-group">
                                                <label for="lensPowerAdditionalInfo">
                                                    Additional Information
                                                </label>
                                                <textarea name="notes" id="lensPowerAdditionalInfo" class="form-control" placeholder="Additional Information"></textarea>
                                            </div>


                                            <button type="submit" id="lensPowerSubmitBtn"
                                                class="btn btn-block btn-primary">
                                                Add Power
                                            </button>

                                        </form>
                                    @endif
                                </div>
                                <!--.lensPowerDiv -->

                                <div class="lensPrescriptionDiv">
                                    @if ($lens_prescription)
                                        <!-- The timeline -->
                                        <div class="timeline timeline-inverse">

                                            <!-- timeline time label -->
                                            <div class="time-label">
                                                <span class="bg-primary">
                                                    Lens Prescription
                                                </span>
                                            </div>
                                            <!-- /.timeline-label -->

                                            <!-- timeline item -->
                                            <div>
                                                <i class="fa fa-tripadvisor bg-danger"></i>

                                                <div class="timeline-item">
                                                    <h3 class="timeline-header">
                                                        <a href="#">Lens</a> Type
                                                    </h3>

                                                    <div class="timeline-body table-responsive">
                                                        <p>
                                                            {{ $lens_prescription->lens_type->type }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END timeline item -->

                                            <!-- timeline item -->
                                            <div>
                                                <i class="fa fa-cubes bg-warning"></i>

                                                <div class="timeline-item">

                                                    <h3 class="timeline-header"><a href="#">Lens </a> Material</h3>

                                                    <div class="timeline-body table-responsive">
                                                        {{ $lens_prescription->lens_material->title }}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END timeline item -->

                                            <!-- timeline item -->
                                            <div>
                                                <i class="fa fa-th bg-purple"></i>

                                                <div class="timeline-item">

                                                    <h3 class="timeline-header"><a href="#">Lens </a>
                                                        Index/Thickness</h3>

                                                    <div class="timeline-body">
                                                        {{ $lens_prescription->index }}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END timeline item -->

                                            <!-- timeline item -->
                                            <div>
                                                <i class="fa fa-tint bg-info"></i>

                                                <div class="timeline-item">

                                                    <h3 class="timeline-header"><a href="#">Lens </a> Tint</h3>

                                                    <div class="timeline-body">
                                                        {{ $lens_prescription->tint }}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END timeline item -->

                                            <!-- timeline item -->
                                            <div>
                                                <i class="fa fa-th bg-info"></i>

                                                <div class="timeline-item">

                                                    <h3 class="timeline-header"><a href="#">Lens </a> Diameter /
                                                        Pupil</h3>

                                                    <div class="timeline-body">
                                                        {{ $lens_prescription->diameter }}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END timeline item -->

                                            <!-- timeline item -->
                                            <div>
                                                <i class="fa fa-text-height bg-danger"></i>

                                                <div class="timeline-item">

                                                    <h3 class="timeline-header"><a href="#">Lens </a> Focal Height
                                                    </h3>

                                                    <div class="timeline-body">
                                                        {{ $lens_prescription->focal_height }}
                                                    </div>

                                                    @if ($frame_prescription)
                                                        <div class="timeline-footer">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <a href="#"
                                                                        data-id="{{ $frame_prescription->id }}"
                                                                        class="btn btn-block btn-primary btn-flat btn-sm frameCodeBtn">
                                                                        Frame Code
                                                                    </a>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <a href="#"
                                                                        data-id="{{ $lens_prescription->id }}"
                                                                        class="btn btn-block btn-sm btn-secondary editPrescriptionBtn">
                                                                        Edit Prescription
                                                                    </a>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    @else
                                                        <div class="timeline-footer">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <a href="#"
                                                                        data-id="{{ $lens_prescription->id }}"
                                                                        class="btn btn-block btn-warning btn-flat btn-sm newFrameCodeBtn">
                                                                        Add Frame Code
                                                                    </a>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <a href="#" id="{{ $lens_prescription->id }}"
                                                                        class="btn btn-block btn-sm btn-secondary">
                                                                        Edit Prescription
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif

                                                </div>
                                            </div>
                                            <!-- END timeline item -->

                                            <div>
                                                <i class="fa fa-stop bg-gray"></i>
                                            </div>
                                        </div>
                                        <!--.timeline .timeline-inverse -->
                                    @else
                                        <form id="lensPrescriptionForm">
                                            @csrf
                                            <input type="hidden" name="power_id" id="lensPrescriptionPowerId"
                                                class="form-control" />
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title">Lens Prescription</h5>
                                                    <br><br>
                                                    <div class="form-group">
                                                        <label for="lensPrescriptionType">Lens Type</label>
                                                        <select id="lensPrescriptionType" name="type_id"
                                                            class="form-control select2 select2-purple"
                                                            style="width: 100%;" data-dropdown-css-class="select2-purple">
                                                            <option selected="selected" disabled="disabled">Choose Lens
                                                                Type
                                                            </option>
                                                            @forelse ($types as $type)
                                                                <option value="{{ $type->id }}">
                                                                    {{ $type->type }}
                                                                </option>
                                                            @empty
                                                                <option disabled="disabled">No Lens Type Found</option>
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                    <!-- /.form-group -->

                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="lensPrescriptionMaterial">Lens Material</label>
                                                                <select id="lensPrescriptionMaterial" name="material_id"
                                                                    class="form-control select2 select2-danger"
                                                                    style="width: 100%;"
                                                                    data-dropdown-css-class="select2-danger">
                                                                    <option selected="selected" disabled="disabled">
                                                                        Choose Lens Material
                                                                    </option>
                                                                    @forelse ($materials as $material)
                                                                        <option value="{{ $material->id }}">
                                                                            {{ $material->title }}
                                                                        </option>
                                                                    @empty
                                                                        <option disabled="disabled">
                                                                            No Lens Material Found
                                                                        </option>
                                                                    @endforelse
                                                                </select>
                                                            </div>
                                                            <!-- /.form-group -->
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="lensPrescriptionIndex">Lens
                                                                    Index/Thickness</label>
                                                                <input type="text" name="index" class="form-control"
                                                                    id="lensPrescriptionIndex"
                                                                    placeholder="Lens Index/Thickness">
                                                            </div>
                                                            <!-- /.form-group -->
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="lensPrescriptionTint">Tint</label>
                                                                <input type="text" name="tint" class="form-control"
                                                                    id="lensPrescriptionTint" placeholder="Lens Tint">
                                                            </div>
                                                            <!-- /.form-group -->
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="lensPrescriptionPupil">Pupil
                                                                    Diameter(mm)</label>
                                                                <input type="text" name="pupil" class="form-control"
                                                                    id="lensPrescriptionPupil"
                                                                    placeholder="Pupil Diameter">
                                                            </div>
                                                            <!-- /.form-group -->
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="lensPrescriptionFocalHeight">Focal
                                                                    Height</label>
                                                                <input type="text" name="focal_height"
                                                                    class="form-control" id="lensPrescriptionFocalHeight"
                                                                    placeholder="Focal Height">
                                                            </div>
                                                            <!-- /.form-group -->
                                                        </div>

                                                    </div>
                                                    <!--.row -->

                                                    <button type="submit" id="lensPrescriptionSubmitBtn"
                                                        class="btn btn-block btn-primary">
                                                        Next
                                                    </button>

                                                </div>
                                                <!--.card-body -->
                                            </div>
                                            <!--.card -->
                                        </form>
                                        <!--#lensPrescriptionForm -->
                                    @endif
                                </div>
                                <!--.lensPrescriptionDiv -->

                                <div class="frameCodesDiv">
                                    @if ($frame_prescription)
                                        <!-- The timeline -->
                                        <div class="timeline timeline-inverse">

                                            <!-- timeline time label -->
                                            <div class="time-label">
                                                <span class="bg-primary">
                                                    Frame Code
                                                </span>
                                            </div>
                                            <!-- /.timeline-label -->

                                            <!-- timeline item -->
                                            <div>
                                                <i class="fa fa-list bg-primary"></i>

                                                <div class="timeline-item">
                                                    <h3 class="timeline-header">
                                                        <a href="#">Frame</a> Code
                                                    </h3>

                                                    <div class="timeline-body table-responsive">
                                                        <p>
                                                            {{ $frame_prescription->frame_code }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END timeline item -->

                                            <!-- timeline item -->
                                            <div>
                                                <i class="fa fa-file bg-warning"></i>

                                                <div class="timeline-item">

                                                    <h3 class="timeline-header"><a href="#">Receipt </a> Number</h3>

                                                    <div class="timeline-body table-responsive">
                                                        {{ $frame_prescription->receipt_number }}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END timeline item -->

                                            <!-- timeline item -->
                                            <div>
                                                <i class="fa fa-industry bg-purple"></i>

                                                <div class="timeline-item">

                                                    <h3 class="timeline-header"><a href="#">Workshop </a> </h3>

                                                    <div class="timeline-body">
                                                        {{ $frame_prescription->workshop->name }}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END timeline item -->

                                            <!-- timeline item -->
                                            <div>
                                                <i class="fa fa-info bg-info"></i>

                                                <div class="timeline-item">

                                                    <h3 class="timeline-header"><a href="#">Remarks </a></h3>

                                                    <div class="timeline-body">
                                                        {{ $frame_prescription->remarks }}
                                                    </div>
                                                </div>

                                                <div class="timeline-footer">
                                                    <a href="#" data-id="{{ $frame_prescription->id }}"
                                                        class="btn btn-block btn-primary btn-flat btn-sm backToLensPowerBtn">
                                                        Lens Power
                                                    </a>
                                                </div>
                                            </div>
                                            <!-- END timeline item -->

                                            <div>
                                                <i class="fa fa-stop bg-gray"></i>
                                            </div>
                                        </div>
                                        <!--.timeline .timeline-inverse -->
                                    @else
                                        <form id="frameCodeForm">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        @csrf
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="hidden" name="power_id"
                                                                    id="frameCodePowerId" class="form-control" />
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="hidden" name="prescription_id"
                                                                    id="frameCodePrescriptionId" class="form-control" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="frameCode">Frame Code</label>
                                                                <select name="stock_id" id="frameCode"
                                                                    class="form-control select2" style="width:100%;">
                                                                    <option selected="selected" disabled="disabled">Choose
                                                                        Frame Code</option>
                                                                    @forelse ($frame_stocks as $frame_stock)
                                                                        <option value="{{ $frame_stock->id }}">
                                                                            {{ $frame_stock->frame->code }}
                                                                        </option>
                                                                    @empty
                                                                        <option disabled="disabled">No Frame Code Available
                                                                        </option>
                                                                    @endforelse
                                                                </select>
                                                            </div>
                                                            <!-- /.form-group -->
                                                        </div>
                                                        <!-- /.col-md-6 -->

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="frameCodeReceiptNumber">Receipt Number</label>
                                                                <input type="number" name="receipt_number"
                                                                    id="frameCodeReceiptNumber"
                                                                    placeholder="Enter Receipt Number"
                                                                    class="form-control" required />
                                                            </div>
                                                            <!-- /.form-group -->
                                                        </div>
                                                        <!-- /.col-md-6 -->

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="frameCodeWorkShop">
                                                                    Workshop
                                                                </label>
                                                                <select id="frameCodeWorkShop" name="workshop_id"
                                                                    class="form-control select2 select2-info"
                                                                    style="width: 100%;"
                                                                    data-dropdown-css-class="select2-info">
                                                                    <option selected="selected" disabled="disabled">
                                                                        Choose Workshop
                                                                    </option>
                                                                    @forelse ($workshops as $workshop)
                                                                        <option value="{{ $workshop->id }}">
                                                                            {{ $workshop->name }}</option>
                                                                    @empty
                                                                        <option disabled="disabled">No Workshos Added yet!
                                                                        </option>
                                                                    @endforelse
                                                                </select>
                                                            </div>
                                                            <!-- /.form-group -->
                                                        </div>
                                                        <!-- /.col-md-12 -->

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="frameCodeRemarks">
                                                                    Remarks
                                                                </label>
                                                                <textarea name="remarks" id="frameCodeRemarks" class="form-control" placeholder="Remarks"></textarea>
                                                            </div>
                                                            <!-- /.form-group -->
                                                        </div>
                                                        <!-- /.col-md-12 -->
                                                    </div>
                                                    <!-- /.row -->
                                                    <button type="submit" id="frameCodeSubmitBtn"
                                                        class="btn btn-block btn-primary">
                                                        Save
                                                    </button>
                                                </div><!-- /.card-body -->
                                            </div><!-- /.card -->
                                        </form>
                                    @endif
                                </div>
                                <!--.frameCodesDiv -->
                            </div>
                            <!--.tab-pane -->

                            <div class="tab-pane" id="medicineTab">
                                <div class="table-responsive">
                                    <button id="addMedicineBtn" class="btn btn-block btn-success">
                                        <i class="fa fa-plus-circle"></i> Add Medicine
                                    </button>
                                    <hr>
                                    <table id="medicineData" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Medicine</th>
                                                <th>Dose</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="procedureTab">
                                @if ($procedure)
                                    <div class="callout callout-info">
                                        {!! $procedure->procedure !!}
                                    </div>
                                @else
                                    <form id="procedureForm">
                                        @csrf
                                        @if ($diagnosis)
                                            <div class="form-group">
                                                <input type="hidden" name="diagnosis_id" value="{{ $diagnosis->id }}"
                                                    class="form-control" />
                                            </div>
                                        @endif
                                        <div class="form-group">
                                            <label for="procudereText">Procedure</label>
                                            <textarea name="procedure" id="procudereText" class="form-control textarea"></textarea>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" id="procudereSubmitBtn"
                                                    class="btn btn-primary btn-block">Save</button>
                                            </div>
                                        </div>

                                    </form>
                                @endif
                                <hr>
                                @if ($payment_bill)
                                    <a href="#" data-id="{{ $payment_bill->id }}"
                                        class="btn btn-block btn-primary viewPaymentBillBtn">
                                        View Payment Bill
                                    </a>
                                @else
                                    @if ($diagnosis)
                                        <a href="#" id="{{ $diagnosis->schedule_id }}"
                                            class="btn btn-block btn-success openBillBtn" rel="noopener noreferrer">
                                            Open Bill
                                        </a>
                                    @endif
                                @endif
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!--.tab-content -->
                    </div>
                    <!--.card-body -->

                </div>
                <!--.card .card-outline .card-primary -->
            </div>
            <!--.col-md-6 -->

            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Payment Details
                        </h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <strong><i class="fa fa-hourglass mr-1"></i> Client Type</strong>

                        <p class="text-muted">
                            {{ $payment_details->client_type->type }}
                        </p>

                        <hr>
                        @if ($payment_details->insurance)
                            <strong><i class="fa fa-building mr-1"></i> Insurance Company</strong>

                            <p class="text-muted">
                                {{ $payment_details->insurance->title }}
                            </p>

                            <hr>

                            <strong><i class="fa fa-building mr-1"></i> Scheme</strong>

                            <p class="text-muted">
                                {{ $payment_details->scheme }}
                            </p>

                            <hr>

                            <strong><i class="fa fa-user mr-1"></i> Principal Member</strong>

                            <p class="text-muted">
                                {{ $payment_details->principal }}
                            </p>

                            <hr>
                            <strong><i class="fa fa-phone mr-1"></i> Principal Telephone Number</strong>

                            <p class="text-muted">
                                {{ $payment_details->phone }}
                            </p>

                            <hr>
                            <strong><i class="fa fa-map-pin mr-1"></i> Principal Workplace</strong>

                            <p class="text-muted">
                                {{ $payment_details->workplace }}
                            </p>

                            <hr>
                            <strong><i class="fa fa-credit-card mr-1"></i> Insurance Card Number</strong>

                            <p class="text-muted">
                                {{ $payment_details->card_number }}
                            </p>

                            <hr>
                        @endif

                        <strong><i class="fa fa-map-pin mr-1"></i> Patient Workplace</strong>

                        <p class="text-muted">
                            {{ $payment_details->workplace }}
                        </p>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->

        </div>
        <!--.row -->

        <div class="modal fade" id="addDiagnosisModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            Perform Diagnosis
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="addDiagnosisForm">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="clinic_id" class="form-control" id="addDiagnosisClinicId" />
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="patient_id" class="form-control"
                                    id="addDiagnosisPatientId" />
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="appointment_id" class="form-control"
                                    id="addDiagnosisAppointmentId" />
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="user_id" class="form-control" id="addDiagnosisUserId" />
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="schedule_id" class="form-control"
                                    id="addDiagnosisScheduleId" />
                            </div>
                            <div class="form-group">
                                <label for="addDiagnosisSigns">Signs</label>
                                <textarea id="addDiagnosisSigns" name="signs" class="form-control textarea" placeholder="Enter Signs here..."
                                    style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="addDiagnosisSymptoms">Symptoms</label>
                                <textarea id="addDiagnosisSymptoms" name="symptoms" class="form-control textarea"
                                    placeholder="Enter symptoms here..."
                                    style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="addDiagnosisSigns">Diagnosis</label>
                                <textarea id="addDiagnosisSigns" name="diagnosis" class="form-control textarea"
                                    placeholder="Enter diagnosis here..."
                                    style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" id="addDiagnosisSubmitBtn" class="btn btn-primary">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <div class="modal fade" id="editDiagnosisModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            Edit Diagnosis
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="editDiagnosisForm">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="clinic_id" class="form-control"
                                    id="editDiagnosisClinicId" />
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="diagnosis_id" class="form-control" id="editDiagnosisId" />
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="patient_id" class="form-control"
                                    id="editDiagnosisPatientId" />
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="appointment_id" class="form-control"
                                    id="editDiagnosisAppointmentId" />
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="user_id" class="form-control" id="editDiagnosisUserId" />
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="schedule_id" class="form-control"
                                    id="editDiagnosisScheduleId" />
                            </div>
                            <div class="form-group">
                                <label for="editDiagnosisSigns">Signs</label>
                                <textarea id="editDiagnosisSigns" name="signs" class="form-control textarea" placeholder="Enter Signs here..."
                                    style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{!! $diagnosis->signs !!}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="editDiagnosisSymptoms">Symptoms</label>
                                <textarea id="editDiagnosisSymptoms" name="symptoms" class="form-control textarea"
                                    placeholder="Enter symptoms here..."
                                    style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{!! $diagnosis->symptoms !!}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="editDiagnosisDiagnosis">Diagnosis</label>
                                <textarea id="editDiagnosisDiagnosis" name="diagnosis" class="form-control textarea"
                                    placeholder="Enter diagnosis here..."
                                    style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{!! $diagnosis->diagnosis !!}</textarea>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" id="editDiagnosisSubmitBtn" class="btn btn-primary">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <!-- Edit Lens Power -->
        <div class="modal fade" id="editLensPowerModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            Edit Lens Power
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!--.modal-header -->
                    <form id="editLensPowerForm">
                        <div class="modal-body">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" name="power_id" id="editLensPowerId" class="form-control" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <p>Right Eye</p>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="editLensPowerRightSphere">Sphere</label>
                                        <input type="text" name="right_sphere" class="form-control"
                                            id="editLensPowerRightSphere" placeholder="Sphere">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="editLensPowerRightCylinder">Cylinder</label>
                                        <input type="text" name="right_cylinder" class="form-control"
                                            id="editLensPowerRightCylinder" placeholder="Cylinder">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="editLensPowerRightAxis">Axis</label>
                                        <input type="text" name="right_axis" class="form-control"
                                            id="editLensPowerRightAxis" placeholder="Axis">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="editLensPowerRightAdditional">Additional</label>
                                        <input type="text" name="right_add" class="form-control"
                                            id="editLensPowerRightAdditional" placeholder="Additional">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <p>Left Eye</p>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="editLensPowerLeftSphere">Sphere</label>
                                        <input type="text" name="left_sphere" class="form-control"
                                            id="editLensPowerLeftSphere" placeholder="Sphere">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="editLensPowerLeftCylinder">Cylinder</label>
                                        <input type="text" name="left_cylinder" class="form-control"
                                            id="editLensPowerLeftCylinder" placeholder="Cylinder">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="editLensPowerLeftAxis">Axis</label>
                                        <input type="text" name="left_axis" class="form-control"
                                            id="editLensPowerLeftAxis" placeholder="Axis">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="editLensLeftAdditional">Additional</label>
                                        <input type="text" name="left_add" class="form-control"
                                            id="editLensLeftAdditional" placeholder="Additional">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label for="editLensPowerAdditionalInfo">
                                    Additional Information
                                </label>
                                <textarea name="notes" id="editLensPowerAdditionalInfo" class="form-control" placeholder="Additional Information"></textarea>
                            </div>
                        </div>
                        <!--.modal-body -->
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" id="editLensPowerSubmitBtn" class="btn btn-primary">
                                Update
                            </button>
                        </div>
                        <!--.modal-footer .justify-content-between -->
                    </form>
                    <!--#editLensPowerForm -->
                </div>
                <!--.modal-content -->
            </div>
            <!--.modal-dialog -->
        </div>
        <!-- /.modal -->

        <!-- Edit Lens Prescription -->
        <div class="modal fade" id="editPrescriptionModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            Edit Lens Prescription
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!--.modal-header -->
                    <form id="editPrescriptionForm">
                        <div class="modal-body">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" name="prescription_id" id="editPrescriptionId"
                                        class="form-control" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="editPrescriptionType">Lens Type</label>
                                        <select id="editPrescriptionType" name="type_id"
                                            class="form-control select2 select2-purple" style="width: 100%;"
                                            data-dropdown-css-class="select2-purple">
                                            @forelse ($types as $type) 
                                                <option value="{{ $type->id }}" @if($type->id == $lens_prescription->type_id) selected="selected" @endif>
                                                    {{ $type->type }}
                                                </option>
                                            @empty
                                                <option disabled="disabled">
                                                    No Lens Type Found
                                                </option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="editPrescriptionMaterial">Lens Material</label>
                                        <select id="editPrescriptionMaterial" name="material_id"
                                            class="form-control select2 select2-danger" style="width: 100%;"
                                            data-dropdown-css-class="select2-danger">
                                            @forelse ($materials as $material)
                                                <option value="{{ $material->id }}" @if($material->id == $lens_prescription->material_id) selected="selected" @endif>
                                                    {{ $material->title }}
                                                </option>
                                            @empty
                                                <option disabled="disabled">
                                                    No Lens Material Found
                                                </option>
                                            @endforelse
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="editPrescriptionIndex">Lens
                                            Index/Thickness</label>
                                        <input type="text" name="index" class="form-control"
                                            id="editPrescriptionIndex" placeholder="Lens Index/Thickness">
                                    </div>
                                    <!-- /.form-group -->
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="editPrescriptionTint">Tint</label>
                                        <input type="text" name="tint" class="form-control"
                                            id="editPrescriptionTint" placeholder="Lens Tint">
                                    </div>
                                    <!-- /.form-group -->
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="editPrescriptionPupil">Pupil
                                            Diameter(mm)</label>
                                        <input type="text" name="pupil" class="form-control"
                                            id="editPrescriptionPupil"
                                            placeholder="Pupil Diameter">
                                    </div>
                                    <!-- /.form-group -->
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="editPrescriptionFocalHeight">Focal
                                            Height
                                        </label>
                                        <input type="text" name="focal_height"
                                            class="form-control" id="editPrescriptionFocalHeight"
                                            placeholder="Focal Height">
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                            </div>
                        </div>
                        <!--.modal-body -->
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" id="editPrescriptionSubmitBtn" class="btn btn-primary">
                                Update Prescription
                            </button>
                        </div>
                        <!--.modal-footer .justify-content-between -->
                    </form>
                    <!--#editLensPowerForm -->
                </div>
                <!--.modal-content -->
            </div>
            <!--.modal-dialog -->
        </div>
        <!-- /.modal -->

        <div class="modal fade" id="addMedicineModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            Add Medicine
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="addMedicineForm">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                @if ($diagnosis)
                                    <input type="hidden" value="{{ $diagnosis->id }}" name="diagnosis_id"
                                        class="form-control" id="addMedicineDiagnosisId" />
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="addMedicineName">Medicine</label>
                                <input type="text" name="medicine" class="form-control" id="addMedicineName"
                                    placeholder="Medicine Name">
                            </div>

                            <div class="form-group">
                                <label for="addMedicineDose">Quantity/ Dose</label>
                                <input type="text" class="form-control" id="addMedicineDose" name="dose"
                                    placeholder="Dose/ Quantity">
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button id="addMedicineSubmitBtn" type="submit" class="btn btn-primary">
                                Add Medicine
                            </button>
                        </div>
                    </form>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <div class="modal fade" id="openBillModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            Open Bill
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="openBillForm">
                        <div class="modal-body">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" id="openBillScheduleId"
                                            name="schedule_id" />
                                    </div>
                                </div>
                                <!--.col-md-12-->
                            </div>
                            <!--.row-->

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="openBillConsultationFee">
                                            Consultation Fee
                                        </label>
                                        <input type="text" class="form-control" name="consultation_fee"
                                            id="openBillConsultationFee" placeholder="Consultation Fee">
                                    </div>
                                </div>
                                <!--.col-md-6-->

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="openBillConsultationReceipt">
                                            Consultation Receipt
                                        </label>
                                        <input type="text" class="form-control" name="consultation_receipt"
                                            id="openBillConsultationReceipt" placeholder="Consultation Receipt">
                                    </div>
                                </div>
                                <!--.col-md-6-->
                            </div>
                            <!--.row-->

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="openBillClaimedAmount">
                                            Claimed Amount
                                        </label>
                                        <input type="text" class="form-control" name="claimed_amount"
                                            id="openBillClaimedAmount" placeholder="Claimed Amount">
                                    </div>
                                </div>
                            </div>
                            <!--.row-->

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="openBillRemarks">
                                            Remarks
                                        </label>
                                        <textarea name="remarks" id="openBillRemarks" class="form-control" placeholder="Enter Remarks"></textarea>
                                    </div>
                                </div>
                            </div>
                            <!--.row-->

                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" id="openBillSubmitBtn" class="btn btn-primary">Save</button>
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

            $('.addDiagnosisBtn').click(function(e) {
                e.preventDefault();
                var path = '{{ route('users.doctor.schedules.show') }}';
                var schedule_id = $(this).attr('id');
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
                        if (data['status']) {
                            $('#addDiagnosisClinicId').val(data.data.clinic_id);
                            $('#addDiagnosisPatientId').val(data.data.patient_id);
                            $('#addDiagnosisAppointmentId').val(data.data.appointment_id);
                            $('#addDiagnosisUserId').val(data.data.user_id);
                            $('#addDiagnosisScheduleId').val(data.data.id);
                            $('#addDiagnosisModal').modal('show');
                        } else {
                            console.log(data);
                        }

                    }
                });
            });

            $('#addDiagnosisForm').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var formData = new FormData(form[0]);
                var path = '{{ route('users.diagnosis.store') }}';
                $.ajax({
                    url: path,
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#addDiagnosisSubmitBtn').html(
                            '<i class="fa fa-spinner fa-spin"></i>');
                        $('#addDiagnosisSubmitBtn').attr('disabled', true);
                    },
                    complete: function() {
                        $('#addDiagnosisSubmitBtn').html('Save');
                        $('#addDiagnosisSubmitBtn').attr('disabled', false);
                    },
                    success: function(data) {
                        if (data['status']) {
                            $('#addDiagnosisModal').modal('hide');
                            toastr.success(data['message']);
                            setTimeout(function() {
                                window.location.reload();
                            }, 1000);
                        } else {
                            console.log(data);
                        }

                    }
                });
            });

            $('.editDiagnosisBtn').on('click', function(e) {
                e.preventDefault();
                var diagnosis_id = $(this).data('id');
                var token = '{{ csrf_token() }}';
                var path = '{{ route('users.diagnosis.show') }}';
                $.ajax({
                    url: path,
                    type: "POST",
                    data: {
                        diagnosis_id: diagnosis_id,
                        _token: token
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data['status']) {
                            $('#editDiagnosisModal').modal('show');
                            $('#editDiagnosisClinicId').val(data['data']['clinic_id']);
                            $('#editDiagnosisId').val(data['data']['id']);
                            $('#editDiagnosisPatientId').val(data['data']['patient_id']);
                            $('#editDiagnosisAppointmentId').val(data['data'][
                                'appointment_id'
                            ]);
                            $('#editDiagnosisUserId').val(data['data']['user_id']);
                            $('#editDiagnosisScheduleId').val(data['data']['schedule_id']);
                            $('#editDiagnosisSigns').val(data['data']['signs']);
                            $('#editDiagnosisSymptoms').val(data['data']['symptoms']);
                            $('#editDiagnosisDiagnosis').val(data['data']['diagnosis']);
                        }
                    }
                });
            });

            $('#editDiagnosisForm').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var formData = new FormData(form[0]);
                var path = '{{ route('users.diagnosis.update') }}';
                $.ajax({
                    url: path,
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#editDiagnosisSubmitBtn').html(
                            '<i class="fa fa-spinner fa-spin"></i>');
                        $('#editDiagnosisSubmitBtn').attr('disabled', true);
                    },
                    complete: function() {
                        $('#editDiagnosisSubmitBtn').html('Save');
                        $('#editDiagnosisSubmitBtn').attr('disabled', false);
                    },
                    success: function(data) {
                        if (data['status']) {
                            $('#editDiagnosisModal').modal('hide');
                            toastr.success(data['message']);
                            setTimeout(function() {
                                window.location.reload();
                            }, 1000);
                        } else {
                            console.log(data);
                        }

                    }
                });
            });

        });
    </script>

    @if ($diagnosis)
        <script>
            $(document).ready(function() {
                // Treatment
                $('.lensPowerDiv').fadeIn();
                $('.lensPrescriptionDiv').fadeOut();
                $('.frameCodesDiv').fadeOut();

                // Lens Power
                $('#lensPowerForm').submit(function(e) {
                    e.preventDefault();
                    var form = $(this);
                    var formData = new FormData(form[0]);
                    var path = '{{ route('users.lens.power.store') }}';
                    $.ajax({
                        url: path,
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        beforeSend: function() {
                            $('#lensPowerSubmitBtn').html(
                                '<i class="fa fa-spinner fa-spin"></i>');
                            $('#lensPowerSubmitBtn').attr('disabled', true);
                        },
                        complete: function() {
                            $('#lensPowerSubmitBtn').html('Add Power');
                            $('#lensPowerSubmitBtn').attr('disabled', false);
                        },
                        success: function(data) {
                            if (data['status']) {
                                toastr.success(data['message']);
                                $('#lensPowerForm')[0].reset();
                                $('.lensPowerDiv').fadeOut();
                                $('#lensPrescriptionPowerId').val(data['power_id']);
                                $('.lensPrescriptionDiv').fadeIn();
                                $('.frameCodesDiv').fadeOut();
                            } else {
                                console.log(data);
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
                        },
                    });
                });

                // Edit Lens Power
                $(document).on('click', '.editLensPowerBtn', function(e) {
                    e.preventDefault();
                    var power_id = $(this).data('id');
                    var path = '{{ route('users.lens.power.show') }}';
                    var token = '{{ csrf_token() }}';
                    $.ajax({
                        url: path,
                        type: "POST",
                        data: {
                            power_id: power_id,
                            _token: token
                        },
                        dataType: "JSON",
                        success: function(data) {
                            if (data['status']) {
                                $('#editLensPowerModal').modal('show');
                                $('#editLensPowerId').val(data['data']['id']);
                                $('#editLensPowerRightSphere').val(data['data']['right_sphere']);
                                $('#editLensPowerRightCylinder').val(data['data'][
                                    'right_cylinder'
                                ]);
                                $('#editLensPowerRightAxis').val(data['data']['right_axis']);
                                $('#editLensPowerRightAdditional').val(data['data']['right_add']);
                                $('#editLensPowerLeftSphere').val(data['data']['left_sphere']);
                                $('#editLensPowerLeftCylinder').val(data['data']['left_cylinder']);
                                $('#editLensPowerLeftAxis').val(data['data']['left_axis']);
                                $('#editLensLeftAdditional').val(data['data']['left_add']);
                                $('#editLensPowerAdditionalInfo').val(data['data']['notes'])
                            }
                        }
                    });
                });

                // update lens power
                $('#editLensPowerForm').submit(function(e) {
                    e.preventDefault();
                    var form = $(this);
                    var formData = new FormData(form[0]);
                    var path = '{{ route('users.lens.power.update') }}';
                    $.ajax({
                        url: path,
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        beforeSend: function() {
                            $('#editLensPowerSubmitBtn').html(
                                '<i class="fa fa-spinner fa-spin"></i>');
                            $('#editLensPowerSubmitBtn').attr('disabled', true);
                        },
                        complete: function() {
                            $('#editLensPowerSubmitBtn').html('Update Power');
                            $('#editLensPowerSubmitBtn').attr('disabled', false);
                        },
                        success: function(data) {
                            if (data['status']) {
                                toastr.success(data['message']);
                                $('#editLensPowerModal').modal('hide');
                                $('#editLensPowerForm')[0].reset();
                                $('#myTab a[href="#treatmentTab"]').tab('show');
                                location.reload();
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
                        },

                    });
                });

                // Lens Prescription
                $(document).on('click', '.newLensPrescriptionBtn', function(e) {
                    e.preventDefault();
                    $('.lensPowerDiv').fadeOut();
                    $('#lensPrescriptionPowerId').val($(this).data('id'));
                    $('.lensPrescriptionDiv').fadeIn();
                    $('.frameCodesDiv').fadeOut();
                });

                // new prescription
                $('#lensPrescriptionForm').submit(function(e) {
                    e.preventDefault();
                    var form = $(this);
                    var formData = new FormData(form[0]);
                    var path = '{{ route('users.lens.prescription.store') }}';
                    $.ajax({
                        url: path,
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        beforeSend: function() {
                            $('#lensPrescriptionSubmitBtn').html(
                                '<i class="fa fa-spinner fa-spin"></i>');
                            $('#lensPrescriptionSubmitBtn').attr('disabled', true);
                        },
                        complete: function() {
                            $('#lensPrescriptionSubmitBtn').html('Add Prescription');
                            $('#lensPrescriptionSubmitBtn').attr('disabled', false);
                        },
                        success: function(data) {
                            if (data['status']) {
                                toastr.success(data['message']);
                                $('#lensPrescriptionForm')[0].reset();
                                $('.lensPowerDiv').fadeOut();
                                $('.lensPrescriptionDiv').fadeOut();
                                $('#frameCodePowerId').val(data['power_id']);
                                $('#frameCodePrescriptionId').val(data['prescription_id']);
                                $('.frameCodesDiv').fadeIn();
                            } else {
                                console.log(data);
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
                        },
                    });
                });

                // Edit lens prescription
                $(document).on('click', '.editPrescriptionBtn', function(e) {
                    e.preventDefault();
                    var prescription_id = $(this).data('id');
                    var token = '{{ csrf_token() }}';
                    var path = '{{ route('users.lens.prescription.show') }}';
                    $.ajax({
                        url: path,
                        type: "POST",
                        data: {
                            prescription_id: prescription_id,
                            _token: token,
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data['status']) {
                                $('#editPrescriptionModal').modal('show');
                                $('#editPrescriptionId').val(data['data']['id']);
                                $('#editPrescriptionIndex').val(data['data']['index']);
                                $('#editPrescriptionTint').val(data['data']['tint']);
                                $('#editPrescriptionPupil').val(data['data']['diameter']);
                                $('#editPrescriptionFocalHeight').val(data['data']['focal_height']);
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

                // update lens prescription
                $('#editPrescriptionForm').submit(function(e){
                    e.preventDefault();
                    var form = $(this);
                    var formData = new FormData(form[0]);
                    var path = '{{ route('users.lens.prescription.update') }}';
                    $.ajax({
                        url: path,
                        type: "POST",
                        data: formData,
                        dataType: "json",
                        contentType:false,
                        processData: false,
                        beforeSend: function(){
                            $('#editPrescriptionSubmitBtn').html(
                                '<i class="fa fa-spinner fa-spin"></i>'
                            );
                            $('#editPrescriptionSubmitBtn').attr('disabled', true);
                        },
                        complete:function(){
                            $('#editPrescriptionSubmitBtn').html('Update Prescription');
                            $('#editPrescriptionSubmitBtn').attr('disabled', false);
                        },
                        success:function(data){
                            if(data['status']){
                                toastr.success(data['message']);
                                $('#editPrescriptionForm')[0].reset();
                                $('#editPrescriptionModal').modal('hide');
                                location.reload();
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

                // view lens prescription
                $(document).on('click', '.viewLensPrescription', function(e) {
                    e.preventDefault();
                    var prescription_id = $(this).data('id');
                    var token = '{{ csrf_token() }}';
                    var path = '{{ route('users.lens.prescription.show') }}';
                    $.ajax({
                        url: path,
                        type: 'POST',
                        data: {
                            prescription_id: prescription_id,
                            _token: token
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data['status']) {
                                $('.lensPowerDiv').fadeOut();
                                $('.lensPrescriptionDiv').fadeIn();
                                $('.frameCodesDiv').fadeOut();
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
                        },
                    });
                });

                // Frame Codes
                // frame code form
                $(document).on('click', '.newFrameCodeBtn', function(e) {
                    e.preventDefault();
                    var prescription_id = $(this).data('id');
                    var token = '{{ csrf_token() }}';
                    var path = '{{ route('users.lens.prescription.show') }}';
                    $.ajax({
                        url: path,
                        type: 'POST',
                        data: {
                            prescription_id: prescription_id,
                            _token: token
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data['status']) {
                                $('.lensPowerDiv').fadeOut();
                                $('.lensPrescriptionDiv').fadeOut();
                                $('#frameCodePowerId').val(data['data']['power_id']);
                                $('#frameCodePrescriptionId').val(data['data']['id']);
                                $('.frameCodesDiv').fadeIn();
                            }
                        },
                    });
                });

                // new frame code
                $('#frameCodeForm').submit(function(e) {
                    e.preventDefault();
                    var form = $(this);
                    var formData = new FormData(form[0]);
                    var path = '{{ route('users.lens.frame.prescription.store') }}';
                    $.ajax({
                        url: path,
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        beforeSend: function() {
                            $('#frameCodeSubmitBtn').html(
                                '<i class="fa fa-spinner fa-spin"></i>');
                            $('#frameCodeSubmitBtn').attr('disabled', true);
                        },
                        complete: function() {
                            $('#frameCodeSubmitBtn').html('Add Frame Code');
                            $('#frameCodeSubmitBtn').attr('disabled', false);
                        },
                        success: function(data) {
                            if (data['status']) {
                                toastr.success(data['message']);
                                $('#frameCodeForm')[0].reset();
                                setTimeout(() => {
                                    location.reload();
                                }, 1000);
                            } else {
                                console.log(data);
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
                        },
                    });

                });

                // view frame code
                $(document).on('click', '.frameCodeBtn', function(e) {
                    e.preventDefault();
                    $('.lensPowerDiv').fadeOut();
                    $('.lensPrescriptionDiv').fadeOut();
                    $('.frameCodesDiv').fadeIn();
                });

                // Medical History
                find_medicine();

                function find_medicine() {
                    var path = '{{ route('users.medicine.index', $diagnosis->id) }}';
                    $('#medicineData').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: path,
                        columns: [{
                                data: 'medicine',
                                name: 'medicine'
                            },
                            {
                                data: 'dose',
                                name: 'dose',
                            },
                            {
                                data: 'action',
                                name: 'action',
                                orderable: false,
                                searchable: false
                            },
                        ],
                        "autoWidth": false,
                        "responsive": true,
                    });
                }

                // medicine form
                $('#addMedicineBtn').click(function(e) {
                    e.preventDefault();
                    $('#addMedicineModal').modal('show');
                });

                $('#addMedicineForm').submit(function(e) {
                    e.preventDefault();
                    var form = $(this);
                    var formData = new FormData(form[0]);
                    var path = '{{ route('users.medicine.store') }}';
                    $.ajax({
                        url: path,
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        beforeSend: function() {
                            $('#addMedicineSubmitBtn').html(
                                '<i class="fa fa-spinner fa-spin"></i>');
                            $('#addMedicineSubmitBtn').attr('disabled', true);
                        },
                        complete: function() {
                            $('#addMedicineSubmitBtn').html('Add Medicine');
                            $('#addMedicineSubmitBtn').attr('disabled', false);
                        },
                        success: function(data) {
                            if (data['status']) {
                                toastr.success(data['message']);
                                $('#addMedicineForm')[0].reset();
                                $('#addMedicineModal').modal('hide');
                                $('#medicineData').DataTable().ajax.reload();
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
                        },
                    });
                });

                // delete medicine
                $(document).on('click', '.deleteMedicineBtn', function(e) {
                    e.preventDefault();
                    var path = '{{ route('users.medicine.delete') }}';
                    var medicine_id = $(this).attr('data-id');
                    var token = '{{ csrf_token() }}';
                    Swal.fire({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recommend this mmedicine to this patient!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            $.ajax({
                                url: path,
                                type: "POST",
                                data: {
                                    medicine_id: medicine_id,
                                    _token: token,
                                },
                                dataType: "json",
                                success: function(data) {
                                    if (data['status']) {
                                        Swal.fire(data['message'], '', 'success')
                                        $('#medicineData').DataTable().ajax.reload();
                                    } else {
                                        console.log(data);
                                    }
                                },
                                error: function(data) {
                                    var errors = data.responseJSON;
                                    var errorsHtml = '<ul>';
                                    $.each(errors['errors'], function(key, value) {
                                        errorsHtml += '<li>' + value + '</li>';
                                    });
                                    errorsHtml += '</ul>';
                                    Swal.fire(errorsHtml, '', 'info');
                                },
                            });
                        } else if (result.isDenied) {
                            Swal.fire('Changes are not saved', '', 'info');
                        }
                    });
                });

                // procedure form
                $('#procedureForm').submit(function(e) {
                    e.preventDefault();
                    var form = $(this);
                    var formData = new FormData(form[0]);
                    var path = '{{ route('users.procedure.store') }}';
                    $.ajax({
                        url: path,
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        beforeSend: function() {
                            $('#procudereSubmitBtn').html(
                                '<i class="fa fa-spinner fa-spin"></i>');
                            $('#procedureSubmitBtn').attr('disabled', true);
                        },
                        complete: function() {
                            $('#procudereSubmitBtn').html('Add Procedure');
                            $('#procedureSubmitBtn').attr('disabled', false);
                        },
                        success: function(data) {
                            if (data['status']) {
                                toastr.success(data['message']);
                                location.reload();
                            } else {
                                console.log(data);
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
                        },
                    });
                });

                // open Billing
                $(document).on('click', '.openBillBtn', function(e) {
                    e.preventDefault();
                    var schedule_id = $(this).attr('id');
                    var token = '{{ csrf_token() }}';
                    var path = '{{ route('users.doctor.schedules.show') }}';
                    $.ajax({
                        url: path,
                        type: 'POST',
                        data: {
                            schedule_id: schedule_id,
                            _token: token,
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data['status']) {
                                $('#openBillScheduleId').val(data['data']['id']);
                                $('#openBillModal').modal('show');
                            }

                            console.table(data);
                        },
                        error: function(data) {
                            var errors = data.responseJSON;
                            var errorsHtml = '<ul>';
                            $.each(errors['errors'], function(key, value) {
                                errorsHtml += '<li>' + value + '</li>';
                            });
                            errorsHtml += '</ul>';
                            toastr.error(errorsHtml);
                        },
                    });
                });

                // Open Billing Form
                $('#openBillForm').submit(function(e) {
                    e.preventDefault();
                    var form = $(this);
                    var formData = new FormData(form[0]);
                    var path = '{{ route('users.payments.bills.store') }}';
                    $.ajax({
                        url: path,
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        beforeSend: function() {
                            $('#openBillSubmitBtn').html(
                                '<i class="fa fa-spinner fa-spin"></i>');
                            $('#openBillSubmitBtn').attr('disabled', true);
                        },
                        complete: function() {
                            $('#openBillSubmitBtn').html('Open Bill');
                            $('#openBillSubmitBtn').attr('disabled', false);
                        },
                        success: function(data) {
                            if (data['status']) {
                                toastr.success(data['message']);
                                $('#openBillForm')[0].reset();
                                $('#openBillModal').modal('hide');
                                let url = '{{ route('users.payments.bills.index') }}';
                                setTimeout(() => {
                                    window.location.href = url;
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
                        },
                    });

                });

                // view bill
                $(document).on('click', '.viewPaymentBillBtn', function(e) {
                    e.preventDefault();
                    var bill_id = $(this).data('id');
                    var token = '{{ csrf_token() }}';
                    var path = '{{ route('users.payments.bills.show') }}';
                    $.ajax({
                        url: path,
                        type: "POST",
                        dataType: "json",
                        data: {
                            bill_id: bill_id,
                            _token: token,
                        },
                        success: function(data) {
                            if (data['status']) {
                                // later change it to view
                                let url = '{{ route('users.payments.bills.view', ':id') }}';
                                url = url.replace(':id', data['data']['id']);
                                setTimeout(() => {
                                    window.location.href = url;
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
                        },
                    });

                });

            });
        </script>
    @endif
@endsection
