<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="http://localhost/intranet_test/public/css/libs/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="http://localhost/intranet_test/public/css/libs/bootstrap-theme.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="http://localhost/intranet_test/public/js/libs/jquery-2.2.4.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script src="http://localhost/intranet_test/public/js/libs/bootstrap.min.js"></script>
    <style>
        li{
            list-style: none;
        }
        span.glyphicon-remove{
            color: red;
            margin-left:10px;
        }
        span.glyphicon-remove:hover {
            cursor: pointer;
        }
        .btn-default {
            margin-left:10px;
        }
    </style>
</head>
<body>

<input type="file" id="fileElem" multiple accept="image/*" style="display:none" onchange="handleFiles(this.files)">
<a href="#" id="fileSelect">Select some files</a>
<div id="fileList">
    <p>No files selected!</p>
</div>


</body>
<script>

//    function sendFiles() {
//        var imgs = document.querySelectorAll(".obj");
//
//        for (var i = 0; i < imgs.length; i++) {
//            new FileUpload(imgs[i], imgs[i].file);
//        }
//    }

//    function FileUpload(img, file) {
//        var reader = new FileReader();
//        this.ctrl = createThrobber(img);
//        var xhr = new XMLHttpRequest();
//        this.xhr = xhr;
//
//        var self = this;
//        this.xhr.upload.addEventListener("progress", function(e) {
//            if (e.lengthComputable) {
//                var percentage = Math.round((e.loaded * 100) / e.total);
//                self.ctrl.update(percentage);
//            }
//        }, false);
//
//        xhr.upload.addEventListener("load", function(e){
//            self.ctrl.update(100);
//            var canvas = self.ctrl.ctx.canvas;
//            canvas.parentNode.removeChild(canvas);
//        }, false);
//        xhr.open("POST", "http://localhost/intranet-test/public/upload.php");
//        xhr.overrideMimeType('text/plain; charset=x-user-defined-binary');
//        reader.onload = function(evt) {
//            xhr.send(evt.target.result);
//        };
//        reader.readAsBinaryString(file);
//    }

    window.URL = window.URL || window.webkitURL;

    var fileSelect = document.getElementById("fileSelect"),
    fileElem = document.getElementById("fileElem"),
    fileList = document.getElementById("fileList");



    fileSelect.addEventListener("click", function (e) {
    if (fileElem) {
    fileElem.click();
    }
    e.preventDefault(); // prevent navigation to "#"
    }, false);

    function handleFiles(files) {
        console.log(files);
    if (!files.length) {
    fileList.innerHTML = "<p>No files selected!</p>";
    } else {
    fileList.innerHTML = "";
    var list = document.createElement("ul");
    fileList.appendChild(list);
    for (var i = 0; i < files.length; i++) {
    var li = document.createElement("li");
    list.appendChild(li);

    var img = document.createElement("img");
    img.src = window.URL.createObjectURL(files[i]);
    img.height = 60;
    img.onload = function() {
    window.URL.revokeObjectURL(this.src);
    }
    li.appendChild(img);
    var info = document.createElement("span");
    info.innerHTML = files[i].name + ": " + files[i].size + " bytes ";
    li.appendChild(info);

    var label = document.createElement('input');
        label.setAttribute("placeholder", 'Описание на файла');
    li.appendChild(label);


       // var remove_button = document.createElement('button');
       // remove_button.setAttribute('class', 'btn btn-default');
    var remove_span = document.createElement('span');

        remove_span.setAttribute('class', 'glyphicon glyphicon-remove');
     //   remove_button.appendChild(remove_span);
    li.appendChild(remove_span);

        remove_span.addEventListener("click", function (e) {
          $(this).parents('li').remove();
        })

    }
    }

    }

</script>
</html>