<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Администрация интранет страница на АМ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- jQuery UI -->
    <link href="https://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.css" rel="stylesheet" media="screen">

    <!-- Bootstrap -->
    <link href="<?php url()?>/public/css/libs/bootstrap.min.css" rel="stylesheet">
    <link href="<?php url() ?>public/css/libs/bootstrap-dialog.css" media="all" rel="stylesheet"
          type="text/css"/>
    <!-- styles -->
    <link href="<?php url()?>/public/css/admin_styles.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

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

        /*.row {*/
            /*border: 1px dashed #aaa;*/
            /*border-radius: 4px;*/
            /*padding: 20px;*/
        /*}*/

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
<div class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <!-- Logo -->
                <div class="logo">
                    <h1><a href="index.html">Администрация интранет</a></h1>
                </div>
            </div>
            <div class="col-md-5">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="input-group form">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
	                         <button class="btn btn-primary" type="button">Search</button>
	                       </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="navbar navbar-inverse" role="banner">
                    <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account <b class="caret"></b></a>
                                <ul class="dropdown-menu animated fadeInUp">
                                    <li><a href="profile.html">Profile</a></li>
                                    <li><a href="logout">Изход</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-content">
    <div class="row">
        <div class="col-md-2">
            <div class="sidebar content-box" style="display: block;">
                <ul class="nav">
                    <!-- Main menu -->
                    <li><a href="index.html"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
                    <li><a href="calendar.html"><i class="glyphicon glyphicon-calendar"></i> Calendar</a></li>
                    <li><a href="stats.html"><i class="glyphicon glyphicon-stats"></i> Statistics (Charts)</a></li>
                    <li><a href="tables.html"><i class="glyphicon glyphicon-list"></i> Tables</a></li>
                    <li><a href="buttons.html"><i class="glyphicon glyphicon-record"></i> Buttons</a></li>
                    <li class="current"><a href="editors.html"><i class="glyphicon glyphicon-pencil"></i> Editors</a></li>
                    <li><a href="forms.html"><i class="glyphicon glyphicon-tasks"></i> Forms</a></li>
                    <li class="submenu">
                        <a href="#">
                            <i class="glyphicon glyphicon-list"></i> Pages
                            <span class="caret pull-right"></span>
                        </a>
                        <!-- Sub menu -->
                        <ul>
                            <li><a href="login.html">Login</a></li>
                            <li><a href="signup.html">Signup</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-10">

            <div class="content-box-large">
                <div class="panel-heading">
                    <div class="panel-title"><h4 class="text-center">Добавете Вашата публикация в редактора по-долу.</h4></div>

                    <div class="panel-options">
                        <a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
                        <a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>
                    </div>
                </div>
                <div class="panel-body">
                    <form action="" method="post" enctype="multipart/form-data">

                        <div id="callout-formgroup-inputgroup" class="bs-callout bs-callout-warning">

                        </div>
                        <div class="form-group">
                            <textarea cols="80" id="text" name="text" rows="10" placeholder="Място за текст"></textarea>
                        </div>

                        <div class="form-group">
                            <span class="form-control-static"><strong>Изберете от списъка в коя папка да бъде Вашата публикация.</strong></span>

                            <span class="form-control-static"><strong>Или създайте </strong></span>
                            <!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Нова папка</button> -->
                            <a href="#" id="mod"><strong>Нова папка</strong></a>
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

                            <input type="button" class="form-control btn-info" id="addAnotherFile" value="Добави файл"/>

                        </div>
                        <div id="attachedFiles">

                        </div>


                        <div class="spacer-bg"></div>
                        <div class="text-center">
                            <!--                <button type="submit" class="btn btn-default" id="view_post" name="view">Прегледай</button>-->
                            <button type="submit" class="btn btn-primary" name="save">Запази</button>
                        </div>
                    </form>
                </div>
            </div>

<!--            <div class="content-box-large">-->
<!--                <div class="panel-heading">-->
<!--                    <div class="panel-title">CKEditor Full</div>-->
<!---->
<!--                    <div class="panel-options">-->
<!--                        <a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>-->
<!--                        <a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="panel-body">-->
<!--                    <textarea id="ckeditor_full"></textarea>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--            <div class="content-box-large">-->
<!--                <div class="panel-heading">-->
<!--                    <div class="panel-title">TinyMCE Basic</div>-->
<!---->
<!--                    <div class="panel-options">-->
<!--                        <a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>-->
<!--                        <a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="panel-body">-->
<!--                    <textarea id="tinymce_basic"></textarea>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--            <div class="content-box-large">-->
<!--                <div class="panel-heading">-->
<!--                    <div class="panel-title">TinyMCE Full</div>-->
<!---->
<!--                    <div class="panel-options">-->
<!--                        <a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>-->
<!--                        <a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="panel-body">-->
<!--                    <textarea id="tinymce_full"></textarea>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--            <div class="content-box-large">-->
<!--                <div class="panel-heading">-->
<!--                    <div class="panel-title">Bootstrap WYSIWYG</div>-->
<!---->
<!--                    <div class="panel-options">-->
<!--                        <a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>-->
<!--                        <a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="panel-body">-->
<!--                    <textarea id="bootstrap-editor" placeholder="Enter text ..." style="width:98%;height:200px;"></textarea>-->
<!--                </div>-->
<!--            </div>-->



        </div>
    </div>
</div>

<footer>
    <div class="container">

        <div class="copy text-center">
            Copyright 2014 <a href='#'>Website</a>
        </div>

    </div>
</footer>

<script src="<?php url() ?>public/js/libs/jquery-2.2.4.min.js"></script>
<script src="<?php url() ?>public/js/plugins/sortable.js" type="text/javascript"></script>
<script src="<?php url() ?>public/js/fileinput.js" type="text/javascript"></script>
<script src="<?php url() ?>public/js/locales/bg.js" type="text/javascript"></script>
<script src="<?php url() ?>public/js/locales/es.js" type="text/javascript"></script>
<script src="<?php url() ?>public/themes/explorer/theme.js" type="text/javascript"></script>
<script src="<?php url() ?>public/js/libs/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php url() ?>public/js/libs/bootstrap-dialog.js" type="text/javascript"></script>
<script src="<?php url() ?>public/ckeditor/ckeditor.js"></script>

<script src="<?php url()?>/public/ckeditor/ckeditor.js"></script>
<script src="<?php url()?>/public/ckeditor/adapters/jquery.js"></script>

<script src="<?php url()?>/public/js/custom.js"></script>
<!--<script src="--><?php //url()?><!--/public/js/editors.js"></script>-->
<script>

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

</script>
</body>
</html>