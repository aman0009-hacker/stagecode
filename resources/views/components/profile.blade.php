@extends('layouts.main_account')
@section('content')
    {{--
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css"
	integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" /> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        body {
            color: #9b9ca1;
        }

        .bg-secondary-soft {
            background-color: #f9f9f9 !important;
        }

        .rounded {
            border-radius: 5px !important;
        }

        .py-5 {
            padding-top: 3rem !important;
            padding-bottom: 3rem !important;
        }

        .px-4 {
            padding-right: 1.5rem !important;
            padding-left: 1.5rem !important;
        }

        .file-upload .square {
            height: 160px;
            width: 160px;
            margin: auto;
            vertical-align: middle;
            border: 1px solid #e5dfe4;
            background-color: #fff;
            border-radius: 5px;
        }

        .text-secondary {
            --bs-text-opacity: 1;
            color: rgba(208, 212, 217, 0.5) !important;
        }

        .btn-success-soft {
            color: #28a745;
            background-color: rgba(40, 167, 69, 0.1);
        }

        .btn-danger-soft {
            color: #dc3545;
            background-color: rgba(220, 53, 69, 0.1);
        }

        .btn-primary-soft {
            color: #0b5ed7;
            background-color: #0d6efd33;
        }

        .form-control {
            display: block;
            width: 100%;
            padding: 0.5rem 1rem;
            font-size: 0.9375rem;
            font-weight: 400;
            line-height: 1.6;
            color: #29292e;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #e5dfe4;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 5px;
            -webkit-transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
        }

        .box-check input {

            width: 20px;
            height: 17px;

            vertical-align: -2px;
        }

        .display_button {
            display: none;
        }

        .displaysubmit {
            visibility: hidden;
        }

        .error {
            color: red;
        }
        .billing-detail ,.shipping_detail{
            background: #fff!important;
        }
    </style>

    @include('vendor.sweetalert.alert');
    <div class="container mb-5">
        <div class="row">
            <div class="col-12">
                <!-- Page title -->
                <div class="my-5">
                    <h3><span id="username" style="color:#13dcff">{{ $user->name }} {{ $user->last_name }}</span> Profile
                    </h3>
                    <hr>
                </div>
                <!-- Form START -->
                <div class="file-upload">
                    <div class="row mb-5 gx-5">
                        <!-- Contact detail -->
                        <div class="col-xxl-8 mb-5  col-md-7 mb-xxl-0">
                            <div class="bg-secondary-soft px-4 py-5 rounded">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <h4 class="mb-4 mt-0">Contact Detail</h4>
                                    </div>
                                    <div class="col-md-6 ">
                                        <form method="post" action="{{ route('userimage') }}" enctype="multipart/form-data"
                                            class="file-upload">
                                            @csrf
                                            <div class="d-inline float-end">
                                                <button type="button" class="btn btn-success-soft"
                                                    id="editUserDetails">Edit</button>
                                                <input type="submit" class="btn btn-primary-soft display_button"
                                                    id="updatecontact" value="Update">

                                            </div>


                                    </div>
                                    <!-- First Name -->
                                    <div class="col-md-6">


                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                        <label class="form-label">First Name *</label>
                                        <input type="text" class="form-control user-details" placeholder=""
                                            aria-label="First name" value="{{ $user->name }}" readonly name="firstname">
                                    </div>
                                    <!-- Last name -->
                                    <div class="col-md-6">
                                        <label class="form-label">Last Name *</label>
                                        <input type="text" class="form-control user-details" placeholder=""
                                            aria-label="Last name" value="{{ $user->last_name }}" readonly name="lastname">
                                    </div>
                                    <!-- Phone number -->
                                    <div class="col-md-6">
                                        <label class="form-label">Phone number *</label>
                                        <input type="text" class="form-control user-details" placeholder=""
                                            aria-label="Phone number" value="{{ $user->contact_number }}" readonly
                                            name="number">
                                    </div>
                                    <!-- Mobile number -->

                                    <!-- Email -->
                                    <div class="col-md-6">
                                        <label for="inputEmail4" class="form-label">Email *</label>
                                        <input type="email" class="form-control user-details" id="inputEmail4"
                                            value="{{ $user->email }}" readonly name="email">
                                    </div>

                                    <!-- Skype -->

                                </div> <!-- Row END -->
                            </div>
                        </div>
                        <!-- Upload profile -->
                        <div class="col-xxl-4 col-md-5">
                            <div class="bg-secondary-soft px-4 py-5 rounded">
                                <div class="row g-3">

                                    <h4 class="mt-0 text-center">Upload Profile Photo</h4>
                                    <div class="text-center position-relative">
                                        <!-- Image upload -->


                                        <div class="square position-relative display-2 mb-3" id="image-preview"
                                            style="padding:10px">
                                            @if (!$user->user_image)
                                                <i
                                                    class="fas fa-fw fa-user position-absolute top-50 start-50 translate-middle text-secondary"></i>
                                            @endif

                                        </div>
                                        <!-- Button -->
                                        <input type="file" id="image" name="file" hidden="">

                                        @if (!$user->user_image)
                                            <label class="btn btn-success-soft btn-block" for="image">Upload</label>


                                            <button type="button" class="btn btn-danger-soft"
                                                id="remove-btn">Remove</button>
                                        @endif



                                        </form>
                                        <form method="post" action="{{ route('removeimage') }}"
                                            enctype="multipart/form-data" style="display:inline" id="submission">
                                            @csrf
                                            @if ($user->user_image)
                                                <input type="hidden" name="userimageid" value="{{ $user->id }}">
                                                <img src="uploads/{{ $user->user_image }}"
                                                    style="width:140px;height:136px;position:absolute;top:9px;left:115px;object-fit:contain">
                                                <button type="button" class="btn btn-danger-soft"
                                                    id="form1">Remove</button>
                                            @endif
                                        </form>
                                        <!-- Content -->
                                        @if (!$user->user_image)
                                            <p class="text-muted mt-3 mb-0"><span class="me-1">Note:</span>File size
                                                should be
                                                less than 500kb <br>Support(jpg, jpeg, png)</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- Row END -->


                    <form method="post" action="{{ route('profile-address') }}" id="forms">
                        @csrf
                        <div class="row mb-5 gx-5">
                            <div class="col-xxl-6 mb-5 mb-xxl-0">
                                <div class="bg-secondary-soft px-4 py-5 rounded">
                                    <div class="row g-3">

                                        <div class="col-md-6">

                                            <h4 class="mb-4 mt-0">Shipping Address Detail</h4>
                                        </div>
                                        <div class="col-md-6 ">
                                            <div class="d-inline float-end">
                                                <button type="button" class="btn btn-success-soft btn-block"
                                                    id="editShippingDetails">Edit</button>
                                                <button type="button" class="btn btn-primary-soft display_button"
                                                    id="shippingupdate">Update</button>

                                            </div>


                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label">Shipping's Name *</label>
                                            <input type="text" class="form-control shipping_detail" placeholder=""
                                                aria-label="" id="shipname" name="shipname"
                                                value="{{ $address->shipping_name ?? '' }}" readonly>
                                            @error('shipname')
                                                <div style="color:red">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">GST IN/UIN *</label>
                                            <input type="text" class="form-control shipping_detail" placeholder=""
                                                aria-label="Twitter" value="{{ $address->shipping_gst_number ?? '' }}"
                                                readonly id="shipgstnumber" name="shipgstnumber">
                                            @error('shipgstnumber')
                                                <div style="color:red">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">GST State Code *</label>
                                            <input type="number" class="form-control shipping_detail" placeholder=""
                                                aria-label="ITR" name="shipgstcode"
                                                value="{{ $address->shipping_gst_statecode ?? '' }}" readonly
                                                id="shipgstcode">
                                            @error('shipgstcode')
                                                <div style="color:red">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">State *</label>
                                            {{-- <input type="text" class="form-control shipping_detail" placeholder=""
											aria-label="ITR" name="shipstate" value="{{$address->shipping_state ?? ""}}"
											readonly id="shipstate"> --}}
                                            <select class="form-control shipping_detail" name="shipstate" id="shipstate" disabled>
                                                <option value="">Select State</option>
                                                @foreach ($states as $state)
                                                    <option value="{{ $state->id }}" {{(isset($address->shipping_state) && $state->name == $address->shipping_state) ? 'selected' : '' }}>{{ $state->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('shipstate')
                                                <div style="color:red">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">City *</label>
                                            {{-- <input type="text" class="form-control shipping_detail" placeholder=""
                                                aria-label="Aadhar" value="{{ $address->shipping_city ?? '' }}"
                                                name="shipcity" readonly id="shipcity"> --}}
                                                @if (isset($address->shipping_city))
                                                    <select class="form-control shipping_detail" name="shipcity" id="shipcity">
                                                        <option value="{{$address->shipping_city}}">{{$address->shipping_city}}</option>
                                                    </select>
                                                @else
                                                    <select class="form-control shipping_detail" name="shipcity" id="shipcity">
                                                        <option value="">Select City</option>
                                                    </select>
                                                @endif
                                            @error('shipcity')
                                                <div style="color:red">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">District *</label>
                                            <input type="text" class="form-control shipping_detail" placeholder=""
                                                aria-label="Aadhar" value="{{ $address->shipping_district ?? '' }}"
                                                name="shipdistrict" readonly id="shipdistrict">
                                            @error('shipdistrict')
                                                <div style="color:red">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Pincode *</label>
                                            <input type="number" class="form-control shipping_detail" placeholder=""
                                                aria-label="Aadhar" value="{{ $address->shipping_zipcode ?? '' }}"
                                                name="shippincode" readonly id="shippincode">
                                            @error('shippincode')
                                                <div style="color:red">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Address *</label>
                                            <textarea class="form-control shipping_detail" rows="5" placeholder="" aria-label="" value=""
                                                name="shipaddress" readonly id="shipaddress" style="resize: none" required>{{ $address->shipping_address ?? '' }}</textarea>
                                            @error('shipaddress')
                                                <div style="color:red">{{ $message }}</div>
                                            @enderror
                                        </div>


                                        <div class="box-check">
                                            <input type="checkbox" id="checkbox"> Check the box for same billing address
                                        </div>




                                    </div>
                                </div>
                            </div>


                            <div class="col-xxl-6 mb-5 mb-xxl-0">
                                <div class="bg-secondary-soft px-4 py-5 rounded">
                                    <div class="row g-3">

                                        <div class="col-md-6">

                                            <h4 class="mb-4 mt-0">Billing Address Detail</h4>
                                        </div>
                                        <div class="col-md-6 ">
                                            <div class="d-inline float-end">
                                                <button type="button" class="btn btn-success-soft btn-block"
                                                    id="editBillingDetails">Edit</button>
                                                <button type="button" class="btn btn-primary-soft display_button"
                                                    id="billingupdate">Update</button>

                                            </div>


                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label">Billing's Name *</label>
                                            <input type="text" class="form-control billing-detail" placeholder=""
                                                aria-label="" name="billname"
                                                value="{{ $address->billing_name ?? '' }}" readonly id="billname">
                                            @error('billname')
                                                <div style="color:red">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">GST IN/UIN *</label>
                                            <input type="text" class="form-control billing-detail" placeholder=""
                                                aria-label="Twitter" value="{{ $address->billing_gst_number ?? '' }}"
                                                readonly id="billgstnumber" name="billgstnumber">
                                            @error('billgstnumber')
                                                <div style="color:red">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">GST State Code *</label>
                                            <input type="number" class="form-control billing-detail" placeholder=""
                                                aria-label="ITR" name="billgstcode"
                                                value="{{ $address->billing_gst_statecode ?? '' }}" readonly
                                                id="billgstcode">
                                            @error('billgstcode')
                                                <div style="color:red">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">State *</label>
                                            {{-- <input type="text" class="form-control billing-detail" placeholder=""
                                                aria-label="ITR" name="billstate"
                                                value="{{ $address->billing_state ?? '' }}" readonly id="billstate"> --}}
                                                <select class="form-control billing-detail" name="billstate" id="billstate" disabled>
                                                    <option value="">Select Sate</option>
                                                    @foreach ($states as $state)
                                                        <option value="{{$state->id}}" {{(isset($address->billing_state) && $state->name == $address->billing_state) ? 'selected' : '' }} readonly>{{$state->name}}</option>
                                                    @endforeach
                                                </select>
                                            @error('billstate')
                                                <div style="color:red">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">City *</label>
                                            @if (isset($address->billing_city))
                                            {{-- <input type="text" class="form-control billing-detail" placeholder=""
                                                aria-label="Aadhar" value="{{ $address->billing_city ?? '' }}"
                                                name="billcity" readonly id="billcity"> --}}
                                                <select class="form-control billing-detail" name="billcity" id="billcity"  >
                                                    <option value="{{$address->billing_city}}" >{{$address->billing_city}}</option>
                                                </select>
                                                @else
                                                <select class="form-control billing-detail" name="billcity" id="billcity">
                                                    <option value="">Select City</option>

                                                </select>
                                                @endif
                                            @error('billcity')
                                                <div style="color:red">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">District *</label>
                                            <input type="text" class="form-control billing-detail" placeholder=""
                                                aria-label="Aadhar" value="{{ $address->billing_district ?? '' }}"
                                                name="billdistrict" readonly id="billdistrict">
                                            @error('billdistrict')
                                                <div style="color:red">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Pincode *</label>
                                            <input type="number" class="form-control billing-detail" placeholder=""
                                                aria-label="Aadhar" value="{{ $address->billing_zipcode ?? '' }}"
                                                name="billpincode" readonly id="billpincode">
                                            @error('billpincode')
                                                <div style="color:red">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Address *</label>
                                            <textarea class="form-control billing-detail" rows="5" placeholder="" aria-label="" value=""
                                                name="billaddress" readonly id="billaddress" style="resize: none">{{ $address->billing_address ?? '' }}</textarea>
                                            @error('billaddress')
                                                <div style="color:red">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="box-check" style="visibility:hidden">
                                            <input type="checkbox" id="checkbox"> Check the box for same billing address
                                        </div>


                                    </div> <!-- Row END -->
                                </div>
                            </div>

                            <div class="col-xxl-12 mb-5 mb-xxl-0">
                                <input type="submit" value="Submit Address" class="btn btn-primary-soft displaysubmit "
                                    id="mainsubmit" style="display:block;margin:30px auto">
                            </div>

                        </div> <!-- Row END -->
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>




    <script>
        var selectedImage;

        $('#image').on('change', function() {
            var input = this;
            $('#updatecontact').removeClass('display_button');
            $('#editUserDetails').addClass('display_button');

            let alldetails = document.getElementsByClassName('user-details');
            Array.from(alldetails).forEach(element => {
                element.readOnly = false;
            })

            if (input.files && input.files[0]) {
                var file = input.files[0];


                var allowedExtensions = ['jpg', 'jpeg', 'png'];
                var fileExtension = file.name.split('.').pop().toLowerCase();

                if ($.inArray(fileExtension, allowedExtensions) === -1) {

                    swal.fire({
                        title: 'Invalid file extension',
                        text: 'Allowed extensions are: ' + allowedExtensions.join(', '),
                        icon: 'warning',
                    });
                    return;
                }

                var size = 500 * 1024;
                if (size < file.size) {

                    swal.fire({
                        title: 'Image size exceeds',
                        text: 'The maximum limit of image is less than 500KB ',
                        icon: 'warning',
                    });
                    return;
                }


                selectedImage = file;
                var reader = new FileReader();

                reader.onload = function(e) {
                    // Display the image in the preview div
                    $('#image-preview').html('<img src="' + e.target.result +
                        '" style="width:140px;height:136px;object-fit:contain">');
                }

                // Read the selected image as a data URL
                reader.readAsDataURL(input.files[0]);
            }
        });

        $('#remove-btn').on('click', function() {
            if (selectedImage) {

                $('#updatecontact').addClass('display_button');
                $('#editUserDetails').removeClass('display_button');

                let alldetails = document.getElementsByClassName('user-details');
                Array.from(alldetails).forEach(element => {
                    element.readOnly = true;
                })



                $('#image-preview').empty();
                $('#image-preview').html(
                    '<i class="fas fa-fw fa-user position-absolute top-50 start-50 translate-middle text-secondary"></i>'
                    );
            }

        });

        $('#editUserDetails	').on('click', function() {
            let userdetails = document.getElementsByClassName('user-details');

            $(this).addClass('display_button');
            $('#updatecontact').removeClass('display_button');

            Array.from(userdetails).forEach(element => {
                element.readOnly = false;
            });
        });

        $('#editDocumentDetails	').on('click', function() {
            let documentdetails = document.getElementsByClassName('document-details');
            $(this).addClass('display_button');
            $('#documentupdate').removeClass('display_button');

            Array.from(documentdetails).forEach(element => {
                element.readOnly = false;
            });
        });

        $('#editPassword').on('click', function() {
            let passworddetails = document.getElementsByClassName('changepassword');

            Array.from(passworddetails).forEach(element => {
                element.readOnly = false;
            });
        });


        $('#editShippingDetails').on('click', function() {
            let shipdetail = document.getElementsByClassName('shipping_detail');
            let billdetail = document.getElementsByClassName('billing-detail');
            $("#editBillingDetails").addClass('display_button');

            $(this).addClass('display_button');
            $('#mainsubmit').removeClass('displaysubmit');



            Array.from(shipdetail).forEach(element => {
                element.readOnly = false;
                element.disabled = false;

            })
            Array.from( billdetail).forEach(element => {
                element.readOnly = false;
                element.disabled = false;

            })
        });

        $('#editBillingDetails').on('click', function() {
            $(this).addClass('display_button');
            $('#mainsubmit').removeClass('displaysubmit');
            $("#editShippingDetails").addClass('display_button');
            let shipdetail = document.getElementsByClassName('shipping_detail');
            let billngdetail = document.getElementsByClassName('billing-detail');
            Array.from(billngdetail).forEach(element => {
                element.readOnly = false;
                element.disabled = false;

            });
            Array.from(shipdetail).forEach(element => {
                element.readOnly = false;
                element.disabled = false;

            });
        });



        $('#checkbox').on('change', function() {
            let field1 = document.getElementById('shipname').value;
            let field2 = document.getElementById('shipgstnumber').value;
            let field3 = document.getElementById('shipgstcode').value;
            let field4 = document.getElementById('shipstate').value;
            let field5 = document.getElementById('shipcity').value;
            //let field5=document.getElementById("shipcity").selectedIndex;
            console.log(field5);
            let field6 = document.getElementById('shipdistrict').value;
            let field7 = document.getElementById('shippincode').value;
            let field8 = document.getElementById('shipaddress').value;


            if (this.checked) {
                document.getElementById('billname').value = field1;
                document.getElementById('billgstnumber').value = field2;
                document.getElementById('billgstcode').value = field3;
                document.getElementById('billstate').value = field4;
                // document.getElementById('billcity').value = field5;
                //document.getElementById("billcity").options[field5].value;
                //$('#billcity').val(document.getElementById('billstate').options[field5].value);
                // $('#billcity').append("<option value="+"lkjjkl"+">"+"hjkjhkj"+"</option>");
                $('#billcity').empty();
                $('#billcity').append('<option value="'+field5+'">'+field5+'</option>');
                document.getElementById('billdistrict').value = field6;
                document.getElementById('billpincode').value = field7;
                document.getElementById('billaddress').value = field8;
            } else {
                document.getElementById('billname').value = "";
                document.getElementById('billgstnumber').value = "";
                document.getElementById('billgstcode').value = "";
                document.getElementById('billstate').value = "";
                document.getElementById('billcity').value = ""
                document.getElementById('billdistrict').value = "";
                document.getElementById('billpincode').value = "";
                document.getElementById('billaddress').value = "";
            }
        });

        $('#form1').on('click', function(e) {



            e.preventDefault(); // <--- prevent form from submitting

            Swal.fire({
                title: 'Remove Profile Picture',
                text: 'Are you sure you want to remove your profile picture?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, proceed',
                cancelButtonText: 'No, cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('submission').submit();

                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire(
                        'Cancelled',
                        'Your action has been cancelled.',
                        'error'
                    );

                }
            });
        });





        $("#forms").validate({
            rules: {

                'shipname': {
                    required: true,
                },
                'shipaddress': {
                    required: true,
                },
                'shipstate': {
                    required: true,
                },
                'shipdistrict': {
                    required: true,
                },
                'shipcity': {
                    required: true,
                },
                'shippincode': {
                    required: true,
                    minlength: 6,
                    maxlength: 6,
                },
                'shipgstnumber': {
                    required: true,
                    minlength: 15,
                    maxlength: 15,
                },
                'shipgstcode': {
                    required: true,
                    minlength: 2,
                    maxlength: 2,
                },

                'billname': {
                    required: true,
                },
                'billaddress': {
                    required: true,
                },
                'billstate': {
                    required: true,
                },
                'billdistrict': {
                    required: true,
                },
                'billcity': {
                    required: true,
                },
                'billpincode': {
                    required: true,
                    minlength: 6,
                    maxlength: 6,
                },
                'billgstnumber': {
                    required: true,
                    minlength: 15,
                    maxlength: 15,
                },
                'billgstcode': {
                    required: true,
                    minlength: 2,
                    maxlength: 2,
                }
            },

            messages: {

                'shipname': "Please enter a valid Shipping Name.",
                'shipaddress': "Please enter a valid Shipping Address.",
                'shipstate': "Please enter a valid Shipping State.",
                'shipdistrict': "Please enter a valid Shipping District.",
                'shipcity': "Please enter a valid Shipping City.",
                'shippincode': "Please enter a valid Shipping Zipcode.",
                'shipgstnumber': "Please enter your GST Number (15 digit).",
                'shipgstcode': "Please enter a valid Shipping GST Code.",

                'billname': "Please enter a valid Billing Name.",
                'billaddress': "Please enter a valid Billing Address.",
                'billstate': "Please enter a valid Billing State.",
                'billdistrict': "Please enter a valid Billing District.",
                'billcity': "Please enter a valid Billing City.",
                'billpincode': "Please enter a valid Billing Zipcode.",
                'billgstnumber': "Please enter your GST Number (15 digit).",
                'billgstcode': "Please enter a valid Billing GST Code.",
            }

        });
        let user = document.getElementById('username').innerHTML;
        user = user.charAt(0).toUpperCase() + user.slice(1);

        document.getElementById('username').innerHTML = user;



        $(document).ready(function() {
            $('#shipstate').on('change', function() {
                var stateId = $(this).val();
                if (stateId) {
                    $.ajax({
                        url: '/get-cities/' + stateId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#shipcity').empty();
                            $('#shipcity').append('<option value="">Select City</option>');
                            $.each(data, function(key, value) {
                                $('#shipcity').append('<option value="' + value
                                    .name + '">' + value.name + '</option>');
                            });


                        }
                    });
                } else {
                    $('#shipcity').empty();
                    $('#shipcity').append('<option value="">Select City</option>');
                }
            });
            $('#billstate').on('change', function() {
                var stateId = $(this).val();
                console.log(stateId);
                if (stateId) {
                    $.ajax({
                        url: '/get-cities/' + stateId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#billcity').empty();
                            $('#billcity').append('<option value="">Select City</option>');
                            $.each(data, function(key, value) {
                                $('#billcity').append('<option value="' + value
                                    .name + '">' + value.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#billcity').empty();
                    $('#billcity').append('<option value="">Select City</option>');
                }
            });

        });
    </script>
@endsection
