$(document).ready(function () {
    $("input[type=checkbox]").on('change',function(){
        if($(this).prop('checked')) 
        {
            $(this).parent().parent().css('background-color', '#FFFDD3');
        }
   });
  });

  