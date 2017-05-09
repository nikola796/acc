/**
 * Created by Vladislav Andreev on 26.4.2017 г..
 */

CKEDITOR.replace('text', {
    language: 'bg',
    height: 250,
    extraPlugins: 'colorbutton,colordialog'
});


$("#folder").on('change', function () {
    var str = '';
    str = $("#folder option:selected").val();
    console.log(str);
})
function wrapText(elementID, openTag, closeTag) {
    var textArea = document.getElementById(elementID);

    if (typeof(textArea.selectionStart) != "undefined") {
        var begin = textArea.value.substr(0, textArea.selectionStart);
        var selection = textArea.value.substr(textArea.selectionStart, textArea.selectionEnd - textArea.selectionStart);
        var end = textArea.value.substr(textArea.selectionEnd);
        textArea.value = begin + openTag + selection + closeTag + end;
    }
}

var $text = $('#sel');
$('#mod').on('click', function (dialog) {
    dialog.preventDefault();
    BootstrapDialog.show({
        title: 'Нова папка',
        message: $text,
        buttons: [{
            label: 'Създай',
            cssClass: 'btn-primary',
            action: function (dialog) {
                var $button = this; // 'this' here is a jQuery object that wrapping the <button> DOM element.

                if (($('#newFolderName').val().length) > 0) {
                    $button.disable();
                    $button.spin();
                    dialog.setClosable(false);
                    $.ajax({
                        method: 'post',
                        url: 'create-folder',
                        data: {
                            name: $('#newFolderName').val(),
                            parent: $('#perentFolder').val()
                        }
                    }).done(function (data) {
                        console.log(typeof data);
                        if (data !== 'success') {
                            BootstrapDialog.alert({
                                type: BootstrapDialog.TYPE_WARNING,
                                title: 'Мнимание',
                                message: 'Възникна проблем с Вашата заявка!'
                            });
                            $button.enable();
                            $button.stopSpin();
                            dialog.setClosable(true);
                            dialog.close();
                        } else {
                            BootstrapDialog.alert({
                                type: BootstrapDialog.TYPE_SUCCESS,
                                title: 'Успех',
                                message: 'Успешно създадохте новата папка!'
                            });
                            $button.enable();
                            $button.stopSpin();
                            dialog.setClosable(true);
                            dialog.close();
                        }
                    })

                } else {
                    BootstrapDialog.alert({
                        type: BootstrapDialog.TYPE_WARNING,
                        title: 'Внимание',
                        message: 'Не сте въвели нищо в полето за име на новата папка!'
                    });
                }
            }
        }, {
            label: 'Отказ',
            action: function (dialogItself) {
                dialogItself.close();
            }
        }]
    })
})

$(document).on('click', '#createFolder', function () {
    if (($('#newFolderName').val().length) > 0) {
        $.ajax({
            method: 'post',
            url: 'folders',
            data: {
                name: $('#newFolderName').val(),
                parent: $('#perentFolder').val()
            }
        })
            .done(function (data) {
                console.log('seccess');
                $('#myModal').modal('hide');
                BootstrapDialog.alert({
                    title: 'Браво',
                    message: $text
                });
            })
    } else {
        BootstrapDialog.alert({
            type: BootstrapDialog.TYPE_WARNING,
            title: 'Внимание',
            message: 'Не сте въвели нищо в полето за име на новата папка!'
        });
    }

})

$(document).on('click', 'span.glyphicon-remove', function () {
    $(this).parent('div').remove();
})
$(document).on('click', '#addAnotherFile', function () {
    $('#attachedFiles').append('<div class="form-inline"><input style="display:inline" name="userfile[]" type="file" /><span>Описание на файла:<span style="color: red">*</span> </span><input class="form-control" type="text" required name="label[]" /><span class="glyphicon glyphicon-remove"></span> <br /></div>');
});
$(document).on('click', '#view_post', function (e) {
    e.preventDefault();
    if (($('#text').val().length) > 0) {
        $.ajax({
            method: 'POST',
            url: 'http://localhost/intranet_test/view-post',
            data: {
                text: $('#text').val(),
                type: 'show post'
            }
        })
            .done(function (data) {
                if (data.length > 0) {
                    $('#view_parsed_text').show().html(data);
                }

            })
    } else {
        BootstrapDialog.alert({
            type: BootstrapDialog.TYPE_WARNING,
            title: 'Внимание',
            message: 'Не сте въвели нищо в полето!'
        });
    }

});

window.URL = window.URL || window.webkitURL;

var fileSelect = document.getElementById("fileSelect"),
    fileElem = document.getElementById("fileElem"),
    fileList = document.getElementById("fileSelect"),
    fileUl = document.getElementById("attached");

function handleFiles(files) {
    $("#fileSelect").appendTo('#fileList');

    $('#fileList').show();
    console.log(files);
    if (!files.length) {
        fileUl.innerHTML = "<p>No files selected!</p>";
    } else {

        for (var i = 0; i < files.length; i++) {
            var li = document.createElement("li");
            fileUl.appendChild(li);

            var img = document.createElement("img");
            img.src = window.URL.createObjectURL(files[i]);
            img.height = 60;
            img.onload = function () {
                window.URL.revokeObjectURL(this.src);
            }
            li.appendChild(img);
            var info = document.createElement("span");
            info.innerHTML = files[i].name + ": " + files[i].size + " bytes ";
            li.appendChild(info);

            var label = document.createElement('input');
            label.setAttribute("placeholder", 'Описание на файла');
            label.setAttribute("name", 'label[]');
            label.setAttribute("multiple", 'multiple');
            li.appendChild(label);

            var remove_span = document.createElement('span');

            remove_span.setAttribute('class', 'glyphicon glyphicon-remove');
            //   remove_button.appendChild(remove_span);
            li.appendChild(remove_span);

            remove_span.addEventListener("click", function (e) {
                $(this).parents('li').remove();
                if ($('#fileList li').length === 0) {
                    $('#fileList').hide();
                }

            })

        }
    }

}


