var rowsValues = [];
function handleMultipleCheckboxes() {
    // alert("kjlhhkj");
    var selectedRows = []; // Array to store the selected rows

    // Iterate over each checked checkbox
    $('.table tbody input[type="checkbox"]:checked').each(function () {
        var row = $(this).closest('tr');

        // Create an object with the row data
        var rowData = {
            name: row.find('td:nth-child(2)').text(),
            description: row.find('td:nth-child(3)').text(),
            // diameter: row.find('td:nth-child(4)').text(),
            // size: row.find('td:nth-child(5)').text(),
            //quantity: parseFloat(row.find('.quantity-input').val()),
            //measurement: parseFloat(row.find('.measurement-input').val())
        };

        selectedRows.push(rowData);
    });

    // Check if multiple checkboxes are checked
    if (selectedRows.length > 1) {
        // Call the function to update the modal content with multiple rows' data
        updateModalContentMultiple(selectedRows);
    }
}

// Modify the existing function to update the modal content with a single row's data
function updateModalContent(rowData, callingFunction = 1) {
    var modal = $('#exampleModal');
    modal.find('.modal-body h3').text(rowData.name);
    modal.find('.modal-body p').text(rowData.description);
    modal.find('.modal-body span').eq(0).text(rowData.diameter);
    modal.find('.modal-body span').eq(1).text(rowData.size);
    modal.find('#number').empty().append('<input type="number" class="form-control quantity-input" value="' + (rowData.quantity || 1) + '">');
    //modal.find('#measurement').empty().append('<input type="number" class="form-control measurement-input" value="' + rowData.measurement + '">');
    modal.find('#measurement').empty().append('<select class="form-select measurement-input">' +
        '<option value="Ton"' + (rowData.measurement === "Ton" ? ' selected' : '') + '>Ton</option>' +
        '<option value="kW"' + (rowData.measurement === "kW" ? ' selected' : '') + '>kW</option>' +
        '</select>');
}

// Add a new function to update the modal content with multiple rows' data
function updateModalContentMultiple(rowsData) {
    var modal = $('#bookingDetailsModal');
    var modalBody = modal.find('.modal-body');
    var table = modalBody.find('.showDetailsTableOrder');
    var tbody = table.find('tbody');

    // Clear the existing table rows
    tbody.empty();

    // Iterate over the rows' data and create the table rows
    rowsData.forEach(function (rowData) {
        var tr = $('<tr></tr>');
        tr.append('<td>' + rowData.name + '</td>');
        tr.append('<td>' + rowData.description + '</td>');
        // tr.append('<td>' + rowData.diameter + '</td>');
        // tr.append('<td>' + rowData.size + '</td>');
        //   tr.append('<td>' + rowData.quantity + '</td>');
        //   tr.append('<td>' + rowData.measurement + '</td>');
        tr.append('<td>' + '<input type="number" class="form-control quantity-input" value="' + (rowData.quantity || 1) + '">' + '</td>');
        //tr.append('<td>' + '<input type="number" class="form-control measurement-input" value="' + rowData.measurement + '">' + '</td>');
        tr.append('<td>' + '<select class="form-select measurement-input">' +
            '<option value="Ton"' + (rowData.measurement === "Ton" ? ' selected' : '') + '>Ton</option>' +
            '<option value="kW"' + (rowData.measurement === "kW" ? ' selected' : '') + '>kW</option>' +
            '</select>' + '</td>');
        tbody.append(tr);
    });

    modal.modal('show');
    // Get all rows' values
    //var rowsValues = [];
    tbody.find('tr').each(function () {
        var rowValues = {};
        var row = $(this);
        rowValues.name = row.find('td:nth-child(1)').text();
        rowValues.description = row.find('td:nth-child(2)').text();
        rowValues.diameter = row.find('td:nth-child(3)').text();
        rowValues.size = row.find('td:nth-child(4)').text();
        rowValues.quantity1 = row.find('td:nth-child(5) .quantity-input').val();
        rowValues.quantity2 = row.find('td:nth-child(6) .measurement-input').val();
        rowsValues.push(rowValues);
    });

    console.log(rowsValues);

    // rowsValues.forEach(function(rowData) {
    //     var name = rowData.name;
    //     var description = rowData.description;
    //     var diameter = rowData.diameter;
    //     var size = rowData.size;
    //     var quantity1 = rowData.quantity1;
    //     var quantity2 = rowData.quantity2;

    //     // Do something with the row data
    //     console.log('Name: ' + name);
    //     console.log('Description: ' + description);
    //     console.log('Diameter: ' + diameter);
    //     console.log('Size: ' + size);
    //     console.log('Quantity 1: ' + quantity1);
    //     console.log('Quantity 2: ' + quantity2);
    //     //alert(quantity1);
    //   });

}


