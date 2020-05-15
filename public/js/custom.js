$(document).ready(function(){


  $(".submenu > a").click(function(e) {
    e.preventDefault();
    var $li = $(this).parent("li");
    var $ul = $(this).next("ul");

    if($li.hasClass("open")) {
      $ul.slideUp(350);
      $li.removeClass("open");
    } else {
      $(".nav > li > ul").slideUp(350);
      $(".nav > li").removeClass("open");
      $ul.slideDown(350);
      $li.addClass("open");
    }
  });

   /*************** CREATE NEW USER **************************************************************/
   $(document).on('click', '#createUser', function (e) {
    e.preventDefault();
    var error_message;
    if ($.trim($('#inputUser').val()).length == 0) {
        BootstrapDialog.alert('Въведете потребителско име');
        return false;

    } else if($.trim($('#inputUser').val()).length <= 3){
        BootstrapDialog.alert('Прекалено кратко потребителско име. Минимална дължина 4 символа');
        return false;

    }

    if ($.trim($('#inputEmail').val()).length == 0) {
        BootstrapDialog.alert('Въведете поща!');
        return false;
    }


    if ($.trim($('#inputPassword').val()).length == 0) {
        BootstrapDialog.alert('Въведете парола');
        return false;
    } else if ($.trim($('#inputPasswordConfirm').val()).length == 0) {
      BootstrapDialog.alert('Потвърдете паролата');
      return false;
    } else if ($.trim($('#inputPasswordConfirm').val()) !== $.trim($('#inputPassword').val())) {
      BootstrapDialog.alert('Паролите не съвпадат');
      return false;
    }

    $.ajax({
        method: 'POST',
        data: {
            name: $('#inputUser').val(),
            pass: $('#inputPassword').val(),
            email: $('#inputEmail').val(),
            action: $(this).data('value')
        }
    }).done(function (data) {
        if (data) {
            BootstrapDialog.show({
                type: BootstrapDialog.TYPE_SUCCESS,
                title: 'Успех',
                message: data,
                buttons: [{
                    label: 'Разбрах',
                    action: function () {
                        window.location.replace('./');
                    }
                }]

            });
        }
    });

});
  
});