<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<style>
.panel-default > .panel-heading {
    color: #333;
    background-color: #fcfcfc;
    border-color: #ddd;
    border-color: rgba(221,221,221,0.85);
}
.box-header.with-border {
    border-bottom: 0px solid #f4f4f4 !important;
}
.panel_header_2
{
    /* background-color: #00E396!important; */
    background-color: #2ac792!important;

}
.notification4
{
    background-color: #2ac792!important;
    border-top:0px!important;
    margin-bottom: 0px!important;
    box-shadow: 0px;
}
.showBtn_order
{
    display: block;
    text-align: center;
    color: white;
    background-color: #115e44;
    padding: 3px;
}
.showBtn_order:hover .fa.fa-arrow-right
{
margin-left: 10px;
transition:0.5s;
}
.fa.fa-arrow-right
{
    transition:0.5s;
}
a:hover{
    color: white;
}
.order{
    background-color: #2ac792;
    border-radius: 3px;
    border: .5px solid #08a870;
    color:white;

}
.panel_order
{
    margin-bottom: 20px;
}
.nonotification
{
    font-size: 20px;
    display: flex;
    justify-content: center;
    align-items:center;
    height: 100%;
    color:#fff;
}
</style>
{{-- {{dd($newOrder)}} --}}
<div id="panel_header_2">
    <div class="row">
        <div class="user name"style="display:flex;justify-content:space-between;align-items:center; margin-bottom: 10px; ">
            <h3 style="font-size:25px; font-weight:600; color:white; margin-left:25px;">New Orders</h3>
            <i class="fa fa-archive" style="font-size:50px; color:#08a870ee; margin-right:15px;"></i>
            {{-- <h3 id="count" style="font-size:25px; font-weight:600; color:white; margin-left:25px;"></h3> --}}
        </div>

    </div>
		<div class="panel_order panel_yard" id="new_cards2" >

	  </div>
      <hr style="border-top: 1px solid #08a870ee;">
    </div>
    <div>
      <a href="" id="showallorder" class="showBtn_order" >Mark all as read<i class="fa fa-arrow-right" aria-hidden="true"></i></a>
    </div>
<script>
$(document).ready(function(){

let fogo=document.getElementById('panel_header_2');
let addclass3=fogo.parentNode.parentNode.parentNode;
let addclass4=fogo.parentNode.parentNode;
addclass3.classList.add('notification3');
addclass4.classList.add('notification4');


let counter = document.getElementById('name2');
let contenter=document.createElement('span');
let user2 = document.getElementById('users_id2');

$.ajax({
        url:'/notifi',
        method:'GET',
        datatype:'JSON',
        success:function(response){
    let latestn=response.data;

    let htmlws = ``;
    let arr=[];
    if(latestn!=null )
    {

        Array.from(latestn).forEach(element => {

            const orderdata=element.data;
            const ordernoti=orderdata.replaceAll('"', '');
            const ordernotiId =element.id;
            arr.push(element.id);

            htmlws +=`<div id="users_id2" class="alert alert order"><a href ="mark/as/read/${ordernotiId}" ><strong class="default"><i class="fa fa-bell"></i><span style="margin-left: 5px; " id="name2">${ordernoti}</span> </strong></a></div>`;

            });
    }
    else
    {
        htmlws=`<strong class="default nonotification"><span style="margin-left: 5px; " id="name2">No Notification Yet !</span> </strong> `;
    }
        $('#new_cards2').html(htmlws);

        var queryStringOrder = arr.join(',');
            if(queryStringOrder===null || queryStringOrder==='')
            {
                toastr.options = {
                closeButton: true,
                progressBar: true,
                positionClass: 'toast-top-right',
                showDuration: '300',
                hideDuration: '1000',
                timeOut: '5000',
                extendedTimeOut: '1000',
                showEasing: 'swing',
                hideEasing: 'linear',
                showMethod: 'fadeIn',
                                    };
                toastr.success("No new order notification");
            }
            else
            {

                var urlofallorderid = `mark/as/read/multiple/${queryStringOrder}`;
                $('#showallorder').attr('href',urlofallorderid);
            }





    }
});
});

</script>
