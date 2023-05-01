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
                            <button class="nav-link active m-0" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Steel</button>
                            <button class="nav-link m-0" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Coal</button>
                          </div>
                        </nav>
                        <div class="tab-content p-3" id="nav-tabContent">
                          <div class="tab-pane fade active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="row mb-3">
                              <div class="col-md-12">
                                <div class="category-selection">
                                  <select class="form-select form-select-lg mb-3" aria-label="form-select-lg">
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
          <!-- Hot Product Selling -->
          <section class="product-selling">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-12">
                    <div class="table-responsive">
                      <table class="table" style="width:100%">
                        <thead class="bg-gray">
                            <tr>
                                <th style="width:10%">SELECT</th>
                                <th style="width:20%">CATERORY NAME</th>
                                <th style="width:30%">DESCRIPTION</th>
                                <th style="width:10%">Diameter</th>
                                <th style="width:10%">Size</th>
                                <th style="width:20%">Book</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input class="form-check-input" type="checkbox"></td>
                                <td>ERW Pipes</td>
                                <td>Its welded longitudinally, manufactured from Strip / Coil and can be manufactured upto 24” OD.</td>
                                <td>8 5/8</td>
                                <td>3 mm</td>
                                <td><a href="" class="btn btn-secondary book-now" data-bs-toggle="modal" data-bs-target="#exampleModal">Book Now</a></td>
                            </tr>
                            <tr>
                                <td><input class="form-check-input" type="checkbox"></td>
                                <td>ERW Pipes</td>
                                <td>Its welded longitudinally, manufactured from Strip / Coil and can be manufactured upto 24” OD.</td>
                                <td>8 5/8</td>
                                <td>4 mm</td>
                                <td><a href="" class="btn btn-secondary book-now" data-bs-toggle="modal" data-bs-target="#bookingDetailsModal">Book Now</a></td>
                            </tr>
                            <tr>
                                <td><input class="form-check-input " type="checkbox"></td>
                                <td>ERW Pipes</td>
                                <td>Its welded longitudinally, manufactured from Strip / Coil and can be manufactured upto 24” OD.</td>
                                <td>8 5/8</td>
                                <td>6 mm</td>
                                <td><a href="" class="btn btn-secondary book-now">Book Now</a></td>
                            </tr>
                            <tr>
                              <td><input class="form-check-input " type="checkbox"></td>
                              <td>ERW Pipes</td>
                              <td>Its welded longitudinally, manufactured from Strip / Coil and can be manufactured upto 24” OD.</td>
                              <td>8 5/8</td>
                              <td>6.5 mm</td>
                              <td><a href="" class="btn btn-secondary book-now">Book Now</a></td>
                          </tr>
                          <tr>
                              <td><input class="form-check-input " type="checkbox"></td>
                              <td>ERW Pipes</td>
                              <td>Its welded longitudinally, manufactured from Strip / Coil and can be manufactured upto 24” OD.</td>
                              <td>8 5/8</td>
                              <td>4 mm</td>
                              <td><a href="" class="btn btn-secondary book-now">Book Now</a></td>
                          </tr>
                          <tr>
                              <td><input class="form-check-input " type="checkbox"></td>
                              <td>ERW Pipes</td>
                              <td>Its welded longitudinally, manufactured from Strip / Coil and can be manufactured upto 24” OD.</td>
                              <td>8 5/8</td>
                              <td>6 mm</td>
                              <td><a href="" class="btn btn-secondary book-now">Book Now</a></td>
                          </tr>
                        </tbody>
                    </table>
                    </div>
                  </div>
                </div>

              </div>
            </section>
