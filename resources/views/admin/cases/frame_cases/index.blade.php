@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        Cases
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.organization.index') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.settings.index') }}">
                                Clinic Settings
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Cases
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-tools">
                                <a href="javascript:void(0)" id="newCaseBtn" class="btn btn-outline-primary btn-sm">
                                    <i class="fa fa-plus-circle"></i> New Case
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table id="casesData" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Color</th>
                                        <th>Size</th>
                                        <th>Shape</th>
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

        <div class="modal fade" id="newCaseModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="newCaseForm">
                        <div class="modal-header">
                            <h4 class="modal-title">New Case</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label for="newCaseCode">Code</label>
                                <input type="text" name="code" class="form-control" id="newCaseCode"
                                    placeholder="Enter Case Code">
                            </div>

                            <div class="form-group">
                                <label for="newCaseColor">Color</label>
                                <select name="color_id" id="newCaseColor" class="form-control select2" style="width: 100%;">
                                    <option selected="selected" disabled="disabled">Select Color</option>
                                    @forelse ($case_colors as $color)
                                        <option value="{{ $color->id }}">
                                            {{ $color->title }}
                                        </option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="newCaseSize">Size</label>
                                <select name="size_id" id="newCaseSize" class="form-control select2" style="width: 100%;">
                                    <option selected="selected" disabled="disabled">Select Size</option>
                                    @forelse ($case_sizes as $size)
                                        <option value="{{ $size->id }}">
                                            {{ $size->title }}
                                        </option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="newCaseShape">Shape</label>
                                <select name="shape_id" id="newCaseShape" class="form-control select2" style="width: 100%;">
                                    <option selected="selected" disabled="disabled">Select Shape</option>
                                    @forelse ($case_shapes as $shape)
                                        <option value="{{ $shape->id }}">
                                            {{ $shape->title }}
                                        </option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <div class="modal fade" id="updateCaseModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="updateCaseForm">
                        <div class="modal-header">
                            <h4 class="modal-title">Update Case</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" class="form-control" id="updateCaseId">
                            </div>

                            <div class="form-group">
                                <label for="updateCaseCode">Code</label>
                                <input type="text" name="code" class="form-control" id="updateCaseCode"
                                    placeholder="Enter Case Code">
                            </div>

                            <div class="form-group">
                                <label for="updateCaseColor">Color</label>
                                <select name="color_id" id="updateCaseColor" class="form-control select2"
                                    style="width: 100%;">
                                    <option selected="selected" disabled="disabled">Select Color</option>
                                    @forelse ($case_colors as $color)
                                        <option value="{{ $color->id }}">
                                            {{ $color->title }}
                                        </option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="updateCaseSize">Size</label>
                                <select name="size_id" id="updateCaseSize" class="form-control select2"
                                    style="width: 100%;">
                                    <option selected="selected" disabled="disabled">Select Size</option>
                                    @forelse ($case_sizes as $size)
                                        <option value="{{ $size->id }}">
                                            {{ $size->title }}
                                        </option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="updateCaseShape">Shape</label>
                                <select name="shape_id" id="updateCaseShape" class="form-control select2"
                                    style="width: 100%;">
                                    <option selected="selected" disabled="disabled">Select Shape</option>
                                    @forelse ($case_shapes as $shape)
                                        <option value="{{ $shape->id }}">
                                            {{ $shape->title }}
                                        </option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
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

@push('scripts')
    <script>
        $(document).ready(function() {

            find_cases();

            function find_cases() {
                var path = "{{ route('admin.settings.workshops.cases.frame.cases.index') }}";
                $('#casesData').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": path,
                    'responsive': true,
                    'autoWidth': false,
                    "columns": [{
                            data: 'code',
                            name: 'code'
                        },
                        {
                            data: 'color',
                            name: 'color'
                        },
                        {
                            data: 'size',
                            name: 'size'
                        },
                        {
                            data: 'shape',
                            name: 'shape'
                        },
                        {
                            data: 'actions',
                            name: 'actions',
                            orderable: false,
                            searchable: false
                        }
                    ]
                });
            }


            $(document).on('click', '#newCaseBtn', function(e) {
                e.preventDefault();
                $('#newCaseModal').modal('show');
                $('#newCaseForm').trigger("reset");
            });

            $('#newCaseForm').submit(function(e) {
                e.preventDefault();
                let form = $(this);
                let formData = new FormData(form[0]);
                let path = '{{ route('admin.settings.workshops.cases.frame.cases.store') }}';
                $.ajax({
                    type: "POST",
                    url: path,
                    data: formData,
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        form.find('button[type=submit]').html(
                            '<i class="fa fa-spinner fa-spin"></i>');
                        form.find('button[type=submit]').attr('disabled', true);
                    },
                    complete: function() {
                        form.find('button[type=submit]').html('Save');
                        form.find('button[type=submit]').attr('disabled', false);
                    },
                    success: function(data) {
                        if (data['status']) {
                            toastr.success(data['message']);
                            $('#newCaseModal').modal('hide');
                            $('#newCaseForm')[0].reset();
                            $('#casesData').DataTable().ajax.reload();
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

            $(document).on('click', '.deleteCaseBtn', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this record!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        let case_id = $(this).data('id');
                        let path =
                            '{{ route('admin.settings.workshops.cases.frame.cases.delete', ':id') }}';
                        path = path.replace(':id', case_id);
                        let token = '{{ csrf_token() }}';
                        $.ajax({
                            url: path,
                            type: "DELETE",
                            data: {
                                _token: token,
                            },
                            dataType: "json",
                            success: function(data) {
                                if (data['status']) {
                                    Swal.fire(data['message'], '', 'success')
                                    $('#casesData').DataTable().ajax.reload();
                                }
                            }
                        });
                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info');
                    }
                });
            });

            $(document).on('click', '.updateCaseBtn', function(e) {
                e.preventDefault();
                let case_id = $(this).data('id');
                let path = '{{ route('admin.settings.workshops.cases.frame.cases.show', ':id') }}'
                path = path.replace(':id', case_id);
                $.ajax({
                    type: "GET",
                    url: path,
                    dataType: "json",
                    success: function(data) {
                        if (data['status']) {
                            $('#updateCaseModal').modal('show');
                            $('#updateCaseId').val(data['data']['id']);
                            $('#updateCaseCode').val(data['data']['code']);
                            $('#updateCaseColor').val(data['data']['color_id']).trigger('change');
                            $('#updateCaseSize').val(data['data']['size_id']).trigger('change');
                            $('#updateCaseShape').val(data['data']['shape_id']).trigger('change');
                        }
                    }
                });
            });

            $('#updateCaseForm').submit(function(e) {
                e.preventDefault();
                let form = $(this);
                let formData = new FormData(form[0]);
                let case_id = $('#updateCaseId').val();
                let path = '{{ route('admin.settings.workshops.cases.frame.cases.update', ':id') }}';
                path = path.replace(':id', case_id);
                $.ajax({
                    type: "POST",
                    url: path,
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        form.find('button[type=submit]').html(
                            '<i class="fa fa-spinner fa-spin"></i>');
                        form.find('button[type=submit]').attr('disabled', true);
                    },
                    complete: function() {
                        form.find('button[type=submit]').html('Save');
                        form.find('button[type=submit]').attr('disabled', false);
                    },
                    success: function(data) {
                        if (data['status']) {
                            toastr.success(data['message']);
                            $('#updateCaseModal').modal('hide');
                            $('#updateCaseForm')[0].reset();
                            $('#casesData').DataTable().ajax.reload();
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
