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

                    <div class="card card-default card-outline">
                        <div class="card-body">
                            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill"
                                        href="#custom-content-below-home" role="tab"
                                        aria-controls="custom-content-below-home" aria-selected="true">
                                        All
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill"
                                        href="#custom-content-below-profile" role="tab"
                                        aria-controls="custom-content-below-profile" aria-selected="false">
                                        Trash
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content" id="custom-content-below-tabContent">
                                <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel"
                                    aria-labelledby="custom-content-below-home-tab">
                                    <br>
                                    <div class="table-responsive">
                                        <table id="clinicData" class="table table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Name</th>
                                                    <th>Initials</th>
                                                    <th>Logo</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel"
                                    aria-labelledby="custom-content-below-profile-tab">
                                    <br>
                                    <div class="table-responsive">
                                        <table id="clinicTrashedData"
                                            class="table table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Name</th>
                                                    <th>Initials</th>
                                                    <th>Logo</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.card -->
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
                            data: 'actions',
                            name: 'actions',
                            orderable: false,
                            searchable: false
                        },
                    ],
                    "autoWidth": false,
                    "responsive": true,
                });
            }

            find_trashed_clinics();

            function find_trashed_clinics() {
                var path = '{{ route('admin.clinics.trashed') }}';
                $('#clinicTrashedData').DataTable({
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
                            data: 'actions',
                            name: 'actions',
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
                let clinic_id = $(this).attr('id');
                let path = '{{ route('admin.clinics.show', ':clinic') }}';
                path = path.replace(':clinic', clinic_id);
                $.ajax({
                    url: path,
                    type: 'GET',
                    success: function(data) {
                        if (data['status']) {
                            setTimeout(() => {
                                window.location.href =
                                    '{{ route('admin.dashboard.index', ':clinic') }}'
                                    .replace(':clinic',
                                        data.data.id);
                            }, 500);
                        }
                    }
                });
            });

            $(document).on('click', '.restoreBtn', function(e){
                e.preventDefault();
                let clinic_id = $(this).attr('id');
                let token = '{{ csrf_token() }}';
                let path = '{{ route('admin.clinics.restore.clinic', ':clinic') }}';
                path = path.replace(':clinic', clinic_id);
                Swal.fire({
                    title: "Are you sure?",
                    text: "You are gong to restore clinic data",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: path,
                            type: "POST",
                            data: {
                                _token: token,
                            },
                            dataType: "json",
                            success: function(data) {
                                if (data['status']) {
                                    toastr.success(data['message']);
                                    $('#clinicTrashedData').DataTable().ajax.reload();
                                    $('#clinicData').DataTable().ajax.reload();
                                    
                                }
                            }
                        });
                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info');
                    }
                });
            })

            $(document).on('click', '.deleteBtn', function(e) {
                e.preventDefault();
                let clinic_id = $(this).attr('id');
                let token = '{{ csrf_token() }}';
                let path = '{{ route('admin.clinics.delete', ':clinic') }}';
                path = path.replace(':clinic', clinic_id);
                Swal.fire({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this record!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: path,
                            type: "DELETE",
                            data: {
                                _token: token,
                            },
                            dataType: "json",
                            success: function(data) {
                                if (data['status']) {
                                    toastr.success(data['message']);
                                    $('#clinicData').DataTable().ajax.reload();
                                }
                            }
                        });
                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info');
                    }
                });
            });

            $(document).on('click', '.deleteCompletelyBtn', function(e) {

                e.preventDefault();
                let clinic_id = $(this).attr('id');
                let token = '{{ csrf_token() }}';
                let path = '{{ route('admin.clinics.force.delete', ':clinic') }}';
                path = path.replace(':clinic', clinic_id);
                Swal.fire({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this record!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: path,
                            type: "DELETE",
                            data: {
                                _token: token,
                            },
                            dataType: "json",
                            success: function(data) {
                                if (data['status']) {
                                    toastr.success(data['message']);
                                    $('#clinicTrashedData').DataTable().ajax.reload();
                                }
                            }
                        });
                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info');
                    }
                });

            });
        });
    </script>
@endsection
