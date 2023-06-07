@extends('layouts.main')
@section('content')
<!-- Booking Section -->
<section class="total-payment">
  <div class="container">
    <div class="row mb-4">
      <div class="col-md-12">
        <div class="invoice">
          <h3>
            Total Payment
          </h3>
          <a href="" class="download-invoice">
            Download Invoice
          </a>
        </div>
      </div>
    </div>
    <div class="row mb-4">
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table" style="width:100%">
            <thead class="bg-gray">
              <tr>
                <th style="width:20%">CATERORY NAME</th>
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
    <div class="row mb-4 amount-box">
      <div class="col-md-4">
        <div class="amount-box-position">
          <h3>Amount</h3>
          <p>22,00,000/-</p>
        </div>
      </div>
      <div class="col-md-4"></div>
      <div class="col-md-4"></div>
    </div>
    <div class="row">
      <div class="col-md-4 ">
        <form class="payment-option">
          <select class="form-select form-select-lg mb-3 category-selection" aria-label="form-select-lg">
            <option selected>Select Payment Option</option>
            <option value="1">Debit Card</option>
            <option value="1">Credit Card</option>
            <option value="1">Mobile Payment</option>
            <option value="1">RTGs</option>
            <option value="1">DD</option>
            <option value="1">Check</option>
          </select>
          <div class="select-selected"></div>
        </form>
      </div>
      <div class="col-md-4 ">
        <form class="payment-form">
          <div class="mb-3">
            <img src="{{asset('images/payment/₹.png')}}" class="img-fluid rupee-icon" />
            <input type="text" class="form-control" id="amount" aria-describedby="nameHelp"
              placeholder="Enter Your Amount">
          </div>
          <div class="mb-3">
            <a href="" class="btn next-btn w-100">NEXT</a>
          </div>
        </form>
      </div>
      <div class="col-md-4 ">
        <form class="payment-method">
          <select class="form-select form-select-lg mb-3 category-selection" aria-label="form-select-lg">
            <option selected>Select Payment Option</option>
            <option value="1">Debit Card</option>
            <option value="1">Credit Card</option>
            <option value="1">Mobile Payment</option>
            <option value="1">RTGs</option>
            <option value="1">DD</option>
            <option value="1">Check</option>
          </select>
          <div class="select-selected"></div>
          <div class="mb-3">
            <input type="text" class="form-control" id="cardnumber" aria-describedby="cardNumbereHelp"
              placeholder="Enter Card Number">
          </div>
          <div class="mb-3">
            <input type="text" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Enter your Name">
          </div>
          <div class="mb-3">
            <div class="row">
              <div class="col-md-6">
                <input type="text" class="form-control" id="date" aria-describedby="dateHelp"
                  placeholder="Expiration Date">
              </div>
              <div class="col-md-6 cvv">
                <input type="text" class="form-control" id="cvv" aria-describedby="passwordHelp" placeholder="CVV">
                <img src="{{asset('images/login-signup/show.png')}}" alt="show password" class="img-fluid eye-icon"
                  width="18" height="12">
              </div>
            </div>
          </div>
          <div class="mb-3">
            <div class="action">
              <a href="" class="btn pay-btn w-100" data-bs-target="#makepaymentnModal" data-bs-toggle="modal">pay</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection
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
            <div class="order-box">
              <p>
                Your All Booking or delivery
                <span>Payment are complete. If any other </span>
                <span>information contact to field officer.</span>
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer mb-4">
        <a href="./payment.html" class="btn ok-btn">Ok</a>
      </div>
    </div>
  </div>
</div>