<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/login-signup/admin_logo_img.png')}}"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/regular.min.css"
        integrity="sha512-WidMaWaNmZqjk3gDE6KBFCoDpBz9stTsTZZTeocfq/eDNkLfpakEd7qR0bPejvy/x0iT0dvzIq4IirnBtVer5A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
    .alldata {
        width: 90%;
        margin: auto;
    }

    .quantity-result {
        margin-left: 3px;
    }

    .amount-result {
        margin-left: 5px;
    }

    .pr-qu {
        display: flex;
        justify-content: space-between;
    }

    .des {
        display: flex;
        margin-top: 20px;
    }

    .result {
        display: flex;
        width: 90%;
        margin: auto;
        justify-content: space-between;
    }

    .background {
        background-color: #fff;
        padding: 15px;
        border-radius: 2px;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
        border-top: 3px solid #d2d6de;
        border-top-color: #00c0ef;
    }

    .box-header {
        display: block;
        font-size: 18px;
        margin: 0;
        line-height: 1;
        border-bottom: 1px solid #f4f4f4;
        padding-bottom: 10px;
        / margin-bottom: 10px;/
    }

    form.border-form {
        padding-top: 10px;
    }

    input,
    textarea {
        border: 1px solid #ccc;
        padding: 6px 11px;
    }
    select
    {
        padding: 7.3px 11px;
    }
    input[type="number"]
    {
        padding:7px 11px;
    }

    textarea {
        width: 100%;
    }

    span.icon {
        border: 1px solid #ccc;
        border-right: 0px;
        padding: 7px 11px;
         /* margin-top: 5px; */
         display: inline-block;
    }

    .quanchange {
        margin-left: -3px;
    }

    label {
        margin-right: 30px;
    }

    .prodatt,
    .quaatt,
    .amoatt,
    .dadatt {
        margin-top: 20px;
    }

    .allpro {
        flex: 0 0 20%;
    }

    .widthchange {
        width: 50%;
    }

    .product-result,
    .quantity-result,
    .amount-result,
    .date-result {
        flex: 0 0 20%;
    }

    .float-btn {
        float: right;
    }

    .two-btn {
        border-top: 1px solid #f4f4f4;
        margin-top: 25px;
        padding-top: 10px;
    }

    .btn-handle {
        display: flex;
        width: 55%;
        justify-content: space-between;
        margin: auto;
    }

    .table-name h1 {
        font-size: 24px;
        margin: 0px 0px 20px 0px;
        display: inline-block;
        margin-right: 10px;
    }

    .table-name small {
        font-size: 15px;
        color: #777;
    }

    .addbtn {
    font-weight: 900;
    font-size: 18px;
    padding: 5px 13px;
    height: fit-content;
}

    .add-sub {
        display: flex;
    }
</style>

