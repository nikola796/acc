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
use App\Core\UploadException;

class File
{

    private $db;

    /**
     * File constructor.
     */
    public function __construct()
    {
        $conf = App::get('config');

        $this->db = Connection::make($conf['database']);
    }

    /**
     * GET ALL FILES
     * @return array
     */
    public function getAllFiles()
    {
        $sql = 'SELECT f.id, f.original_filename, f.sort_number, f.label, u.name AS author,nc.name AS folder,f.modified,p.post FROM files AS f
                                                  LEFT JOIN users AS u ON (f.added_from=u.id)
                                                  LEFT JOIN ' . NESTED_CATEGORIES . ' AS nc ON (f.directory=nc.category_id) 
                                                  LEFT JOIN posts AS p ON (f.post_id=p.id)';

        $sql = $this->userAccess($sql);

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    private function userAccess($sql)
    {
        if ($_SESSION['role'] > 1) {
            $user = new User();
            $user_access = $user->getUserAccess($_SESSION['user_id']);
            foreach ($user_access as $ua) {
                //echo $ua->folder_id;
                $stmt = $this->db->prepare('SELECT  `lft`,  `rgt` FROM ' . NESTED_CATEGORIES . '  WHERE category_id = ?');
                $stmt->execute(array($ua->folder_id));
                $params[] = $stmt->fetchAll(PDO::FETCH_CLASS);
            }

            $nsql = 'SELECT category_id FROM nested_categories WHERE lft BETWEEN ';

            foreach ($params as $k => $param) {
                $nsql .= $param[0]->lft . ' AND ' . $param[0]->rgt;
                // echo $k.'<br />';
                if (($k + 1) < count($params)) {
                    $nsql .= ' OR lft BETWEEN ';
                }
            }

            $stmt = $this->db->prepare($nsql);
            $stmt->execute();
            $user_access_folders = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $cats = implode(', ', array_map(function ($entry) {
                return $entry['category_id'];
            }, $user_access_folders));


            $sql .= ' WHERE f.directory IN (' . $cats . ')';

        }
        //dd($sql);
        return $sql;
    }

    /**
     * FILE UPLOAD
     * @param null $post_id
     * @param array $action
     * @return array
     */
    public function fileUpload($post_id = null, $action = array())
    {
        //dd($_FILES);
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

    /**
     * SAVE INFO IN DB FOR UPLOADED FILE
     * @param array $file
     * @return int
     */
    public function saveFile($file = array())
    {
        //dd($file);
        if ($file['sort_number'] != null) {
            if ($file['sort_number'] != $file['default_sort_number']) {

                try {
                    $this->db->beginTransaction();

                    $stmt = $this->db->prepare('UPDATE ' . NESTED_CATEGORIES . ' SET sort_number = (sort_number + 1) WHERE parent_id =:directory AND sort_number >=:sort_number');
                    $stmt->execute(array('directory' => $file['directory'], 'sort_number' => $file['sort_number']));
//dd('Test');
                    $stmt = $this->db->prepare('UPDATE files SET sort_number = (sort_number + 1) WHERE directory =:directory AND sort_number >= :sort_number AND post_id IS NULL');
                    $stmt->execute(array('directory' => $file['directory'], 'sort_number' => $file['sort_number']));

                    $stmt = $this->db->prepare('UPDATE posts SET sort_number = (sort_number + 1) WHERE directory = :directory AND sort_number >= :sort_number');
                    $stmt->execute(array('directory' => $file['directory'], 'sort_number' => $file['sort_number']));

                    unset($file['default_sort_number']);

                    $stmt = $this->db->prepare('INSERT INTO files (original_filename, stored_filename, file_basename, file_ext, file_size, file_md5_hash, label, added_from, department_id, directory, post_id, sort_number)
                    VALUES(:original_filename, :stored_filename, :file_basename, :file_ext, :file_size, :file_md5_hash, :label, ' . $_SESSION['user_id'] . ', :department_id, :directory, :post_id, :sort_number)');

                    $stmt->execute($file);

                    $id = $this->db->lastInsertId();

                    $this->db->commit();

                } catch (PDOException $ex) {
                    $this->db->rollBack();
                    echo $ex->getMessage();
                }

            } else {
                unset($file['default_sort_number']);
                $sql = 'INSERT INTO files (original_filename, stored_filename, file_basename, file_ext, file_size, file_md5_hash, label, added_from, department_id, directory, post_id, sort_number)
                  VALUES(:original_filename, :stored_filename, :file_basename, :file_ext, :file_size, :file_md5_hash, :label, ' . $_SESSION['user_id'] . ', :department_id, :directory, :post_id, :sort_number)';

                $stmt = $this->db->prepare($sql);
                $stmt->execute($file);
            }
        } else {
            unset($file['default_sort_number']);
            unset($file['sort_number']);
            $sql = 'INSERT INTO files (original_filename, stored_filename, file_basename, file_ext, file_size, file_md5_hash, label, added_from, department_id, directory, post_id)
                  VALUES(:original_filename, :stored_filename, :file_basename, :file_ext, :file_size, :file_md5_hash, :label, ' . $_SESSION['user_id'] . ', :department_id, :directory, :post_id)';

            $stmt = $this->db->prepare($sql);
            $stmt->execute($file);
        }


        return $stmt->rowCount();
    }

    /**
     * DELETE FILE
     * @param array $files_id
     * @return int
     */
    public function deleteFile($files_id = array())
    {

        $path = realpath(FILES_FOLDER) . DIRECTORY_SEPARATOR;
        $del_files = 0;
        foreach ($files_id as $file_id) {
            $stmt = $this->db->prepare('SELECT stored_filename, post_id, sort_number, directory FROM files WHERE id = ?');
            $stmt->execute(array(intval($file_id)));
            $row = $stmt->fetchAll(PDO::FETCH_CLASS);
            if ($row[0]->post_id !== null) {
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
        if ($post_id) {
            foreach ($post_id as $pid) {
                $stmt = $this->db->prepare('SELECT count(*) AS cnt FROM files WHERE post_id = ?');
                $stmt->execute(array($pid));
                $rows = $stmt->fetchAll(PDO::FETCH_CLASS);
                $rows['post_id'] = $pid;
            }
            if ($rows[0]->cnt == 0) {
                $stmt = $this->db->prepare('SELECT attachment FROM posts WHERE id = ?');
                $stmt->execute(array($rows['post_id']));
                $res = $stmt->fetchAll(PDO::FETCH_CLASS);
                if ($res[0]->attachment == 1) {
                    $stmt = $this->db->prepare('UPDATE  posts SET attachment = 0 WHERE id = ?');
                    $stmt->execute(array($rows['post_id']));
                }

            }
        } else {
            try {
                $this->db->beginTransaction();

                $stmt = $this->db->prepare('UPDATE ' . NESTED_CATEGORIES . ' SET sort_number = (sort_number - 1) WHERE parent_id =:directory AND sort_number >=:sort_number');
                $stmt->execute(array('directory' => $row[0]->directory, 'sort_number' => $row[0]->sort_number));
//dd('Test');
                $stmt = $this->db->prepare('UPDATE files SET sort_number = (sort_number - 1) WHERE directory =:directory AND sort_number > :sort_number AND post_id IS NULL');
                $stmt->execute(array('directory' => $row[0]->directory, 'sort_number' => $row[0]->sort_number));

                $stmt = $this->db->prepare('UPDATE posts SET sort_number = (sort_number - 1) WHERE directory = :directory AND sort_number > :sort_number');
                $stmt->execute(array('directory' => $row[0]->directory, 'sort_number' => $row[0]->sort_number));

                $this->db->commit();

            } catch (PDOException $ex) {
                $this->db->rollBack();
                echo $ex->getMessage();
            }
        }

        return $del_files;
    }

    /**
     * PROCESS FILE UPLOAD
     * @param $files
     * @return array|int
     */
    public function process_uploaded_file($files)
    {
//dd($files);
        foreach ($files as $file) {
            if ($file['size'] > 0) {
                $data_storage_path = realpath(FILES_FOLDER) . DIRECTORY_SEPARATOR;
                $original_filename = $file['name'];
                $file_basename = substr($original_filename, 0, strripos($original_filename, '.')); // strip extention
                $file_ext = substr($original_filename, strripos($original_filename, '.'));
                $file_md5_hash = md5_file($file['tmp_name']);
                $stored_filename = uniqid();
                $stored_filename .= $file_ext;
                $sort_number = $file['sort_number'];
                $default_sort_number = $file['default_sort_number'];
                //dd($data_storage_path);
                //move_uploaded_file($file['tmp_name'], '/var/www/html/intranet_test/public/'. $original_filename);
                if (!move_uploaded_file($file['tmp_name'], $data_storage_path . $stored_filename)) {
                    dd($data_storage_path . $stored_filename);
                    // unable to move,  check error_log for details
                    return 0;
                }
                $file_data = array('original_filename' => $original_filename, 'stored_filename' => $stored_filename, 'file_md5_hash' => $file_md5_hash, 'file_basename' => $file_basename, 'file_ext' => $file_ext, 'file_size' => $file['size'], 'directory' => $file['folder'], 'post_id' => $file['post_id'], 'department_id' => $file['dep_id'], 'label' => $file['label'], 'sort_number' => $sort_number, 'default_sort_number' => $default_sort_number);
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

                $files = $_FILES['userfile'];
                $files['label'] = $_POST['label'];
                $files['folder'] = $_POST['folder'];
                $files['dep'] = $action['department_id'];

                if ($action['act'] == 'add') {
                    $files['dep'] = intval(App::get('database')->getFolderDepartment($_POST['folder']));
                    if ($post_id == null) {
                        $sort_number = intval($_POST['sort_number']);
                        $default_sort_number = intval($_POST['default_sort_number']);
                    }
                }

                foreach ($files as $k => $f) {

                    if (is_array($f)) {
                        foreach ($f as $kk => $v) {
                            //echo '<pre>' . print_r($k .'=>'. $v, true) . '</pre>';die();
                            $narr[$kk][$k] = $v;
                            $narr[$kk]['folder'] = $files['folder'];
                            $narr[$kk]['post_id'] = $post_id;
                            $narr[$kk]['dep_id'] = $files['dep'];
                            $narr[$kk]['sort_number'] = ($sort_number + $kk);
                            $narr[$kk]['default_sort_number'] = $default_sort_number;

                        }
                    }


                }

                $res = $this->process_uploaded_file($narr);

                if (count($res['all_files']) > 0) {
                    $success_upload = true;
                }
//dd($success_upload);
// a flag to see if everything is ok
                //  $success_upload = null;

// file paths to store
                //    $paths = array();


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

// return a json encoded response for plugin to process successfully
                // return json_encode($output);

        return $output;

    }

    public static function checkFileErrors()
    {
        /**  CHECK FOR ERRORS ON UPLOAD FILES **/
        foreach ($_FILES['userfile']['error'] as $k => $error) {
            if ($error > 0) {
                $errors[$k] = $error;
            } else {
                if (isset($_POST['label'][$k]) && strlen(trim($_POST['label'][$k])) > 0) {
                    //$files = $_FILES['userfile'][$k];
                    $files_label[$k] = $_POST['label'][$k];
                }
            }
        }

        /** IF NO ERRORS CONTINUE **/
        if (count($errors) === 0) {
            /** IF FILE GOT A LABEL CONTINUE **/
            if (count($_FILES['userfile']['error']) === count($files_label)) {
                return $output = array('success' => 'File is OK');
            } else {
                // NO DESCRIPTION FOR SOME FILE
                $output = array('error' => 'Не сте добавили описание на файл');
            }

        } else {
            // CHECK FOR TYPE OF ERROR
            $output = static::uploadedFileErrorCheck($errors);

        }
        return $output;
    }



    /**
     * @param array $errors
     * @return mixed
     * @internal param array $test
     * @internal param $output
     */
    private static function uploadedFileErrorCheck($errors = array())
    {
        $output = array();
        foreach ($errors as $error) {

            switch ($error) {

                case 1:
                    $output['error'] = 'Файлът, който се опитвате да прикачите е с прекалено голям размер. Максимално допустим е файл с големина до 20Mb';
                    break;
                case 2:
                    $output['error'] = 'Файлът, който се опитвате да прикачите е с прекалено голям размер. Максимално допустим е файл с големина до 20Mb';
                    break;
                case 3:
                    $output['error'] = 'Прикаченият файл е само частично добавен!';
                    break;
                case 4:
                    $output['error'] = ' Не сте прикачили файл!';
                    break;
                case 6:
                    $output['error'] = ' Липсва временната папка за прикачване!.';
                    break;
                case 7:
                    $output['error'] = ' Грешка при опит да се пише на диска.';
                    break;
                case 8:
                    $output['error'] = ' PHP спря качването на файла.';
                    break;
                default:
                    $output['error'] = 'Неясна грешка при прикачнаве на файл. Моля опитайте отново.';
            }
        }


        return $output;
    }

}