<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  {{--
  <meta http-equiv="refresh" content="7"> --}}
  <meta name="csrf-token" content="{{csrf_token()}}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/login-signup/admin_logo_img.png')}}">
  <title>PSIEC</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css"
    href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" />
  <link rel="stylesheet" type="text/css" href="{{asset('css/chat.css')}}" />
  <link rel="stylesheet" type="text/css" href="{{asset('css/booking.css')}}" />
  <link href='https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.css' type='text/css' rel='stylesheet'>

  <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/booking.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/payment.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/category.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/raw-material.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/total-payment.css') }}" />
</head>
<style>
  .chat-wrapper {

    box-shadow: 4px 6px 0px 0px #11bfdc;
  
    margin: auto;
    padding: 35px 35px 0px 35px;
  }

  .heading {
    / background-color: #ff9618b0;/ padding: 50px 0px;
    margin-bottom: 20px;
  }

  input#btnSubmit {
    position: absolute;
    top: 50%;
    right: 22px;
    transform: translateY(-50%);
    border-radius: 10px;
    padding: 5px 10px;
    border: 1px solid;
    background-color: #bbf5ff00;
    color: #416078;
    font-weight: 600;
  }

  textarea#textAreaMsg {
    padding: 12px 120px 12px 55px;
    background-color: #f1f1f1;
  }

  form#image-upload {
    border-radius: 40% !important;
    width: 30px !important;
    min-height: 0px !important;
    box-sizing: border-box;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    left: 18px;
    background: #fff;
    padding: 0px 0px 0px 8px !important;
    height: 30px !important;
    display: flex;
    text-align: center;
  }

  .dz-preview {
    position: relative;
    top: -163px;
    left: -44px;
  }

  .dz-default.dz-message {
    display: none;
  }

  .message_body {
    display: block;
    margin-bottom: 15px;
  }

  .color_message {
    background-color: #8beeff;
    display: inline-block;
    padding: 10px;
    border-radius: 10px;
    color: #000;
  }

  .color_message.user {
    background-color: #eaf0f6;
    color: #000;
    Clear: both;
  }

  .timer {
    margin-top: 19px;
    float: right;
  }

  .read_by {
    font-weight: 800;

  }

  .chat-wrapper {
    position: relative;
    margin-top: 50px;
    height: 750px;
  }

  .image_chat img {
    width: 100%;
  }

  .image_chat {
    position: absolute;
    top: -32px;
    width: 70px;
    padding: 15px;
    left: 50%;
    background-color: #fff;
    border-radius: 100%;
    transform: translateX(-50%);
    box-shadow: 0px 0px 7px -2px #0000007a;

  }

  .text-head {
    display: flex;
    justify-content: center;
    padding-top: 25px;
    position: relative;
  }

  .text_control {
    padding: 10px 19px;
    font-size: 15px;
  }

  textarea::placeholder {
    font-size: 15px;
  }

  .all_reply {
    font-size: 20px;
    margin-bottom: 25px;
    font-weight: 600;
  }

  .message_body.user {
    margin-left: 70px;
    display: inline-block;
  }

  .message_body.user div {
    float: right;
  }

  .svg-icon {
    width: 20px;
    position: absolute;
    right: 10%;
    top: 54%;
    cursor: pointer;
  }
.message_body.admin .read_by
{
  display: block;
}
.message_body.user .read_by
{
  float: right;
}
  #submitDiv {
    display: inline-flex;
    flex-direction: column-reverse;
    width: 100%;
    height: 500px;
    overflow-y: scroll;
    padding-right: 15px;
}

  .set-background {
  
    background-size: 250px;
    height: 579px;
    background-attachment: fixed;
  }


  .items-drop li a:hover {
background-color: #bbf5ff !important;
}
.icon-container {
position: relative;
display: inline-block;
left: -10px;
}

.badge
{
  display: none!important;
}
.icon {
/* width: 100px; Adjust the size of the icon */
/* height: 100px; */
/* background-color: #3498db; Change this to your icon's background color */
/* border-radius: 50%; */
}

