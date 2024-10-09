@if (Route::is('admin.banking.index'))
    <script>
        $(document).ready(function() {

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
                            let bankingPath = '{{ route('admin.banking.view', ':id') }}';
                            bankingPath = bankingPath.replace(':id', data['bank_id']);
                            setTimeout(() => {
                                window.location.href = bankingPath;
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

            let selectedRemittanceIds = [];

            $(document).on('change', '.submitRemmittanceCheckBox', function(e) {
                e.preventDefault();
                selectedRemittanceIds = [];
                // Track checkbox selections
                $('.submitRemmittanceCheckBox:checked').each(function() {
                    selectedRemittanceIds.push($(this).val());
                });
                // Show or hide the submit button
                if (selectedRemittanceIds.length > 0) {
                    $('.receivePaymentsBtnRow').fadeIn();
                } else {
                    $('.receivePaymentsBtnRow').fadeOut();
                }

            });

            // Open the modal when the submit button is clicked
            $(document).on('click', '.receivePaymentsBtn', function(e) {
                e.preventDefault();
                $('#newBankingModal').modal('show');
            });

            $('#newBankingForm').submit(function(e) {
                e.preventDefault();

                let form = $(this);
                let formData = new FormData(form[0]);

                // Append the selected remittance IDs
                selectedRemittanceIds.forEach(function(id) {
                    formData.append('remmittance_id[]',
                        id); // Ensure `[]` is added to handle multiple IDs
                });

                // Debug: Log the FormData contents to ensure remmittance_id is being appended
                for (let pair of formData.entries()) {
                    console.log(pair[0] + ', ' + pair[1]);
                }

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.banking.store') }}",
                    data: formData,
                    dataType: "json",
                    processData: false, // Required for FormData
                    contentType: false, // Required for FormData
                    beforeSend: function() {
                        $(this).find('button[type=submit]').html(
                            '<i class="fa fa-spinner fa-spin"></i>'
                        );
                        $(this).find('button[type=submit]').attr('disabled', true);
                    },
                    complete: function() {
                        $(this).find('button[type=submit]').html(
                            'Save'
                        );
                        $(this).find('button[type=submit]').attr('disabled', false);
                    },
                    success: function(data) {
                        if (data['status']) {

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
@endif
