$(document).ready(function(){
  $("#gstFile").on("change",function(e)
  {
   e.preventDefault();
   $("#gstDataId").wrapInner( "<div class='new'></div>");
   var fileName=e.target.files[0].name;
   $("#gstdoc").html(fileName);

   var source = "/images/login-signup/file_upload_icon.jpg";
   $('#gstpic').prop('src', source);

  })
  $("#msmeFile").on("change",function(e)
  {
   e.preventDefault();
   $("#msmeDataId").wrapInner();
   var fileName=e.target.files[0].name;
   $("#msmedoc").html(fileName);

   var source = "/images/login-signup/file_upload_icon.jpg";
   $('#msmepic').prop('src', source);
  })
  $("#itrFile").on("change",function(e)
  {
   e.preventDefault();
   $("#itrDataId").wrapInner();
   var fileName=e.target.files[0].name;
   $("#itrdoc").html(fileName);

   var source = "/images/login-signup/file_upload_icon.jpg";
   $('#itrpic').prop('src', source);
  })
  $("#aadharFile").on("change",function(e)
  {
   e.preventDefault();
   $("#aadharDataId").wrapInner();
   var fileName=e.target.files[0].name;
   $("#aadhardoc").html(fileName);

   var source = "/images/login-signup/file_upload_icon.jpg";
   $('#aadharpic').prop('src', source);
  })
  $("#panFile").on("change",function(e)
  {
   e.preventDefault();
   $("#panDataId").wrapInner();
   var fileName=e.target.files[0].name;
   $("#pandoc").html(fileName);

   var source = "/images/login-signup/file_upload_icon.jpg";
   $('#panpic').prop('src', source);
  })
  $("#utilityFile").on("change",function(e)
  {
   e.preventDefault();
   $("#utilityDataId").wrapInner();
   var fileName=e.target.files[0].name;
   $("#utilitydoc").html(fileName);

   var source = "/images/login-signup/file_upload_icon.jpg";
   $('#utilitypic').prop('src', source);
  })
  $("#extradoc1").on("change",function(e)
  {
   e.preventDefault();
   $("#extradocId1").wrapInner();
   var fileName=e.target.files[0].name;
   $("#document1").html(fileName);

   var source = "/images/login-signup/file_upload_icon.jpg";
   $('#documetation1').prop('src', source);
  })

  $("#extradoc2").on("change",function(e)
  {
   e.preventDefault();
   $("#extradocId2").wrapInner();
   var fileName=e.target.files[0].name;
   $("#document2").html(fileName);

   var source = "/images/login-signup/file_upload_icon.jpg";
   $('#documetation2').prop('src', source);
  })


  $("#extradoc3").on("change",function(e)
  {
   e.preventDefault();
   $("#extradocId3").wrapInner();
   var fileName=e.target.files[0].name;
   $("#document3").html(fileName);
 
   var source = "/images/login-signup/file_upload_icon.jpg";
   $('#documetation3').prop('src', source);
  })
 });
