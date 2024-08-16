<script>
    $(document).ready(function() {

        $('[data-mask]').inputmask();


        $("#submittedData").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["excel", "print", "colvis"],
            "pageLength": 10
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        $("#paymentsData").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["excel", "print", "colvis"],
            "pageLength": 10
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        $("#receivedData").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["excel", "print", "colvis"],
            "pageLength": 10
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        $(document).on('click', '#newBankingBtn', function(e) {
            e.preventDefault();
            $("#newBankingModal").modal('show');
            $('#newBankingForm').trigger("reset");
        });

        $(document).on('change', '#newBankingInsurance', function(e) {
            e.preventDefault();
            let insurance_id = $(this).val();
            let path = '{{ route('admin.banking.get.remmittance', ':id') }}';
            path = path.replace(':id', insurance_id);
            $.ajax({
                type: "GET",
                url: path,
                dataType: "json",
                success: function(data) {
                    if (data['status']) {
                        $('#newBankingReceivedRemmittance').empty();
                        $.each(data['data'], function(key, value) {
                            console.log(value);
                            $('#newBankingReceivedRemmittance').append(
                                '<option value="' + value.id + '">' + value
                                .payment_bill.patient.first_name + ' ' + value
                                .payment_bill.patient.last_name + '</option>');
                        });
                    }
                }
            });
        });

        $('#newBankingForm').submit(function(e) {
            e.preventDefault();
            let path = '{{ route('admin.banking.store') }}';
            let form = $(this);
            let formData = new FormData(form[0]);
            $.ajax({
                type: "POST",
                url: path,
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                beforeSend: function() {
                    form.find('button[type=submit]').html(
                        '<i class="fa fa-spinner fa-spin"></i>'
                    );
                    form.find('button[type=submit]').attr('disabled', true);
                },
                complete: function() {
                    form.find('button[type=submit]').html(
                        'Save'
                    );
                    form.find('button[type=submit]').attr('disabled', false);
                },
                success: function(data) {
                    if (data['status']) {
                        toastr.success(data['message']);
                        $("#newBankingModal").modal('hide');
                        $('#newBankingForm').trigger("reset");
                        setTimeout(() => {
                            location.reload();
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
