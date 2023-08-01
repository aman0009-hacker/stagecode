<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <style>
    table,
    th,
    td {
      border: 1px solid black;
      border-collapse: collapse;
      vertical-align: initial;
      padding: 3px;
      text-align: initial;
    }

    .qr-table td {
      border: none;
    }

    .tax-table table,
    .tax-table th,
    .tax-table td {
      font-size: 14px;
    }
  </style>
  <title>Document</title>
</head>

<body>
  <div class="main">
    <div class="container">
      <table class="qr-table" style="border: 0px solid !important; width: 100%">
        <tr>
          <td style="width: 20%">IRN:</td>
          <td>{{$IRN}}</td>
          <td rowspan="4" style="text-align: end; vertical-align: middle">
            <!-- <img
                src="./QR_code_for_mobile_English_Wikipedia.svg.png"
                alt=""
                class="img-fluid"
                style="width: 9%"
              /> -->
          </td>
        </tr>
        <tr>
          <td>Ack No. :</td>
          <td>{{$AckNo}}</td>
        </tr>
        <tr>
          <td>Ack Date :</td>
          <td>{{$AckDate}}</td>
        </tr>
        <tr></tr>
      </table>

      <table style="width: 100%">
        <tr>
          <th rowspan="3">
            @foreach ($PSIECAddress as $key => $value)
            @if ($key === 'psiec_biilling_name')
            <strong>{{ $value }}</strong><br>
            @elseif ($key === 'psiec_billing_area')
            {{ $value }}<br>
            @elseif ($key === 'psiec_biilling_city')
            {{ $value }}<br>
            @elseif ($key === 'psiec_biilling_gst')
            GSTIN/UIN: {{ $value }}<br>
            @elseif ($key === 'psiec_biilling_state')
            State Name: {{ $value }},
            @elseif ($key === 'psiec_biilling_code')
            Code: {{ $value }}<br>
            @elseif ($key === 'psiec_biilling_cin')
            CIN: {{ $value }}
            @endif
            @endforeach
          </th>
          <td style="text-align: start">
            Invoice No. <span style="text-align: end">/E-way Bill No.</span>
            <br />
            <span style="font-weight: bold">{{$InvoiceNo}}</span>
          </td>
          <td>
            Dated <br />
            <span style="font-weight: bold">{{$DatedInvoice}}</span>
          </td>
        </tr>
        <tr>
          <td>
            Delivery Note <br /><span style="font-weight: bold">{{$DeliveryNote}}</span>
          </td>
          <td>Mode/Terms of Payment
            <br><span style="font-weight: bold;">{{$ModeTermsofPayment}}</span>
          </td>
        </tr>
        <tr>
          <td>Refernce No. & Date
            <br><span style="font-weight: bold;">{{$InvoiceNo}} &nbsp; {{$DatedInvoice}}</span>
          </td>
          <td>Other Refernce</td>
        </tr>
        <tr>
          <th rowspan="3">
            ( Ship To ) <br />
            {{$shipping_name}} <br />
            {{$shipping_address}} <br />
            {{$shipping_city}} <br />
            GSTIN/UIN: {{$shipping_gst_number}} <br />
            State Name: {{$shipping_state}} , Code: {{$shipping_gst_statecode}} <br />
          </th>
          <td>Buyer's Order No.
            <br><span style="font-weight: bold;">{{$Buyers_Order_No}}</span>
          </td>
          <td>Dated
            <br><span style="font-weight: bold;">{{$DatedOrderNo}}</span>
          </td>
        </tr>
        <tr>
          <td>
            Dispatch Doc No. <br />
            <span style="font-weight: bold">{{$DispatchDocNo}}</span>
          </td>
          <td>
            Delivery Note Date<br />
            <span style="font-weight: bold">{{$DeliveryNoteDate}}</span>
          </td>
        </tr>
        <tr>
          <td>
            Dispatched through<br />
            <span style="font-weight: bold">{{$DispatchedThrough}}</span>
          </td>
          <td>
            Destination<br />
            <span style="font-weight: bold">{{$Destination}}</span>
          </td>
        </tr>
        <tr>
          <th rowspan="2">
            ( Bill To ) <br />
            {{$billing_name}} <br />
            {{$billing_address}} <br />
            {{$billing_city}} <br />
            GSTIN/UIN: {{$billing_gst_number}} <br />
            State Name: {{$billing_state}} , Code: {{$billing_gst_statecode}} <br />
          </th>
          <td>
            Bill of Landing/LR-RR No.<br />
            <span style="font-weight: bold">{{$BillofLandingLRRRNo ?? ''}}</span>
          </td>
          <td>
            Moter Vehicle No.<br />
            <span style="font-weight: bold">{{$MotorVehicleNo ?? ''}}</span>
          </td>
        </tr>
        <tr>
          <td colspan="2">
            Term of Delivery<br />
            <span style="font-weight: bold">{{$TermsofDelivery ?? ''}}</span>
          </td>
        </tr>
      </table>
      <table style="width: 100%">
        <tr>
          <th style="width: 5%">Sl No.</th>
          <th style="width: 45%">Description of Goods</th>
          <th style="width: 10%">HSN/SAC</th>
          <th style="width: 10%">Quantity</th>
          <th style="width: 10%">Rate</th>
          <th style="width: 10%">Per</th>
          <th style="width: 10%">Amount</th>
        </tr>
        @foreach ($DescriptionofGoods as $index => $item)
        <tr>
          <td style="height: 125px; border-bottom: none">{{ $index + 1 }}</td>
          <td style="border-bottom: none">{{ $item['category_name'] }}</td>
          <td style="border-bottom: none">{{ $HSNSAC }}</td>
          <td style="border-bottom: none">{{ $item['quantity'] }}</td>
          <td style="border-bottom: none">{{$Rate}}</td>
          <td style="border-bottom: none">{{$Per}}</td>
          <td style="border-bottom: none">{{$Amount}}</td>
        </tr>
        @endforeach

        <tr>
          <td style="border-top: none; border-bottom: none">1.</td>
          <td style="border-top: none; border-bottom: none; text-align: end">
            CGST
          </td>
          <td style="border-top: none; border-bottom: none"></td>
          <td style="border-top: none; border-bottom: none"></td>
          <td style="border-top: none; border-bottom: none"></td>
          <td style="border-top: none; border-bottom: none"></td>
          <td style="border-top: none; border-bottom: none; text-align: end">
            {{$CGST}}
          </td>
        </tr>
        <!-- <tr>
            <td style="border-bottom: none; border-top: none">1.</td>
            <td style="border-bottom: none; border-top: none; text-align: end">
              Maria Anders
            </td>
            <td style="border-bottom: none; border-top: none">Germany</td>
            <td style="border-bottom: none; border-top: none">Maria Anders</td>
            <td style="border-bottom: none; border-top: none">Germany</td>
            <td style="border-bottom: none; border-top: none">Maria Anders</td>
            <td style="border-bottom: none; border-top: none; text-align: end">
              Germany
            </td>
          </tr> -->
        <tr>
          <td style="border-top: none; border-bottom: none">1.</td>
          <td style="border-top: none; border-bottom: none; text-align: end">
            SGST
          </td>
          <td style="border-top: none; border-bottom: none"></td>
          <td style="border-top: none; border-bottom: none"></td>
          <td style="border-top: none; border-bottom: none"></td>
          <td style="border-top: none; border-bottom: none"></td>
          <td style="border-top: none; border-bottom: none; text-align: end">
            {{$SGST}}
          </td>
        </tr>

        <tr>
          <td style="border-top: none; border-bottom: none"></td>
          <td style="border-top: none; border-bottom: none; text-align: end">
            {{-- TCS ON SALES --}}
          </td>
          <td style="border-top: none; border-bottom: none"></td>
          <td style="border-top: none; border-bottom: none"></td>
          <td style="border-top: none; border-bottom: none"></td>
          <td style="border-top: none; border-bottom: none"></td>
          <td style="border-top: none; border-bottom: none; text-align: end">
            {{-- {{$TCSonSales}} --}}
          </td>
        </tr>

        <tr>
          <td></td>
          <td>Total</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td>Rs. {{$Taxablevalue}}</td>
        </tr>
        <tr>
          <td colspan="7">Amount Chargeable(In Words)</td>
        </tr>
      </table>
      <table class="tax-table" style="width: 100%">
        <tr>
          <td rowspan="2">HSN/SAC</td>
          <td rowspan="2">Taxable Value</td>
          <td colspan="2">Central Tax</td>
          <td colspan="2">State Tax</td>
          {{-- <td colspan="2"></td> --}}
          <td rowspan="2">Total <br>Tax amount</td>
        </tr>
        <tr>
          <td>Rate</td>
          <td>Amount</td>
          <td>Rate</td>
          <td>Amount</td>
          <!-- <td>Rate</td>
          <td>Amount</td> -->
        </tr>
        <tr>
          <td>{{$HSNSAC}}</td>
          <td>{{$Amount}}</td>
          <td>{{$CGSTTAX}}</td>
          <td>{{$CGST}}</td>
          <td>{{$SGSTTAX}}</td>
          <td>{{$SGST}}</td>
          {{-- <td></td>
          <td></td> --}}
          <td>{{$TotalTaxAmount}}</td>
        </tr>
        <!-- <tr>
          <td>Rs 133</td>
          <td>Rs 133</td>
          <td>Rs 133</td>

          <td>Rs 133</td>
          <td>Rs 133</td>
          <td>Rs 133</td>
          <td>Rs 133</td>
          <td>Rs 133</td>
          <td>Rs 133</td>
        </tr> -->
      </table>
      <table style="width: 100%; margin-top: 14px">
        <tr>
          <td colspan="2" style="border: none;padding-bottom: 23px;">
            <u><b>Declaration:-</b></u>&nbsp; We declare that this invoice shows 
            the actual price of the goods described and that all particulars are 
            true and correct.
          </td>
        </tr>
        <tr>
          <td style="border: none">
            {{-- Balance (Amount to paid):{{$Amount - $Balance}} --}}
          </td>
          <td rowspan="3" style="width: 50%; text-align: end; font-weight: bold">
            for Punjab Small Industries & Export Corp.
          </td>
        </tr>
        <tr>
          <!-- <td style="border: none">Balance:40,67,434.00 CR</td> -->
        </tr>
        <tr>
          <!-- <td style="border: none">Balance:40,67,434.00 CR</td> -->
        </tr>
      </table>
    </div>
  </div>
</body>

</html>