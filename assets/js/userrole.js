
$(document).ready(function () {
    
    // DataTable initialization
    var table = $('#items_table').DataTable({
        
        "ajax": "../userroles/get_userroles",
        "columns": [
            {
                data: 'id',
                className: 'py-0 px-1 text-center'
            },
            {
                data: 'role_name',
                className: 'py-0 px-1 text-center'
            },
            {
                data: 'fullname',
                className: 'py-0 px-1 text-center'
            },
            {
                data: 'area',
                className: 'py-0 px-1 text-center'
            },
            {
                data: 'username',
                className: 'py-0 px-1 text-center'
            },
            {
                data: 'email',
                className: 'py-0 px-1 text-center'
            },
            {
                data: 'created_at',
                className: 'py-0 px-1 text-center'
            },
            {
                data: 'id',
                orderable: false,
                className: 'text-center py-0 px-1',
                render: function (data, type, row, meta) {
                    return '<a class="me-2 btn-sm editbtn rounded-0 py-0 edit_data" href="javascript:void(0)" data-id="' + (row.id) + '" data-url="../userroles/get_userrole_details/"><i class="ni ni-settings"></i></a>'
                    //  +
        // '<a class="me-2 btn-sm deletebtn rounded-0 py-0 delete_data" href="javascript:void(0)" data-id="' + (row.id) + '"><i class="ni ni-fat-remove"></i></a>'
        ;
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
            {
                text: '<a class="text-white addbtn"><i class="fas fa-plus text-white "></i>&nbsp; Add New User</a>',
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
                title: 'Traceability'
            },
            {
                extend: 'print',
                text: '<a class="text-white pdfbtn"><i class="fa fa-file-pdf text-white"></i>&nbsp;&nbsp;PDF Download</a>',
                className: "buttontest",
                autoFilter: true,
                orientation: 'landscape',
                sheetName: 'Exported data',
                exportOptions: {
                    columns: ':visible'
                },
                title: 'Traceability'
            }
        ],
        "responsive": true // Enable responsiveness
    });

    // Add the buttons to the layout
    table.buttons().container().appendTo($('.dataTables_length', table.wrapper));

    // ... Your existing code ...
    
    // Delegate click event to dynamically added elements
    $('#items_table tbody').on('click', '.edit_data', function () {
        var id = $(this).data('id');
        edit_data(id);
    });
    function validateForm() {

    var fullname = $('#fullname').val().trim();
    var email = $('#email').val().trim();
    var username = $('#username').val().trim();
    var password = $('#password').val().trim();
    var role_id = $('#role_id').val().trim();
    var area_id = $('#area_id').val().trim();
    var regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;


    if (fullname === '') {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Fullname field cannot be empty'
        });
        return false; // prevent form submission
    } else if (username === '') {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Username field cannot be empty'
        });
        return false; // prevent form submission
    } else if (email === '') {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Email field cannot be empty'
        });
        return false; // prevent form submission

    } else if (!regex.test(email)) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Invalid email format'
        });
        return false; // prevent form submission
    
   } else if (password === '') {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Username field cannot be empty'
        });
        return false; // prevent form submission
    } else if (role_id === '') {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Roles field cannot be empty'
        });
        return false; // prevent form submission
    } else if (area_id === '') {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Area field cannot be empty'
        });
        return false; // prevent form submission
    }

    return true; // allow form submission
    }
         // Function to add item
        function addUserroles() {
        if (!validateForm()) return; // validate the form before proceeding
        // Get data from form
        var fullname = $('#fullname').val();
        var email = $('#email').val();
        var username = $('#username').val();
        var password = $('#password').val();
        var role_id = $('#role_id').val();
        var area_id = $('#area_id').val();
        var userdata = $('#userdata').val();


        // Perform AJAX request to add item
        $.post("../userroles/add_userroles", { email: email,fullname: fullname, username: username, password: password, role_id: role_id, area_id: area_id, userdata: userdata })
            .done(function (data) {
                // console.log("Success:", data);
                if (data.status == 'success') {
                    Swal.fire({
            icon: 'success',
            title: 'Success',
            text: data.message,
            showConfirmButton: false,
            timer: 1500
        });

        table.ajax.reload(); // Reload the DataTable
        $('#add_model').modal('hide'); // Close the modal
        $('#fullname').val(''); // Clear form fields
        $('#username').val('');
        $('#email').val('');
        $('#password').val('');
        $('#role_id').val('');
        $('#area_id').val('');
    } else {
        // Display an error message
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: data.message
        });
    }
})
                    // .fail(function (xhr, status, error) {
                    //     console.error("Error:", error);
                    // });
            }

            // Bind click event to the "Save changes" button
            $(document).on('click', '#saveChangesBtn', function (event) {
                event.preventDefault();
                addUserroles();
            });

// Function to handle edit_data
function edit_data(id) {
// Fetch the current item details from the server
$.ajax({
url: "../userroles/get_userrole_details/" + id,
type: "GET",
dataType: "json",
success: function (data) {
// Log the data received from the server
console.log("Data Received:", data);

// Check if the response contains line_details
if (data.userrole_details) {
    var existingId = data.userrole_details.id;
    var existingFullname = data.userrole_details.fullname;
    var existingUsername = data.userrole_details.username;
    var existingPassword = data.userrole_details.password;
    var existingRole_id = data.userrole_details.role_id;
    var existingArea_id = data.userrole_details.area_id;
    var existingEmail = data.userrole_details.email;

    // Log the existing data
    console.log("Existing existingId:", existingId);
    console.log("Existing existingFullname:", existingFullname);
    console.log("Existing  existingUsername:", existingUsername);
    console.log("Existing  existingPassword:", existingPassword);
    console.log("Existing  existingRole_id:", existingRole_id);
    console.log("Existing  existingArea_id:", existingArea_id);

    // Populate form fields in the modal with existing data
    $('#edit_id').val(existingId);
    $('#edit_fullname').val(existingFullname);
    $('#edit_username').val(existingUsername);
    $('#edit_password').val(existingPassword);
    $('#edit_role_id').val(existingRole_id);
    $('#edit_area_id').val(existingArea_id);
    $('#edit_email').val(existingEmail);
    


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

// Get the form data
var formData = {
    id: $('#edit_id').val(),
    fullname: $('#edit_fullname').val(),
    email: $('#edit_email').val(),
    username: $('#edit_username').val(),
    password: $('#edit_password').val(),
    role_id: $('#edit_role_id').val(),
    area_id: $('#edit_area_id').val(),
    userdata: $('#userdata').val()

    // Add any other form fields as needed
};

// Perform an AJAX request to save the edited data
$.ajax({
url: "../userroles/update_userrole",
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
    text: 'Username already exists.'
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
title: 'Deactivate User',
text: 'Are you sure you want to delete this line?',
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
    url: "../lines/delete_line",
    type: "POST",
    data: { id: id },
    success: function (data) {
        console.log("Success:", data);
        // Reload the DataTable after deleting the item
        table.ajax.reload();
        Swal.fire({
            icon: 'success',
            title: 'Line Deleted Successfully!',
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




