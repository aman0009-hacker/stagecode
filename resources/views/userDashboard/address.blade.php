@extends('userDashboard.maindashboard')




@section('content')
<style>
    .number-wise {
     text-align: center;
     background-color: #6c757d;
     border-radius: 50%;
     width: 30px;
     height: 30px;
     display: inline-block;
     padding-top: 3px;
     color: #fff;
 }
 span.contact.header {
     font-weight: 600;
     color: #6c757d;
     font-size: 20px;
 }
 
 .input-fields {
     margin-left: 50px;
     margin-top: 30px;
 }
 label {
     display: block!important;
     color: #6c757d;
     font-weight: 500!important;
 }
 .input {
    border: 1px solid lightgrey;
    border-radius: 7px;
    padding: 0.4rem 1rem;
    width: 70%;
    display: inline-block;
    height: 40px;
}
 textarea
 {
     border: 1px solid lightgrey;
     padding: 0.4rem 1rem;
    
    border-radius: 7px;  
 }

 </style>
<div class="row">

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="contact-body">
                                <span class="number-wise">1</span><span class="contact header ml-3">Contact Information</span>
                                <div class="input-fields">
                                      <div class="row">
                                        <div class="col-12">
                                            <label for="name">Name</label>
                                            <span class="input">{{$data->name ?? ""}} {{$data->last_name ?? ""}}</span>
        
                                        </div>
                                        <div class="col-12 mt-3" >
                                            <label for="number">Phone Number</label>
                                            <span class="input">{{$data->contact_number ?? ""}} </span>
        
                                        </div>
                                        <div class="col-12 mt-3">
                                            <label for="name">Email address</label>
                                            <span class="input">{{$data->email ?? ""}} </span>
                                         
        
                                        </div>
                                      </div>
                                </div>
                            </div>
                            <hr style="margin:45px 0px !important">
                          </div>
                          
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="shipping-body">
                                <span class="number-wise">2</span><span class="contact header ml-3">Shipping Details</span>
                                <div class="input-fields">
                                      <div class="row">
                                        <div class="col-12">
                                            <label for="name">Shipping's Name</label>
                                            <span class="input">{{$address->shipping_name ?? ""}} </span>
                                         
                                        </div>
                                        <div class="col-12 mt-3" >
                                            <label for="name">GST IN/UIN</label>
                                            <span class="input">{{$address->shipping_gst_number ?? ""}}</span>
                                          
        
                                        </div>
                                        <div class="col-12 mt-3">
                                            <label for="name">GST State Code</label>
                                            <span class="input">{{$address->shipping_gst_statecode ?? ""}}</span>
                                           
        
                                        </div>
                                        <div class="col-12 mt-3">
                                            <label for="name">State</label>
                                            <span class="input">{{$address->shipping_state ?? ""}}</span>
                                            
        
                                        </div>
                                        <div class="col-12 mt-3">
                                            <label for="name">City</label>
                                            <span class="input">{{$address->shipping_city ?? ""}} </span>
                                           
        
                                        </div>
                                        <div class="col-12 mt-3">
                                            <label for="name">District</label>
                                            <span class="input">{{$address->shipping_district ?? ""}} </span>
                                           
        
                                        </div>
                                        <div class="col-12 mt-3">
                                            <label for="name">Pincode</label>
                                            <span class="input">{{$address->shipping_zipcode ?? ""}}</span>
                                           
        
                                        </div>
                                        <div class="col-12 mt-3">
                                            <label for="name">Address</label>
                                            <span class="input">{{$address->shipping_address ?? ""}} </span>
                                         
        
                                        </div>
                                      </div>
                                </div>
                            </div>
                          
                          </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="shipping-body">
                            <span class="number-wise">3</span><span class="contact header ml-3">Billing Details</span>
                            <div class="input-fields">
                                  <div class="row">
                                    <div class="col-12">
                                        <label for="name">Billing's Name</label>
                                        <span class="input">{{$address->billing_name ?? ""}}</span>
                                    
    
                                    </div>
                                    <div class="col-12 mt-3" >
                                        <label for="name">GST IN/UIN</label>
                                        <span class="input">{{$address->billing_gst_number ?? ""}}</span>
                                      
    
                                    </div>
                                    <div class="col-12 mt-3">
                                        <label for="name">GST State Code</label>
                                        <span class="input">{{$address->billing_gst_statecode ?? ""}}</span>
                                  
    
                                    </div>
                                    <div class="col-12 mt-3">
                                        <label for="name">State</label>
                                        <span class="input">{{$address->billing_state ?? ""}}</span>
                                     
    
                                    </div>
                                    <div class="col-12 mt-3">
                                        <label for="name">City</label>
                                        <span class="input">{{$address->billing_city ?? ""}}</span>
                                       
                                    </div>
                                    <div class="col-12 mt-3">
                                        <label for="name">District</label>
                                        <span class="input">{{$address->billing_district ?? ""}}</span>
                                     
    
                                    </div>
                                    <div class="col-12 mt-3">
                                        <label for="name">Pincode</label>
                                        <span class="input">{{$address->billing_zipcode ?? ""}}</span>
                                     
                                    </div>
                                    <div class="col-12 mt-3">
                                        <label for="name">Address</label>
                                        <span class="input">{{$address->billing_address ?? ""}}</span>
                                      
    
                                    </div>
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>

    </div>
  
        </div>
    </div>
</div>

@endsection