<body>
    {{-- <div class="table-name">
        <h1>Supervisor Record </h1>
        <small>Create</small>
    </div> --}}
    <div class="background">
        <h3 class="box-header">Create</h3>
        <form action="{{route('storing')}}" method="post" id="data" class="border-form">
            @csrf
            <div class="alldata">
                <input type="hidden" name="hide" id="hidden" value="1">
                <div class="pr-qu">
                    <div class="allpro">
                        <label for="date">Date</label>
                        <input type="datetime-local" name="date[]" class="dates">
                    </div>
                    <div class="allpro">
                        <label for="products">Product </label>
                        <select id="products" class="productName widthchange quanchange" name="product[]">
                            {{-- <option></option> --}}
                            @foreach ($data as $values )
                            <option value="{{$values->name}}">{{$values->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="allpro">
                        <label for="quantities">Quantity</label>
                        <span class="icon"> <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                <!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                <path
                                    d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z" />
                            </svg></span> <input type="number" name="quantity[]" id="quantities"
                            class="quanchange widthchange" required>
                    </div>
                    <div class="allpro">
                        <label for="amount">Amount</label>
                        <span class="icon"> <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                <!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                <path
                                    d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z" />
                            </svg></span><input type="number" name="amount[]" id="quantities"
                            class="quanchange widthchange" value="{{env('YARD_VALUE')}}" readonly>
                    </div>
                    <div class="add-sub">
                        <a onclick="adding()" class="btn btn-success addbtn">+</a>
                        <a href="#" onclick="subtract()" class="btn btn-success addbtn"
                            style="background-color:#55acee;margin-left:5px;">-</a>
                    </div>
                </div>
            </div>
            <div class="result">
                <div class="date-result">
                </div>
                <div class="product-result">
                </div>
                <div class="quantity-result">
                </div>
                <div class="amount-result">
                </div>
                <div class="addingsub" style="visibility:hidden">
                    <a onclick="adding()" class="btn btn-success addbtn">+</a>
                    <a href="#" onclick="subtract()" class="btn btn-success addbtn"
                        style="background-color:#55acee;margin-left:5px;">-</a>
                </div>
            </div>
            <div class="des">
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="50" rows="7"></textarea>
            </div>
    </div>
    <div class="two-btn">
        <div class="btn-handle">

            <input type="button" onclick="clears()" value="Reset" class="btn btn-warning">
            <input type="submit" value="Submit" class="btn btn-primary ">
        </div>
    </div>
    </form>
    </div>
    <script>
        let num=1;
       function adding()
    {
num++;
        let dresult=document.getElementsByClassName('date-result');
        let presult=document.getElementsByClassName('product-result');
        let qresult=document.getElementsByClassName('quantity-result');
        let aresult=document.getElementsByClassName('amount-result');
        let datdoc=document.createElement('div');
        datdoc.setAttribute('class','dadatt');
       datdoc.innerHTML=`   <label for ="date">Date</label>
                <input type="datetime-local"name="date[]" class="dates">`;
        let prod=document.createElement('div');
        prod.setAttribute('class','prodatt');
        prod.innerHTML=`<label for="product${num}">Product </label>
        <select id="products" class="productName widthchange quanchange"name="product[]">
                    @foreach ($data as $values )
                    <option value="{{$values->name}}">{{$values->name}}</option>
                    
                    @endforeach
                   </select> `  
                let quan=document.createElement('div');
            quan.setAttribute('class','quaatt');
        quan.innerHTML=`<label for="quantity${num}">Quantity </label>
        <span class="icon"> <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"/></svg></span><input type="number" name="quantity[]"id="quantity${num}" required class="widthchange">`
           let amou=document.createElement('div');
            amou.setAttribute('class','amoatt');
        amou.innerHTML=`<label for="amount${num}">Amount </label>
        <span class="icon"> <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"/></svg></span><input type="number" name="amount[]"id="amount${num}" required value="270"class="widthchange">`
        dresult[0].append(datdoc);
            presult[0].append(prod);  
            qresult[0].append(quan); 
            aresult[0].append(amou); 
            document.getElementById('hidden').value=num; 
            let data=new Date();
let day=String(data.getDate()).padStart(2,"0");
let month=String(data.getMonth()+1).padStart(2,"0");
let year=data.getFullYear();
let hour=data.getHours();
let minute=String(data.getMinutes()).padStart(2,"0");
let today=year+"-"+month+"-"+day+" "+hour+":"+minute;
$('.dates').attr({min:today,max:today});
$('.dates').val(today);      
    }
    function subtract()
    {
         if(num>1)
        {

            num--;
        }
        let datar=document.getElementsByClassName('dadatt');
        let pattr=document.getElementsByClassName('quaatt');
        let qattr=document.getElementsByClassName('prodatt');
        let aattr=document.getElementsByClassName('amoatt');
        if(pattr.length>0 && qattr.length>0 && aattr.length>0)
        {
            datar[num-1].remove();
        pattr[num-1].remove();
        qattr[num-1].remove();
        aattr[num-1].remove();
        }
        document.getElementById('hidden').value=num;
    }
    function clears()
    {
        let data=document.getElementById('data');
        data.reset();
    }
    let data=new Date();
    let day=String(data.getDate()).padStart(2,"0"); 
    let month=String(data.getMonth()+1).padStart(2,"0");
    let year=data.getFullYear();
    let hour=data.getHours();
    let minute=String(data.getMinutes()).padStart(2,"0");
let today=year+"-"+month+"-"+day+" "+hour+":"+minute;
    $('.dates').attr({min:today,max:today});
    $('.dates').val(today);      
    </script>
</body>

</html>