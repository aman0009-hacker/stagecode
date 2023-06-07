@extends('layouts.main')
@section('content')
<!--  Banner Section -->
<section class="banner">
  <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
        aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
        aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
        aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="{{asset('images/home-page/homepage.webp')}}" class="d-block carousel-img img-fluid w-100"
          alt="no-image" />
        <div class="carousel-caption  d-md-block">
          <a href="" class="btn btn-secondary welcome-btn mb-4">
            welcome to</a>
          <h2>
            Punjab Small Industries <span>& Export Corporation</span>
          </h2>
          <h5>(A State Government Undertaking)</h5>
        </div>
      </div>
      <div class="carousel-item">
        <img src="{{asset('images/home-page/homepage.webp')}}" class="d-block carousel-img img-fluid w-100"
          alt="no-image" />
        <div class="carousel-caption  d-md-block">
          <a href="" class="btn btn-secondary welcome-btn mb-4">
            welcome to</a>
          <h2>
            Punjab Small Industries <span>& Export Corporation</span>
          </h2>
          <h5>(A State Government Undertaking)</h5>
        </div>
      </div>
      <div class="carousel-item">
        <img src="{{('images/home-page/homepage.webp')}}" class="d-block carousel-img img-fluid w-100" alt="no-image" />
        <div class="carousel-caption  d-md-block">
          <a href="" class="btn btn-secondary welcome-btn mb-4">
            welcome to</a>
          <h2>
            Punjab Small Industries <span>& Export Corporation</span>
          </h2>
          <h5>(A State Government Undertaking)</h5>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
      data-bs-slide="prev">
      <span class="carousel-control-prev-icon d-none" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
      data-bs-slide="next">
      <span class="carousel-control-next-icon d-none" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</section>
@if(Session::has('tab'))
<script>
  $("#mySignUp").hide();
         $("#myLogin").hide();
         $("#myid").show();
         $("#logoutid").show();
</script>
@endif
<?php
   if(Auth::check())
{
if(Auth::user()->state==1)
{
  header("Location: " . URL::to('/signUpSubmit'), true, 302);
  session(['state' => '1']);
  exit();
}
else if(Auth::user()->state==2)
{
  header("Location: " . URL::to('/userDocument'), true, 302);
  exit();
 
}
else if(Auth::user()->state==3  )
{
  header("Location: " . URL::to('/documentProcess'), true, 302);
  session(['state' => '3']);
  exit();
}
else 
{ 
?>
<script>
  $("#myid").show();
 $("#logoutid").show();
 $("#mySignUp").hide();
 $("#myLogin").hide();
</script>
<?php
}
}
?>
<!--  About Section -->
<section class="about-us">
  <div class="container box-shadow">
    <div class="row h-100 align-items-center">
      <div class="col-md-6">
        <div class="about-content">
          <h3 class="my-md-5">About <span>PSIEC</span></h3>
          <p>
            PSIEC Ltd. has been acting as a Catalyst & springboard for all
            round development and promotion of industries in Punjab
            through the development of Industrial infrastructure, namely
            Industrial Focal Points(IFP) ranging between 50 acres to 500
            acres of land at various towns and cities of Punjab. Therefore
            to facilitate the spirit of industry, PSIEC Ltd. provides self
            sufficient industrial focal points.
          </p>
          <a href="#" class="btn btn-secondary read-more mt-md-5 mt-2">Read More
          </a>
        </div>
      </div>
      <div class="col-md-2"></div>
      <div class="col-md-4 mt-5 mt-md-0">
        <div>
          <img src="{{('images/home-page/about-Psiec.webp')}}" class="img-fluid" alt="no-image" />
        </div>
      </div>
    </div>
  </div>
