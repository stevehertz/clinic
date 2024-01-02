@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            {{ $page_title }}
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
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="framesData" class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Transfered Date</th>
                                            <th>Frame Code</th>
                                            <th>Clinic</th>
                                            <th>Quantity</th>
                                            <th>Received By</th>
                                            <th>Transered By</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <!--/.table-responsive -->
                        </div>
                        <!--/.card-body -->
                    </div>
                    <!--/.card -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
        <!--/.container-fluid -->
    </section>
    <!--/.content -->
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

        });
    </script>
@endpush
