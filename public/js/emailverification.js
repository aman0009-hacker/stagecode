let verify=document.getElementById('emailverification');

if(verify &&  verify.parentNode)
{

    let buttonsubmit=verify.parentNode;
    
    let findlabel=buttonsubmit.querySelector('label')
    findlabel.setAttribute('id','emaillabel')
    let sndbutton=document.createElement('span');
    sndbutton.innerHTML=`<a href="#" style="margin-left: 10px;padding: 6px 26px;background-color: #00a65a;color: #fff;border: 1px solid #00a65a;border-radius: 3px;" id="Sendemail" >Send</a>`;
    
    buttonsubmit.append(sndbutton);
}




if(verify && verify.parentNode.parentNode)
{

    let verifyparent=verify.parentNode.parentNode;
    let makeelement=document.createElement('div');
    makeelement.setAttribute('id','verifiction_head');
    makeelement.innerHTML=`<label for="emailotp">OTP</label><input type="text" id="emailotp" placeholder="InputOtp"><button type="button"style="margin-left: 10px;padding: 6px 26px;background-color: #55ACEE;color: #fff;border: 1px solid #55ACEE;border-radius: 3px;"id="verifytheotp">Verify</button>
        `
    
    verifyparent.append(makeelement);
}









let getdata=document.getElementById('Sendemail');
if(getdata)
{

    getdata.addEventListener('click',function(){
        
        let adminId=document.getElementById('emailotpcheck').value;
        let email=document.getElementById('emailverification').value;
        if(email==='' || email===null)
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
        url:'sendemailtoadmin/'+email+'/'+adminId,
        method:'get',
        datatype:'json',
        success:function(response)
        {
            console.log(response);
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
}

let getheoptelement=document.getElementById('verifytheotp');
if(getheoptelement)
{

    getheoptelement.addEventListener('click',function()
    {
        let theotp=document.getElementById('emailotp').value;
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
        let adminIds=document.getElementById('emailotpcheck').value;
        $.ajax({
            url:'checktheotp/'+theotp+'/'+adminIds,
            method:'get',
            datatype:'json',
            success:function(response)
            {
                if(response.data==="success")
                {
                    
                    document.getElementById('verifytheotp').disabled=true;
                    document.getElementById('emailotp').disabled=true;
                    
                   document.getElementById('verifytheotp').innerHTML="Verified";
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
}

