Array.from(document.getElementsByClassName('allbtn')).forEach(element => {
   element.addEventListener('click', function () {
      $('#OrderForm')[0].reset();
      let attr = element.getAttribute('id');
       document.getElementById("modalIdInput").value = attr;
      $('#openthemodal').modal('show');
   })

});