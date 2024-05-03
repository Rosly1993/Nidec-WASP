

$(document).ready(function () {
    // DataTable initialization
    var table = $('#items_table').DataTable({
        "ajax": "../createtickets/get_areas",
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

        "createdRow": function(row, data, dataIndex) {
            // Apply the class to the row based on the condition
            if (data.level2_status === 'Plan') {
                $(row).find('td:eq(13)').addClass('status-plan');
            } else if (data.level2_status === 'Done') {
                $(row).find('td:eq(13)').addClass('status-done');
            } else if (data.level2_status === 'Ongoing') {
                $(row).find('td:eq(13)').addClass('status-ongoing');
            }
        }
    });

    // Buttons initialization
    new $.fn.dataTable.Buttons(table, {
        buttons: [
            {
                text: '<a class="text-white addbtn1"><i class="fas fa-plus text-white "></i>&nbsp; Create Activity</a>',
                className: "buttontest",
                action: function (e, dt, node, config) {
                    $('#add_model').modal('show');
                }
            },
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

    // Add the buttons to the layout
    table.buttons().container().appendTo($('.dataTables_length', table.wrapper));

    // ... Your existing code ...

    // Delegate click event to dynamically added elements
    $('#items_table tbody').on('click', '.edit_data', function () {
        var id = $(this).data('id');
        edit_data(id);
    });

//     

function validateForm() {
    var isValid = true; // Initialize form validity as true

    // Clear previous error highlights
    $('.error-highlight').removeClass('error-highlight');

    // Helper function to highlight and invalidate
    function highlightAndInvalidate(selector) {
        $(selector).addClass('error-highlight');
        isValid = false; // Mark form as invalid
    }

    // Validation checks
    if ($('#type').val().trim() === '') {
        highlightAndInvalidate('#type');
    }
    if ($('#activity').val().trim() === '') {
        highlightAndInvalidate('#activity');
    }
    if ($('#details').val().trim() === '') {
        highlightAndInvalidate('#details');
    }
    if ($('#impact_type').val().trim() === '') {
        highlightAndInvalidate('#impact_type');
    }
    if ($('#before').val().trim() === '') {
        highlightAndInvalidate('#before');
    }
    if ($('#after').val().trim() === '') {
        highlightAndInvalidate('#after');
    }
   
    if ($('#level2_status').val().trim() === '') {
        highlightAndInvalidate('#level2_status');
    }
    if ($('#target_date').val().trim() === '') {
        highlightAndInvalidate('#target_date');
    }
    if ($('#attachment').val().trim() === '') {
        highlightAndInvalidate('#attachment');
    }

    // Validation check for 'before' value being greater than 'after'
    var beforeValue = parseFloat($('#before').val().trim()); // Parse 'before' value to float
    var afterValue = parseFloat($('#after').val().trim()); // Parse 'after' value to float
    if (!isNaN(beforeValue) && !isNaN(afterValue) && beforeValue < afterValue) {
        // If both are numbers and 'before' is greater than 'after', invalidate both
        highlightAndInvalidate('#before');
        highlightAndInvalidate('#after');
    }

    return isValid; // Return the form's validity status
}


function addArea() {
    if (!validateForm()) return; // validate the form before proceeding
    var type = $('#type').val();
    var activity = $('#activity').val();
    var details = $('#details').val();
    var impact_type = $('#impact_type').val();
    var before = $('#before').val();
    var after = $('#after').val();
    var target_date = $('#target_date').val();
    var level2_status = $('#level2_status').val();

    // Get the attachment file
    var attachment = $('#attachment')[0].files[0];

    // Create form data to send all data including the attachment
    var formData = new FormData();
    formData.append('type', type);
    formData.append('activity', activity);
    formData.append('details', details);
    formData.append('impact_type', impact_type);
    formData.append('before', before);
    formData.append('after', after);
    formData.append('target_date', target_date);
    formData.append('level2_status', level2_status);
    formData.append('attachment', attachment);

    $.ajax({
        url: "../createtickets/add_area",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function(data) {
            if (data.status == 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: data.message,
                    showConfirmButton: false,
                    timer: 1500
                });

                table.ajax.reload();
                $('#add_model').modal('hide');
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Only PDF allowed',
                    text: data.message
                });
            }
        },
        error: function(xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Failed to add area. Please try again later.'
            });
        }
    });
}

$(document).on('click', '#saveChangesBtn', function(event) {
    event.preventDefault();
    addArea();
});


