var num=1;
Array.from(document.getElementsByClassName('allbtn')).forEach(element => {
   element.addEventListener('click', function () {

      $('#OrderForm')[0].reset();

      for (let a = document.getElementsByClassName('allitems').length - 1; a > 0; a--) {
         document.getElementsByClassName('allitems')[a].remove();
         num = 1;
         console.log(num);
      }
      let attr = element.getAttribute('id');
      //alert(attr);
      document.getElementById("modalIdInput").value = attr;

      $('#openthemodal').modal('show');
   })

});


// let num = 2;
function imagesAdd() {
 
   if (num <= 2) {
      let grab = document.getElementById('allfiles');
      let add = document.createElement('input');
      add.setAttribute('type', 'file');
      add.setAttribute('name', 'files[]');
      add.setAttribute('id', 'mainfiles');
      add.setAttribute('class', 'allitems');


      grab.append(add);
      num++;
   }
   else {
      alertify.error('Field limit exceed');
   }

}
function imagesRemove() {
   let grab = document.querySelectorAll('input[type="file"]');
   for (let a = grab.length - 1; a > 0; a--) {
      grab[a].remove();
      num--;
      break;
   }
}



 