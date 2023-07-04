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
</head>

<body>
  <div class="main">
    <!--  Navigation -->
    <section>
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
    </section>
    <div class="alert alert-warning text-center">
      <strong>Note!</strong> Kindly submit the required documents for <b>approval</b>. If already submitted then please
      wait for
      <b>approval confirmation.</b>
    </div>
    {{-- Message Section --}}
    <section>
      <div class="container px-5 my-5">
        <div class="chat-wrapper">
          <div class="row">
            <div class="col-12 border-bottom">
              <h3>Reply</h3>
            </div>
            <div class=" col-md-4 mt-2 border-bottom">
              <form action="{{ route('dropzone.store') }}" method="post" enctype="multipart/form-data" id="image-upload"
                class="dropzone">
                @csrf
                <div>
                  <h4>Upload </h4>
                </div>
              </form>
            </div>
            <div class="col-12 col-md-8  border-bottom">
              <div class="my-4 row">
                <form id="chatForm">
                  @csrf
                  <label for="textAreaMsg" class="col-sm-2 col-form-label">Message</label>
                  <textarea class="col-sm-9 form-control" name="textAreaMsg" id="textAreaMsg" rows="3"
                    required></textarea>
              </div>
            </div>
            <div class=" mt-4">
              <div class="justify-content-end d-flex">
                <button type="button" class="btn btn-outline-secondary me-3" id="btnClear">Clear</button>
                <input class="btn btn-primary" type="submit" value="Submit" id="btnSubmit">
              </div>
            </div>
            <div class="col-12 scroll-chat mt-4 ">
              <p class="note-text">Note:Username will not appear on the app.</p>
              <div class="msg-grp">
                <p>
                <div id="submitDiv"></div>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    </form>
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
    <script src="{{asset('js/chat.js')}}"></script>
</body>

</html>