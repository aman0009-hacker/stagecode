<style>
  .items-drop li a:hover {
    background-color: #bbf5ff !important;
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
              <ul>
                <li>
                  <a href="">
                    <img src="{{asset('images/home-page/bell.png')}}" class="img-fluid" alt="no-image" />
                  </a>
                </li>
                <li>
                  <a href="">
                    <img src="{{asset('images/home-page/square.png')}}" class="img-fluid" alt="no-image" />
                  </a>
                </li>
                <li>
                  {{-- <form method="post" action="{{route('myaccount')}}">
                    @csrf --}}
                    {{-- <a href="#" class="btn btn-primary account-btn" id="myid" style="display:none">
                      My Account
                    </a> --}}
                    {{-- <button type="submit" class="btn btn-secondary account-btn" id="myid" style="display:none">My
                      Account</button> --}}

                    {{-- <a href="/order" class="btn btn-outline-secondary ms-4" id="myOrder" style="display:none">
                      My Order
                    </a> --}}
                    {{-- </form> --}}
                  @auth
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
                  @endguest
                  {{-- <h2 style="display: inline;">
                    <a href="/signup" class="btn btn-outline-secondary" id="mySignUp">
                      Register
                    </a> <a href="/login" class="btn btn-outline-secondary ms-4" id="myLogin">
                      Login
                    </a>

                  </h2> --}}
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