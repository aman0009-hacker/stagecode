@extends('layouts.main')
@section('content')
<!-- tOGGLER sECTION -->
<section class="raw-material-box">
  <div class="container">
    <div class="row">
      <div class="col-md-2">
      </div>
      <div class="col-md-8">
        <div class="row mb-3">
          <div class="col-md-12">
            <nav>
              <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                <button class="nav-link active m-0" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                  type="button" role="tab" aria-controls="nav-home" aria-selected="true">Steel</button>
                <button class="nav-link m-0" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                  type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Coal</button>
              </div>
            </nav>
            <div class="tab-content p-3" id="nav-tabContent">
              <div class="tab-pane fade active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="row mb-3">
                  <div class="col-md-12">
                    <div class="category-selection">
                      <select class="form-select form-select-lg mb-3 category-selection" aria-label=".form-select-lg">
                        <option selected>Select Category</option>
                        <option value="1">Pipes</option>
                      </select>
                      <div class="select-selected"></div>
                    </div>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-12 text-center">
                    <div class="search">
                      <span class="search-icon">
                        <i class="fa fa-search" aria-hidden="true"></i>
                      </span>
                      <input placeholder="Search term">
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <div class="row mb-3">
                  <div class="col-md-12">
                    <select class="form-select form-select-lg mb-3 category-selection" aria-label=".form-select-lg">
                      <option selected>Select Category</option>
                      <option value="1">One</option>
                      <option value="2">Two</option>
                      <option value="3">Three</option>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-12">
                    <div class="search">
                      <span class="search-icon">
                        <i class="fa fa-search" aria-hidden="true"></i>
                      </span>
                      <input placeholder="Search term">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-2">
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
                <img src="{{asset('images/home-page/register-user.png')}}" class="img-fluid" alt="no-image">
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-xl-3 col-md-6">
            <div class="white-box">
              <h3>40<span>+</span></h3>
              <p>Big Industries</p>
              <div class="circle">
                <img src="{{asset('images/home-page/industries.png')}}" class="img-fluid" alt="no-image">
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
@endsection