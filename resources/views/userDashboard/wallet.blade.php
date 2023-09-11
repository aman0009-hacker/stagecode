@extends('userDashboard.maindashboard')
@section('content')
<style>
    .table-primary
    {
        background-color: #196f8e !important;
        color :white;
    }
    .table{
        text-align: center;
    }
    .table thead th {
    vertical-align: inherit !important;
    border-bottom: 2px solid #dee2e6;
}
</style>
{{-- {{dd($registration_data)}} --}}
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="table-wrap">
                    <table class="table">
                        <h3>Registration</h3>
                        <thead class="table-primary">
                            <tr>
                                <th>User's Name</th>
                                <th>Transaction ID</th>
                                <th>Registration Amount</th>
                                <th>Status</th>

                            </tr>
                        </thead>
                        <tbody>

                                <tr>
                                    <td>{{ucfirst(trans(Auth::user()->name))." " .ucfirst(trans(Auth::user()->last_name))}}</td>
                                    <td>{!! $registration_data->transaction_id ?? "<span style='color:red;font-weight:600'>(N/A)</span>" !!}</td>
                                    <td>{!! $registration_data->user_amount ?? "<span style='color:red;font-weight:600'>(Unpaid)</span>" !!}</td>
                                    @if($registration_data->payment_status === "SUCCESS" || $registration_data->payment_status === "SIP" || $registration_data->payment_status === "RIP")
                                    <td><span style='color:green ;font-weight:600'>(Paid)</span></td>
                                    @else
                                    <td><span  style='color:red;font-weight:600'>(UnPaid)</span></td>
                                    @endif
                                </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="table-wrap">
                    <table class="table">
                        <thead class="table-primary">
                            <h3>Order </h3>
                            <tr>
                                <th>Order No.</th>
                                <th>Balance on Booking</th>
                                <th>Booking Transaction ID</th>
                                <th>Booking Amount</th>
                                <th>Final Transaction ID</th>
                                <th>Final Amount</th>
                                <th>Final Payment Mode</th>
                                <th>Cheque Info</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderData["Order_No"] as $index => $orderNo)
                                <tr>
                                    <td>{{ $orderNo }}</td>
                                    <td>{!! $orderData["Balance_on_booking"][$index] ?? "<span style='color:red;font-weight:600'>(N/A)</span>" !!}</td>
                                    <td>{!! $orderData["booking_transaction_id"][$index] ?? "<span style='color:red;font-weight:600'>(Unpaid)</span>" !!}</td>
                                    <td>{!! $orderData["Booking_Initial_Amount"][$index] ?? "<span style='color:red;font-weight:600'>(Unpaid)</span>" !!}</td>
                                    <td>{!! $orderData["final_transaction_id"][$index] ?? "<span style='color:red;font-weight:600'>(Unpaid)</span>" !!}</td>
                                    <td>{!! $orderData["Final_Amount"][$index]?? "<span style='color:red;font-weight:600'>(Unpaid)</span>" !!}</td>
                                    <td>{{ $orderData["Final_Payment_Mode"][$index] ?? "<span style='color:red;font-weight:600'>(N/A)</span>" }}</td>
                                    <td>{!! $orderData["Cheque_Info"][$index] ?? "<span style='color:red;font-weight:600'>(N/A)</span>" !!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
