

$(document).ready(function () {
    // DataTable initialization
    var table = $('#items_table').DataTable({
        "ajax": "../rejecttickets/get_areas",
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
                data: 'level1_pic',
                className: 'py-0 px-1 text-center font-size-14'
            },
            {
                data: 'level1_remarks',
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
                $(row).find('td:eq(12)').addClass('status-plan');
            } else if (data.level2_status === 'Done') {
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

    // Add the buttons to the layout
    table.buttons().container().appendTo($('.dataTables_length', table.wrapper));

    // ... Your existing code ...

    // Delegate click event to dynamically added elements
    $('#items_table tbody').on('click', '.edit_data', function () {
        var id = $(this).data('id');
        edit_data(id);
    });

//     function validateForm() {

//     var type = $('#type').val().trim();
//     var activity = $('#activity').val().trim();
//     var details = $('#details').val().trim();
//     var impact_type = $('#impact_type').val().trim();
//     var before = $('#before').val().trim();
//     var after = $('#after').val().trim();
//     var target_date = $('#target_date').val().trim();
//     var uom = $('#uom').val().trim();

   
   
    
//     if (type === '') {
//         Swal.fire({
//             icon: 'error',
//             title: 'Error',
//             text: 'Type field cannot be empty'
//         });
//         return false; // prevent form submission
//     } else if (activity === '') {
//         Swal.fire({
//             icon: 'error',
//             title: 'Error',
//             text: 'Activity field cannot be empty'
//         });
//         return false; // prevent form submission
 
// } else if (details === '') {
//     Swal.fire({
//         icon: 'error',
//         title: 'Error',
//         text: 'Details field cannot be empty'
//     });
//     return false; // prevent form submission
// } else if (activity === '') {
//     Swal.fire({
//         icon: 'error',
//         title: 'Error',
//         text: 'Activity field cannot be empty'
//     });
//     return false; // prevent form submissionuom
// } else if (impact_type === '') {
//     Swal.fire({
//         icon: 'error',
//         title: 'Error',
//         text: 'Impact Type field cannot be empty'
//     });
//     return false; // prevent form submission
// } else if (uom === '') {
//     Swal.fire({
//         icon: 'error',
//         title: 'Error',
//         text: 'Uom field cannot be empty'
//     });
//     return false; // prevent form submission
// } else if (before === '') {
//     Swal.fire({
//         icon: 'error',
//         title: 'Error',
//         text: 'Before field cannot be empty'
//     });
//     return false; // prevent form submission
// } else if (after === '') {
//     Swal.fire({
//         icon: 'error',
//         title: 'Error',
//         text: 'After field cannot be empty'
//     });
//     return false; // prevent form submission
// } else if (level2_status === '') {
//     Swal.fire({
//         icon: 'error',
//         title: 'Error',
//         text: 'Level2 Status field cannot be empty'
//     });
//     return false; // prevent form submission
// } else if (target_date === '') {
//     Swal.fire({
//         icon: 'error',
//         title: 'Error',
//         text: 'Target Date Status field cannot be empty'
//     });
//     return false; // prevent form submission
// }





    
//     return true; // allow form submission
// }

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
    // Note: 'level2_status' was mentioned but not provided in your initial validation. 
    // Make sure to include it in your HTML or handle its absence as needed.
    if ($('#uom').val().trim() === '') {
        highlightAndInvalidate('#uom');
    }
    if ($('#level2_status').val().trim() === '') {
        highlightAndInvalidate('#level2_status');
    }
    if ($('#target_date').val().trim() === '') {
        highlightAndInvalidate('#target_date');
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
    var uom = $('#uom').val();
    var level2_status = $('#level2_status').val();



    $.post("../rejecttickets/add_area", 
    
    { type: type, activity: activity, details: details, impact_type: impact_type, before: before , after: after, target_date: target_date, uom: uom, level2_status: level2_status })
        .done(function (data) {
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
                // $('#area').val('');
                // $('#location').val('');
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message
                });
            }
        })
        .fail(function (xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Failed to add area. Please try again later.'
            });
        });
}

$(document).on('click', '#saveChangesBtn', function (event) {
    event.preventDefault();
    addArea();
});


// Function to handle edit_data
function edit_data(id) {
// Fetch the current item details from the server
$.ajax({
url: "../rejecttickets/get_area_details/" + id,
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
    var existingUom = data.area_details.uom;
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
    $('#edit_uom').val(existingUom);
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
 $('.validation-error').css('border', ''); // Assuming you add this class to all input elements
//  $('#error_message').text(''); // Clear previous error message
  // Initialize an object to track validation status
  var isValid = true;
// Get the form data
var formData = {
    id: $('#edit_id').val(),
    // area: $('#edit_area').val(),
    type: $('#edit_type').val(),
    activity: $('#edit_activity').val(),
    details: $('#edit_details').val(),
    impact_type: $('#edit_impact_type').val(),
    before: $('#edit_before').val(),
    after: $('#edit_after').val(),
    target_date: $('#edit_target_date').val(),
    uom: $('#edit_uom').val(),
    level2_status: $('#level2_status').val()
    // Add any other form fields as needed
};

// Perform validation
 // Validate each field and update `isValid` accordingly
 if (formData.level2_status.trim() === '') {
    $('#edit_level2_status').css('border', '2px solid red');
    isValid = false;
}
if (formData.type.trim() === '') {
    $('#edit_type').css('border', '2px solid red');
    isValid = false;
}
if (formData.activity.trim() === '') {
    $('#edit_activity').css('border', '2px solid red');
    isValid = false;
}
if (formData.details.trim() === '') {
    $('#edit_details').css('border', '2px solid red');
    isValid = false;
}
if (formData.impact_type.trim() === '') {
    $('#edit_impact_type').css('border', '2px solid red');
    isValid = false;
}
if (formData.before.trim() === '') {
    $('#edit_before').css('border', '2px solid red');
    isValid = false;
}
if (formData.after.trim() === '') {
    $('#edit_after').css('border', '2px solid red');
    isValid = false;
}
if (formData.target_date.trim() === '') {
    $('#edit_target_date').css('border', '2px solid red');
    isValid = false;
}
if (formData.uom.trim() === '') {
    $('#edit_uom').css('border', '2px solid red');
    isValid = false;
}
// Add other validation checks as needed
// Repeat the above pattern for each field you need to validate

// Only proceed if all fields are valid
if (!isValid) {
    // Display an error message or focus the first invalid element if needed
    // Example: focus the first element with a red border
    $('input[style*="border: 2px solid red"]').first().focus();
    // Optionally, show a generic error message
    // $('#error_message').text('Please correct the highlighted fields.').css('color', 'red');
    return;
}

// Perform an AJAX request to save the edited data
$.ajax({
url: "../rejecttickets/update_area",
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
    url: "../rejecttickets/delete_area",
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


