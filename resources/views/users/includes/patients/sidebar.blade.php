<div class="col-md-3">
    <div class="card card-primary card-outline">
        <div class="card-body">
            <a href="{{ route('users.patients.view', $patient->id) }}"
                class="text-dark @if (isset($patient_sidebar) && $patient_sidebar == trans('patient.profile')) active @endif">
                <i class="fa fa-user mr-1"></i> @lang('patient.profile')
            </a>

            <hr>

            <a href="{{ route('users.patients.appointments', $patient->id) }}"
                class="text-dark @if (isset($patient_sidebar) && $patient_sidebar == trans('patient.appointment')) active @endif">
                <i class="fa fa-check-square mr-1"></i> @lang('patient.appointment')
            </a>

            <hr>

            <a href="{{ route('users.patients.schedules', $patient->id) }}"
                class="text-dark @if (isset($patient_sidebar) && $patient_sidebar == trans('patient.schedule')) active @endif">
                <i class="fa fa-calendar mr-1"></i> @lang('patient.schedule')
            </a>
        </div>
        <!--/.card-body -->
    </div>
    <!--/.card -->
</div>
<!-- /.col -->