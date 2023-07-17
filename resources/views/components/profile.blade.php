@extends('layouts.main')
@section('content')
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" /> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" rel="stylesheet">
<style>

body
{
color: #9b9ca1;
}
.bg-secondary-soft {
    background-color:#f9f9f9!important;
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
.btn-primary-soft
{
	color:#0b5ed7;
	background-color:#0d6efd33;
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
.box-check input
{

    width: 20px;
    height: 17px;

    vertical-align: -2px;
}
.display_button
{
	display: none;
}
.displaysubmit
{
	visibility: hidden;
}

.profile_change
{

	width:160px;
	height:160px;
	margin:auto;
}
.profile_margin
{
	margin-bottom: 20px;
}


</style>

@include('vendor.sweetalert.alert');
<div class="container mb-5">
<div class="row">
		<div class="col-12">
			<!-- Page title -->
			<div class="my-5">
				<h3>My Profile</h3>
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
									<h4 class="mb-4 mt-0">Contact detail</h4>

								</div>
								<div class="col-md-6 ">
									<form method="post" action="{{route('userimage')}}" enctype="multipart/form-data" class="file-upload">
										@csrf
									<div class="d-inline float-end">
										<button type="button"class="btn btn-success-soft" id="editUserDetails">Edit</button>
										<input type="submit"class="btn btn-primary-soft display_button" id="updatecontact" value="Update">
										
									</div>
								

								</div>
								<!-- First Name -->
								<div class="col-md-6">
									
								
									<input type="hidden" name="id"value="{{$user->id}}"> 
									<label class="form-label">First Name *</label>
									<input type="text" class="form-control user-details" placeholder="" aria-label="First name" value="{{$user->name}}" readonly required name="firstname">
								</div>
								<!-- Last name -->
								<div class="col-md-6">
									<label class="form-label">Last Name *</label>
									<input type="text" class="form-control user-details" placeholder="" aria-label="Last name" value="{{$user->last_name}}" readonly required name="lastname">
								</div>
								<!-- Phone number -->
								<div class="col-md-6">
									<label class="form-label">Phone number *</label>
									<input type="text" class="form-control user-details" placeholder="" aria-label="Phone number" value="{{$user->contact_number}}" readonly name="number" >
								</div>
								<!-- Mobile number -->
								
								<!-- Email -->
								<div class="col-md-6">
									<label for="inputEmail4" class="form-label">Email *</label>
									<input type="email" class="form-control user-details" id="inputEmail4" value="{{$user->email}}" readonly name="email">
								</div>
							
								<!-- Skype -->
							
							</div> <!-- Row END -->
						</div>
					</div>
					<!-- Upload profile -->
					<div class="col-xxl-4 col-md-5">
						<div class="bg-secondary-soft px-4 py-5 rounded">
							<div class="row g-3">
								
								<h4 class="mt-0 text-center" id="uploadphoto">Upload your profile photo</h4>
								<div class="text-center position-relative"id="profileupdation">
									<!-- Image upload -->
									
										
									<div class="square position-relative display-2 mb-3" id="image-preview" style="padding:10px">
				                         @if(!$user->user_image)
										 <i class="fas fa-fw fa-user position-absolute top-50 start-50 translate-middle text-secondary"></i>
										
										 @endif
								
									</div>
									<!-- Button -->
									<input type="file" id="image" name="file" hidden="">

									@if(!$user->user_image)
									<label class="btn btn-success-soft btn-block" for="image">Upload</label>
									
										
										<button type="button" class="btn btn-danger-soft"id="remove-btn">Remove</button>
									
									@endif
									
									
									
								</form>
								<form method="post" action="{{route('removeimage')}}" enctype="multipart/form-data" style="display:inline"id="submission">
									@csrf
									@if($user->user_image)
									<input type="hidden"name="userimageid" value="{{$user->id}}">
									<img src="upload/{{$user->user_image}}"style="width:140px;height:136px;position:absolute;top:9px;left:17px;object-fit:contain"id="upload_image_data">
									<button type="button" class="btn btn-danger-soft"id="form1">Remove</button>
									@endif	
							  </form>
									<!-- Content -->
									@if(!$user->user_image)
									
									<p class="text-muted mt-3 mb-0"><span class="me-1">Note:</span>File size should be less than 500kb <br>Support(jpg, jpeg, png)</p>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div> <!-- Row END -->

				
				<form method="post" action="{{route('profile-address')}}">
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
										<button type="button"class="btn btn-success-soft btn-block" id="editShippingDetails">Edit</button>
										<button type="button"class="btn btn-primary-soft display_button" id="shippingupdate">Update</button>
										
									</div>
									
									
								</div>
								
								<div class="col-md-12">
									<label class="form-label">Shipping's Name *</label>
									<input type="text" class="form-control shipping_detail" placeholder="" aria-label=""name="shipname" value="@if($address) {{$address->shipping_name}}@else  @endif "readonly id="sfield1" required>
									@error('shipname')
									<div style="color:red">{{$message}}</div>
										
									@enderror
								</div>
								
								<div class="col-md-6">
									<label class="form-label">GST IN/UIN *</label>
									<input type="text" class="form-control shipping_detail" placeholder="" aria-label="Twitter" value="@if($address) {{$address->shipping_gst_number}}@else @endif"  readonly  id="sfield2" name="shipgstnumber"required>
									@error('shipgstnumber')
									<div style="color:red">{{$message}}</div>
										
									@enderror
								</div>
								
								<div class="col-md-6">
									<label class="form-label">GST State Code *</label>
									<input type="number" class="form-control shipping_detail" placeholder="" aria-label="ITR" name="shipgstcode" value="@if($address){{$address->shipping_gst_statecode}}@else @endif"  readonly  id="sfield3" required>
									@error('shipgstcode')
									<div style="color:red">{{$message}}</div>
										
									@enderror
								</div>
								<div class="col-md-6">
									<label class="form-label">State *</label>
									<input type="text" class="form-control shipping_detail" placeholder="" aria-label="ITR" name="shipstate" value="@if($address) {{$address->shipping_state}}@else @endif"  readonly  id="sfield4"required>
									@error('shipstate')
									<div style="color:red">{{$message}}</div>
										
									@enderror
								</div>
								
								<div class="col-md-6">
									<label class="form-label">City *</label>
									<input type="text" class="form-control shipping_detail" placeholder="" aria-label="Aadhar" value="@if($address) {{$address->shipping_city}}@else @endif"name="shipcity"  readonly  id="sfield5"required>
									@error('shipcity')
									<div style="color:red">{{$message}}</div>
										
									@enderror
								</div>
								<div class="col-md-6">
									<label class="form-label">District *</label>
									<input type="text" class="form-control shipping_detail" placeholder="" aria-label="Aadhar" value="@if($address) {{$address->shipping_district}}@else @endif"name="shipdistrict"  readonly  id="sfield6"required>
									@error('shipdistrict')
									<div style="color:red">{{$message}}</div>
										
									@enderror
								</div>
								<div class="col-md-6">
									<label class="form-label">Pincode *</label>
									<input type="number" class="form-control shipping_detail" placeholder="" aria-label="Aadhar" value="@if($address){{$address->shipping_zipcode}}@else @endif"name="shippincode"  readonly  id="sfield7"required>
									@error('shippincode')
									<div style="color:red">{{$message}}</div>
										
									@enderror
								</div>
								<div class="col-md-12">
									<label class="form-label">Address *</label>
									<textarea class="form-control shipping_detail"rows="5" placeholder="" aria-label="" value=""name="shipaddress"  readonly  id="sfield8" style="resize: none"required>@if($address) {{$address->shipping_address}}@else @endif</textarea>
									@error('shipaddress')
									<div style="color:red">{{$message}}</div>
										
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
										<button type="button"class="btn btn-success-soft btn-block" id="editBillingDetails">Edit</button>
										<button type="button"class="btn btn-primary-soft display_button" id="billingupdate">Update</button>
										
									</div>
									
									
								</div>
								
								<div class="col-md-12">
									<label class="form-label">Billing's Name *</label>
									<input type="text" class="form-control billing-detail" placeholder="" aria-label=""name="billname" value="@if($address) {{$address->billing_name}}@else @endif"  readonly id="bfield1" 	required>
									@error('billname')
									<div style="color:red">{{$message}}</div>
										
									@enderror
								</div>
								
								<div class="col-md-6">
									<label class="form-label">GST IN/UIN *</label>
									<input type="text" class="form-control billing-detail" placeholder="" aria-label="Twitter" name="billgstnumber" value="@if($address){{$address->billing_gst_number}}@else @endif" readonly id="bfield2"required>
									@error('billgstnumber')
									<div style="color:red">{{$message}}</div>
										
									@enderror
								</div>
								
								<div class="col-md-6">
									<label class="form-label">GST State Code *</label>
									<input type="number" class="form-control billing-detail" placeholder="" aria-label="ITR" name="billgstcode" value="@if($address){{$address->billing_gst_statecode}}@else @endif"  readonly id="bfield3"required>
									@error('billgstcode')
									<div style="color:red">{{$message}}</div>
										
									@enderror
								</div>
								<div class="col-md-6">
									<label class="form-label">State *</label>
									<input type="text" class="form-control billing-detail" placeholder="" aria-label="ITR" name="billstate" value="@if($address) {{$address->billing_state}}@else @endif"  readonly id="bfield4"required>
									@error('billstate')
									<div style="color:red">{{$message}}</div>
										
									@enderror
								</div>
								
								<div class="col-md-6">
									<label class="form-label">City *</label>
									<input type="text" class="form-control billing-detail" placeholder="" aria-label="Aadhar" value="@if($address) {{$address->billing_city}}@else @endif"name="billcity"  readonly id="bfield5"required>
									@error('billcity')
									<div style="color:red">{{$message}}</div>
										
									@enderror
								</div>
								<div class="col-md-6">
									<label class="form-label">District *</label>
									<input type="text" class="form-control billing-detail" placeholder="" aria-label="Aadhar" value="@if($address) {{$address->billing_district}}@else @endif"name="billdistrict"  readonly id="bfield6"required>
									@error('billdistrict')
									<div style="color:red">{{$message}}</div>
										
									@enderror
								</div>
								<div class="col-md-6">
									<label class="form-label">Pincode *</label>
									<input type="number" class="form-control billing-detail" placeholder="" aria-label="Aadhar" value="@if($address){{$address->billing_zipcode}}@else @endif"name="billpincode"  readonly id="bfield7"required>
									@error('billpincode')
									<div style="color:red">{{$message}}</div>
										
									@enderror
								</div>
								<div class="col-md-12">
									<label class="form-label">Address *</label>
									<textarea class="form-control billing-detail"rows="5" placeholder="" aria-label="" value=""name="billaddress"  readonly id="bfield8"style="resize: none"required>@if($address) {{$address->billing_address}}@else @endif</textarea>
									@error('billaddress')
									<div style="color:red">{{$message}}</div>
										
									@enderror
								</div>
								
								<div class="box-check"style="visibility:hidden">
									<input type="checkbox" id="checkbox"> Check the box for same billing address
								</div>
								
								
							</div> <!-- Row END -->
						</div>
					</div>
					
					<div class="col-xxl-12 mb-5 mb-xxl-0">
						<input type="submit"value="Submit Address"class="btn btn-primary-soft displaysubmit " id="mainsubmit" style="display:block;margin:30px auto">
					</div>
					
				</div> <!-- Row END -->
			</form> 
				{{-- <div class="row mb-5 gx-5">
					<div class="col-xxl-6 mb-5 mb-xxl-0">
						<div class="bg-secondary-soft px-4 py-5 rounded">
							<div class="row g-3">

								<div class="col-md-6">

									<h4 class="mb-4 mt-0">Document details</h4>
								</div>
								<div class="col-md-6 ">
									<div class="d-inline float-end">
										<button type="button"class="btn btn-success-soft btn-block" id="editDocumentDetails">Edit</button>
										<button type="button"class="btn btn-primary-soft display_button" id="documentupdate">Update</button>
										
									</div>
								

								</div>
								
								<div class="col-md-6">
									<label class="form-label"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#9b9ca1}</style><path d="M224 96C135.6 96 64 167.6 64 256s71.6 160 160 160c77.4 0 142-55 156.8-128H256c-17.7 0-32-14.3-32-32s14.3-32 32-32H400c25.8 0 49.6 21.4 47.2 50.6C437.8 389.6 341.4 480 224 480C100.3 480 0 379.7 0 256S100.3 32 224 32c57.4 0 109.7 21.6 149.3 57c13.2 11.8 14.3 32 2.5 45.2s-32 14.3-45.2 2.5C302.3 111.4 265 96 224 96z"/></svg> Gst Number</label>
									<input type="text" class="form-control document-details" placeholder="" aria-label="gst"name="gst" value=""  readonly>
								</div>
							
								<div class="col-md-6">
									<label class="form-label"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#9b9ca1}</style><path d="M308.5 135.3c7.1-6.3 9.9-16.2 6.2-25c-2.3-5.3-4.8-10.5-7.6-15.5L304 89.4c-3-5-6.3-9.9-9.8-14.6c-5.7-7.6-15.7-10.1-24.7-7.1l-28.2 9.3c-10.7-8.8-23-16-36.2-20.9L199 27.1c-1.9-9.3-9.1-16.7-18.5-17.8C173.9 8.4 167.2 8 160.4 8h-.7c-6.8 0-13.5 .4-20.1 1.2c-9.4 1.1-16.6 8.6-18.5 17.8L115 56.1c-13.3 5-25.5 12.1-36.2 20.9L50.5 67.8c-9-3-19-.5-24.7 7.1c-3.5 4.7-6.8 9.6-9.9 14.6l-3 5.3c-2.8 5-5.3 10.2-7.6 15.6c-3.7 8.7-.9 18.6 6.2 25l22.2 19.8C32.6 161.9 32 168.9 32 176s.6 14.1 1.7 20.9L11.5 216.7c-7.1 6.3-9.9 16.2-6.2 25c2.3 5.3 4.8 10.5 7.6 15.6l3 5.2c3 5.1 6.3 9.9 9.9 14.6c5.7 7.6 15.7 10.1 24.7 7.1l28.2-9.3c10.7 8.8 23 16 36.2 20.9l6.1 29.1c1.9 9.3 9.1 16.7 18.5 17.8c6.7 .8 13.5 1.2 20.4 1.2s13.7-.4 20.4-1.2c9.4-1.1 16.6-8.6 18.5-17.8l6.1-29.1c13.3-5 25.5-12.1 36.2-20.9l28.2 9.3c9 3 19 .5 24.7-7.1c3.5-4.7 6.8-9.5 9.8-14.6l3.1-5.4c2.8-5 5.3-10.2 7.6-15.5c3.7-8.7 .9-18.6-6.2-25l-22.2-19.8c1.1-6.8 1.7-13.8 1.7-20.9s-.6-14.1-1.7-20.9l22.2-19.8zM112 176a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zM504.7 500.5c6.3 7.1 16.2 9.9 25 6.2c5.3-2.3 10.5-4.8 15.5-7.6l5.4-3.1c5-3 9.9-6.3 14.6-9.8c7.6-5.7 10.1-15.7 7.1-24.7l-9.3-28.2c8.8-10.7 16-23 20.9-36.2l29.1-6.1c9.3-1.9 16.7-9.1 17.8-18.5c.8-6.7 1.2-13.5 1.2-20.4s-.4-13.7-1.2-20.4c-1.1-9.4-8.6-16.6-17.8-18.5L583.9 307c-5-13.3-12.1-25.5-20.9-36.2l9.3-28.2c3-9 .5-19-7.1-24.7c-4.7-3.5-9.6-6.8-14.6-9.9l-5.3-3c-5-2.8-10.2-5.3-15.6-7.6c-8.7-3.7-18.6-.9-25 6.2l-19.8 22.2c-6.8-1.1-13.8-1.7-20.9-1.7s-14.1 .6-20.9 1.7l-19.8-22.2c-6.3-7.1-16.2-9.9-25-6.2c-5.3 2.3-10.5 4.8-15.6 7.6l-5.2 3c-5.1 3-9.9 6.3-14.6 9.9c-7.6 5.7-10.1 15.7-7.1 24.7l9.3 28.2c-8.8 10.7-16 23-20.9 36.2L315.1 313c-9.3 1.9-16.7 9.1-17.8 18.5c-.8 6.7-1.2 13.5-1.2 20.4s.4 13.7 1.2 20.4c1.1 9.4 8.6 16.6 17.8 18.5l29.1 6.1c5 13.3 12.1 25.5 20.9 36.2l-9.3 28.2c-3 9-.5 19 7.1 24.7c4.7 3.5 9.5 6.8 14.6 9.8l5.4 3.1c5 2.8 10.2 5.3 15.5 7.6c8.7 3.7 18.6 .9 25-6.2l19.8-22.2c6.8 1.1 13.8 1.7 20.9 1.7s14.1-.6 20.9-1.7l19.8 22.2zM464 304a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg> Udyam Number</label>
									<input type="text" class="form-control document-details" placeholder="" aria-label="Twitter" value=""  readonly>
								</div>
								
								<div class="col-md-6">
									<label class="form-label"><i class="ri-coin-line"></i> ITR Number</label>
									<input type="text" class="form-control document-details" placeholder="" aria-label="ITR" nmae="itr" value=""  readonly>
								</div>
								
								<div class="col-md-6">
									<label class="form-label"><i class="ri-bank-card-fill"></i> Aadhar Card Number</label>
									<input type="text" class="form-control document-details" placeholder="" aria-label="Aadhar" value=""name="Aadhar"  readonly>
								</div>
								
								<div class="col-md-6">
									<label class="form-label"><i class="ri-pantone-fill"></i> Pan Card Number</label>
									<input type="text" class="form-control document-details" placeholder="" aria-label=" Pan" value=""name=" Pan"readonly>
								</div>
								
								<div class="col-md-6">
									<label class="form-label"><i class="ri-refund-line"></i> Capacity Card Number</label>
									<input type="text" class="form-control document-details" placeholder="" aria-label="Capacity" value=""name="Capacity" readonly>
								</div>
							</div> <!-- Row END -->
						</div>
					</div>

					<!-- change password -->
					
				</div> --}}
				 <!-- Row END -->
				<!-- button -->
				{{-- <div class="gap-3 d-md-flex justify-content-md-end text-center">
					<button type="button" class="btn btn-danger btn-lg">Delete profile</button>
					<button type="button" class="btn btn-primary btn-lg">Update profile</button>
				</div> --}}
		<!-- Form END -->
		</div>
	</div>
	</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
<script>

	var selectedImage;
      
        $('#image').on('change', function() {
            var input = this;
			
		
			$('#updatecontact').removeClass('display_button');
			$('#editUserDetails').addClass('display_button');
			
               let alldetails=document.getElementsByClassName('user-details');
                Array.from(alldetails).forEach(element=>{
					element.readOnly=false;
				})

            if (input.files && input.files[0]) {
				var file=input.files[0];
                

				var allowedExtensions = ['jpg', 'jpeg', 'png'];
                var fileExtension = file.name.split('.').pop().toLowerCase();
				
                if ($.inArray(fileExtension, allowedExtensions) === -1) {
                  
					swal.fire({
						title:'Invalid file extension',
						text:'Allowed extensions are: ' + allowedExtensions.join(', '),
						icon: 'warning',
					});
                    return;
                }

				var size=500* 1024;
				if(size < file.size )
				{
					
					swal.fire({
						title:'Image size exceeds',
						text:'The maximum limit of image is less than 500KB ',
						icon: 'warning',
					});
                    return;
				}
            

				selectedImage=file;
                var reader = new FileReader();

                reader.onload = function(e) {
                    // Display the image in the preview div
                    $('#image-preview').html('<img src="' + e.target.result + '" style="width:140px;height:136px;object-fit:contain">');
                }

                // Read the selected image as a data URL
                reader.readAsDataURL(input.files[0]);
            }
        });

		$('#remove-btn').on('click', function() {
           if(selectedImage)
		   {

			$('#image').val('');  
			$('#updatecontact').addClass('display_button');
			$('#editUserDetails').removeClass('display_button');
			
               let alldetails=document.getElementsByClassName('user-details');
                Array.from(alldetails).forEach(element=>{
					element.readOnly=true;
				})
			
			
			
			$('#image-preview').empty();
			   $('#image-preview').html('<i class="fas fa-fw fa-user position-absolute top-50 start-50 translate-middle text-secondary"></i>');
                }

		   }
        );

		$('#editUserDetails	').on('click',function()
		{
        let userdetails	= document.getElementsByClassName('user-details');
          
		$(this).addClass('display_button');
             $('#updatecontact').removeClass('display_button');
			
		Array.from(userdetails).forEach(element => {
			element.readOnly=false;
		});
		});

		$('#editDocumentDetails	').on('click',function()
		{
        let documentdetails	= document.getElementsByClassName('document-details');
          $(this).addClass('display_button');
		  $('#documentupdate').removeClass('display_button');

		Array.from(documentdetails).forEach(element => {
			element.readOnly=false;
		});
		});

		$('#editPassword').on('click',function()
		{
           let passworddetails=document.getElementsByClassName('changepassword');

		   Array.from(passworddetails).forEach(element => {
			element.readOnly=false;
		});
		});


		$('#editShippingDetails').on('click',function(){
			let shipdetail=document.getElementsByClassName('shipping_detail');

             $(this).addClass('display_button');
			 $('#mainsubmit').removeClass('displaysubmit');
			

		
			Array.from(shipdetail).forEach(element=>{
				element.readOnly=false;
			})
		});

		$('#editBillingDetails').on('click',function()
		{
			$(this).addClass('display_button');
			$('#mainsubmit').removeClass('displaysubmit');
			
			let billngdetail=document.getElementsByClassName('billing-detail');
			Array.from(billngdetail).forEach(element=>{
				element.readOnly=false;
			})
		});



$('#checkbox').on('change',function()
{
let field1=document.getElementById('sfield1').value;
let field2=document.getElementById('sfield2').value;
let field3=document.getElementById('sfield3').value;
let field4=document.getElementById('sfield4').value;
let field5=document.getElementById('sfield5').value;
let field6=document.getElementById('sfield6').value;
let field7=document.getElementById('sfield7').value;
let field8=document.getElementById('sfield8').value;


	if(this.checked)
	{
		document.getElementById('bfield1').value=field1;
		document.getElementById('bfield2').value=field2;
		document.getElementById('bfield3').value=field3;
		document.getElementById('bfield4').value=field4;
		document.getElementById('bfield5').value=field5
		document.getElementById('bfield6').value=field6;
		document.getElementById('bfield7').value=field7;
		document.getElementById('bfield8').value=field8;
	}
	else
	{
		document.getElementById('bfield1').value="";
		document.getElementById('bfield2').value="";
		document.getElementById('bfield3').value="";
		document.getElementById('bfield4').value="";
		document.getElementById('bfield5').value=""
		document.getElementById('bfield6').value="";
		document.getElementById('bfield7').value="";
		document.getElementById('bfield8').value="";
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



if($('#upload_image_data').val() == undefined)
{
	$('#profileupdation').removeClass('profile_change');
	$('#uploadphoto').removeClass('profile_margin');
}
else
{
	$('#profileupdation').addClass('profile_change');
	$('#uploadphoto').addClass('profile_margin');
}





</script>


@endsection
