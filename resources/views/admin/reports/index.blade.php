@extends('admin.layouts.temp')

@section('content')
    

    
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            find_reports();

            

            $(document).on('click', '#filter', function(e) {
                e.preventDefault();
                var from_date = $('#fromDate').val();
                var to_date = $('#toDate').val();
                if (from_date != '' && to_date != '') {
                    $('#reportsData').DataTable().destroy();
                    find_reports(from_date, to_date);
                } else {
                    toastr.error('Both Date is required');
                }
            });

            $(document).on('click', '#refresh', function(e) {
                e.preventDefault();
                $('#fromDate').val('');
                $('#toDate').val('')
                $('#reportsData').DataTable().destroy();
                find_reports();
            });

        });
    </script>
@endsection
