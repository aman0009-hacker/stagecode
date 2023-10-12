<style>
  .items-drop li a:hover {
background-color: #bbf5ff !important;
}
.icon-container {
position: relative;
display: inline-block;
left: -10px;
}

.icon {
/ width: 100px; Adjust the size of the icon /
/ height: 100px; /
/ background-color: #3498db; Change this to your icon's background color /
/ border-radius: 50%; /
}

.badge {
position: absolute;
top: 0;
right: 0;
left:11px;
width: 15px;
height: 15px;
background-color: #e74c3c; / Change this to the badge color /
color: white;
border-radius: 50%;
display: flex;
justify-content: center;
align-items: center;
animation: pulseBadge 2s infinite; / Change animation duration as needed /
opacity: 0.9; / Initial opacity /
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
      {{-- <button class="btn btn-outline-success  account-btn ms-1" type="submit" id="btnSubmit">Logout</button> --}}
      <a href="/logout" class="btn btn-outline-secondary  account-btn ms-1" style="display:none"
        id="logoutid">Logout</a>
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
            <ul class="alliconshead">
              <form  class="icon-container" >
                  <div class="icon">
                      <button style="border: none; background:none;" onclick="fun(event)">
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
                <form method="post" action="{{route('myaccount')}}">

                  @csrf
                   {{-- <a href="#" class="btn btn-primary account-btn" id="myid" style="display:none">
                    My Account
                  </a>  --}}




                 {{-- @if ($payment_data!==null || $payment_data !=="" || $payment_data!==[])
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
                   @else --}}
                   <button type="submit" class="btn btn-secondary account-btn" id="myid" style="display:none">My
                    Account</button>
                 {{-- @endif --}}



                    {{-- <a href="/order" class="btn btn-outline-secondary ms-4" id="myOrder" style="display:none">
                      My Order
                    </a>  --}}
                </form>
                {{-- @auth
                <div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle border-0" type="button"
                    style="background-color:#bbf5ff;color:#000;" data-bs-toggle="dropdown" aria-expanded="false">
                    My
                    Account
                  </button>
                  <ul class="dropdown-menu items-drop">
                    <li class=" d-block mx-0"><a class="dropdown-item" href="{{route('userprofile')}}">Profile</a>
                    </li>
                    <li class=" d-block mx-0"><a class="dropdown-item" href="#">Dashboard</a></li>
                  </ul>
                </div>
                @endauth
                @guest
                <h2 style="display: inline;">
                  <a href="/signup" class="btn btn-outline-secondary" id="mySignUp">
                    Register
                  </a> <a href="/login" class="btn btn-outline-secondary ms-4" id="myLogin">
                    Login
                  </a>
                </h2>
                @endguest --}}
                <h2 style="display: inline;">
                  <a href="/signup" class="btn btn-outline-secondary" id="mySignUp">
                    Registers
                  </a> <a href="/login" class="btn btn-outline-secondary ms-4" id="myLogin">
                    Login
                  </a>

                </h2>
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
              <a class="nav-link active" aria-current="page" href="{{url('/')}}">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#product">Products</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#about">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#new">News</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#contact">Contact Us</a>
            </li>
            <li>
              @guest
              <li class="register_login">

                <a href="/signup" class="btn btn-outline-secondary" id="mySignUp"style="background-color:#bbf5ff;color: #333333;border:0px">
                  Register
                </a> <a href="/login" class="btn btn-outline-secondary mt-3" id="myLogin"style="background-color:#bbf5ff;color: #333333;border:0px">
                  Login
                </a>
              </li>
              @endguest
            </li>
          </ul>
        </span>
      </div>
    </div>
  </nav>
</div>
</section>
<script>

  $.ajax({
      url: '/chatcount',
      method: 'GET',
      dataType: 'JSON',
      success:function(response){

        if(response.chatCount==""|| response.chatCount===null)
        {
          document.getElementsByClassName('badge')[0].style.display="none";
          document.getElementById('notification-badge').style.display="none";

        }
        else
        {

              document.getElementById('notification-badge').innerHTML=response.chatCount;
          }
      }
  });

  function fun(event)
  {
      event.preventDefault();
      window.location.href="/chat";
      // console.log("asdf");
  }
</script>