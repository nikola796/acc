<?php
//die('<pre>' . print_r($folders, true) . '</pre>');
//session_start();

if(isset($_SESSION['is_logged']) && $_SESSION['is_logged'] === true) {


//require_once 'core/HTML/BBCodeParser2.php';
//$options = @parse_ini_file('core/BBCodeParser.ini');
//
//// die( '<pre>' . print_r($folders, true) . '</pre>');
//$parser = new HTML_BBCodeParser2($options);
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Администрация</title>
        <link href="<?php echo url() ?>public/css/libs/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo url() ?>public/css/libs/fileinput.css" media="all" rel="stylesheet"
              type="text/css"/>
        <link href="<?php echo url() ?>public/css/libs/bootstrap-dialog.css" media="all" rel="stylesheet"
              type="text/css"/>
        <link href="<?php echo url() ?>public/themes/explorer/theme.css" media="all" rel="stylesheet"
              type="text/css"/>
        <link href="<?php echo url() ?>public/css/styles.css" media="all" rel="stylesheet" type="text/css"/>

        <script src="<?php echo url() ?>public/js/libs/jquery-2.2.4.min.js"></script>
        <script src="<?php echo url() ?>public/js/plugins/sortable.js" type="text/javascript"></script>
        <script src="<?php echo url() ?>public/js/fileinput.js" type="text/javascript"></script>
        <script src="<?php echo url() ?>public/js/locales/bg.js" type="text/javascript"></script>
        <script src="<?php echo url() ?>public/js/locales/es.js" type="text/javascript"></script>
        <script src="<?php echo url() ?>public/themes/explorer/theme.js" type="text/javascript"></script>
        <script src="<?php echo url() ?>public/js/libs/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo url() ?>public/js/libs/bootstrap-dialog.js" type="text/javascript"></script>
        <script src="<?php echo url() ?>public/ckeditor/ckeditor.js"></script>

        <style>
            li {
                list-style: none;
            }

            span.glyphicon-remove {
                color: red;
                margin-left: 10px;
            }

            span.glyphicon-remove:hover {
                cursor: pointer;
            }

            .btn-default {
                margin-left: 10px;
            }

            #fileSelect {
                margin: 10px
            }

            #fileSelect:hover {
                cursor: pointer;
            }

            .row {
                border: 1px dashed #aaa;
                border-radius: 4px;
                padding: 20px;
            }

            #fileList {
                display: none;
                border: 1px dashed #aaa;
                border-radius: 4px;
            }

            #attached li {
                margin: 5px 0;
            }

        </style>

    </head>
    <body>
    <h3 class="text-center">Администрация интранет страница на АМ</h3>
    <div class="container">


        <div class="row">
            <form action="" method="post" enctype="multipart/form-data">

                <div id="callout-formgroup-inputgroup" class="bs-callout bs-callout-warning">
                    <h4 class="text-center">Добавете текст в редактора по-долу.</h4>
                </div>
                <div class="form-group">
                    <textarea cols="80" id="text" name="text" rows="10" placeholder="Място за текст"></textarea>
                </div>
                <!--            <div class="form-group">-->
                <!--                <button type="button" onclick="wrapText('text','[b]','[/b]');">B</button>-->
                <!--                <button type="button" onclick="wrapText('text','[i]','[/i]');">I</button>-->
                <!--                <button type="button" onclick="wrapText('text','[u]','[/u]');">U</button>-->
                <!--                <button type="button" onclick="wrapText('text','[img]','[/img]');">Img</button>-->
                <!--                <br/>-->
                <!--                <textarea id="text" class="form-control" placeholder="Място за текст" rows="4" name="text"></textarea>-->
                <!--            </div>-->

                <!--            <input type="file" name="userfile[]" id="fileElem" multiple accept="" style="" onchange="handleFiles(this.files)">-->
                <!--            <div id="fileList">-->
                <!--                <span>Прикачени файлове</span>-->
                <!--                <ul id="attached">-->
                <!---->
                <!--                </ul>-->
                <!--                <!--                <p>No files selected!</p>-->
                <!--            </div>-->

                <!--            <div class="form-group">-->
                <!--                <span id="fileSelect2" ><strong>Прикачи файл</strong></span>-->
                <!--            <div class="btn btn-primary btn-file" tabindex="500">-->
                <!--                <i class="glyphicon glyphicon-folder-open"></i>-->
                <!--                <span class="hidden-xs">Избери …</span>-->
                <!--                <input id="fileSelect" type="file" name="file-fr">-->
                <!--            </div>-->
                <!--            </div>-->
                <div class="form-group">
                    <span class="form-control-static"><strong>Изберете от списъка в коя папка да бъде Вашата публикация.</strong></span>

                    <span class="form-control-static"><strong>Или създайте </strong></span>
                    <!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Нова папка</button> -->
                    <button id="mod" type="button" class="btn btn-success">Нова папка</button>
                    <!-- Modal -->

                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Нова папка</h4>
                                </div>
                                <div id="sel" class="modal-body">
                                    <div class="form-group">
                                        <label for="folderName">Име на новата папка</label>
                                        <input type="text" class="form-control" id="newFolderName"
                                               placeholder="Наименование">
                                    </div>
                                    <div class="form-group">
                                        <label for="folderName">Място на новата папка</label>
                                        <select name="folder" id="perentFolder" class="form-control">
                                            <option value="0">Главна директория</option>
                                            <?php foreach ($folders as $folder): ?>

                                                <option value="<?= $folder->category_id ?>"><?= $folder->name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Отказ</button>
                                    <button type="button" id="createFolder" class="btn btn-primary">Запази</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Modal -->

                </div>


                <div id="perentFolders" class="form-group">
                    <select name="folder" class="form-control" id="folder">
                        <option value="0">Главна директория</option>
                        <?php foreach ($folders as $folder): ?>
                            <option value="<?= $folder->category_id ?>"><?= $folder->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">

                    <input type="button" class="form-control btn-primary" id="addAnotherFile" value="Добави файл"/>

                </div>
                <div id="attachedFiles">

                    <!--                <div class="form-group">-->
                    <!--                    <input style="display:inline" name="userfile[]" type="file" /><span>Описание на файла: </span><input type="text" name="label[]" /> <br />-->
                    <!--                </div>-->
                </div>

                <!--    <div class="form-group">-->
                <!--    <input id="file" name="file-fr" type="file">-->
                <!--    </div>-->
                <!--    <div class="form-group">-->
                <!--    <div class="input-group">-->
                <!--        <span class="input-group-addon" id="basic-addon3">Описание на файла:</span>-->
                <!--        <input type="text" name="label" class="form-control" id="label" aria-describedby="basic-addon3">-->
                <!--    </div>-->
                <!--    </div>-->
                <!--            <div class="form-control file-caption  kv-fileinput-caption" tabindex="500">-->
                <!--                <div class="file-caption-name"></div>-->
                <!--            </div>-->


                <!--            <div class="input-group-btn">-->
                <!--                <button class="btn btn-default fileinput-remove fileinput-remove-button" title="Изчисти избраните" tabindex="500" type="button"><i class="glyphicon glyphicon-trash"></i>  <span class="hidden-xs">Премахни</span></button>-->
                <!--                <button class="btn btn-default hide fileinput-cancel fileinput-cancel-button" title="Откажи качването" tabindex="500" type="button"><i class="glyphicon glyphicon-ban-circle"></i>  <span class="hidden-xs">Откажи</span></button>-->
                <!--                <a class="btn btn-default fileinput-upload fileinput-upload-button" title="Качи избраните файлове" tabindex="500" href="http://localhost/intranet_test/public/upload.php"><i class="glyphicon glyphicon-upload"></i>  <span class="hidden-xs">Качи</span></a>-->
                <!--                <div class="btn btn-primary btn-file" tabindex="500"><i class="glyphicon glyphicon-folder-open"></i>&nbsp;  <span class="hidden-xs">Избери …</span><input type="file" name="file-fr" id="file"></div>-->
                <!--            </div>-->

                <!--            <div class="form-group">-->
                <!--                <label for="exampleInputFile">File input</label>-->
                <!--                <input type="file" id="InputFile" name="myfile">-->
                <!--            </div>-->

                <!--            <div class="btn btn-primary btn-file" tabindex="500">-->
                <!--                <i class="glyphicon glyphicon-folder-open"></i>-->
                <!--                <span class="hidden-xs">Избери …</span>-->
                <!--                <input id="file" type="file" name="file-fr">-->
                <!--            </div>-->
                <!--<input type="hidden" name="type" value="show post">-->
                <div class="spacer-bg"></div>
                <div class="text-center">
                    <!--                <button type="submit" class="btn btn-default" id="view_post" name="view">Прегледай</button>-->
                    <button type="submit" class="btn btn-primary" name="save">Запази</button>
                </div>
            </form>
            <div id="view_parsed_text" style="display:none; border: solid 1px orange; padding:20px; margin: 20px">

            </div>

            <!--        <form action="" method="post" enctype="multipart/form-data">-->
            <!--            Send these files:<br />-->
            <!--            <div class="form-group"><button id="addAnotherFile" type="button">+</button><br /></div>-->
            <!--            <div id="attachedFiles">-->
            <!--                <div class="form-group">-->
            <!--                <input style="display:inline" name="userfile[]" type="file" /><span>Описание на файла: </span><input type="text" name="label[]" /> <br />-->
            <!--                </div>-->
            <!--            </div>-->
            <!--            <div class="form-group">-->
            <!--            <div class="form-group"><input type="submit" value="Send files" /></div>-->
            <!--            </div>-->
            <!--        </form>-->
        </div>
    </div>

    </div>

    <script>
