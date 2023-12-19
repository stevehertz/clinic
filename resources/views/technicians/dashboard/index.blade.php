 @extends('technicians.layouts.app')

 @section('content')
     <!-- Content Header (Page header) -->
     <div class="content-header">
         <div class="container-fluid">
             <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1 class="m-0 text-dark">{{ $workshop->name }}</h1>
                 </div><!-- /.col -->
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item">
                             <a href="{{ route('admin.dashboard.index', $workshop->id) }}">Home</a>
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
                             <h3>{{ $sum_lenses }}</h3>

                             <p>Lenses</p>
                         </div>
                         <div class="icon">
                             <i class="ion ion-bag"></i>
                         </div>
                         <a href="{{ route('technicians.lens.index') }}" class="small-box-footer">
                            More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                     </div>
                 </div>
                 <!-- ./col -->

                 <div class="col-lg-3 col-6">
                     <!-- small box -->
                     <div class="small-box bg-success">
                         <div class="inner">
                             <h3>{{ count($orders) }}</h3>

                             <p>Orders</p>
                         </div>
                         <div class="icon">
                             <i class="ion ion-stats-bars"></i>
                         </div>
                         <a href="{{ route('technicians.orders.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                     </div>
                 </div>
                 <!-- ./col -->

                 <div class="col-lg-3 col-6">
                     <!-- small box -->
                     <div class="small-box bg-warning">
                         <div class="inner">
                             <h3>{{ $num_sales }}</h3>

                             <p>Sales</p>
                         </div>
                         <div class="icon">
                             <i class="ion ion-person-add"></i>
                         </div>
                         <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                     </div>
                 </div>
                 <!-- ./col -->

             </div>
             <!-- /.row -->

             <div class="row">
                 <div class="col-md-12">
                     <div class="card">
                         <div class="card-body table-responsive">
                             <table id="ordersData" class="table table-striped table-bordered table-valign-middle">
                                 <thead>
                                     <tr>
                                        <th></th>
                                         <th>Date</th>
                                         <th>Receipt Number</th>
                                         <th>Patient</th>
                                         <th>Clinic</th>
                                         <th>Status</th>
                                         <th>View</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                 </tbody>
                             </table>
                         </div>
                     </div>
                     <!-- /.card -->
                 </div>

             </div>
             <!-- /.row -->

         </div>
         <!--.container-fluid -->
     </div>
 @endsection

 @section('scripts')
     <script>
         $(document).ready(function() {

             find_orders();

             function find_orders() {
                 let path = '{{ route('technicians.dashboard.index') }}';
                 $('#ordersData').DataTable({
                     processing: true,
                     serverSide: true,
                     ajax: path,
                     columns: [{
                             data: "DT_RowIndex",
                             name: "DT_RowIndex"
                         },
                         {
                             data: 'order_date',
                             name: 'order_date'
                         },
                         {
                             data: 'receipt_number',
                             name: 'receipt_number'
                         },
                          {
                              data: 'patient',
                              name: 'patient'
                          },
                         {
                             data: 'clinic',
                             name: 'clinic'
                         },
                         {
                             data: 'status',
                             name: 'status'
                         },
                         {
                             data: 'view',
                             name: 'view',
                             orderable: false,
                             searchable: false
                         },
                     ],
                     "responsive": true,
                     "autoWidth": false,
                     "searching": false,
                     "ordering": false,
                     "lengthChange": false,
                 });
             }

             $(document).on('click', '.viewOrderBtn', function(e) {
                 e.preventDefault();
                 let order_id = $(this).data('id');
                 let path = '{{ route('technicians.orders.show', ':id') }}';
                 path = path.replace(':id', order_id);
                 let token = '{{ csrf_token() }}';
                 $.ajax({
                     type: "POST",
                     url: path,
                     data: {
                         _token: token
                     },
                     dataType: "json",
                     success: function(data) {
                         if (data['status']) {
                             let order_url = '{{ route('technicians.orders.view', ':id') }}';
                             order_url = order_url.replace(':id', data['data']['id']);
                             setTimeout(() => {
                                 window.location.href = order_url;
                             }, 1000);
                         }
                     }
                 });
             });

         });
     </script>
 @endsection
