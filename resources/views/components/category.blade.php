@extends('layouts.main_account')
@section('content')
<!-- tOGGLER sECTION -->
<section class="raw-material-box">
    {{-- custom logic --}}
    <?php
         if(Auth::check())
         {
            ?>
    <script>
        $("#mySignUp").hide();
                $("#myLogin").hide();
                $("#myid").show();
                $("#logoutid").show();
                $("#myOrder").show();
                
    </script>
    <?php
         }
     ?>
    {{-- custom logic --}}
    <div class="container">
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <form id="productCategoryInfo">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <nav>
                                <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                                    <button class="nav-link active m-0" id="nav-home-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                                        aria-selected="true">Steel</button>
                                    <button class="nav-link m-0" id="nav-profile-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-profile" type="button" role="tab"
                                        aria-controls="nav-profile" aria-selected="false">Coal</button>
                                </div>
                            </nav>
                            <div class="tab-content p-3" id="nav-tabContent">
                                <div class="tab-pane fade active show" id="nav-home" role="tabpanel"
                                    aria-labelledby="nav-home-tab">
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <div class="category-selection">

                                                <select class="form-select form-select-lg mb-3" required
                                                    aria-label="form-select-lg" name="category" id="category"
                                                    onchange="handleCategoryChange(this.value)">
                                                    <option value="">Select</option>
                                                    @if(isset($categoryList))
                                                    @foreach ($categoryList as $id => $name)
                                                    <option value="{{ $id }}" {{ old('category')==$id ? ' selected' : ''
                                                        }}>
                                                        {{ $name }}
                                                    </option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                {{-- <select class="form-select form-select-lg mb-3"
                                                    aria-label="form-select-lg" name="category" id="category">
                                                    <option selected>Select Category</option>
                                                    <option value="1">Pipes</option>
                                                </select> --}}

                                                {{-- <div class="select-selected"></div> --}}

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12 text-center">
                                            {{-- <div class="search">
                                                <span class="search-icon">
                                                    <i class="fa fa-search" aria-hidden="true"></i>
                                                </span>
                                                <input placeholder="Search term">
                                            </div> --}}
                                            <select class="form-select form-select-lg mb-3 category-selection"
                                                aria-label="form-select-lg" name="entity" id="entity" >
                                                <option value="">Select</option>
                                            </select>
                                            <button type="button" value="Submit" class="btn btn-info mt-4"
                                                id="showEntity">Submit</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                    aria-labelledby="nav-profile-tab">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <select class="form-select form-select-lg mb-3 category-selection"
                                                aria-label=".form-select-lg" onchange="handleCategoryChangeCoal(this.value)" name="categoryCoal" id="categoryCoal">
                                                <option value="">Select</option>
                                                @if(isset($categoryListCoal))
                                                @foreach ($categoryListCoal as $id => $name)
                                                <option value="{{ $id }}" {{ old('category')==$id ? ' selected' : ''
                                                    }}>
                                                    {{ $name }}
                                                </option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12 text-center">
                                            {{-- <div class="search">
                                                <span class="search-icon">
                                                    <i class="fa fa-search" aria-hidden="true"></i>
                                                </span>
                                                <input placeholder="Search term">
                                            </div> --}}
                                            <select class="form-select form-select-lg mb-3 category-selection"
                                                aria-label="form-select-lg" name="entityCoal" id="entityCoal" >
                                                <option value="">Select</option>
                                            </select>
                                            <button type="button" value="Submit" class="btn btn-info mt-4"
                                                id="showEntityCoal">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            {{-- <div class="col-md-2">
            </div> --}}
        </div>
    </div>
</section>
<!-- Hot Product Selling -->
<section class="product-selling">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table showDetailsTable" style="width:100%">
                        <thead class="bg-gray">
                            <tr>
                                <th style="width:10%">SELECT</th>
                                <th style="width:20%">CATEGORY NAME</th>
                                <th style="width:30%">DESCRIPTION</th>
                                {{-- <th style="width:10%">Diameter</th>
                                <th style="width:10%">Size</th> --}}
                                {{-- <th style="width:10%">Quanity</th>
                                <th style="width:10%">Measurement</th> --}}
                                <th style="width:30%">Book</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Market Place -->
