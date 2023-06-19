$(document).ready(function(){
 $("#gstFile").on("change",function(e)
 {
  e.preventDefault();
  $("#gstDataId").wrapInner( "<div class='new'></div>");
  var fileName=e.target.files[0].name;
  $("#gstdoc").html(fileName);
//   var source = "{!! asset('images/login-signup/gst.jpg') !!}";
  // var source = "/images/login-signup/gst.jpg";
  var source = "/images/login-signup/file_upload_icon.jpg";
  $('#gstpic').prop('src', source);
  // $('#gstpic').css('height', '20%');
  // $('#gstpic').css('width', '100%');
 })
 $("#msmeFile").on("change",function(e)
 {
  e.preventDefault();
  $("#msmeDataId").wrapInner();
  var fileName=e.target.files[0].name;
  $("#msmedoc").html(fileName);
//   var source = "{!! asset('images/login-signup/msme.jpg') !!}";
  // var source = "/images/login-signup/msme.jpg";
  var source = "/images/login-signup/file_upload_icon.jpg";
  $('#msmepic').prop('src', source);
 })
 $("#itrFile").on("change",function(e)
 {
  e.preventDefault();
  $("#itrDataId").wrapInner();
  var fileName=e.target.files[0].name;
  $("#itrdoc").html(fileName);
//   var source = "{!! asset('images/login-signup/itr.jpg') !!}";
  // var source = "/images/login-signup/itr.jpg";
  var source = "/images/login-signup/file_upload_icon.jpg";
  $('#itrpic').prop('src', source);
 })
 $("#aadharFile").on("change",function(e)
 {
  e.preventDefault();
  $("#aadharDataId").wrapInner();
  var fileName=e.target.files[0].name;
  $("#aadhardoc").html(fileName);
 //var source = "{!! asset('images/login-signup/aadhar.jpg') !!}";
  // var source = "/images/login-signup/aadhar.jpg";
  var source = "/images/login-signup/file_upload_icon.jpg";
  $('#aadharpic').prop('src', source);
 })
 $("#panFile").on("change",function(e)
 {
  e.preventDefault();
  $("#panDataId").wrapInner();
  var fileName=e.target.files[0].name;
  $("#pandoc").html(fileName);
//   var source = "{!! asset('images/login-signup/pan.jpg') !!}";
  // var source = "/images/login-signup/pan.jpg";
  var source = "/images/login-signup/file_upload_icon.jpg";
  $('#panpic').prop('src', source);
 })
 $("#utilityFile").on("change",function(e)
 {
  e.preventDefault();
  $("#utilityDataId").wrapInner();
  var fileName=e.target.files[0].name;
  $("#utilitydoc").html(fileName);
//   var source = "{!! asset('images/login-signup/utility.jpg') !!}";
  // var source = "/images/login-signup/utility.jpg";
  var source = "/images/login-signup/file_upload_icon.jpg";
  $('#utilitypic').prop('src', source);
 })
});
