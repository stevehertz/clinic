@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>All Clinics</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.organization.index') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Clinics</li>
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
                        <div class="card-header">
                            <div class="card-tools">
                                <a href="#" class="btn btn-primary btn-sm newClinicBtn">
                                    <i class="fa fa-plus-circle"></i> New Clinic
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table id="clinicData" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Initials</th>
                                        <th>Logo</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th></th>
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

        <div class="modal fade" id="newClinicModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="newClinicForm">
                        @csrf
                        <div class="modal-header">
                            <h4 class="modal-title">New Clinic</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="newClinicName">Clinic Name</label>
                                <input type="text" name="clinic" class="form-control" id="newClinicName"
                                    placeholder="Enter clinic name">
                            </div>

                            <div class="form-group">
                                <label for="newClinicLogo">Logo</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="logo" class="custom-file-input" id="newClinicLogo">
                                        <label class="custom-file-label" for="newClinicLogo">Choose file</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="newClinicInitials">Clinic Initials</label>
                                <input type="text" name="initials" class="form-control" id="newClinicInitials"
                                    placeholder="Enter clinic initials">
                            </div>

                            <div class="form-group">
                                <label for="newClinicPhone">Phone Number</label>
                                <input type="text" name="phone" class="form-control" id="newClinicPhone"
                                    placeholder="Enter Phone Number">
                            </div>

                            <div class="form-group">
                                <label for="newClinicEmail">Email Address</label>
                                <input type="email" name="email" class="form-control" id="newClinicEmail"
                                    placeholder="Enter Email Address">
                            </div>

                            <div class="form-group">
                                <label for="newClinicAddress">Address</label>
                                <textarea name="address" id="newClinicAddress" class="form-control" placeholder="Enter Address"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="newClinicLocation">Location</label>
                                <input type="text" name="location" class="form-control" id="newClinicLocation"
                                    placeholder="Enter Email Address">
                            </div>

                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" id="newClinicSubmitBtn" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

    </section><!-- /.content -->
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            find_clinics();

            function find_clinics() {
                var path = '{{ route('admin.clinics.index') }}';
                $('#clinicData').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: path,
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'clinic',
                            name: 'clinic'
                        },
                        {
                            data: 'initials',
                            name: 'initials'
                        },
                        {
                            data: 'logo',
                            name: 'logo',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'phone',
                            name: 'phone'
                        },
                        {
                            data: 'select',
                            name: 'select',
                            orderable: false,
                            searchable: false
                        },
                    ],
                    "autoWidth": false,
                    "responsive": true,
                });
            }

            $(document).on('click', '.newClinicBtn', function(e) {
                e.preventDefault();
                $('#newClinicModal').modal('show');
                $('#newClinicForm').trigger('reset');
            });

            $('#newClinicForm').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var formData = new FormData(form[0]);
                var path = '{{ route('admin.clinics.store') }}';
                $.ajax({
                    url: path,
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#newClinicSubmitBtn').html('<i class="fa fa-spinner fa-spin"></i>');
                        $('#newClinicSubmitBtn').attr('disabled', true);
                    },
                    complete: function() {
                        $('#newClinicSubmitBtn').html('Save');
                        $('#newClinicSubmitBtn').attr('disabled', false);
                    },
                    success: function(data) {
                        if (data['status']) {
                            toastr.success(data['message']);
                            $('#newClinicModal').modal('hide');
                            $('#newClinicForm').trigger('reset');
                            $('#clinicData').DataTable().ajax.reload();
                        } else {
                            console.log(data);
                        }
                    }
                });
            });

            $(document).on('click', '.selectBtn', function(e) {
                e.preventDefault();
                var clinic_id = $(this).attr('id');
                var path = '{{ route('admin.clinics.show') }}';
                var token = '{{ csrf_token() }}';
                $.ajax({
                    url: path,
                    type: 'POST',
                    data: {
                        clinic_id: clinic_id,
                        _token: token
                    },
                    success: function(data) {
                        if (data['status'] == false) {
                            console.log(data);
                        } else {
                            window.location.href = '{{ route('admin.dashboard.index', ':id') }}'
                                .replace(':id', data.data.id);
                        }
                    }
                });
            });

        });
    </script>
@endsection