@endsection

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
                    <h3>ERW Pipes</h3>
                    <p>Its welded longitudinally, manufactured from Strip / Coil and can be manufactured upto 24” OD.</p>
                </div>
                <div class="col-md-6">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>
                                Diameter
                            </strong>
                        </div>
                        <div class="col-md-6">
                            <span>8 5/8</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>
                                SIZE
                            </strong>
                        </div>
                        <div class="col-md-6">
                            <span>3 mm</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <form>
                        <div class="mb-3">
                            <div class="qty">
                            <label for="qty" class="form-label">Quantity*</label>
                            <div>
                                <button class="qtyminus" aria-hidden="true">&minus;</button>
                            <input type="number" name="qty" id="qty" min="1" max="10" step="1" value="1">
                            <button class="qtyplus" aria-hidden="true">&plus;</button>
                            </div>
                        </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <form>
                        <div class="mb-3 ">
                            <label for="formGroupExampleInput" class="form-label measurement">Measurement*</label>
                            <select class="form-select" aria-label="Default select example">
                                <!-- <option selected>Open this select menu</option> -->
                                <option value="1">Tons</option>
                            </select>
                            </div>
                    </form>
                </div>
            </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary cancel-btn" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary order-btn" data-bs-toggle="modal" data-bs-target="#orderModal">Order Submit</button>
            </div>
        </div>
        </div>
    </div>

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
                    <img src="./resources/images/raw-material/order.png" class="img-fluid mb-3" alt="no-image">
                    <p>
                        Thanks for Booking
                        Wait For Admin Approval
                    </p>
                </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary continue-btn">Continue</button>
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
                <table class="table"  style="width:100%">
                    <thead>
                    <tr>
                        <th style="width:20%">Booking Details</th>
                        <th style="width:20%">Description</th>
                        <th style="width:10%">Diameter</th>
                        <th style="width:10%">Size</th>
                        <th style="width:20%">Quantity*</th>
                        <th style="width:20%">Measurement*</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <table>
                                <tr>
                                    <td style="width:40%">
                                        <img src="./resources/images/raw-material/Delete.png" class="img-fluid" alt="no-img">
                                    </td>
                                    <td style="width:60%" class="pipe">ERW Pipes
                                    </td>
                                    <td>3 mm</td>
                                </tr>
                            </table>
                        </td>
                        <td>Its welded longitudinally, manufactured from Strip / Coil and can be...</td>
                        <td>8 5/8</td>
                        <td>3 mm</td>
                        <td>
                            <form>
                                <div class="mb-3">
                                    <div class="qty">
                                    <div>
                                        <button class="qtyminus" aria-hidden="true">&minus;</button>
                                    <input type="number" name="qty" id="qty" min="1" max="10" step="1" value="1">
                                    <button class="qtyplus" aria-hidden="true">&plus;</button>
                                    </div>
                                </div>
                                </div>
                            </form>
                        </td>
                        <td>
                            <form>
                                <div class="mb-3 ">
                                    <select class="form-select" aria-label="Default select example">
                                        <!-- <option selected>Open this select menu</option> -->
                                        <option value="1">Tons</option>
                                    </select>
                                    </div>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table>
                                <tr>
                                    <td style="width:40%">
                                        <img src="./resources/images/raw-material/Delete.png" class="img-fluid" alt="no-img">
                                    </td>
                                    <td style="width:60%" class="pipe">Cold Rolled
                                        Stainless Steel</td>
                                        <td>3 mm</td>
                                </tr>
                            </table>
                        </td>
                        <td>Its welded longitudinally, manufactured from Strip / Coil and can be...</td>
                        <td>8 5/8</td>
                        <td>3 mm</td>
                        <td>
                            <form>
                                <div class="mb-3">
                                    <div class="qty">
                                    <div>
                                        <button class="qtyminus" aria-hidden="true">&minus;</button>
                                    <input type="number" name="qty" id="qty" min="1" max="10" step="1" value="1">
                                    <button class="qtyplus" aria-hidden="true">&plus;</button>
                                    </div>
                                </div>
                                </div>
                            </form>
                        </td>
                        <td>
                            <form>
                                <div class="mb-3 ">
                                    <select class="form-select" aria-label="Default select example">
                                        <!-- <option selected>Open this select menu</option> -->
                                        <option value="1">Tons</option>
                                    </select>
                                    </div>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table>
                                <tr>
                                    <td style="width:40%">
                                        <img src="./resources/images/raw-material/Delete.png" class="img-fluid" alt="no-img">
                                    </td>
                                    <td style="width:60%" class="pipe">PM Plates Steel</td>
                                    <td>3 mm</td>
                                </tr>
                            </table>
                        </td>
                        <td>Its welded longitudinally, manufactured from Strip / Coil and can be...</td>
                        <td>8 5/8</td>
                        <td>3 mm</td>
                        <td>
                            <form>
                                <div class="mb-3">
                                    <div class="qty">
                                    <div>
                                        <button class="qtyminus" aria-hidden="true">&minus;</button>
                                    <input type="number" name="qty" id="qty" min="1" max="10" step="1" value="1">
                                    <button class="qtyplus" aria-hidden="true">&plus;</button>
                                    </div>
                                </div>
                                </div>
                            </form>
                        </td>
                        <td>
                            <form>
                                <div class="mb-3 ">
                                    <select class="form-select" aria-label="Default select example">
                                        <!-- <option selected>Open this select menu</option> -->
                                        <option value="1">Tons</option>
                                    </select>
                                    </div>
                            </form>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
                <button type="button" class="btn btn-secondary cancel-btn" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary order-btn" data-bs-toggle="modal" data-bs-target="#orderSubmitModal">Order Submit</button>

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
                        <img src="./resources/images/raw-material/order.png" class="img-fluid mb-3" alt="no-image">
                        <p>
                            Thanks for Booking
                            Wait For Admin Approval
                        </p>
                    </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary continue-btn">Continue</button>
            </div>
          </div>
        </div>
        </div>
