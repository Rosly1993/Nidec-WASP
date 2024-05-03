
$(document).ready(function() {
    // Store added ID numbers in a Set for quick lookup
    var addedIds = new Set();

    $('#employeeForm').submit(function(e) {
        e.preventDefault(); // Prevent default form submission

        var idNumber = $('input[name="id_number"]').val().trim(); // Get the ID number from the input and remove leading/trailing whitespace

        // Check if the ID number is empty
        if (idNumber === '') {
            Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Id Number is empty!'
                });
            return; // Exit the function if ID number is empty
        }

        // Reset the textbox color before making the AJAX request
        $('input[name="id_number"]').removeClass('error');
        $('input[name="id_number"]').removeClass('success');

        // Check if the ID number is already added
        if (addedIds.has(idNumber)) {
            console.log("ID number already exists in the table:", idNumber);
            return; // Exit the function to avoid adding duplicate entry
        }

        $.ajax({
            url: "../apply/get_employee_details",
            type: "GET",
            dataType: "json",
            data: { id_number: idNumber },
            success: function(response) {
                console.log("Response from server:", response);
                if (response && response.data) {
                    var employee = response.data;
                    var idNumber = employee.fnEmpId;
                    var firstName = employee.fcEmpFName;
                    var lastName = employee.fcEmpLName;

                    var newRowContent = `<tr>
                                            <td>${idNumber}</td>
                                            <td>${firstName}</td>
                                            <td>${lastName}</td>
                                            <td><input type='time' name='timeFrom' style='height: 30px; border-radius: 5px' ></td>
                                            <td><input type='time' name='timeTo' style='height: 30px; border-radius: 5px' ></td>
                                         
                                            <td><button class="removeRowBtn btn btn-danger">Remove</button></td>
                                        </tr>`;
                    $('#items_table tbody').append(newRowContent);

                    // Add the ID to the set of added IDs
                    addedIds.add(idNumber);
                    $('input[name="id_number"]').addClass('success');
                } else {
                    console.error("No data found in database.");
                    $('input[name="id_number"]').addClass('error');
                }
            },
            error: function(xhr, status, error) {
                console.error("Error fetching data:", error);
            }
        });
    });

    // Add event delegation for dynamically created remove buttons
    $('#items_table').on('click', '.removeRowBtn', function() {
        $(this).closest('tr').remove();
        // You may also want to remove the ID from the addedIds set
    });
});



$('#save_appenddata_btn').click(function(e) {
    e.preventDefault(); // Prevent default form submission

    // Check if there are any rows in the table
    if ($('#items_table tbody tr').length === 0) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No Data to Save Please Check!'
        });
        return; // Exit the function if there are no rows in the table
    }

    var isValid = true;

    // Validate each row
    $('#items_table tbody tr').each(function() {
        var timeFrom = $(this).find('td:nth-child(4) input[type="time"]').val();
        var timeTo = $(this).find('td:nth-child(5) input[type="time"]').val();
        
        // Check if timeFrom is greater than or equal to timeTo
        if (timeFrom >= timeTo) {
            isValid = false;
            return false; // Exit the loop early if an invalid entry is found
        }
    });

    if (!isValid) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Time From should be less than Time To!'
        });
        return; // Exit the function if validation fails
    }
    // Additional validation for department, division, section, and date_ot
        var division = $('select[name="division"]').val();
        // var area = $('select[name="area[]"]').val() || []; 
        var area = $('select[name="area"]').val(); 
        var location = $('select[name="location"]').val();
        // var location = $('select[name="location[]"]').val() || []; // Ensure we get an array, even if empty
        var date_ot = $('input[name="date_ot"]').val();
        var category = $('select[name="category"]').val();
        var purpose = $('input[name="purpose"]').val();

    if (!location || !area || !division || !date_ot || !category || !purpose) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Division, Department, Section, Category, Purpose and Date OT fields cannot be empty!'
        });
        return; // Exit the function if any of the fields are empty
    }

    // If validation passes, proceed with saving the data
    var requestData = [];
    $('#items_table tbody tr').each(function() {
        var idNumber = $(this).find('td:first').text();
        var firstName = $(this).find('td:nth-child(2)').text();
        var lastName = $(this).find('td:nth-child(3)').text();
        var timeFrom = $(this).find('td:nth-child(4) input[type="time"]').val();
        var timeTo = $(this).find('td:nth-child(5) input[type="time"]').val();
        var division = $('select[name="division"]').val();
        // var area = $('select[name="area[]"]').val() || []; 
        var area = $('select[name="area"]').val(); 
        var location = $('select[name="location"]').val();
        // var location = $('select[name="location[]"]').val() || []; // Ensure we get an array, even if empty
        var date_ot = $('input[name="date_ot"]').val();
        var category = $('select[name="category"]').val();
        // var purpose = $('textarea[name="purpose"]').val();
        var purpose = $('input[name="purpose"]').val();
        // requestData.push({ idNumber: idNumber, firstName: firstName, lastName: lastName, timeFrom: timeFrom, timeTo: timeTo, division: division, area: area.join(','), location: location.join(','), date_ot: date_ot, category: category, purpose: purpose });
        requestData.push({ idNumber: idNumber, firstName: firstName, lastName: lastName, timeFrom: timeFrom, timeTo: timeTo, division: division, area: area, location: location, date_ot: date_ot, category: category, purpose: purpose });
       
       
    });
    // Send the data to the server for insertion
    $.ajax({
        url: "../apply/add_request", // URL of your server-side endpoint
        type: "POST",
        dataType: "json",
        data: { requestData: JSON.stringify(requestData) },
        success: function(response) {
            console.log(response);
            // Handle success response
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Data successfully saved!',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                // Clear the table by removing all its rows
                $('#items_table tbody').empty();
                $('input[name="id_number"]').val('');

                // Optionally, clear the addedIds object if you want to allow these IDs to be added again.
                addedIds = {};
            });
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            // Handle error response
        }
    });
});
