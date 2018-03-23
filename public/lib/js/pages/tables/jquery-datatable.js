$(function () {
    var table = $('.js-listview-table').DataTable({
        // "ordering": true,
        // "pageLength": 10,
        // "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        // "order": [[0, "desc"]],
        // buttons: true,
        // buttons: [ 'copy', 'csv', 'print' ],
        "columnDefs": [
            {
                // The `data` parameter refers to the data for the cell (defined by the
                // `data` option, which defaults to the column being worked with, in
                // this case `data: 0`.
                "render": function ( data, type, row ) {
                    return "<a href=''>" + data + "</a>";
                    // return data +' ('+ row[3]+')';
                },
                 "targets": [0]
            },
            // { "visible": false,  "targets": [ 3 ] }
        ],
        // "columnDefs": [
        //     {
        //         "targets": -1,
        //         "data": null,
        //         "defaultContent": "<a class='btn btn-primary waves-effect'><i class='material-icons'>edit</i></a><a class='btn btn-warning waves-effect'><i class='material-icons'>delete</i></a>"
        //     },
        // ]
    });


    //Exportable table
    // $('.js-exportable').DataTable({
    //     dom: 'Bfrtip',
    //     buttons: [
    //         'copy', 'csv', 'excel', 'pdf', 'print'
    //     ]
    // });


});