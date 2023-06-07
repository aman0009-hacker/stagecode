@extends('layouts.main')
@section('content')

<!-- Booking Section -->
<section class="booking">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h3>
          My Booking
        </h3>
      </div>
    </div>
    <div class="row orderhistoryOne-section">
      <div class="col-md-12">
        <div class="row historyBox mb-3">
          <div class="col-12 col-sm-12 col-md-4 col-lg-4">
            <h4 class="orderid mb-0"><span>Order ID:</span>45961-1708753</h4>
          </div>
          <div class="col-12 col-sm-12 col-md-4 col-lg-4">

          </div>
          <div class="col-12 col-sm-12 col-md-4 col-lg-4">
            <h4 class="orderplaced mb-0">
              <span>Booking Date: </span> <span class="order-status">: Mar 20, 2023</span>
            </h4>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table" style="width:100%">
                <thead class="bg-gray">
                  <tr>
                    <th style="width:20%">CATEGORY NAME</th>
                    <th style="width:35%">DESCRIPTION</th>
                    <th style="width:15%">Diameter</th>
                    <th style="width:15%">Size</th>
                    <th style="width:15%">MEASUREMENT</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><a href="" class="text-underline">ERW Pipes</a></td>
                    <td>Its welded longitudinally, manufactured from Strip / Coil and can
                      be manufactured upto 24” OD..</td>
                    <td>8 5/8</td>
                    <td>3 mm</td>
                    <td>10 TON</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-12 text-center">
            <a href="" class="btn btn-secondary order-btn" data-bs-toggle="modal"
              data-bs-target="#confirmationModal">View Order Details</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
<!-- Confirmation Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="order-box mt-5">
              <p>
                Your Booking Confirmation
                <span>on waiting</span>
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer mb-4">
        <a href="" class="btn btn-secondary continue-btn" data-bs-target="#makepaymentnModal"
          data-bs-toggle="modal">ok</a>
        <!-- <button type="button" class="btn btn-primary continue-btn">Ok</button> -->
      </div>
    </div>
  </div>
</div>
<!-- Make payment Modal -->
<!-- Confirmation Modal -->
<div class="modal fade" id="makepaymentnModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="order-box mt-5">
              <p>Your Booking Approved.</p>
              <p>Kindly Pay Booking amount as
                <span>per PSIEC Policy.</span>
              </p>
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer mb-4">
        <a href="./payment.html" class="btn btn-secondary continue-btn">Make Payment</a>
        <!-- <button type="button" class="btn btn-primary continue-btn">Ok</button> -->
      </div>
    </div>
  </div>
</div>