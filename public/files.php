<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .file-preview {
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 5px;
            padding: 5px;
            width: 100%;
        }

        .file-drop-zone {
            border: 1px dashed #aaa;
            border-radius: 4px;
            height: 100%;
            margin: 12px 15px 12px 12px;
            padding: 5px;
            text-align: center;
            vertical-align: middle;
        }

        .file-drop-zone-title {
            color: #aaa;
            cursor: default;
            font-size: 1.6em;
            padding: 85px 10px;
        }
    </style>
</head>
<body>

<input type="file" id="input" multiple >

<input type="file" id="fileElem" multiple accept="image/*" style="display:none" onchange="handleFiles(this.files)">
<label for="fileElem">Select some files</label>

<div id="dropbox" class="file-preview ">
    <div class="close fileinput-remove">×</div>
    <div id="fh" class=" file-drop-zone"><div  class="file-drop-zone-title">Пуснете файловете тук …</div>
        <div id="fp" class="file-preview-thumbnails">
        </div>
        <div class="clearfix"></div>    <div class="file-preview-status text-center text-success"></div>
        <div class="kv-fileinput-error file-error-message" style="display: none;"></div>
    </div>
</div>



</body>

<script>
    var dropbox = '';

    dropbox = document.getElementById("dropbox");
    dropbox.addEventListener("dragenter", dragenter, false);
    dropbox.addEventListener("dragover", dragover, false);
    dropbox.addEventListener("drop", drop, false);

    function dragenter(e) {
        e.stopPropagation();
        e.preventDefault();
    }

    function dragover(e) {
        e.stopPropagation();
        e.preventDefault();
    }

    function drop(e) {
        e.stopPropagation();
        e.preventDefault();

        var dt = e.dataTransfer;
        var files = dt.files;

        handleFiles(files);
    }

    function handleFiles(files) {
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var imageType = /^image\//;

            if (!imageType.test(file.type)) {
                continue;
            }
            var preview =  document.getElementById("fp");
            var img = document.createElement("img");
            img.classList.add("obj");
            img.file = file;
            preview.appendChild(img); // Assuming that "preview" is the div output where the content will be displayed.

            var reader = new FileReader();
            reader.onload = (function(aImg) { return function(e) { aImg.src = e.target.result; }; })(img);
            reader.readAsDataURL(file);
        }
    }


//    var fileSelect = document.getElementById("fileSelect"),
//        fileElem = document.getElementById("fileElem");
//
//    fileSelect.addEventListener("click", function (e) {
//        if (fileElem) {
//            fileElem.click();
//        }
//        e.preventDefault(); // prevent navigation to "#"
//    }, false);
//
//    function handlesFiles(files) {
//
//        for (var i = 0, numFiles = files.length; i < numFiles; i++) {
//            var file = files[i];
//            console.log(file.name);
//        }
//
//    }

//    var inputElement = document.getElementById("input");
//    inputElement.addEventListener("change", handleFiles, false);
//    function handleFiles() {
//        var fileList = this.files; /* now you can work with the file list */
//        console.log(fileList.length);
//
//        for (var i = 0, numFiles = this.files.length; i < numFiles; i++) {
//            var file = this.files[i];
//        console.log(file.name);
//        }
//
//    }

   // var selectedFile = document.getElementById('input').files[0];

   // function handleFiles(selectedFile)
 //   {
  //      console.log(selectedFile);
  //  }


</script>

</html>



<!--<!DOCTYPE html>-->
<!--<html>-->
<!--<head>-->
<!--    <meta charset="UTF-8">-->
<!--    <title>File(s) size</title>-->
<!--    <script>-->
<!--        function updateSize() {-->
<!--            var nBytes = 0,-->
<!--                oFiles = document.getElementById("uploadInput").files,-->
<!--                nFiles = oFiles.length;-->
<!--            for (var nFileId = 0; nFileId < nFiles; nFileId++) {-->
<!--                nBytes += oFiles[nFileId].size;-->
<!--            }-->
<!--            var sOutput = nBytes + " bytes";-->
<!--            // optional code for multiples approximation-->
<!--            for (var aMultiples = ["KiB", "MiB", "GiB", "TiB", "PiB", "EiB", "ZiB", "YiB"], nMultiple = 0, nApprox = nBytes / 1024; nApprox > 1; nApprox /= 1024, nMultiple++) {-->
<!--                sOutput = nApprox.toFixed(3) + " " + aMultiples[nMultiple] + " (" + nBytes + " bytes)";-->
<!--            }-->
<!--            // end of optional code-->
<!--            document.getElementById("fileNum").innerHTML = nFiles;-->
<!--            document.getElementById("fileSize").innerHTML = sOutput;-->
<!--        }-->
<!--    </script>-->
<!--</head>-->
<!---->
<!--<body onload="updateSize();">-->
<!--<form name="uploadForm">-->
<!--    <p><input id="uploadInput" type="file" name="myFiles" onchange="updateSize();" multiple> selected files: <span id="fileNum">0</span>; total size: <span id="fileSize">0</span></p>-->
<!--    <p><input type="submit" value="Send file"></p>-->
<!--</form>-->
<!--</body>-->
<!--</html>-->