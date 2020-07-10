$(document).ready(function () {


    $(".submenu > a").click(function (e) {
        e.preventDefault();
        var $li = $(this).parent("li");
        var $ul = $(this).next("ul");

        if ($li.hasClass("open")) {
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
            //BootstrapDialog.alert('Въведете потребителско име');
            return false;

        } else if ($.trim($('#inputUser').val()).length <= 3) {
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

    $('#calculate_period_amount').on('click', function(e){
        e.preventDefault();
 
        $.ajax({
            method: 'POST',
            url: $(this).data('url'),
            data: {
                startPeriod: $('#startPeriod').val(),
                endPeriod: $('#endPeriod').val(),
                categoryId: $(this).data('category'),
                type: $(".records_type option:selected" ).val()
            }
        }).done(function (data) {
            console.log(data[0].amount / 100)
            if (data) {
                const amount = data[0].amount > 0 ? data[0].amount / 100 : 0;
                const message = `Сумата за въведения от Вас период е ${amount}лв.`;
                BootstrapDialog.show({
                    type: BootstrapDialog.TYPE_SUCCESS,
                    title: 'Сума',
                    message: message,
                    // buttons: [{
                    //     label: 'Разбрах',
                    //     action: function () {
                    //         window.location.replace('./');
                    //     }
                    // }]

                });
            }
        })
    })

    $('.records_type').select2({
        placeholder: 'Select an option',
        width: '50%'
    });

    $('.select-period-toggle').on('click', function(){
        $('.select-period-wrapper').toggle();
    })
});