</section>
<!-- PSIEC -->
<section class="psciec">
  <div class="container vision-psice h-100">
    <div class="row h-100 align-items-center">
      <div class="col-lg-9 col-xl-9 col-md-6">
        <div class="vision-section">
          <h3 class="my-md-5">Vision of <span>PSIEC</span></h3>
          <p>
            To create world class industrial infrastructure promoting
            entrepreneurship encouraging all round economic prosperity in
            the Sate. To promote handicrafts and local arts to showcase
            the culture of Punjab in the world. To ensure smooth and
            affordable supply of critical inputs to the industry of Punjab
            and build competitive advantage.
          </p>
          <a href="#" class="btn btn-secondary read-more mt-md-5">Read More
          </a>
        </div>
      </div>
      <div class="col-lg-3 col-xl-3 col-md-6 p-0">
        <div class="notice-board">
          <div class="row tender-box">
            <div class="col-md-12">
              <h3 class="text-center">Tenders</h3>
              <ul>
                <li>
                  Engagement of Subcontractor for the SAIL Stockyard,
                  Ludhiana and Mandigobindgarh
                </li>
                <li>
                  Mass Gifting options for the Purpose of Progressive
                  Punjab Investment Summit 2023 and G20 Summit 2023
                </li>
                <li>
                  Engagement of Subcontractor for the SAIL Stockyard,
                  Ludhiana and Mandigobindgarh
                </li>
              </ul>
            </div>
          </div>
          <div class="row notification-box">
            <div class="col-md-12">
              <h3 class="text-center">NOTIFICATIONS</h3>
              <ul>
                <li>
                  Engagement of Subcontractor for the SAIL Stockyard,
                  Ludhiana and Mandigobindgarh
                </li>
                <li>
                  Mass Gifting options for the Purpose of Progressive
                  Punjab Investment Summit 2023 and G20 Summit 2023
                </li>
                <li>
                  Engagement of Subcontractor for the SAIL Stockyard,
                  Ludhiana and Mandigobindgarh
                </li>
              </ul>
            </div>
          </div>
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
          <div class="col-lg-3 col-xl-3 col-md-6 d-flex justify-content-center">
            <div class="white-box">
              <h3>9,45,668<span>+</span></h3>
              <p>Import Products</p>
              <div class="circle">
                <img src="{{asset('images/home-page/import.png')}}" class="img-fluid" alt="no-image" />
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-xl-3 col-md-6 d-flex justify-content-center">
            <div class="white-box">
              <h3>30<span>+</span></h3>
              <p>Product Categories</p>
              <div class="circle">
                <img src="{{asset('images/home-page/category.png')}}" class="img-fluid" alt="no-image" />
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-xl-3 col-md-6 d-flex justify-content-center">
            <div class="white-box">
              <h3>500<span>+</span></h3>
              <p>Register Users</p>
              <div class="circle">
                <img src="{{asset('images/home-page/register-user.png')}}" class="img-fluid" alt="no-image" />
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-xl-3 col-md-6 d-flex justify-content-center">
            <div class="white-box">
              <h3>40<span>+</span></h3>
              <p>Big Industries</p>
              <div class="circle">
                <img src="{{asset('images/home-page/industries.png')}}" class="img-fluid" alt="no-image" />
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12 mt-5">
        <div class="text-center">
          <a href="#" class="btn btn-secondary text-center"> Book Now </a>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Hot Product Selling -->
<section class="product-selling">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="d-md-flex align-items-center justify-content-between">
          <h3>Our Hot Selling <span>Products</span></h3>
          <div class="pagination">
            <nav aria-label="Page navigation example">
              <ul class="pagination">
                <li class="page-item">
                  <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true"><i class="fa fa-angle-left" aria-hidden="true"></i></span>
                  </a>
                </li>
                <li class="page-item">
                  <a class="page-link" href="#">1</a>
                </li>
                <li class="page-item">
                  <a class="page-link" href="#">2</a>
                </li>
                <li class="page-item">
                  <a class="page-link" href="#">3</a>
                </li>
                <li class="page-item">
                  <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table" style="width: 100%">
            <thead class="bg-gray">
              <tr>
                <th style="width: 10%">SELECT</th>
                <th style="width: 20%">CATERORY NAME</th>
                <th style="width: 30%">DESCRIPTION</th>
                <th style="width: 10%">Diameter</th>
                <th style="width: 10%">Details</th>
                <th style="width: 20%">Book</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <input class="form-check-input" type="checkbox" />
                </td>
                <td>ERW Pipes</td>
                <td>
                  Its welded longitudinally, manufactured from Strip /
                  Coil and can be manufactured upto 24” OD.
                </td>
                <td>8 5/8</td>
                <td>3 mm</td>
                <td>
                  <a href="" class="btn btn-secondary book-now">Book Now</a>
                </td>
              </tr>
              <tr>
                <td>
                  <input class="form-check-input" type="checkbox" />
                </td>
                <td>ERW Pipes</td>
                <td>
                  Its welded longitudinally, manufactured from Strip /
                  Coil and can be manufactured upto 24” OD.
                </td>
                <td>8 5/8</td>
                <td>4 mm</td>
                <td>
                  <a href="" class="btn btn-secondary book-now">Book Now</a>
                </td>
              </tr>
              <tr>
                <td>
                  <input class="form-check-input" type="checkbox" />
                </td>
                <td>ERW Pipes</td>
                <td>
                  Its welded longitudinally, manufactured from Strip /
                  Coil and can be manufactured upto 24” OD.
                </td>
                <td>8 5/8</td>
                <td>6 mm</td>
                <td>
                  <a href="" class="btn btn-secondary book-now">Book Now</a>
                </td>
              </tr>
              <tr>
                <td>
                  <input class="form-check-input" type="checkbox" />
                </td>
                <td>ERW Pipes</td>
                <td>
                  Its welded longitudinally, manufactured from Strip /
                  Coil and can be manufactured upto 24” OD.
                </td>
                <td>8 5/8</td>
                <td>6.5 mm</td>
                <td>
                  <a href="" class="btn btn-secondary book-now">Book Now</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Contact Us  -->
<section class="contact-us">
  <div class="container">
    <div class="row">
      <div class="col-lg-2"></div>
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