@extends('userDashboard.maindashboard')

@section('content')
<div class="card">
    <div class="card-header">
      <h3 class="card-title total-users">
        All Orders
      </h3>
  </div>
  <div class="card-body"class="position-relative">
     <table style="width:100%;text-align:center"border="1px solid ">
        <tr>
        <th>#</th>
        <th>Name</th>
        <th>Description</th>
        <th>Diamneter</th>
        <th>Size</th>
        <th>Quantity</th>
        <th>Measurement</th>
        </tr>
        <span class="position:absolute;top:0" style="visibility:hidden">{{$no=1}}</span>
        @if($main == null)
        
        @else
        @foreach($main as $values)
        @foreach ($values as $value)
        <tr>
                 
               <td>{{$no}}</td>
               <td>{{$value->category_name}}</td>
               <td>{{$value->description}}</td>
               <td>{{$value->diameter}}</td>
               <td>{{$value->size}}</td>
               <td>{{$value->quantity}}</td>
               <td>{{$value->measurement}}</td>
              </tr>
              <span class="position:absolute;top:0" style="visibility:hidden"> {{$no++}}</span>
               @endforeach
           
            @endforeach
            @endif
     </table>
  </div>

</div>


@endsection