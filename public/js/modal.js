function fun(id)
{
 alert(id);   
 document.getElementById("OrderForm").reset();
 document.getElementById("modalIdInput").value = id;
 $('#openthemodal').modal('show');
}

let num=1;
function imagesAdd()
{
   if(num<=2)
    {
    let grab=document.getElementById('allfiles');
    let add=document.createElement('input');
    add.setAttribute('type','file');
    add.setAttribute('name','files[]');
    add.setAttribute('id','mainfiles');
    grab.append(add);
    num++;
    }
    else
    {
      return 1;
    }

}
function imagesRemove()
{
    let grab=document.querySelectorAll('input[type="file"]');
    for(let a=grab.length-1;a>0;a--)
    {
        grab[a].remove();
        num--;
     break;
  }
}