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

    public function getAllFiles()
    {

        $stmt = $this->db->prepare('    SELECT f.id,f.original_filename,f.label, u.name as author,nc.name as folder,f.file_added_when,p.post FROM intranet.files AS f
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
            if ($action['act'] == 'add') {
                $files['dep'] = App::get('database')->getFolderDepartment($_POST['folder']);
            } else {
                $files['dep'] = $action['department_id'];
            }

            // echo '<pre>' . print_r($files, true) . '</pre>';die();
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

            $upload_action = $this->saveFile($narr, $files);

// a flag to see if everything is ok
            $success_upload = null;

// file paths to store
            $paths = array();

// get file names
            $filenames = $files['name'];

// loop and process files
            for ($i = 0; $i < count($filenames); $i++) {
                $ext = explode('.', basename($filenames[$i]));
                $target = realpath('public/files') . DIRECTORY_SEPARATOR . basename($filenames[$i]);

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
                if (count($paths) > 1) {
                    $output['success'] .= 'ове ';
                } else {
                    $output['success'] .= ' ';
                }
                foreach ($paths as $path) {

                    $up_file[] = basename($path);
                }

                $output['success'] .= implode(', ', $up_file);

// for example you can get the list of files uploaded this way
// $output = ['uploaded' => $paths];
            } elseif ($success_upload === false) {
                $output = array('error' => 'Error while uploading file. Contact the system administrator');
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
        $sql = 'INSERT INTO files (original_filename, stored_filename, file_basename, file_ext, file_size, file_md5_hash, label, added_from, department_id, directory, post_id)
                  VALUES(:original_filename, :stored_filename, :file_basename, :file_ext, :file_size, :file_md5_hash, :label, ' . $_SESSION['user_id'] . ', :department_id, :directory, :post_id)';

        $stmt = $this->db->prepare($sql);
        $stmt->execute($file);
//        foreach($files as $one_file){
//            $file_upload = $this->process_uploaded_file('userfile');
//            if($file_upload !== 0){
//                $stmt->execute(array($f['name'], $f['label'], $f['dep_id'], $f['folder'], $f['post_id']));
//            }
//        }


        // foreach ($file as $f) {
        //      $stmt->execute(array($f['name'], $f['label'], $f['dep_id'], $f['folder'], $f['post_id']));
        //  }
        //$stmt->execute($file);

        return $stmt->rowCount();
    }

    public function deleteFile($files_id = array())
    {

        $path = realpath('core/files') . DIRECTORY_SEPARATOR;
        $del_files = 0;
        foreach ($files_id as $file_id) {
            $stmt = $this->db->prepare('SELECT stored_filename, post_id FROM files WHERE id = ?');
            $stmt->execute(array($file_id));
            $row = $stmt->fetchAll(PDO::FETCH_CLASS);
            if($row[0]->post_id !== null){
                $post_id[] = $row[0]->post_id;
            }


            $stmt = $this->db->prepare('DELETE FROM files WHERE id = ?');
            //echo '<pre>' . print_r($row, true) . '</pre>';
            //fclose(url().'public/files/'.$row[0]['name']);
            if (unlink($path . $row[0]->stored_filename)) {
                $stmt->execute(array($file_id));
                $del_files += $stmt->rowCount();
            }
        }
        if($post_id) {
            foreach ($post_id as $pid) {
                $stmt = $this->db->prepare('SELECT count(*) as cnt FROM files WHERE post_id = ?');
                $stmt->execute(array($pid));
                $rows = $stmt->fetchAll(PDO::FETCH_CLASS);
                $rows['post_id'] = $pid;
            }
            if($rows[0]->cnt == 0){
                $stmt = $this->db->prepare('SELECT attachment FROM posts WHERE id = ?');
                $stmt->execute(array($rows['post_id']));
                $res = $stmt->fetchAll(PDO::FETCH_CLASS);
                if ($res[0]->attachment == 1){
                    $stmt = $this->db->prepare('UPDATE  posts SET attachment = 0 WHERE id = ?');
                    $stmt->execute(array($rows['post_id']));
                }

            }
        }
        //dd($rows[0]->cnt);die();
       // echo '<pre>' . print_r($rows, true) . '</pre>';die();
        return $del_files;


        //return $stmt->rowCount();
    }

    public function process_uploaded_file($files)
    {

        foreach ($files as $file) {
            if ($file['size'] > 0) {
                $data_storage_path = realpath('core/files') . DIRECTORY_SEPARATOR;
                $original_filename = $file['name'];
                $file_basename = substr($original_filename, 0, strripos($original_filename, '.')); // strip extention
                $file_ext = substr($original_filename, strripos($original_filename, '.'));
                $file_md5_hash = md5_file($file['tmp_name']);
                $stored_filename = uniqid();
                $stored_filename .= $file_ext;
                //echo '<pre>' . print_r($data, true) . '</pre>';die();
                if (!move_uploaded_file($file['tmp_name'], $data_storage_path . $stored_filename)) {
                    // unable to move,  check error_log for details
                    return 0;
                }
                $file_data = array('original_filename' => $original_filename, 'stored_filename' => $stored_filename, 'file_md5_hash' => $file_md5_hash, 'file_basename' => $file_basename, 'file_ext' => $file_ext, 'file_size' => $file['size'], 'directory' => $file['folder'], 'post_id' => $file['post_id'], 'department_id' => $file['dep_id'], 'label' => $file['label']);
                $file_name[] = $original_filename;
                $this->saveFile($file_data);
                $data[] = $file_data;
                // insert a record into your db using your own mechanism ...
                // $statement = "INSERT into yourtable (original_filename, stored_filename, file_md5_hash, username, activity_date) VALUES (?, ?, ?, ?, NOW())";

                // success, all done

            }
        }
        $data['all_files'] = $file_name;
        return $data;
    }

    /**
     * IN THIS METHOD WE PREPARE AND EXECUTE FILE UPLOAD
     * @param null $post_id
     * @param array $action
     * @return array|string
     * @internal param $files
     */
    public function fileUpload2($post_id = null, $action = array())
    {

        if ($_FILES['userfile']['error'][0] === 0) {
            $files = $_FILES['userfile'];
            $files['label'] = $_POST['label'];
            $files['folder'] = $_POST['folder'];
            $files['dep'] = $action['department_id'];
            if ($action['act'] == 'add') {
                $files['dep'] = App::get('database')->getFolderDepartment($_POST['folder']);
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
//dd($narr);
            $res = $this->process_uploaded_file($narr);

            if (count($res['all_files']) > 0) {
                $success_upload = true;
            }

            //    echo $res['name'];
            // die();
            //  echo '<pre>' . print_r($res, true) . '</pre>';die();
//            echo '<pre>' . print_r($narr, true) . '</pre>';die();
//            if ($action['act'] == 'add') {
//                App::get('database')->saveFile($narr);
//            }


// a flag to see if everything is ok
            //  $success_upload = null;

// file paths to store
            //    $paths = array();

// get file names
            //  $filenames = $files['name'];

// loop and process files
//            for ($i = 0; $i < count($filenames); $i++) {
//                $ext = explode('.', basename($filenames[$i]));
//                $target = "C:\\xampp_5.3\\htdocs\\intranet_test\\public\\files" . DIRECTORY_SEPARATOR . basename($filenames[$i]);
//
//                if (move_uploaded_file($files['tmp_name'][$i], $target)) {
//                    $success_upload = true;
//                    $paths[] = $target;
//                } else {
//                    $success_upload = false;
//                    break;
//                }
//            }

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
                if (count($res['all_files']) > 1) {
                    $output['success'] .= 'ове ';
                } else {
                    $output['success'] .= ' ';
                }

                $output['success'] .= implode(', ', $res['all_files']);

// for example you can get the list of files uploaded this way
// $output = ['uploaded' => $paths];
            } elseif ($success_upload === false) {
                $output = array('error' => 'Error while uploading images. Contact the system administrator');
// delete any uploaded files
                //  foreach ($paths as $file) {
                //    unlink($file);
                //  }
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

}