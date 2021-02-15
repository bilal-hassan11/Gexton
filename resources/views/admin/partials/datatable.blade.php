<style>
    .dataTables_wrapper>.row {
        justify-content: center;
        align-items: center;
    }

    .dataTables_wrapper .dt-buttons {
        margin-bottom: 10px;
    }

    .dt_table tr td,
    .dt_table tr th {
        vertical-align: middle;
    }

    .dt_table .table-img {
        width: 40px;
        height: 40px;
        object-fit: cover;
    }
</style>
<script src="{{ asset('admin_assets') }}/js/dataTable_bundled.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.60/pdfmake.min.js" crossorigin="anonymous"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.60/vfs_fonts.js" crossorigin="anonymous"></script>

<script>
    var dtable = $("table.table").DataTable({
        scrollX: false,
        responsive: true,
        lengthMenu: [
            [50, 100, 250, 500, -1],
            [50, 100, 250, 500, "All"]
        ],
        buttons: [
               {extend: 'copy',
                title: '',},
                {extend: 'csv',
                title: '',},
                {extend: 'excel',
                title: '',},
                {extend: 'pdf',
                title: '',},
                {extend: 'print',
                title: '',
                }
            ],
        language: {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'>",
                next: "<i class='mdi mdi-chevron-right'>"
            }
        },
        drawCallback: function() {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
        }
    });
    dtable.buttons().container().prependTo(".dataTables_wrapper .col-md-6:eq(0)");
</script>