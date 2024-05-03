

$(document).ready(function () {
    // DataTable initialization
    var table = $('#items_table').DataTable({
        "ajax": "../ireporter/get_areas",
       
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
                className: 'py-0 px-1 text-left font-size-14'
            },
            {
                data: 'details',
                className: 'py-0 px-1 text-left font-size-14'
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
                data: 'attachment',
                className: 'py-0 px-1 text-center font-size-14',
                render: function(data, type, row, meta) {
                    // Assuming the 'attachment' field contains the full URL to the PDF file
                    if (data) {
                        // Extract the filename from the URL
                        var filename = data.substring(data.lastIndexOf('/') + 1);
                        return '<a href="/WENDS/uploads/' + filename + '" class="pdf-link" target="_blank"><i class="fa fa-file-pdf fa-2x deletebtn"></i></a>';
                    } else {
                        return ''; // Empty string if no attachment
                    }
                }
            },
            {
                "data": "customized_level2_status",
                "className": "py-0 px-1 text-center font-size-14",
                "render": function(data, type, row) {
                    if (type === 'display') {
                        let label = '';
                        if (data === 'Plan') {
                            label = 'Plan';
                        } else if (data === 'Done' || data === 'Ongoing') {
                            label = 'Ongoing';
                        } else if (data === 'Accept') {
                            label = 'Accept';
                        }
                        return label;
                    }
                    return data;
                }
            }
            
            
           
        ],
        "responsive": true,
        lengthMenu: [
            [10, 25, 50 ,100,  -1],
            [10, 25, 50 ,100,  "All"],
        ],
        
        
        
        "pageLength": 10,

        "createdRow": function(row, data, dataIndex) {
            // Apply the class to the row based on the condition
            if (data.customized_level2_status === 'Plan') {
                $(row).find('td:eq(13)').addClass('status-plan');
            } else if (data.customized_level2_status === 'Done' || data.customized_level2_status === 'Accept') {
                $(row).find('td:eq(13)').addClass('status-done');
            } else if (data.customized_level2_status === 'Ongoing') {
                $(row).find('td:eq(13)').addClass('status-ongoing');
            }
        }
    });

    // Buttons initialization
    new $.fn.dataTable.Buttons(table, {
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<a class="text-white excelbtn"><i class="fa fa-file-excel  text-white"></i>&nbsp;&nbsp;Excel Download</a>',
                className: "buttontest",
                autoFilter: true,
                sheetName: 'Exported data',
                exportOptions: {
                    columns: ':visible'
                },
                title: 'WENDS'
            },
           
        ]
    });

    table.buttons().container().appendTo($('.dataTables_length', table.wrapper));

table.on('draw.dt', function () {
 // Aggregate counts for each area
var areaCounts = {};
table.rows().data().each(function(row) {
    if (row.type === 'IREPORTER') {
        if (!areaCounts[row.area]) {
            areaCounts[row.area] = {
                Plan: 0,
                Ongoing: 0,
                // Done: 0,
                Accept: 0
            };
        }
        switch (row.customized_level2_status) {
            // case 'Done':
            //     areaCounts[row.area].Done++;
            //     break;
            case 'Plan':
                areaCounts[row.area].Plan++;
                break;
            case 'Accept':
                areaCounts[row.area].Accept++;
                break;
            case 'Ongoing':
                areaCounts[row.area].Ongoing++;
                break;
        }
    }
});

// Sort areaCounts by the total number of tasks in ascending order
var sortedAreas = Object.keys(areaCounts).sort(function(b, a) {
    var totalTasksA = areaCounts[a].Plan + areaCounts[a].Ongoing + areaCounts[a].Accept;
    var totalTasksB = areaCounts[b].Plan + areaCounts[b].Ongoing + areaCounts[b].Accept;
    return totalTasksA - totalTasksB;
});

// Update bar chart based on area counts
updateBarChart('barChartCanvasId', sortedAreas, areaCounts);

// Function to update the grouped stacked bar chart
function updateBarChart(canvasId, sortedAreas, areaCounts) {
    var ctx = document.getElementById(canvasId).getContext('2d');
    var labels = sortedAreas;
    var datasets = [];

    // Create datasets for each status
    var statuses = ['Plan', 'Ongoing', 'Accept'];
    statuses.forEach(function(status) {
        var data = [];
        labels.forEach(function(area) {
            data.push(areaCounts[area][status]);
        });
        datasets.push({
            label: status,
            data: data,
            backgroundColor: (status === 'Plan') ? '#008DDA' :
                // (status === 'Plan') ? '#008DDA' :
                (status === 'Accept') ? '#008000' :
                '#FFC700'
        });
    });

    var barChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: datasets
        },
        options: {
            scales: {
                x: {
                    stacked: true // Stack bars horizontally
                },
                y: {
                    stacked: true // Stack bars vertically
                }
            },
            responsive: true,
            maintainAspectRatio: false
        }
    });
}


// Calculate counts for RPA type


var rpaPlanCount = table.rows().data().filter(function (row) {
    return row.customized_level2_status === 'Plan' && row.type === 'IREPORTER';
}).length;

var rpaAcceptCount = table.rows().data().filter(function (row) {
    return row.customized_level2_status === 'Accept' && row.type === 'IREPORTER';
}).length;

var rpaOngoingCount = table.rows().data().filter(function (row) {
    return row.customized_level2_status === 'Ongoing' && row.type === 'IREPORTER';
}).length;

// Update elements for RPA type

$('#plan_count').text(rpaPlanCount);
$('#accept_count').text(rpaAcceptCount);
$('#ongoing_count').text(rpaOngoingCount);

// Total count of RPA tasks
var totalRPATasks = rpaPlanCount + rpaAcceptCount + rpaOngoingCount;

// Calculate percentages

var planPercentage = (rpaPlanCount / totalRPATasks) * 100;
var acceptPercentage = (rpaAcceptCount / totalRPATasks) * 100;
var acceptPercentage1 = (rpaAcceptCount / totalRPATasks) * 100;
var ongoingPercentage = (rpaOngoingCount / totalRPATasks) * 100;


// Update elements for percentages

$('#plan_percentage').text(planPercentage.toFixed(2) + "%");
$('#accept_percentage').text(acceptPercentage.toFixed(2) + "%");
$('#accept_percentage1').text(acceptPercentage1.toFixed(2) + "%");
$('#ongoing_percentage').text(ongoingPercentage.toFixed(2) + "%");
 
  
});

    



    // ... Your existing code ...

    // Delegate click event to dynamically added elements
    $('#items_table tbody').on('click', '.edit_data', function () {
        var id = $(this).data('id');
        edit_data(id);
    });

});



