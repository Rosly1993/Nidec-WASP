$(document).ready(function () {
    var table = $('#items_table').DataTable({
        "ajax": "./dashboards/get_areas",
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
                data: 'file_name_column',
                className: 'py-0 px-1 text-center',
                render: function(data, type, row, meta) {
                    // Assuming the 'attachment' field contains the full URL to the PDF file
                    if (data) {
                        // Extract the filename from the URL
                        var filename = data.substring(data.lastIndexOf('/') + 1);
                        return '<a href="/Nidec-WASP/uploads/' + filename + '" class="pdf-link" target="_blank"><i class="fa fa-file-pdf fa-2x deletebtn"></i></a>';
                    } else {
                        return ''; // Empty string if no attachment
                    }
                }
            }
        ],
        "responsive": true,
        "pageLength": 10
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
       
    ]    });
    table.buttons().container().appendTo($('.dataTables_length', table.wrapper));
    var barChart = null; // Store the chart instance globally

    // Function to fetch and update the bar chart
    function updateBarChart() {
        table.ajax.reload(function (json) {
            var fullnameSum = {};

            // Aggregate hour_difference by fullname
            json.data.forEach(function (item) {
                if (fullnameSum[item.fullname]) {
                    fullnameSum[item.fullname] += parseFloat(item.hour_difference);
                } else {
                    fullnameSum[item.fullname] = parseFloat(item.hour_difference);
                }
            });

            // Convert the object into an array and sort, slice for top 10
            var chartData = Object.keys(fullnameSum).map(function (key) {
                return { fullname: key, total_hours: fullnameSum[key] };
            }).sort(function (a, b) {
                return b.total_hours - a.total_hours;
            }).slice(0, 15);

            // Destroy existing chart if it exists
            if (barChart) {
                barChart.destroy();
            }

            // Create chart
            var ctx = document.getElementById('fullnameBarChart').getContext('2d');
            barChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: chartData.map(function (data) { return data.fullname; }),
                    datasets: [{
                        label: 'Total Hours',
                        data: chartData.map(function (data) { return data.total_hours; }),
                        backgroundColor: [
                           
                            '#008000', // Accept - HEX color
                          
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    }

    // Load and update the chart when data is loaded
    updateBarChart();

    // Re-fetch and update chart data on filter apply
    $('#filterBtn').on('click', function (e) {
        e.preventDefault();
        var division = $('#division').val();
        var date_ot = $('#date_ot').val();
        table.ajax.url("./dashboards/get_areas?division=" + division + "&date_ot=" + date_ot).load(updateBarChart);
    });
    
});
  
