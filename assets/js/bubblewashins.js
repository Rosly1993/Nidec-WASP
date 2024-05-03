

function toggleSerialInput() {
    var lineDropdown = document.getElementById("line");
    var serialInput = document.getElementById("serialInput");
    if (lineDropdown.value === "") {
        serialInput.style.display = "none"; // Hide the Serial input
    } else {
        serialInput.style.display = "block"; // Show the Serial input
    }
}


function validateForm() {
    var serial1 = $('#serial1').val().trim();
    var line = $('#line').val().trim();
    
    if (line === '') {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Please select a Line'
        });
        return false; // prevent form submission
    } else if (serial1 === '') {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Serial field cannot be empty'
        });
        return false; // prevent form submission
    } else if (serial1.length !== 12) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Serial must be 12 characters long'
        });
        return false; // prevent form submission
    }
    
    return true; // allow form submission if all validations pass
}

$(document).ready(function () {
    // Define table variable outside of document.ready
    var table;

    // DataTable initialization
    table = $('#items_table').DataTable({
        "ajax": "../bubblewashins/get_models",
        "columns": [
            {
                data: 'id',
                className: 'py-0 px-1 text-center font-size-14',
                // style: 'color: red;' // Add font-size style
            },
            {
                data: 'serial1',
                className: 'py-0 px-1 text-center font-size-14'
            },
            {
                data: 'tray_no',
                className: 'py-0 px-1 text-center font-size-14'
            },
            {
                data: 'model',
                className: 'py-0 px-1 text-center font-size-14'
            },
            {
                data: 'cavity',
                className: 'py-0 px-1 text-center font-size-14'
            },
            {
                data: 'quantity',
                className: 'py-0 px-1 text-center font-size-14'
            },
            {
                data: 'line',
                className: 'py-0 px-1 text-center font-size-14'
            },
            {
                data: 'input_date',
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
                        return '<a href="/PartsTraceabilitySystem/uploads/' + filename + '" class="pdf-link" target="_blank"><i class="fa fa-file-pdf fa-2x deletebtn"></i></a>';
                    } else {
                        return ''; // Empty string if no attachment
                    }
                }
            }
        ],
        "responsive": true,
        lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],
        "pageLength": 100,
        "order": [[6, "asc"]] // Order by the 7th column (index 6) in ascending order
       
    });

    // Move addLot() function outside of document.ready
    function addLot() {
        if (!validateForm()) return; // validate the form before proceeding
        var serial1 = $('#serial1').val();
        var line = $('#line').val();

        $.ajax({
            url: '../bubblewashins/get_quantity',
            type: "GET",
            dataType: "json",
            data: { serial1: serial1 },
            success: function(response) {
                if (response.status === 'success') {
                    var quantityData = response.quantity;
                    var area = quantityData.area;
                    var quantity = quantityData.quantity;
                    var model = quantityData.model;
                    var serial1 = quantityData.serial1;
                    var cavity = quantityData.cavity;
                    var debplan = quantityData.debplan;
                    var input_status = quantityData.input_status;

                    // Display data in modal
                    $('#areaDisplay').text('Current Area: ' + area);
                    $('#modelDisplay').text('Model: ' + model);
                    $('#quantityDisplay').text('Quantity: ' + quantity);
                    $('#serialDisplay').text('Serial: ' + serial1);
                    $('#cavityDisplay').text('Cavity: ' + cavity);
                    $('#statusDisplay').text('Serial Status: ' + input_status);
                    $('#debplanLink').attr('href', debplan); // Set the href attribute of the anchor tag
                    $('#debplanLink').text('View Deb Plan'); // Set the text of the anchor tag

                    $('#lotModal').modal('show'); // Show the modal
                } else {
                    console.error('Failed to retrieve quantity.');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + error);
            }
        });

        // Handle confirm add lot button click
        $('#confirmAddLotBtn').off('click').on('click', function() {
            // Perform the AJAX request to add lot
            $.post("../bubblewashins/add_lot", { serial1: serial1, line: line })
                .done(function(data) {
                    if (data.status == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('#serial1').val('');
                        table.ajax.reload(); // Reload DataTables
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: data.message
                        });
                    }
                })
                .fail(function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to add lot. Please try again later.'
                    });
                });

            // Close the modal
            $('#lotModal').modal('hide');
        });
    }

    // Event binding for #saveChangesBtn outside of document.ready
    $(document).on('click', '#saveChangesBtn', function(event) {
        event.preventDefault();
        addLot();
    });
});