<section class="raw-market">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12 text-center my-5">
                        <h3>India's Best Raw Material <span>Marketplace</span></h3>
                    </div>
                    <div class="col-lg-3 col-xl-3 col-md-6">
                        <div class="white-box">
                            <h3>9,45,668<span>+</span></h3>
                            <p>Import Products</p>
                            <div class="circle">
                                <img src="{{asset('images/home-page/import.png')}}" class="img-fluid" alt="no-image">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xl-3 col-md-6">
                        <div class="white-box">
                            <h3>30<span>+</span></h3>
                            <p>Product Categories</p>
                            <div class="circle">
                                <img src="{{asset('images/home-page/category.png')}}" class="img-fluid" alt="no-image">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xl-3 col-md-6">
                        <div class="white-box">
                            <h3>500<span>+</span></h3>
                            <p>Register Users</p>
                            <div class="circle">
                                <img src="{{asset('images/home-page/register-user.png')}}" class="img-fluid"
                                    alt="no-image">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xl-3 col-md-6">
                        <div class="white-box">
                            <h3>40<span>+</span></h3>
                            <p>Big Industries</p>
                            <div class="circle">
                                <img src="{{asset('images/home-page/industries.png')}}" class="img-fluid"
                                    alt="no-image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-5">
                <div class="text-center">
                    <a href="#" class="btn btn-secondary text-center">
                        Book Now
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact Us  -->
<section class="contact-us">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 "></div>
            <div class="col-lg-8 col-md-12 text-center py-5">
                <h3>
                    Contact
                    <span>Us At</span>
                </h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="white-box-one">
                            <div class="content">
                                <h4>Helpdesk</h4>
                                <a href="tel:+91-6284999031-32">+91-6284999031-32</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="white-box-two">
                            <div class="content">
                                <h4>Mail</h4>
                                <a href="mailto:eauctions.psiec@gmail.com">eauctions.psiec@gmail.com</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2"></div>
        </div>
    </div>
</section>
<!-- Booking Modal  -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Booking Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <h3></h3>
                        <p></p>
                    </div>
                    {{-- <div class="col-md-6">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <strong>
                                    Diameter
                                </strong>
                            </div>
                            <div class="col-md-6">
                                <span></span>
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-md-6"></div>
                    {{-- <div class="col-md-6">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <strong>
                                    SIZE
                                </strong>
                            </div>
                            <div class="col-md-6">
                                <span></span>
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                        <form>
                            @csrf
                            <div class="mb-3">
                                <div class="qty">
                                    <label for="qty" class="form-label">Quantity*</label>
                                    <div id="number">
                                        {{-- <button class="qtyminus" aria-hidden="true">&minus;</button> --}}
                                        {{-- <input type="number" name="qty" id="qty" min="1" max="10" step="1"
                                            value="1"> --}}
                                        {{-- <button class="qtyplus" aria-hidden="true">&plus;</button> --}}

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <form>
                            @csrf
                            <label class="form-label measurement">Measurement*</label>
                            <div class="mb-3 " id="measurement">
                                {{-- <label for="formGroupExampleInput"
                                    class="form-label measurement">Measurement*</label> --}}
                                {{-- <select class="form-select" aria-label="Default select example">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select> --}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cancel-btn" data-bs-dismiss="modal">Cancel</button>
                {{-- <button type="button" class="btn btn-primary order-btn" data-bs-toggle="modal">Order
                    Submit</button> --}}
                <button type="button" class="btn btn-primary order-btn order-show" data-bs-toggle="modal"
                    data-bs-target="#orderModal">Order Submit</button>
            </div>
        </div>
    </div>
</div>
{{-- </form> --}}
<!--  Order Submit Modal-->
<!-- Modal -->
<div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="order-box">
                            <img src="{{asset('images/raw-material/order.png')}}" class="img-fluid mb-3" alt="no-image">
                            <p>
                                Thanks for Booking
                                Wait For Admin Approval
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-primary continue-btn">Continue</button> --}}
                <a href="/booking" class="btn btn-primary continue-btn">Continue</a>
            </div>
        </div>
    </div>
</div>
<!-- Booking Details Modal -->
<!-- Modal -->
<div class="modal fade" id="bookingDetailsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table showDetailsTableOrder" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width:25%">Booking Details</th>
                                <th style="width:25%">Description</th>
                                {{-- <th style="width:10%">Diameter</th>
                                <th style="width:10%">Size</th> --}}
                                <th style="width:25%">Quantity*</th>
                                <th style="width:25%">Measurement*</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cancel-btn" data-bs-dismiss="modal">Cancel</button>
                {{-- <button type="button" class="btn btn-primary order-btn" data-bs-toggle="modal"
                    data-bs-target="#orderSubmitModal">Order Submit</button> --}}
                <button type="button" class="btn btn-primary order-btn order-bulk">Order Submit</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="orderSubmitModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="order-box">
                            <img src="{{asset('images/raw-material/order.png')}}" class="img-fluid mb-3" alt="no-image">
                            <p>
                                Thanks for Booking
                                Wait For Admin Approval
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                {{-- <a href="/booking" class="btn btn-primary continue-btn">Continue</a> --}}
                {{-- <button type="button" class="btn btn-primary continue-btn">Continue</button> --}}
                <a href="/booking" class="btn btn-primary continue-btn">Continue</a>

            </div>
        </div>
    </div>
</div>
@endsection