// Attach a click event to the "Book Now" button
$('.table').on('click', '.book-now', function (e) {
    //alert("jljklj");
    e.preventDefault();

    var row = $(this).closest('tr');

    // Get the current row data
    var rowData = {
        name: row.find('td:nth-child(2)').text(),
        description: row.find('td:nth-child(3)').text(),
        diameter: row.find('td:nth-child(4)').text(),
        size: row.find('td:nth-child(5)').text(),
        quantity: parseFloat(row.find('.quantity-input').val()),
        //measurement: parseFloat(row.find('.measurement-input').val())
        measurement: parseFloat(row.find('.measurement-input').val())
    };

    // Update the modal content with the current row data
    updateModalContent(rowData, callingFunction = 1);
});

// Attach a change event to the checkboxes
$('.showDetailsTable').on('change', 'input[type="checkbox"]', function () {
    // Check if more than one checkbox is checked
    if ($('.table tbody input[type="checkbox"]:checked').length > 1) {
        handleMultipleCheckboxes();
    }
});


$('.order-bulk').on('click', function (e) {
    e.preventDefault();

    var modal = $('#bookingDetailsModal');
    var rowsValues = [];

    // Retrieve values from the modal controls
    var rows = modal.find('tbody tr');

    rows.each(function () {
        var row = $(this);
        var name = row.find('td:nth-child(1)').text();
        var description = row.find('td:nth-child(2)').text();
        var diameter = row.find('td:nth-child(3)').text();
        var size = row.find('td:nth-child(4)').text();
        var quantity = row.find('.quantity-input').val();
        var measurement = row.find('.measurement-input').val();

        var rowValues = {
            name: name,
            description: description,
            diameter: diameter,
            size: size,
            quantity: quantity,
            measurement: measurement
        };

        rowsValues.push(rowValues);
    });

    // Do something with the row values
    rowsValues.forEach(function (rowData) {

        var name = rowData.name;
        var description = rowData.description;
        var diameter = rowData.diameter;
        var size = rowData.size;
        var quantity = rowData.quantity;
        var measurement = rowData.measurement;

        // Perform desired operations with the values
        console.log('Name: ' + name);
        console.log('Description: ' + description);
        console.log('Diameter: ' + diameter);
        console.log('Size: ' + size);
        console.log('Quantity: ' + quantity);
        console.log('Measurement: ' + measurement);


    });


    //new code to send data to Orders Table
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax(
        {
            url: '/storeOrderBulk',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            //data: formData,
            data: {
                rowsValues: rowsValues
            },
            dataType: 'JSON',
            // processData: false,
            // contentType: false,
            success: function (data) {
                //alert("jlljlkjlkjlk");
                if (data.response == "successful") {
                    //alert("success");
                }
            },
            error: function (error) {
                console.error(error);
            }
        }
    );
    //new code to send data to Orders table
    // Close the modal
    modal.modal('hide');
    // Clear the values in the modal controls
    modal.find('.quantity-input').val('');
    modal.find('.measurement-input').val('');

    $('#orderSubmitModal').modal('show');
});

function handleCategoryChange(categoryId) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // $("#entity").html('<option value="">Select</option>');
    $("#entity").html('');
    $("#entity").append("<option value=''>Select</option>");

    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    var form = document.getElementById("productCategoryInfo");
    var formData = new FormData(form);
    // alert(categoryId);
    if (categoryId) {
        $.ajax(
            {
                url: '/entities/' + categoryId,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
                },
                data: formData,
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function (data) {
                    $.each(data, function (key, value) {
                        if (value !== null) {
                            var option = $('<option>').val(key).text(value);
                            $("#entity").append(option);

                        }
                    });
                },
                error: function (error) {
                    console.error(error);
                }
            }
        );

    }
}


