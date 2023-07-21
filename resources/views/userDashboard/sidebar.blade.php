<aside class="main-sidebar elevation-4 ">
<style>
  .user_profile
  {
    text-align: center;
    margin-top:15px;
  }
.user_profile a span {
    margin-left: 11px;
    vertical-align: -1px;
    font-weight: 500;
    color:#000!important;
}
</style>
    <!-- Brand Logo -->
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panels mt-4 mb-4 d-flex justify-content-center align-items-center flex-column">
        <div class="image square position-relative display-2 mb-3">
       
          @if ($data->user_image =="")
          <i class="fas fa-fw fa-user  top-50 start-50 translate-middle text-secondary"></i>
         @else 
          <img src="{{asset('upload/'.$data->user_image)}}">
         
          @endif
        </div>
        @if ($data->name !="")
        <h3 id="user_name">{{$data->name}}</h3>
        <p>{{$data->email}}</p>
        @endif
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="{{route('userdashboard')}}" class="nav-link active">
              <img src="{{asset('dist/img/admin/dashboard.png')}}" class="img-fluid nav-icon">
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item menu-open">
            <a href="{{route('home')}}" class="nav-link active">
              <img src="{{asset('dist/img/admin/home.jpeg')}}" class="img-fluid nav-icon">
              <p>
                Home
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('userorder')}}" class="nav-link">
              <img src="{{asset('./dist/img/admin/order.png')}}" class="img-fluid nav-icon">
              <p>
                Orders
              </p>
            </a>
          </li>
        
          <li class="nav-item">
            <a href="{{route('useraddress')}}" class="nav-link">
              <img src="{{asset('./dist/img/admin/location.jpeg')}}" class="img-fluid nav-icon">
              <p>
                Address
              </p>
            </a>
          </li>
          {{-- <li class="nav-item">
            <a href="" class="nav-link">
              <img src="{{asset('./dist/img/admin/plants.png')}}" class="img-fluid nav-icon">
              <p>
                Plants
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <img src="{{asset('./dist/img/admin/products.png')}}" class="img-fluid nav-icon">
              <p>
                Products
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="" class="nav-link">
                  <img src="{{asset('./dist/img/admin/coal.png')}}" class="img-fluid nav-icon">
                  <p>Coal</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <img src="{{asset('./dist/img/admin/steel.png')}}" class="img-fluid nav-icon">
                  <p>Steel</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <img src="{{asset('./dist/img/admin/orders.png')}}" class="img-fluid nav-icon">
              <p>
                Orders
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ChartJS</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <img src="{{asset('./dist/img/admin/buyer.png')}}" class="img-fluid nav-icon">
              <p>
                Buyer
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>General</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <!-- <i class="nav-icon fas fa-edit"></i> -->
              <img src="{{asset('./dist/img/admin/invoice.png')}}" class="img-fluid nav-icon">
              <p>
                Invoice
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <!-- <i class="nav-icon fas fa-table"></i> -->
              <img src="{{asset('./dist/img/admin/setting.png')}}" class="img-fluid nav-icon">
              <p>
                Setting
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
          </li> --}}
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->


    <div class="user_profile">

      <a href="{{url('profile')}}"> <img src="{{asset('./dist/img/admin/user.png')}}" class="img-fluid nav-icon"style="width:28px"><span>Profile</span></a>
    </div>


  </aside>