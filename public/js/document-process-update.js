$(document).ready(function () {
  $("#gstFile").on("change", function (e) {
    e.preventDefault();
    $("#gstDataId").wrapInner("<div class='new'></div>");
    var fileName = e.target.files[0].name;
    $("#gstdoc").html(fileName);

    var source = "/images/login-signup/file_upload_icon.jpg";
    $('#gstpic').prop('src', source);

  })
  $("#msmeFile").on("change", function (e) {
    e.preventDefault();
    $("#msmeDataId").wrapInner();
    var fileName = e.target.files[0].name;
    $("#msmedoc").html(fileName);

    var source = "/images/login-signup/file_upload_icon.jpg";
    $('#msmepic').prop('src', source);
  })
  $("#itrFile").on("change", function (e) {
    e.preventDefault();
    $("#itrDataId").wrapInner();
    var fileName = e.target.files[0].name;
    $("#itrdoc").html(fileName);

    var source = "/images/login-signup/file_upload_icon.jpg";
    $('#itrpic').prop('src', source);
  })
  $("#aadharFile").on("change", function (e) {
    e.preventDefault();
    $("#aadharDataId").wrapInner();
    var fileName = e.target.files[0].name;
    $("#aadhardoc").html(fileName);

    var source = "/images/login-signup/file_upload_icon.jpg";
    $('#aadharpic').prop('src', source);
  })
  $("#panFile").on("change", function (e) {
    e.preventDefault();
    $("#panDataId").wrapInner();
    var fileName = e.target.files[0].name;
    $("#pandoc").html(fileName);

    var source = "/images/login-signup/file_upload_icon.jpg";
    $('#panpic').prop('src', source);
  })
  $("#utilityFile").on("change", function (e) {
    e.preventDefault();
    $("#utilityDataId").wrapInner();
    var fileName = e.target.files[0].name;
    $("#utilitydoc").html(fileName);

    var source = "/images/login-signup/file_upload_icon.jpg";
    $('#utilitypic').prop('src', source);
  })

  //new code for three documents
  $("#OtherFile1").on("change", function (e) {
    e.preventDefault();
    $("#OtherCard1id").wrapInner();
    var fileName = e.target.files[0].name;
    $("#OtherCard1doc").html(fileName);

    var source = "/images/login-signup/file_upload_icon.jpg";
    $('#OtherCard1pic').prop('src', source);
  })
  $("#OtherFile2").on("change", function (e) {
    e.preventDefault();
    $("#OtherCard2id").wrapInner();
    var fileName = e.target.files[0].name;
    $("#OtherCard2doc").html(fileName);

    var source = "/images/login-signup/file_upload_icon.jpg";
    $('#OtherCard2pic').prop('src', source);
  })
  $("#OtherFile3").on("change", function (e) {
    e.preventDefault();
    $("#OtherCard3id").wrapInner();
    var fileName = e.target.files[0].name;
    $("#OtherCard3doc").html(fileName);

    var source = "/images/login-signup/file_upload_icon.jpg";
    $('#OtherCard3pic').prop('src', source);
  })
  //new code for three documents
});
