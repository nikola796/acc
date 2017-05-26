<?php
/**
 * Created by PhpStorm.
 * User: Vladislav Andreev
 * Date: 13.4.2017 г.
 * Time: 13:32 ч.
 */

namespace app\models;
use App\Core\App;
use Connection;
use PDO;

class File
{

    private $db;

    public function __construct()
    {
        $conf = App::get('config');

        $this->db = Connection::make($conf['database']);
    }

    public function getAllFiles(){

        $stmt = $this->db->prepare('    SELECT f.id,f.name,f.label, u.name as author,nc.name as folder,f.file_added_when,p.post FROM intranet.files AS f
                                                  LEFT JOIN users as u ON (f.added_from=u.id)
                                                  LEFT JOIN nested_categorys as nc ON (f.directory=nc.category_id) 
                                                  LEFT JOIN posts AS p ON (f.post_id=p.id)');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public function fileUpload($post_id = null, $action = array())
    {
        if ($_FILES['userfile']['error'][0] === 0) {
            $files = $_FILES['userfile'];
            $files['label'] = $_POST['label'];
            $files['folder'] = $_POST['folder'];
            if($action['act'] == 'add'){
                $files['dep'] =  App::get('database')->getFolderDepartment($_POST['folder']);
            }else{
                $files['dep'] = $action['department_id'];
            }



            foreach ($files as $k => $f) {

                if (is_array($f)) {
                    foreach ($f as $kk => $v) {
                        //echo '<pre>' . print_r($k .'=>'. $v, true) . '</pre>';die();
                        $narr[$kk][$k] = $v;
                        $narr[$kk]['folder'] = $files['folder'];
                        $narr[$kk]['post_id'] = $post_id;
                        $narr[$kk]['dep_id'] = $files['dep'];

                    }
                }


            }

                $this->saveFile($narr);

// a flag to see if everything is ok
            $success_upload = null;

// file paths to store
            $paths = array();

// get file names
            $filenames = $files['name'];

// loop and process files
            for ($i = 0; $i < count($filenames); $i++) {
                $ext = explode('.', basename($filenames[$i]));
                $target = "C:\\xampp_5.3\\htdocs\\intranet_test\\public\\files" . DIRECTORY_SEPARATOR . basename($filenames[$i]);

                if (move_uploaded_file($files['tmp_name'][$i], $target)) {
                    $success_upload = true;
                    $paths[] = $target;
                } else {
                    $success_upload = false;
                    break;
                }
            }

// check and process based on successful status
            if ($success_upload === true) {
// call the function to save all data to database
// code for the following function `save_data` is not
// mentioned in this example
//save_data($userid, $username, $paths);

// store a successful response (default at least an empty array). You
// could return any additional response info you need to the plugin for
// advanced implementations.
                $up_files = '';
                $output = array('success' => 'Успешно добавихте файл');
                if(count($paths) > 1){
                    $output['success'] .= 'ове ';
                } else{
                    $output['success'] .= ' ';
                }
                foreach ($paths as $path){

                    $up_file[] = basename($path);
                }

                $output['success'] .= implode(', ', $up_file);

// for example you can get the list of files uploaded this way
// $output = ['uploaded' => $paths];
            } elseif ($success_upload === false) {
                $output = array('error' => 'Error while uploading images. Contact the system administrator');
// delete any uploaded files
                foreach ($paths as $file) {
                    unlink($file);
                }
            } else {
                $output = array('error' => 'No files were processed.');
            }
            return $output;
// return a json encoded response for plugin to process successfully
           // return json_encode($output);

        } else {
            echo '<pre>' . print_r($_FILES['userfile']['error'], true) . '</pre>';
        }

    }

    public function saveFile($file = array())
    {
        $sql = 'INSERT INTO files (name, label, added_from, file_added_when, department_id, directory, post_id)
                  VALUES(?, ?, '.$_SESSION['user_id'].', ' . time() . ', ?, ?, ?)';

        $stmt = $this->db->prepare($sql);

        foreach ($file as $f) {
            $stmt->execute(array($f['name'], $f['label'], $f['dep_id'], $f['folder'], $f['post_id']));
        }
        //$stmt->execute($file);

        return $stmt->rowCount();
    }

    public function deleteFile($file_id)
    {
       $stmt = $this->db->prepare('DELETE FROM files WHERE id = ?');
       $stmt->execute(array($file_id));
       return $stmt->rowCount();
    }

}