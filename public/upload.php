<?php
//echo '<pre>' . print_r($_FILES, true) . '</pre>';
//die(var_dump($_FILES['name']));
// upload.php
// 'images' refers to your file input name attribute
if (empty($_FILES['file-fr'])) {
echo json_encode(array('error'=>'No files found for upload.'));
// or you can throw an exception
return; // terminate
}

//$errors= array();
//$file_name = $_FILES['file-fr']['name'];
//$file_size =$_FILES['file-fr']['size'];
//$file_tmp =$_FILES['file-fr']['tmp_name'];
//$file_type=$_FILES['file-fr']['type'];
//$file_ext=strtolower(end(explode('.',$_FILES['file-fr']['name'])));
//
//$expensions= array("jpeg","jpg","png");
////die(var_dump($file_tmp));
//if(empty($errors)==true){
//    move_uploaded_file($file_tmp[0],"files/".$file_name[0]);
//    echo "Success";
//}else{
//    print_r($errors);
//}
//die();
// get the files posted
$images = $_FILES['file-fr'];
//die(var_dump($images));
// get text added by user
$text = empty($_POST['text']) ? '' : $_POST['text'];

// get label for uploaded file
$label = empty($_POST['label']) ? '' : $_POST['label'];
//die(var_dump($_POST));
// a flag to see if everything is ok
$success = null;

// file paths to store
$paths= array();

// get file names
$filenames = $images['name'];
//die(var_dump($filenames));
// loop and process files
for($i=0; $i < count($filenames); $i++){
$ext = explode('.', basename($filenames[$i]));
$target = "files" . DIRECTORY_SEPARATOR . basename($filenames[$i]);

if(move_uploaded_file($images['tmp_name'][$i], $target)) {
$success = true;
$paths[] = $target;
} else {
$success = false;
break;
}
}

// check and process based on successful status
if ($success === true) {
// call the function to save all data to database
// code for the following function `save_data` is not
// mentioned in this example
//save_data($userid, $username, $paths);

// store a successful response (default at least an empty array). You
// could return any additional response info you need to the plugin for
// advanced implementations.
$output = array();
// for example you can get the list of files uploaded this way
// $output = ['uploaded' => $paths];
} elseif ($success === false) {
$output = array('error'=>'Error while uploading images. Contact the system administrator');
// delete any uploaded files
foreach ($paths as $file) {
unlink($file);
}
} else {
$output = array('error'=>'No files were processed.');
}

// return a json encoded response for plugin to process successfully
echo json_encode($output);