.badge {
position: absolute;
top: 0;
right: 0;
left:11px;
width: 15px;
height: 15px;
background-color: #e74c3c; /* Change this to the badge color */
color: white;
border-radius: 50%;
display: flex;
justify-content: center;
align-items: center;
animation: pulseBadge 2s infinite; /* Change animation duration as needed */
opacity: 0.9; /* Initial opacity */
}

@keyframes pulseBadge {
0%, 100% {
  transform: scale(1);
  opacity: 0.9;
}
50% {
  transform: scale(1.2);
  opacity: 1;
}
}
</style>

<body>

  @include('vendor.sweetalert.alert')
  <div class="main">
    <!--  Navigation -->
    {{-- <section>
      <div class=" container-fluid px-0 language-2-header">
        <div class="">
          <div class="col-12 col-xl-6 offset-xl-5 lang-head d-flex align-items-center px-md-0 py-2 justify-content-end">
            <ul class="tabs-area d-flex">
              <li class="language-links">
                <a class="language-text" class="links-text" aria-current="page" href="#">Skip to Main Content</a>
              </li>
              <li class="language-links">
                <a class="language-text" href="#">Screen Reader Access</a>
              </li>
              <li class="language-links">
                <a class="language-text" href="#">Font Size:</a>
              </li>
              <li class="language-links">
                <a class="language-text" href="#"><img src="images/home-page/minus.png" alt="show password"
                    class="img-fluid eye-icon" width="24" height="17" /></a>
              </li>
              <li class="language-links">
                <a class="language-text" href="#"><img src="images/home-page/plus.png" alt="show password"
                    class="img-fluid eye-icon" width="24" height="17" /></a>
              </li>
              <li class="language-links">
                <a class="language-text" href="#">Colors</a>
              </li>
              <li class="language-links">
                <a class="language-text grey-theme" href="#"></a>
              </li>
              <li class="language-links me-2">
                <a class="language-text black-theme" href="#"></a>
              </li>
              <li class="language-links">
                <a class="language-text pe-2" href="#">English</a>|
                <a class="language-text ps-2" href="#">Hindi</a>
              </li>
            </ul>
            <a href="/logout" class="btn btn-outline-secondary  account-btn ms-1" id="logoutid">Logout</a>
          </div>
        </div>
      </div>
      <div class="primary-menu">
        <div class="container">
          <div class="row my-3">
            <div class="col-md-3">
              <a href="" class="brand">
                <img src="images/home-page/top-logo.png" class="img-fluid navbar-brand" alt="no-image" />
              </a>
            </div>
            <div class="col-md-9">
              <div class="menus">
                <div id="search-bar">
                  <i id="search-icon" class="fa fa-search" aria-hidden="true"></i>
                  <input id="search-input" placeholder="Search" />
                </div>
                <div class="navbar-nav ms-auto">
                  <ul>
                    <li>
                      <a href="">
                        <img src="images/home-page/bell.png" class="img-fluid" alt="no-image" />
                      </a>
                    </li>
                    <li>
                      <a href="">
                        <img src="images/home-page/square.png" class="img-fluid" alt="no-image" />
                      </a>
                    </li>
                    <li>
                      <a href="" class="btn btn-primary account-btn">
                        My Account
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- </div> -->
        <nav class="navbar navbar-expand-lg p-0">
          <div class="container-fluid mb-2 mb-md-0 p-0">
            <button class="navbar-toggler ms-auto me-2 me-md-0" type="button" data-bs-toggle="collapse"
              data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false"
              aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
              <span class="navbar-text d-md-flex justify-content-center align-items-center w-100">
                <ul class="navbar-nav mb-2 mb-lg-0 align-items-center">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Products</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">About Us</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">News</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Contact Us</a>
                  </li>
                </ul>
              </span>
            </div>
          </div>
        </nav>
      </div>
    </section> --}}



    <section>
      <div class=" container-fluid px-0 language-2-header">
      <div class="">
        <div class="col-12 col-xl-6 offset-xl-5 lang-head d-flex align-items-center px-md-0 py-2 justify-content-end ">
          <ul class="tabs-area d-flex">
            <li class="language-links">
              <a class="language-text" class="links-text" aria-current="page" href="#">Skip to Main Content</a>
            </li>
            <li class="language-links">
              <a class="language-text" href="#">Screen Reader Access</a>
            </li>
            <li class="language-links">
              <a class="language-text" href="#">Font Size:</a>
            </li>
            <li class="language-links">
              <a class="language-text" href="#"><img src="{{asset('images/home-page/minus.png')}}" alt="show password"
                  class="img-fluid eye-icon" width="24" height="17" /></a>
            </li>
            <li class="language-links">
              <a class="language-text" href="#"><img src="{{asset('images/home-page/plus.png')}}" alt="show password"
                  class="img-fluid eye-icon" width="24" height="17" /></a>
            </li>
            <li class="language-links">
              <a class="language-text" href="#">Colors</a>
            </li>
            <li class="language-links">
              <a class="language-text grey-theme" href="#"></a>
            </li>
            <li class="language-links me-2">
              <a class="language-text black-theme" href="#"></a>
            </li>
            <li class="language-links">
              <a class="language-text pe-2" href="#">English</a>|
              <a class="language-text ps-2" href="#">Hindi</a>
            </li>
          </ul>
        </div>
      </div>
      </div>
      <div class="primary-menu">
      <div class="container">
        <div class="row my-3">
          <div class="col-md-3">
            <a href="" class="brand">
              <img src="{{asset('images/home-page/top-logo.png')}}" class="img-fluid navbar-brand" alt="no-image" />
            </a>
          </div>
          <div class="col-md-9">
            <div class="menus">
              <div id="search-bar">
                <i id="search-icon" class="fa fa-search" aria-hidden="true"></i>
                <input id="search-input" placeholder="Search" />
              </div>
              <div class="navbar-nav ms-auto">
                <ul>
                  <form  class="icon-container" >
                      <div class="icon">
                          <button tye="button" style="border: none; background:none;" onclick="fun(event)">
                            <img  src="{{asset('images/home-page/bell.png')}}" id="read" class="img-fluid" alt="no-image" />
                          </button>
                      </div>
                      <div class="badge">
                            <div id="notification-badge" style="font-size:8px;" class="icon-badge"></div>
                        </div>
                  </form>
                  <li>
                    <a href="">
                      <img src="{{asset('images/home-page/square.png')}}" class="img-fluid" alt="no-image" />
                    </a>
                  </li>
                  <li>
      
                    <div class="dropdown ">
                      <button class="  account-btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        MY ACCOUNT
                      </button>
                      <ul class="dropdown-menu dropdown-menu-end">
                          <li class="ms-1 mt-2"><a class="dropdown-item" href="/profile">
                            <img src="{{asset('images/home-page/nav_user.png')}}" alt="Sent"style="width:32px;">
                            <div class="dropdown-text d-inline">
                              Profile
                            </div>
                          </a></li>
                          <li class="ms-1 mt-2"><a class="dropdown-item" href="/RawMaterial">
                            <img src="{{asset('images/home-page/nav_product.png')}}" alt="Sent"style="width:32px;">
                            <div class="dropdown-text d-inline">
                              Products
                            </div>
                          </a></li>
                          <li class="ms-1 mt-2"><a class="dropdown-item" href="/booking">
                            <img src="{{asset('images/home-page/Sent.png')}}" alt="Sent">
                            <div class="dropdown-text d-inline">
                              My Bookings
                            </div>
                          </a></li>
                          <li class="ms-1 mt-2"><a class="dropdown-item" href="/order">
                            <img src="{{asset('images/home-page/Combined-Shape.png')}}" alt="Combined-Shape">
                            <div class="dropdown-text d-inline">
                              My Orders
                            </div>
                          </a></li>
                          <li class="ms-1 mt-2"><a class="dropdown-item" href="/user/dashboard">
                            <img src="{{asset('images/home-page/nav_dashboard.png')}}" alt="dashboard" style="width:32px;">
                            <div class="dropdown-text d-inline">
                             Dashboard
                            </div>
                          </a></li>
                        <li class="ms-2 mt-2"><a class="dropdown-item" href="/logout">
                            <img src="{{asset('images/home-page/Logout.png')}}" alt="Logout">
                            <div class="dropdown-text d-inline">
                              Logout
                            </div>
                          </a></li>
                      </ul>
                    </div>
                 </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- </div> -->
      <nav class="navbar navbar-expand-lg p-0">
        <div class="container-fluid mb-2 mb-md-0 p-0">
          <button class="navbar-toggler ms-auto me-2 me-md-0" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarText">
            <span class="navbar-text d-md-flex justify-content-center align-items-center w-100">
              <ul class="navbar-nav mb-2 mb-lg-0 align-items-center">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="home">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="home">Products</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="home">About Us</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="home">News</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="home">Contact Us</a>
                </li>
              </ul>
            </span>
          </div>
        </div>
      </nav>
      </div>
      </section>
    <div class="alert alert-warning text-center">
      <strong>Note!</strong> Kindly submit the required documents for <b>approval</b>. If already submitted then please
      wait for
      <b>approval confirmation.</b>
    </div>
    {{-- Message Section --}}
    <section class="heading">
      <div class="container px-5 my-5">
        <div class="chat-wrapper">
          <div class="row ">
            <div class="col-12 border-bottom">
              <h3 style="font-size:18px;color: #939497;">Reply</h3>
            </div>
            <div class=" col-md-12 set-background">
              <div class=" mt-4">
                <div class="justify-content-end d-flex">
                  {{-- <button type="button" class="btn btn-outline-secondary me-3 clear_btn"
                    id="btnClear">Clear</button>
                  <input class="submit_btn" type="submit" value="Submit" id="btnSubmit"> --}}
                </div>
              </div>
              <div class="col-12 scroll-chat  ">
                {{-- <p class="note-text">Note:Username will not appear on the app.</p> --}}
                <div class="msg-grp">
                  <p>
                  <div id="submitDiv"></div>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-12 text-message">
              <div class="my-4 row" style="position: relative">
                <form id="chatForm">
                  @csrf
                  {{-- <label for="textAreaMsg" class="col-sm-2 col-form-label">Message</label> --}}
                  <textarea class="col-sm-9 form-control w-100 mx-auto" name="textAreaMsg" id="textAreaMsg" rows="1"
                    placeholder="Type message here" required style="resize: none;"></textarea>
                  <input class="submit_btn" type="submit" value="Send now" id="btnSubmit">
                </form>
                <form action="{{ route('dropzone.store') }}" method="post" enctype="multipart/form-data"
                  id="image-upload" class="dropzone">
                  @csrf
                  +
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    {{-- <div class="container"> --}}
      <div class="row">
      </div>
      {{--
    </div> --}}
    <!--  Footer -->
    <footer id="footer">
      <div class="footer-top">
        <div class="container">
          <div class="row py-md-5">
            <div class="col-md-3 col-lg-3 col-xl-3">
              <div class="py-5">
                <img src="images/home-page/logo-psiec.png" alt="footer-logo" class="img-fluid">
              </div>
            </div>
            <div class="col-md-9 col-lg-9 col-xl-9">
              <div class="row">
                <div class="col-md-3">
                  <h4>Products</h4>
                  <ul class="list-unstyled mt-5">
                    <li>
                      <a href="#" class="text-decoration-none">Rectangular Pipe</a>
                    </li>
                    <li>
                      <a href="#" class="text-decoration-none">Steel Pipe</a>
                    </li>
                    <li>
                      <a href="#" class="text-decoration-none">Steel Plate</a>
                    </li>
                    <li>
                      <a href="#" class="text-decoration-none">Steel Round Bar</a>
                    </li>
                    <li>
                      <a href="#" class="text-decoration-none">Steel Flat Bar</a>
                    </li>
                    <li>
                      <a href="#" class="text-decoration-none">Profie/Structual Steel</a>
                    </li>
                  </ul>
                </div>
                <div class="col-md-3">
                  <h4>Quick Links</h4>
                  <ul class="list-unstyled mt-5">
                    <li>
                      <a href="#" class="text-decoration-none">Home</a>
                    </li>
                    <li>
                      <a href="#" class="text-decoration-none">Act</a>
                    </li>
                    <li>
                      <a href="#" class="text-decoration-none">Land Mark</a>
                    </li>
                    <li>
                      <a href="#" class="text-decoration-none">Focal Points Layout Plan</a>
                    </li>
                    <li>
                      <a href="#" class="text-decoration-none">Upcoming Projects</a>
                    </li>
                  </ul>
                </div>
                <div class="col-md-2">
                  <h4>My Accounts</h4>
                  <ul class="list-unstyled mt-5">
                    <li>
                      <a href="#" class="text-decoration-none">Company Profile</a>
                    </li>
                    <li>
                      <a href="#" class="text-decoration-none">Corporate vision</a>
                    </li>
                    <li>
                      <a href="#" class="text-decoration-none">My Orders</a>
                    </li>
                    <li>
                      <a href="#" class="text-decoration-none">My Cart</a>
                    </li>
                  </ul>
                </div>
                <div class="col-md-4">
                  <h4>Contact Us</h4>
                  <ul class="list-unstyled-end mt-5">
                    <li>
                      <a href="#" class="text-decoration-none">
                        <p>

                          <span><b>Address:</b>: 18-Himalya Marg, Udyog Bhawan, Sector 17A,
                            Chandigarh - 160017</span>
                        </p>
                      </a>
                    </li>
                    <li>
                      <a href="#" class="text-decoration-none">
                        <span>
                          <img src="images/home-page/call.png" class="img-fluid" alt="no-image">
                        </span>

                        <span><b>Tel</b>: 0172-2702301-305</span></a>
                      </a>
                    </li>
                    <li>
                      <a href="#" class="text-decoration-none">
                        <span>
                          <img src="images/home-page/Vector.png" class="img-fluid" alt="no-image">
                        </span>
                        <span> <b>E-mail</b> : eauctions.psiec@gmail.com</span>
                      </a>
                    </li>
                    <li>
                      <a href="#" class="text-decoration-none">
                        <span>
                          <img src="images/home-page/whatsapp.png" class="img-fluid" alt="no-image">
                        </span>
                        <span>
                          <b>Whatsapp</b>: +86-13029879858
                        </span>
                      </a>
                    </li>
                  </ul>
                  <div class="social-icons my-md-4">
                    <ul>
                      <li>
                        <a href="">
                          <img src="images/home-page/facebook.png" class="img-fluid">
                        </a>
                      </li>
                      <li>
                        <a href="">
                          <img src="images/home-page/twitter.png" class="img-fluid">
                        </a>
                      </li>
                      <li>
                        <a href="">
                          <img src="images/home-page/instagram.png" class="img-fluid">
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-bottom w-100">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="copyright">
                <p>
                  © 2023 Punjab Small Industries & Export Corporation | All Rights
                  Reserved
                </p>
                <p>Designed & Developed by : anviam Solutions Pvt. Ltd.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js' type='text/javascript'></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
    <script src="{{asset('js/chat.js')}}"></script>
    <script>
      $.ajax({
          url: '/chatcount',
          method: 'GET',
          dataType: 'JSON',
          success:function(response){
      
              if(response.chatCount=="")
              {
                 document.getElementsByClassName('badge')[0].style.display="none";
                 document.getElementById('notification-badge').style.display="none";
              }
              document.getElementById('notification-badge').innerHTML=response.chatCount;
          }
      });
      function fun(event)
      {
          event.preventDefault();
          window.location.href="/chat";
          console.log("asdf");
      }
      
      </script>
      
</body>

</html>