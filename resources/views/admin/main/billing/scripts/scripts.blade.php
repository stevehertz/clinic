<script>
    $(document).ready(function() {

        find_all_closed_bills();

        function find_all_closed_bills() {
            let path = '{{ route('admin.billing.index') }}';
            $('#data').DataTable({
                processing: true,
                serverSide: true,
                ajax: path,
                columns: [{
                        data: "DT_RowIndex",
                        name: "DT_RowIndex"
                    },
                    {
                        data: 'clinic.clinic',
                        name: 'clinic.clinic'
                    },
                    {
                        data: 'appontment.lens_power.frame_prescription.receipt_number',
                        name: 'appontment.lens_power.frame_prescription.receipt_number'
                    },
                    {
                        data: 'patient',
                        name: 'patient'
                    },
                    {
                        data: 'invoice_number',
                        name: 'invoice_number'
                    },
                    {
                        data: 'appontment.patient.phone',
                        name: 'appontment.patient.phone'
                    },
                    {
                        data: 'insurance',
                        name: 'insurance'
                    },
                    {
                        data: 'payment_detail.scheme',
                        name: 'payment_detail.scheme'
                    },
                    {
                        data: 'appontment.patient.card_number',
                        name: 'appontment.patient.card_number'
                    },
                    {
                        data: 'close_date',
                        name: 'close_date'
                    },
                    {
                        data: 'paid_amount',
                        name: 'paid_amount'
                    },
                    {
                        data: 'document_status',
                        name: 'document_status'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    }
                ],
                "autoWidth": false,
                "responsive": true,
            });
        }

    });
</script>
