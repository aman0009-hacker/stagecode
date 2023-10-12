let verify=document.getElementsByClassName('emailverification');


Array.from(verify).forEach(element => {

    console.log(element.parentNode);
    if(element &&  element.parentNode)
{

    let buttonsubmit=element.parentNode;

    let findlabel=buttonsubmit.querySelector('label')
    findlabel.setAttribute('id','emaillabel')
    let sndbutton=document.createElement('span');
    sndbutton.innerHTML=`<a href="#" style="margin-left: 10px;padding: 6px 26px;background-color: #00a65a;color: #fff;border: 1px solid #00a65a;border-radius: 3px;" class="Sendemail" >Send</a>`;

    buttonsubmit.append(sndbutton);
}
});




Array.from(verify).forEach(element => {
if(element && element.parentNode.parentNode)
{

    let verifyparent=element.parentNode.parentNode;
    let makeelement=document.createElement('div');
    makeelement.setAttribute('id','verifiction_head');
    makeelement.innerHTML=`<label for="emailotp">OTP</label><input type="text" class="emailotp" placeholder="InputOtp"><button type="button"style="margin-left: 10px;padding: 6px 26px;background-color: #55ACEE;color: #fff;border: 1px solid #55ACEE;border-radius: 3px;"class="verifytheotp">Verify</button>
        `

    verifyparent.append(makeelement);
}


});






let getdata=document.getElementsByClassName('Sendemail');
if(getdata)
{
Array.from(getdata).forEach(element=>{

     element.addEventListener('click',function(event){



         let parentofbuttons=event.target.parentNode.parentNode;
         let findthehidden=event.target.parentNode.parentNode.parentNode;
        let inputchild= parentofbuttons.querySelector('input');

        let hiddenvalue=findthehidden.querySelector('input[type="hidden"]').value;


         if(inputchild.value==='' || inputchild.value===null)
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

             toastr.error("Please fill the email field");
         }
         else
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

             toastr.info("Please wait");
         }
     $.ajax({
         url:'sendemailtoadmin/'+inputchild.value+'/'+hiddenvalue,
         method:'get',
         datatype:'json',
         success:function(response)
         {

             if(response.data==="success")
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

                 toastr.success("Email sent");
             }
             else if(response.data==="match")
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

                 toastr.warning("Email id is already registered");
             }

             else if(response.data==="fail")
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

                 toastr.warning("Server is busy,Please try again later");
             }
         }
     })
     });
});


}

let getheoptelement=document.getElementsByClassName('verifytheotp');
if(getheoptelement)
{
Array.from(getheoptelement).forEach(element=>{

    element.addEventListener('click',function(event)
    {
        let theotps=event.target.parentNode;
        let theotp= theotps.querySelector('input').value;
     let adminids=event.target.parentNode.parentNode;
     let adminId=adminids.querySelector('input').value;

        console.log(theotp);
        if(theotp===''|| theotp===null)
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

            toastr.error("Please fill the otp field");
        }
     
        $.ajax({
            url:'checktheotp/'+theotp+'/'+adminId,
            method:'get',
            datatype:'json',
            success:function(response)
            {
                if(response.data==="success")
                {

                   element.disabled=true;
                   theotps.querySelector('input').disabled=true;

                   element.innerHTML="Verified";
                }
                else
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

                    toastr.error("The otp is not correct, try again");
                }
            }
        })
    });
})
}

