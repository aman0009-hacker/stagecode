@extends('layouts.main_account')
@section('content')
{{-- custom logic --}}
<?php
 if(Auth::check())
 {
    ?>
<script>
  $("#mySignUp").hide();
        $("#myLogin").hide();
        $("#myid").show();
        $("#logoutid").show();
        $("#myOrder").show();
        
</script>
<?php
 }
?>
{{-- custom logic --}}
<!-- Booking Section -->
<section class="booking">
  <form id="userBookingFormData">
    @csrf
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h3>
            My Booking
          </h3>
        </div>
      </div>






      {{-- New Code to show Payment Success Page --}}
      <?php
      $encryptedResponse = request('encryptedResponse');
      if(isset($encryptedResponse) && !empty($encryptedResponse)) 
      {
      $decryptedResponse = Illuminate\Support\Facades\Crypt::decrypt($encryptedResponse);
      $paymentResponse = $decryptedResponse['paymentResponse'] ?? '';
      $reference_no = $decryptedResponse['reference_no'] ?? '';
      $transaction_id = $decryptedResponse['transaction_id'] ?? '';
     if( $paymentResponse!="" && $paymentResponse!=null && $paymentResponse=="SUCCESS")
     {
      ?>
      <script>
        Swal.fire({
          title: 'Payment Done Succesfully.Your Payment Reference No is <?php echo $reference_no; ?>',
          showClass: {
            popup: 'animate__animated animate__fadeInDown'
          },
          hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
          }
        })
      </script>
      <?php 
     }
    }
     ?>
      {{-- New Code to show Payment Success Page --}}










      <div class="row orderhistoryOne-section">
        <div class="col-md-12">
          @foreach ($orders as $index => $order)
          <div class="row historyBox mb-3">
            <div class="col-12 col-sm-12 col-md-4 col-lg-4">
              <h4 class="orderid mb-0"><span>Order ID:</span>{{ $order->id ?? '' }}</h4>
            </div>





            <div class="col-12 col-sm-12 col-md-4 col-lg-4">
              <!-- Display additional order information if needed -->
              <h4 class="orderid mb-0"><span>Booking Amount:</span>
                <?php if ($order->payment_status === 'verified'): ?>
                Done
                <?php else: ?>
                Pending
                <?php endif; ?>
              </h4>
            </div>





            <div class="col-12 col-sm-12 col-md-4 col-lg-4">
              <h4 class="orderplaced mb-0">
                <span>Booking Date: </span><span class="order-status">{{ $order->created_at ?? '' }}</span>
              </h4>
            </div>
          </div>
          @if ($order->status === 'Rejected')
          <div class="alert alert-danger" role="alert">
            Order Rejected
          </div>
          @elseif ($order->status === 'Delivered')
          <div class="alert alert-success" role="alert">
            Order Delivered
          </div>
          @endif
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
                      <th style="width:15%">Quantity</th>
                      <th style="width:15%">MEASUREMENT</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($order->orderItems as $orderItem)
                    <tr>
                      <td>
                        <a href="" class="text-underline">{{ $orderItem->category_name ?? '' }}</a>
                      </td>
                      <td>{{ $orderItem->description ?? '' }}</td>
                      <td>{{ $orderItem->diameter ?? '' }}</td>
                      <td>{{ $orderItem->size ?? '' }}</td>
                      <td>{{ $orderItem->quantity ?? '' }}</td>
                      <td>{{ $orderItem->measurement ?? '' }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-12 text-center">
              {{-- <a href="" class="btn btn-secondary order-btn" id="bookingUserStatus">View Order Details</a> --}}
              {{-- <input type="text" name="txtOrderGlobalID" id="txtOrderGlobalID" value="{{ $order->id }}"> --}}
              <button type="button" class="btn btn-secondary order-btn bookingUserStatus"
                id="bookingUserStatus{{ $order->id }}" data-status="{{ $order->status }}"
                data-order-id="{{ $order->id }}">View Order Details</button>
              {{-- <button type="button" class="btn btn-secondary order-btn bookingUserStatus">View Order
                Details</button> --}}










            </div>
          </div>
          @if (!$loop->last)
          <hr style="border-top: 3px solid black; margin-top: 15px;">
          @endif


          @endforeach
        </div>
      </div>
    </div>
  </form>
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
        {{-- <a href="" class="btn btn-secondary continue-btn" data-bs-target="#makepaymentnModal"
          data-bs-toggle="modal">ok</a> --}}
        <a href="" class="btn btn-secondary continue-btn" data-bs-toggle="modal">ok</a>
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
        <form action="/orderProcess" method="post">
          @csrf
          <input type="hidden" name="txtOrderGlobalModalID" id="txtOrderGlobalModalID">
          {{-- <a href="/orderProcess" class="btn btn-secondary continue-btn">Make Payment</a> --}}
          <button type="submit" class="btn btn-secondary continue-btn">Make Payment</button>
        </form>
        {{-- <input type="text" name="txtOrderId" id="txtOrderId" value="{{ session('orderId', '') }}"> --}}
        <!-- <button type="button" class="btn btn-primary continue-btn">Ok</button> -->
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="makepaymentnModalRejection" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="order-box mt-5">
              <p>Your Booking has Rejected.</p>
              {{-- <p>Kindly Pay Booking amount as
                <span>per PSIEC Policy.</span>
              </p> --}}
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer mb-4">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
        <!-- <button type="button" class="btn btn-primary continue-btn">Ok</button> -->
      </div>
    </div>
  </div>
</div>
{{-- Other Confirmation Model --}}
<div class="modal fade" id="makepaymentnModals" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="order-box mt-5">
              <p>Your order is ready for delivery.</p>
              <p>Kindly make a full payment
                <span>against invoice.</span>
              </p>
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer mb-4">
        <a href="/payment" class="btn btn-secondary continue-btn">Make Payment</a>
        <!-- <button type="button" class="btn btn-primary continue-btn">Ok</button> -->
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="alreadyPaidBookingAmount" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal Title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="order-box mt-5">
              <p>Your Booking Amount has already paid.</p>
              <p>Kindly wait for admin approval for further processing or Check the latest status
                <span>in My Orders Section.</span>
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer mb-4">
        <a href="/order" class="btn btn-secondary continue-btn">Make Payment</a>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>