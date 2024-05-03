
function validateForm() {
    var userid = $('#userid').val().trim();
    var email = $('#email').val().trim();
    var username = $('#username').val().trim();
    var password = $('#password').val().trim();
    var regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

    if (email === '') {
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
    } else if (username === '') {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Username field cannot be empty'
        });
        return false; // prevent form submission
    } else if (password === '') {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Password field cannot be empty'
        });
        return false; // prevent form submission
    }

    return true; // Validation passed
}

function addLot() {
if (!validateForm()) return; // validate the form before proceeding
var userid = $('#userid').val();
var email = $('#email').val();
var username = $('#username').val();
var password = $('#password').val();


$.post("../profile/add_lot", { userid: userid, email: email, username: username, password: password })
    .done(function (data) {
        if (data.status == 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: data.message,
                showConfirmButton: false,
                timer: 1500
            });

            // table.ajax.reload();
            // $('#add_model').modal('hide');
            $('#password').val('');
           
        
      
        } else {
            Swal.fire({
                icon: 'error',
                title: 'No Changes Made!',
                text: data.message
            });
            $('#password').val('');
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
addLot();
$('#password').focus();
});

