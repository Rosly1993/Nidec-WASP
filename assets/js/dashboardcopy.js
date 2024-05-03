

$(document).ready(function () {
    // DataTable initialization
    var table = $('#items_table').DataTable({
        "ajax": "./dashboards/get_areas",
        // "ajax": {
        //     url: "../areas/get_areas",
        //     method: 'POST'
        // },
        "columns": [
            {
                data: 'id',
                className: 'py-0 px-1 text-center font-size-14'
            },
            {
                data: 'area',
                className: 'py-0 px-1 text-center font-size-14'
            },
            {
                data: 'location',
                className: 'py-0 px-1 text-center font-size-14'
            },
            {
                data: 'type',
                className: 'py-0 px-1 text-center font-size-14'
            },
            {
                data: 'activity',
                className: 'py-0 px-1 text-center font-size-14'
            },
            {
                data: 'details',
                className: 'py-0 px-1 text-center font-size-14'
            },
            {
                data: 'impact_type',
                className: 'py-0 px-1 text-center font-size-14'
            },
            {
                data: 'before',
                className: 'py-0 px-1 text-center font-size-14'
            },
            {
                data: 'after',
                className: 'py-0 px-1 text-center font-size-14'
            },
            {
                data: 'savings_with_uom',
                className: 'py-0 px-1 text-center font-size-14'
            },
            {
                data: 'target_date',
                className: 'py-0 px-1 text-center font-size-14'
            },
            {
                data: 'level2_pic',
                className: 'py-0 px-1 text-center font-size-14'
            },
            {
                "data": "level2_status",
                "className": "py-0 px-1 text-center font-size-14",
                "render": function(data, type, row) {
                    if (type === 'display') {
                        let className = '';
                        if (data === 'Plan') {
                            className = 'status-plan';
                        } else if (data === 'Done') {
                            className = 'status-done';
                        } else if (data === 'Ongoing') {
                            className = 'status-ongoing';
                        }
                        return '<span class="' + className + '">' + data + '</span>';
                    }
                    return data;
                }
            },
            
            // {
            //     data: 'id',
            //     orderable: false,
            //     className: 'text-center font-size-14 py-0 px-1',
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
        
        
        
        "pageLength": 10,

        "createdRow": function(row, data, dataIndex) {
            // Apply the class to the row based on the condition
            if (data.level2_status === 'Plan') {
                $(row).find('td:eq(12)').addClass('status-plan');
            } else if (data.level2_status === 'Done' || data.level2_status === 'Accept') {
                $(row).find('td:eq(12)').addClass('status-done');
            } else if (data.level2_status === 'Ongoing') {
                $(row).find('td:eq(12)').addClass('status-ongoing');
            }
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
            // {
            //     extend: 'excelHtml5',
            //     text: '<a class="text-white excelbtn"><i class="fa fa-file-excel  text-white"></i>&nbsp;&nbsp;Excel Download</a>',
            //     className: "buttontest",
            //     autoFilter: true,
            //     sheetName: 'Exported data',
            //     exportOptions: {
            //         columns: ':visible'
            //     },
            //     title: 'Traceability'
            // },
            // {
            //     extend: 'print',
            //     text: '<a class="text-white pdfbtn"><i class="fa fa-file-pdf text-white"></i>&nbsp;&nbsp;PDF Download</a>',
            //     className: "buttontest",
            //     autoFilter: true,
            //     orientation: 'landscape',
            //     sheetName: 'Exported data',
            //     exportOptions: {
            //         columns: ':visible'
            //     },
            //     title: 'Traceability'
            // }
        ]
    });
   // When the DataTable is initialized and data is loaded, update the counts and pie chart
   table.on('draw.dt', function () {
    var doneCount = table.rows().data().filter(function (row) {
        return row.level2_status === 'Done';
    }).length;

    var planCount = table.rows().data().filter(function (row) {
        return row.level2_status === 'Plan';
    }).length;

    var acceptCount = table.rows().data().filter(function (row) {
        return row.level2_status === 'Accept';
    }).length;
    var ongoingCount = table.rows().data().filter(function (row) {
        return row.level2_status === 'Ongoing';
    }).length;

    $('#done_count').text(doneCount); // Update the element with the done count
    $('#plan_count').text(planCount); // Update the element with the plan count
    $('#accept_count').text(acceptCount); // Update the element with the accept count
    $('#ongoing_count').text(ongoingCount); // Update the element with the accept count

//     // Create a pie chart
//     var ctx = document.getElementById('pieChart').getContext('2d');
//     var pieChart = new Chart(ctx, {
//         type: 'pie',
//         data: {
//             labels: ['Done', 'Plan', 'Accept',  'Ongoing'],
//             datasets: [{
//                 label: 'Number of Tasks',
//                 data: [doneCount, planCount, acceptCount, ongoingCount],
//                 backgroundColor: [
//                     '#FA7070', // Done - HEX color
//                     '#008DDA', // Plan - HEX color
//                     '#416D19',  // Accept - HEX color
//                     '#FFC700'  // Accept - HEX color
//                 ],
//                 borderColor: [
//                     '#FA7070', // Done - HEX color
//                     '#008DDA', // Plan - HEX color
//                     '#416D19',  // Accept - HEX color
//                     '#FFC700'  // Accept - HEX color
//                 ],
//                 borderWidth: 1
//             }]
//         },
//         options: {
//             responsive: true,
//             maintainAspectRatio: false,
//             legend: {
//                 position: 'top',
//             }
//         }
//     });
// });

// Create a donut chart
// Create a doughnut chart with labels inside segments
var ctx = document.getElementById('donutChart').getContext('2d');
var donutChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Done', 'Plan', 'Accept', 'Ongoing'],
        datasets: [{
            label: 'Number of Tasks',
            data: [doneCount, planCount, acceptCount, ongoingCount],
            backgroundColor: [
                '#4CCD99', // Done - HEX color
                '#008DDA', // Plan - HEX color
                '#416D19', // Accept - HEX color
                '#FFC700'  // Ongoing - HEX color
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        cutoutPercentage: 60, // Adjust the size of the center hole (optional)
        plugins: {
            doughnutlabel: {
                labels: [
                    {
                        text: 'Total',
                        font: {
                            size: '50'
                        },
                        color: '#000',
                        formatter: function (value, context) {
                            var sum = context.dataset.data.reduce((a, b) => a + b, 0);
                            return sum;
                        }
                    }
                ]
            }
        },
        legend: {
            display: false // Hide legend
        }
    }
});

});


    // Add the buttons to the layout
    table.buttons().container().appendTo($('.dataTables_length', table.wrapper));

    // ... Your existing code ...

    // Delegate click event to dynamically added elements
    $('#items_table tbody').on('click', '.edit_data', function () {
        var id = $(this).data('id');
        edit_data(id);
    });


});