// Function to handle edit_data
function edit_data(id) {
// Fetch the current item details from the server
$.ajax({
url: "../createtickets/get_area_details/" + id,
type: "GET",
dataType: "json",
success: function (data) {
// Log the data received from the server
console.log("Data Received:", data);

// Check if the response contains line_details
if (data.area_details) {
    var existingId = data.area_details.id;
    var existingType = data.area_details.type;
    var existingActivity = data.area_details.activity;
    var existingDetails = data.area_details.details;
    var existingActivity = data.area_details.activity;
    var existingImpacttype = data.area_details.impact_type;
    var existingBefore = data.area_details.before;
    var existingAfter = data.area_details.after;
    var existingTargetdate = data.area_details.target_date;
    // var existingUom = data.area_details.uom;
    var existingLevel2status = data.area_details.level2_status;
   
    // Log the existing data
    // console.log("Existing Line:", existingId);
    // console.log("Existing Area:", existingArea);
    // console.log("Existing Location:", existingLocation);

    // Populate form fields in the modal with existing data
    $('#edit_id').val(existingId);
    $('#edit_type').val(existingType);
    $('#edit_activity').val(existingActivity);
    $('#edit_details').val(existingDetails);
    $('#edit_impact_type').val(existingImpacttype);
    $('#edit_before').val(existingBefore);
    $('#edit_after').val(existingAfter);
    $('#edit_target_date').val(existingTargetdate);
    // $('#edit_uom').val(existingUom);
    $('#edit_level2_status').val(existingLevel2status);


    // Show modal with pre-filled form fields
    $('#edit_modal').modal('show');
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

// Bind click event to the "Save Changes" button within the modal
$('#updateChangesBtn').click(function(event) {
// Prevent the default form submission behavior
event.preventDefault();

 // Reset any previous error styles and messages
 $('.validation-error').css('border', ''); // Reset borders

 var isValid = true;
 
 // Get the form data
 var formData = {
     id: $('#edit_id').val(),
     type: $('#edit_type').val(),
     activity: $('#edit_activity').val(),
     details: $('#edit_details').val(),
     impact_type: $('#edit_impact_type').val(),
     before: $('#edit_before').val(),
     after: $('#edit_after').val(),
     target_date: $('#edit_target_date').val(),
     level2_status: $('#edit_level2_status').val(),
    //  attachment: $('#attachment').val()
 };
 
 // Validate non-empty fields
 Object.keys(formData).forEach(function(key) {
     if (formData[key].trim() === '') {
         $('#edit_' + key).css('border', '2px solid red');
         isValid = false;
     }
 });
 
 // Additional Validation: Check if 'before' is greater than 'after'
 var beforeValue = parseFloat(formData.before);
 var afterValue = parseFloat(formData.after);
 if (!isNaN(beforeValue) && !isNaN(afterValue) && beforeValue < afterValue) {
     $('#edit_before, #edit_after').css('border', '2px solid red'); // Highlight both fields
     isValid = false;
 }
 
 // Only proceed if all fields are valid
 if (!isValid) {
     // Focus the first element with a red border
     $('input[style*="border: 2px solid red"]').first().focus();
     // Optionally, show a generic error message
     // $('#error_message').text('Please correct the highlighted fields.').css('color', 'red');
     return false; // Prevent form submission or further processing
 }
 

// Perform an AJAX request to save the edited data
$.ajax({
url: "../createtickets/update_area",
type: "POST",
data: formData,
dataType: "json",
success: function(response) {
console.log("Success:", response);
// Close the modal after successful submission
$('#edit_modal').modal('hide');
// Optionally, reload the DataTable or update the UI as needed
table.ajax.reload(); // Reload the DataTable

// Check if no changes were made
if (response.status === 'no_changes') {
Swal.fire({
    icon: 'info',
    title: 'No Changes',
    text: 'No changes were made.'
});
} else if (response.status === 'duplicate') {
Swal.fire({
    icon: 'warning',
    title: 'Duplicate Data',
    text: 'Combination of Area and Location already exists.'
});
} else {
// Show a SweetAlert success message upon successful save
Swal.fire({
    icon: 'success',
    title: 'Success',
    text: 'Data saved successfully!'
});
}
},
error: function(xhr, status, error) {
console.error("Error:", error);
// Handle errors or display error messages to the user
Swal.fire({
icon: 'error',
title: 'Error',
text: 'An error occurred while saving the data. Please try again.'
});
}
});
});






// Function to handle delete_data
function delete_data(id) {
// Show Swal confirmation modal
Swal.fire({
title: 'Delete Area',
text: 'Are you sure you want to delete this area?',
icon: 'warning',
showCancelButton: true,
confirmButtonText: 'Yes, delete it!',
cancelButtonText: 'Cancel',
confirmButtonColor: '#d33',
cancelButtonColor: '#3085d6',
}).then((result) => {
if (result.isConfirmed) {
// User confirmed, make an AJAX request to delete the item
$.ajax({
    url: "../createtickets/delete_area",
    type: "POST",
    data: { id: id },
    success: function (data) {
        console.log("Success:", data);
        // Reload the DataTable after deleting the item
        table.ajax.reload();
        Swal.fire({
            icon: 'success',
            title: 'Area Deleted Successfully!',
            showConfirmButton: false,
            timer: 1500
        });
    },
    error: function (xhr, status, error) {
        console.error("Error:", error);
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Something went wrong!',
        });
    }
});
}
});
}

// Attach click event to dynamically added elements
$('#items_table tbody').on('click', '.delete_data', function () {
var id = $(this).data('id');
delete_data(id);
});
});