function handleCategoryChangeCoal(categoryId) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // $("#entity").html('<option value="">Select</option>');
    $("#entityCoal").html('');
    $("#entityCoal").append("<option value=''>Select</option>");

    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    var form = document.getElementById("productCategoryInfo");
    var formData = new FormData(form);
    // alert(categoryId);
    if (categoryId) {
        $.ajax(
            {
                url: '/entities/' + categoryId,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
                },
                data: formData,
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function (data) {
                    $.each(data, function (key, value) {
                        if (value !== null) {
                            var option = $('<option>').val(key).text(value);
                            $("#entityCoal").append(option);

                        }
                    });
                },
                error: function (error) {
                    console.error(error);
                }
            }
        );

    }
}


$("#showEntity").on("click", function (event) {
    // event.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var form = document.getElementById("productCategoryInfo");
    var formData = new FormData(form);
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    var category_data = $("#category").val();
    var subcategory_data = $("#entity option:selected").text();


    //alert( category +  "  "  +subcategory);

    if (category) {
        $.ajax(
            {
                url: '/entityData',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                //data: formData,
                data: {
                    category_data: category_data,
                    subcategory_data: subcategory_data,
                },
                dataType: 'JSON',
                // processData: false,
                // contentType: false,
                success: function (data) {
                    generateTableRows(data);
                },
                error: function (error) {
                    console.error(error);
                }
            }
        );
    }

});


$("#showEntityCoal").on("click", function (event) {
    // event.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var form = document.getElementById("productCategoryInfo");
    var formData = new FormData(form);
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    var category_data = $("#categoryCoal").val();
    var subcategory_data = $("#entityCoal option:selected").text();


    //alert( category +  "  "  +subcategory);

    if (category) {
        $.ajax(
            {
                url: '/entityData',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                //data: formData,
                data: {
                    category_data: category_data,
                    subcategory_data: subcategory_data,
                },
                dataType: 'JSON',
                // processData: false,
                // contentType: false,
                success: function (data) {
                    generateTableRows(data);
                },
                error: function (error) {
                    console.error(error);
                }
            }
        );
    }

});

// function generateTableRows(data) {
//     var tbody = $('.table tbody');
//     tbody.empty(); // Clear existing table rows

//     // Iterate over each entity and generate the HTML for each row
//     data.forEach(function (entity) {
//         var tr = $('<tr></tr>');

//         // Create and append the table cells
//         var checkboxCell = $('<td><input class="form-check-input" type="checkbox"></td>');
//         var nameCell = $('<td></td>').text(entity.name);
//         var descriptionCell = $('<td></td>').text(entity.description);
//         var diameterCell = $('<td></td>').text(entity.diameter);
//         var sizeCell = $('<td></td>').text(entity.size);
//         var bookNowCell = $('<td></td>').html('<a href="" class="btn btn-secondary book-now" data-bs-toggle="modal" data-bs-target="#exampleModal">Book Now</a>');

//         tr.append(checkboxCell, nameCell, descriptionCell, diameterCell, sizeCell, bookNowCell);
//         tbody.append(tr);
//     });
// }

function generateTableRows(data) {
    var tbody = $('.table tbody');
    tbody.empty(); // Clear existing table rows
    var selectedRows = []; // Array to store the selected rows
    // Iterate over each entity and generate the HTML for each row
    data.forEach(function (entity) {
        var tr = $('<tr></tr>');

        // Create and append the table cells
        var checkboxCell = $('<td><input class="form-check-input" type="checkbox"></td>');
        var nameCell = $('<td></td>').text(entity.name);
        var descriptionCell = $('<td></td>').text(entity.description);
        // var diameterCell = $('<td></td>').text(entity.diameter);
        // var sizeCell = $('<td></td>').text(entity.size);

        //new code
        // var quantityCell = $('<td></td>').html('<input type="number" class="form-control quantity-input" value="' + entity.quantity + '">');
        // var measurementCell = $('<td></td>').html('<input type="number" class="form-control measurement-input" value="' + entity.measurement + '">');
        var quantityCell = $('<td></td>').html('<input type="number" class="form-control quantity-input" hidden value="' + (entity.quantity || 1) + '" min="1" required>');
        //var measurementCell = $('<td></td>').html('<input type="number" class="form-control measurement-input"  hidden value="' + (entity.measurement || 0) + '">');
        var measurementCell = $('<td></td>').html('<select class="form-select measurement-input">' +
            '<option value="Ton">Ton</option>' +
            '<option value="kW">kW</option>' +
            '</select>');

        //new code
        var bookNowCell = $('<td></td>').html('<a href="" class="btn btn-secondary book-now" data-bs-toggle="modal" data-bs-target="#exampleModal">Book Now</a>');
        bookNowCell.find('.book-now').on('click', function (e) {
            e.preventDefault();
            // Get the current row data
            var rowData = {
                name: entity.name,
                description: entity.description,
                // diameter: entity.diameter,
                // size: entity.size,

                //new code

                quantity: parseFloat(quantityCell.find('.quantity-input').val()),
                //measurement: parseFloat(measurementCell.find('.measurement-input').val())
                measurement: (measurementCell.find('.measurement-input').val())
                //new code
            };
            // Update the modal content with the current row data
            updateModalContent(rowData);
        });
        //tr.append(checkboxCell, nameCell, descriptionCell, diameterCell, sizeCell, bookNowCell);
        tr.append(checkboxCell, nameCell, descriptionCell, bookNowCell);
        //tr.append(checkboxCell, nameCell, descriptionCell, diameterCell, sizeCell, quantityCell, measurementCell, bookNowCell);
        tbody.append(tr);
    });
}

