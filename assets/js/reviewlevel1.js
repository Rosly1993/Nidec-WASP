

$(document).ready(function () {
    // DataTable initialization
    var table = $('#items_table').DataTable({
        "ajax": "../reviewlevel1/get_areas",
        "columns": [
            {
                data: 'id',
                className: 'py-0 px-1 text-center font-size-14'
            },
            {
                data: 'date_add',
                className: 'py-0 px-1 text-center font-size-14'
            },
            {
                data: 'control_number',
                className: 'py-0 px-1 text-center font-size-14'
            },
            {
                data: 'requested_by',
                className: 'py-0 px-1 text-center font-size-14'
            },
            {
                data: 'date_ot',
                className: 'py-0 px-1 text-left font-size-14'
            },
            {
                data: 'division',
                className: 'py-0 px-1 text-left font-size-14'
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
                data: 'purpose',
                className: 'py-0 px-1 text-center font-size-14'
            }, 
            {
                data: 'id',
                orderable: false,
                className: 'text-center font-size-14 py-0 px-1',
                render: function (data, type, row, meta) {
                    return '<a class="me-2 btn-sm editbtn rounded-0 py-0 edit_data" href="javascript:void(0)" data-id="' + (row.id) + '"><i class="ni ni-settings"></i></a>' ;
                }
            }
        ],
        "responsive": true,
        lengthMenu: [
            [10, 25, 50 ,100,  -1],
            [10, 25, 50 ,100,  "All"],
        ],
        
        "pageLength": 10,

    });

    // Buttons initialization
    new $.fn.dataTable.Buttons(table, {
        buttons: [
            
        ]
    });

    // Add the buttons to the layout
    table.buttons().container().appendTo($('.dataTables_length', table.wrapper));

    // Delegate click event to dynamically added elements
    $('#items_table tbody').on('click', '.edit_data', function () {
        var id = $(this).data('id');
        edit_data(id);
    });

   

    function edit_data(id) {
        // Fetch the current item details from the server
        $.ajax({
            url: "../reviewlevel1/get_area_details/" + id,
            type: "GET",
            dataType: "json",
            success: function (data) {
                // Log the data received from the server
                console.log("Data Received:", data);
    
                // Check if the response contains area_details
                if (data.area_details) {
                    var areaDetails = data.area_details;
                    var modalBody = $('#edit_modal .modal-body');
                    modalBody.empty(); // Clear previous content
    
                    // Create a table element
                    var tableHtml = '<table class="table table-bordered">';
                    // Add table header row
                    tableHtml += '<tr>';
                    tableHtml += '<th>ID</th>';
                    tableHtml += '<th>ID Number</th>';
                    tableHtml += '<th>Fullname</th>';
                    tableHtml += '<th>Date</th>';
                    tableHtml += '<th>Time</th>';
                    tableHtml += '<th>Status</th>';
                    tableHtml += '<th>Remarks</th>';
                    tableHtml += '</tr>';
                    // Add table rows for each data object
                    areaDetails.forEach(function (item, index) {
                        tableHtml += '<tr>';
                        tableHtml += '<td>' + item.id + '</td>';
                        tableHtml += '<td>' + item.id_number + '</td>';
                        tableHtml += '<td>' + item.fullname + '</td>';
                        tableHtml += '<td>' + item.date_ot + '</td>';
                        tableHtml += '<td>' + item.time_from + ' - ' + item.time_to + '</td>';
                        tableHtml += '<td><select name="status" style="height: 30px; border-radius: 5px; width: 100px"><option value="Level1 Approved">Approve</option><option value="Rejected">Reject</option></select></td>';
                        tableHtml += '<td><textarea name="remarks" style="height: 30px; border-radius: 5px; width: 100px"></textarea></td>';
                        tableHtml += '</tr>';
                        // Add more rows for other properties as needed
                    });
                    tableHtml += '</table>';
    
                    // Append the table to the modal body
                    modalBody.append(tableHtml);
    
                    // Add a single submit button
                    var submitButtonHtml = '<button class="btn btn-primary" id="submit-all">Submit</button>';
                    modalBody.append(submitButtonHtml);
    
                    // Show modal with pre-filled form fields
                    $('#edit_modal').modal('show');
    
                    // Add event listener for submit button
                    $('#submit-all').click(function() {
                        // Handle status update for all rows here
                        var statusUpdates = [];
                        $('select[name="status"]').each(function(index, element) {
                            var status = $(this).val();
                            var remarks = $(this).closest('tr').find('textarea[name="remarks"]').val();
                            var id = $(this).closest('tr').find('td:eq(0)').text(); // Assuming ID is in the first column
                            var rowData = {
                                id: id,
                                status: status,
                                remarks: remarks
                            };
                            statusUpdates.push(rowData);
                        });
                        console.log('Submitting status updates for all rows:', statusUpdates);
                        // Add AJAX call to update status for all rows here
                        updateStatus(statusUpdates);
                    });
                } else {
                    // Handle error or show a message if item details are not available
                    console.error('Failed to fetch item details.');
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", error);
                // Handle error or show a message
            }
        });
    }
    
    function updateStatus(statusUpdates) {
        $.ajax({
            url: "../reviewlevel1/update_status",
            type: "POST",
            dataType: "json",
            data: { status_updates: statusUpdates },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Successfully Transacted Data',
                    showConfirmButton: false,
                    timer: 1500
                });

                table.ajax.reload();
                $('#edit_modal').modal('hide');
                // console.log("Status updated successfully.");
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error("Error updating status:", error);
            }
        });
    }
});