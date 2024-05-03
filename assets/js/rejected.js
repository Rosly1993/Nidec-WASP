

$(document).ready(function () {
    var table = $('#items_table').DataTable({
        "ajax": "../rejected/get_areas",
       
        "columns": [
            {
                data: 'id',
                className: 'py-0 px-1 text-center'
            },
            {
                data: 'date_add',
                className: 'py-0 px-1 text-center'
            },
            {
                data: 'division',
                className: 'py-0 px-1 text-center'
            },
            {
                data: 'area',
                className: 'py-0 px-1 text-center'
            },
            {
                data: 'location',
                className: 'py-0 px-1 text-left'
            },
           
            {
                data: 'category',
                className: 'py-0 px-1 text-center'
            },
            {
                data: 'purpose',
                className: 'py-0 px-1 text-center'
            },
            {
                data: 'id_number',
                className: 'py-0 px-1 text-center'
            },
            {
                data: 'fullname',
                className: 'py-0 px-1 text-center'
            },
            {
                data: 'date_ot',
                className: 'py-0 px-1 text-left'
            },
            {
                data: 'time_from',
                className: 'py-0 px-1 text-center'
            },
            {
                data: 'time_to',
                className: 'py-0 px-1 text-center'
            },
            {
                data: 'hour_difference',
                className: 'py-0 px-1 text-center'
            },
            {
                data: 'remarks',
                className: 'py-0 px-1 text-center'
            },
           
            
            // {
            //     data: 'id',
            //     orderable: false,
            //     className: 'text-center py-0 px-1',
            //     render: function (data, type, row, meta) {
            //         return '<a class="me-2 btn-sm editbtn rounded-0 py-0 edit_data" href="javascript:void(0)" data-id="' + (row.id) + '"><i class="ni ni-settings"></i></a>' ;
            //     }
            // }
        ],
        "responsive": true,
        lengthMenu: [
            [10, 25, 50 ,100,  -1],
            [10, 25, 50 ,100,  "All"],
        ],
        
        "searching": false, // Turn off default search since custom filtering is used
        "pageLength": -1,
        "language": {
            "emptyTable": "Please use the filter to display data"
        }

       
    });

    // Buttons initialization
    new $.fn.dataTable.Buttons(table, {
        buttons: [
            // {
            //     text: '<a class="text-white addbtn"><i class="fas fa-plus text-white "></i>&nbsp; Create Ticket</a>',
            //     className: "buttontest",
            //     action: function (e, dt, node, config) {
            //         $('#add_model').modal('show');
            //     }
            // },
            {
                extend: 'excelHtml5',
                text: '<a class="text-white excelbtn"><i class="fa fa-file-excel  text-white"></i>&nbsp;&nbsp;Excel Download</a>',
                className: "buttontest",
                autoFilter: true,
                sheetName: 'Exported data',
                exportOptions: {
                    columns: ':visible'
                },
                title: 'Nidec-WASP'
            },
           
        ]
    });

    // Add the buttons to the layout
    table.buttons().container().appendTo($('.dataTables_length', table.wrapper));

  // Load data on filter button click
  $('#filterBtn').on('click', function (e) {
    e.preventDefault(); // prevent the default form submission

    var division = $('#division').val();
    var date_ot = $('#date_ot').val();

    // Reinitialize the DataTable with new ajax url including parameters
    table.ajax.url("../rejected/get_areas?division=" + division + "&date_ot=" + date_ot).load();
});
});