function updateModalContent(rowData, callingFunction = 1) {
    //alert(rowData.name);
    var modal = $('#exampleModal');
    modal.find('.modal-body h3').text(rowData.name);
    modal.find('.modal-body p').text(rowData.description);
    // modal.find('.modal-body span').eq(0).text(rowData.diameter);
    // modal.find('.modal-body span').eq(1).text(rowData.size);
    modal.find('#number').empty().append('<input type="number" class="form-control quantity-input" value="' + (entity.quantity || 1) + '" min="1" required>');
    //modal.find('#measurement').empty().append('<input type="number" class="form-control measurement-input" value="' + rowData.measurement + '">');
    //var measurement = modal.find('.measurement-input').val();
    modal.find('#measurement').empty().append('<select class="form-select measurement-input">' +
        '<option value="Ton"' + (rowData.measurement === "Ton" ? ' selected' : '') + '>Ton</option>' +
        '<option value="kW"' + (rowData.measurement === "kW" ? ' selected' : '') + '>kW</option>' +
        '</select>');

}

$('.order-show').on('click', function (e) {
    e.preventDefault();
    $('#exampleModal').modal('show');

    //     var rowData = {
    //         name: $(this).closest('tr').find('td:nth-child(2)').text(),
    //         description: $(this).closest('tr').find('td:nth-child(3)').text(),
    //         diameter: $(this).closest('tr').find('td:nth-child(4)').text(),
    //         size: $(this).closest('tr').find('td:nth-child(5)').text(),
    //         quantity: parseFloat($(this).closest('tr').find('.quantity-input').val()),
    //         measurement: parseFloat($(this).closest('tr').find('.measurement-input').val())
    //      };
    //    //Update the modal content with the current row data

    //     //alert($(this).closest('tr').find('td:nth-child(2)').text());
    //     console.log(rowData);
    //     updateModalContent(rowData);
    // Open the modal
    var modal = $('#exampleModal');
    // Get the values from the modal controls
    var name = modal.find('.modal-body h3').text();
    var description = modal.find('.modal-body p').text();
    var diameter = modal.find('.modal-body span').eq(0).text();
    var size = modal.find('.modal-body span').eq(1).text();
    var quantity = parseFloat(modal.find('.quantity-input').val());
    //var measurement = parseFloat(modal.find('.measurement-input').val());
    var measurement = (modal.find('.measurement-input').val());
    // Use the values as needed
    console.log(name);
    console.log(description);
    console.log(diameter);
    console.log(size);
    console.log(quantity);
    console.log(measurement);
    //new code to send data to Orders Table
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax(
        {
            url: '/storeOrder',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            //data: formData,
            data: {
                name: name,
                description: description,
                diameter: diameter,
                size: size,
                quantity: quantity,
                measurement: measurement,
            },
            dataType: 'JSON',
            // processData: false,
            // contentType: false,
            success: function (data) {
                //alert("jlljlkjlkjlk");
                if (data.response == "successful") {
                    //alert("success");
                }
            },
            error: function (error) {
                console.error(error);
            }
        }
    );
    //new code to send data to Orders table
});






















