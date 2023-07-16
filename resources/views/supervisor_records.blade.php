<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>PSIEC</title>
    <style>
        .back-button {
            position: absolute;
            top: 10px;
            left: 10px;
        }
    </style>
</head>

<body style="border: 1px solid grey">
    <a href="/admin/records" class="btn btn-default">Back</a>
    </div>
    <h2 class="text-center mt-3">Records Collection - Yard Supervisor</h2>
    <br>
    <div class="container mt-4">
        <form id="records">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <label for="product" class="control-label">Product</label>
                    <input type="text" class="form-control" id="product" name="product" placeholder="Product" required>
                </div>
                <div class="col-md-6">
                    <label for="quantity" class="control-label">Quantity</label>
                    <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Quantity"
                        required>
                </div>
            </div>
            <br>
            <div class="row mt-5">
                <div class="col-md-12">
                    <label for="description" class="control-label">Description</label>
                    <textarea class="form-control" id="description" name="description" placeholder="Description"
                        rows="5"></textarea>
                </div>
            </div>
            <br>
            <div class="row mt-3">
                <div class="col-md-12">
                    <button type="button" class="btn btn-primary add-row">Submit</button>
                    <button type="button" class="btn btn-warning clear-controls">Clear</button>
                </div>
            </div>
        </form>
    </div>
    <div class="container mt-4">
        <table class="table">
            <thead>
                <tr>
                    <th>Select</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        <button type="button" class="btn btn-danger delete-row" style="display:none">Delete</button>
    </div>
    <script>
        $(document).ready(function(){
            $(".add-row").click(function(){
                var product = $("#product").val();
                var quantity = $("#quantity").val();
                var description = $("#description").val();
                if(product && quantity) {
                    var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + product + "</td><td>" + quantity + "</td><td>"+description+ "</td></tr>";
                    $("table tbody").append(markup);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    var form = document.getElementById("records");
                    var formData = new FormData(form);
                    var csrfToken = $('meta[name="csrf-token"]').attr('content'); 
                    $.ajax({
                        url:'/records',
                        method:'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
                        },
                        data: formData,
                        dataType: 'JSON',
                        processData: false,
                        contentType: false,
                        success:function(data)
                        {
                            $.each(data, function(key, value) {
                                if (value !== null) {
                                    //alert("success");
                                    $("#product").val('');
                $("#quantity").val('');
                $("#description").val('');
                                }
                            });
                        },
                        error: function(error) {
                            console.error(error);
                        }
                    });
                }
            });
            $(".delete-row").click(function(){
                $("table tbody").find('input[name="record"]').each(function(){
                    if($(this).is(":checked")){
                        $(this).parents("tr").remove();
                    }
                });
            });

            $(".clear-controls").click(function(){
                $("#product").val('');
                $("#quantity").val('');
                $("#description").val('');
            });
        });
    </script>
</body>

</html>