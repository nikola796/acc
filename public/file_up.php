<?php
if(isset($_FILES['file1'])){
   // echo '<pre>' . print_r($_FILES, true) . '</pre>';die();
    // pass the file input name used in the form and any other pertinent info to store in the db, username in this example



    $name = $_FILES["file1"]["name"];
    $ext = end(explode(".", $name)); # extra () to prevent notice

   // echo realpath('../core/files');

//die();


    function _process_uploaded_file($file_key, $username='guest'){
        if(array_key_exists($file_key, $_FILES)){
            $file = $_FILES[$file_key];
            if($file['size'] > 0){
                $data_storage_path = realpath('../core/files').DIRECTORY_SEPARATOR;
                $original_filename = $file['name'];
                $file_basename     = substr($original_filename, 0, strripos($original_filename, '.')); // strip extention
                $file_ext          = substr($original_filename, strripos($original_filename, '.'));
                $file_md5_hash     = md5_file($file['tmp_name']);
                $stored_filename   = uniqid();
                $stored_filename  .= $file_ext;
                $data = array('original_filename' => $original_filename, 'stored_filename' => $stored_filename, 'file_md5_hash' => $file_md5_hash, 'file_basename' => $file_basename, 'file["tmp_name"]' => $file['tmp_name']);
                echo '<pre>' . print_r($data, true) . '</pre>';die();
                if(! move_uploaded_file($file['tmp_name'], $data_storage_path.$stored_filename)){
                    // unable to move,  check error_log for details
                    return 0;
                }
                // insert a record into your db using your own mechanism ...
                // $statement = "INSERT into yourtable (original_filename, stored_filename, file_md5_hash, username, activity_date) VALUES (?, ?, ?, ?, NOW())";

                // success, all done
                return 1;
            }
        }
        return 0;
    }


    _process_uploaded_file('file1', 'jsmith');
    exit;

}

var_dump(realpath('public/files/ducky.gif'));

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form method="post" enctype="multipart/form-data" action="">



<input type="file" name="file1" value="" />



<input type="submit" name="b1" value="Upload File" />

</form>
<a href="down.php">Свали</a>
</body>
</html>