/****** CKEDITOR ****************************************************************************************/
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
                                url: 'admin/create-folder',
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

        //$('form').submit(function(e){
        //
        //    e.preventDefault();
        //    var formData = {
        //        'post' : $('#text').val(),
        //        'folder':  $( "#folder option:selected").val()
        //        'file' : $('input[name=userfile')
        //    }
        //    console.log(formData);
        //
        //
        //})


        //$text.append('<div class="form-group"><label for="folderName">Име на новата папка</label><input type="text" class="form-control" id="newFolderName" placeholder="Наименование"></div><select name="folder" id="perentFolder" class="form-control"><?php foreach ($folders as $folder): ?><option value="">Главна директория</option><option value="<?= $folder->id ?>"><?= $folder->name ?></option><?php endforeach; ?></select>');
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
            //$('#newFolderName').val('')
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


        //    fileSelect.addEventListener("click", function (e) {
        //        if (fileElem) {
        //            fileElem.click();
        //        }
        //        e.preventDefault(); // prevent navigation to "#"
        //    }, false);

        function handleFiles(files) {
            $("#fileSelect").appendTo('#fileList');
            //$('#fileList').append('<input name="userfile[]" type="file" /><br />');
            $('#fileList').show();
            console.log(files);
            if (!files.length) {
                fileUl.innerHTML = "<p>No files selected!</p>";
            } else {
                //fileUl.innerHTML = "";
                // var list = document.createElement("p");
                // list.innerHTML = 'Прикачени файлове:';
                // fileUl.appendChild(list);
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


                    // var remove_button = document.createElement('button');
                    // remove_button.setAttribute('class', 'btn btn-default');
                    var remove_span = document.createElement('span');

                    remove_span.setAttribute('class', 'glyphicon glyphicon-remove');
                    //   remove_button.appendChild(remove_span);
                    li.appendChild(remove_span);

                    remove_span.addEventListener("click", function (e) {
                        $(this).parents('li').remove();
                        if ($('#fileList li').length === 0) {
                            $('#fileList').hide();
                        }
                        // console.log($('#fileList li').length);
                    })

                }
            }

        }

        //    $('#file').fileinput({
        //        language: 'bg',
        //        uploadUrl: 'http://localhost/intranet_test/public/upload.php',
        //        allowedFileExtensions: ['jpg', 'png', 'gif', 'txt', 'doc', 'docx', 'pdf', 'zip', 'rar'],
        //        uploadExtraData: function() {
        //            return {
        //                label: $("#label").val(),
        //                text: $("#text").val()
        //            };
        //        }
        //    });
    </script>
    </body>
    </html>
    <?php
}
else{
   // echo '<pre>' . print_r($_SERVER, true) . '</pre>';die();
echo uri();die();
    redirect(uri());
}
