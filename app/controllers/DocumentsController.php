<?php
/**
 * Created by PhpStorm.
 * User: Vladislav Andreev
 * Date: 10.3.2017 г.
 * Time: 14:10 ч.
 */

namespace App\Controllers;

use App\Core\App;

use app\models\File;
use app\models\Folder;
use app\models\Post;
use app\models\User;
use Connection;
use Exception;
use HTML_BBCodeParser2;
use PDO;

class DocumentsController
{

    private $post;

    public function __construct()
    {
        $this->post = new Post();
    }

    /**
     * GET ALL SPACES
     * @return mixed
     */
    public function getIndex()
    {

        $folders = App::get('database')->selectAllSpaces();

        $posts = App::get('database')->getPosts(array('department' => 0, 'directory' => 0));

        $files = App::get('database')->selectAllFiles(array('directory' => 0, 'dep' => 0));

        $current_folder = 'Документи';

        return view('files', compact('folders', 'posts', 'files', 'current_folder'));

    }

    /**
     * GET ALL SPACES
     * @return mixed
     */
    public function getTestIndex()
    {

        $departments = App::get('database')->selectAll('departments'); //getParents();

        return view('documents_test', compact('departments'));

    }

    /**
     * SHOW DIRECTORY BY ID
     * @param $id
     * @return mixed
     */
    public function show($id)
    {

        $documents = App::get('database')->selectDirectories($id);

        return view('show', compact('documents'));

    }

    public function showTest($dep)
    {
        $dep_id = App::get('database')->getId('category_id', $dep, NESTED_CATEGORIES);
        if ($dep_id[0]->category_id == NULL) {
            return view('404');
        }

        $dep_folder_id = App::get('database')->getDepartmentFolderId($dep_id[0]->category_id);

        $posts = App::get('database')->getPosts(array('department' => $dep_id[0]->category_id, 'directory' => $dep_folder_id[0]->category_id));

        $folders = App::get('database')->selectAllFolders($dep_id[0]->category_id);

        $files = App::get('database')->selectAllFiles(array('directory' => $dep_folder_id[0]->category_id, 'dep' => $dep_id[0]->category_id));

        $current_folder = $dep;
        $department_name = $current_folder;

        return view('files', compact('folders', 'files', 'current_folder', 'posts', 'department_name'));

    }

    /*** CREATE NEW FOLDER ***/
    public function createFolder()
    {
        if (isset($_POST['parent'])) {
            $department_id = Folder::getParentDepartment($_POST['parent']);

            return Folder::createFolder($department_id);
        }
    }

    public function savePostFile()
    {
        //echo '<pre>' . print_r($_FILES, true) . '</pre>';

        $response = array();

        if(intval($_FILES['userfile']) !== 0){
            $response = File::checkFileErrors();
            if ($response['error']){
                $_SESSION['add_new_file_post'] = $response;
                redirect('posts');
            } else{
                unset($response['success']);
            }
        }

        if (isset($_POST['save']) && $_POST['save'] == 1) {
            //TODO METHOD FOR INSERT




            /***************** CHECK IS USER CREATE POST **********************/
            if (!empty($_POST['text'])) {

                $folder_id = intval($_POST['folder']);

                $department_id = intval(App::get('database')->getFolderDepartment($folder_id));

                $data = array('text' => $_POST['text'], 'file' => intval($_FILES['userfile']), 'directory_id' => $folder_id, 'department_id' => $department_id);
                if (intval($_POST['sort_number']) != intval($_POST['default_sort_number'])) {
                    $data['old_sort_number'] = intval($_POST['default_sort_number']);
                    $data['new_sort_number'] = intval($_POST['sort_number']);
                } else {
                    $data['new_sort_number'] = intval($_POST['sort_number']);
                }
                $post_id = $this->savePost($data);
                //dd($post_id);
                if ($post_id > 0) {
                    $response['new_post'] = 'Успешно добавихте нова публикация';
                }

            }

            /*** UPLOAD FILE ***/
            if (isset($_FILES['userfile'])) {
                $file = new File();

                $response += $file->fileUpload2($post_id, array('act' => 'add'));


            }

            $_SESSION['add_new_file_post'] = $response;
            redirect('posts');

        } elseif (isset($_POST['save']) && $_POST['save'] == 2) {

            echo $this->updatePost();
        }

    }

    /**
     * GET DATA FOR USER AND HIS PERMISSION TO FOLDERS
     * @return VIEW FOR ADMIN PAGE
     */
    public function admin2()
    {
        $user = User::getUser(1);

        $folders = App::get('database')->getUsersFolders(1);

        return view('form2', compact('user', 'folders'));

    }

    public function notFound()
    {
        return view('404');
    }


    /**
     * IN THIS METHOD WE PREPARE AND EXECUTE FILE UPLOAD
     * @param null $post_id
     * @param array $action
     * @return array|string
     * @internal param $files
     */
    public function fileUpload($post_id = null, $action = array())
    {

        if ($_FILES['userfile']['error'][0] === 0) {
            $files = $_FILES['userfile'];
            $files['label'] = $_POST['label'];
            $files['folder'] = $_POST['folder'];
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
            $file = new File();
            $res = $file->process_uploaded_file($narr);

            if (count($res['all_files']) > 0) {
                $success_upload = true;
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

    /**
     * DELETE POST
     */
    public function delete_post()
    {

        if (isset($_POST['post_id'])) {
            $post_id = $_POST['post_id'];
        }
        $post = new Post();
        $response = $post->deletePost($post_id);
        header('Content-Type: application/json');
        echo json_encode(array('data' => $response));
    }

    /**
     * DELETE FILE
     */
    public function delete_file()
    {
        if (isset($_POST['file_id'])) {
            $file_id = $_POST['file_id'];
        }
        $file = new File();

        echo $response = $file->deleteFile(array('id' => $file_id));
    }

    /**
     * INSERT USER`S POST INTO DB
     * @param $params
     * @return
     */
    private function savePost($params)
    {
        //echo '<pre>' . print_r($params, true) . '</pre>';die();
        if (isset($_POST['save'])) {

            $id = $this->post->create($params);

        }
        return $id;

    }

    /**
     * UPDATE POST FROM USER
     */
    private function updatePost()
    {



        $post = new Post();
        if (isset($_POST['file_id'])) {
            $existing_files = implode(', ', $_POST['file_id']);
        } else {
            $existing_files = 0;
        }

        if (isset($_POST['removed_file_id'])) {

            $removed_files = $_POST['removed_file_id'];

        } else {
            $removed_files = 0;
        }

        if (isset($_POST['removed_file_name'])) {

            //$removed_files_names = App::get('database')->getFileName($_POST['removed_file_id']);
            $removed_files_names = $_POST['removed_file_name'];

        } else {
            $removed_files_names = null;
        }

        $data = array('post_id' => intval($_POST['postId']), 'post' => $_POST['text'], 'folder' => intval($_POST['folder']), 'existing_file' => $existing_files, 'removed_files' => $removed_files, 'removed_files_name' => $removed_files_names);
        if (intval($_POST['old_sort_number']) != intval($_POST['sort_number'])) {
            $data['old_sort_number'] = intval($_POST['old_sort_number']);
            $data['new_sort_number'] = intval($_POST['sort_number']);
        }
        if($data['folder'] != intval($_POST['old_parent'])){
            $data['old_parent'] = intval($_POST['old_parent']);
            $data['old_sort_number'] = intval($_POST['old_sort_number']);
            $data['new_sort_number'] = intval($_POST['sort_number']);
        }

        return $post->updatePost($data);

    }

    public function showGet($filename)
    {
        echo $filename;
    }

    public function search($term)
    {
        $t = explode('=', $term);
        $search = $t['1'];

        $conf = App::get('config');

        $db = Connection::make($conf['database']);

        $stmt = $db->prepare('SELECT DISTINCT label AS label FROM files WHERE label LIKE :term OR original_filename LIKE :term');
        $stmt->execute(array('term' => '%' . $t[1] . '%'));
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($res) == 0) {
            $res[0]['label'] = 'Няма резултати!';

        };

        header('Content-type: application/json');


        echo json_encode($res);
    }

    public function search_result()
    {
        if (strlen(trim($_POST['term'])) > 2) {
            $term = trim($_POST['term']);

            $conf = App::get('config');

            $db = Connection::make($conf['database']);
            $sql = 'SELECT f.original_filename,f.stored_filename,f.label,f.modified, u.name,nc.name AS zveno, ncc.name AS folder FROM files AS f
                    LEFT JOIN users AS u ON (f.added_from = u.id)
                    LEFT JOIN ' . NESTED_CATEGORIES . ' AS nc ON (f.department_id = nc.category_id)
                    LEFT JOIN ' . NESTED_CATEGORIES . ' AS ncc ON (f.directory = ncc.category_id)
                    WHERE label LIKE :term OR original_filename LIKE :term';
            $stmt = $db->prepare($sql);
            $stmt->execute(array('term' => '%' . $term . '%'));
            $search_results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return view('search_results', compact('search_results'));

        } else {
            echo 'Too short term';
        }

    }

    public function online()
    {
        session_start();
        $session = session_id();
        $time = time();
        $time_check = $time - 300;     //We Have Set Time 5 Minutes

        $conf = App::get('config');

        $db = Connection::make($conf['database']);

        $stmt = $db->prepare("SELECT * FROM online_users WHERE session='$session'");
        $stmt->execute();
        $stmt->fetchAll(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();

        //If count is 0 , then enter the values
        if ($count == 0) {
            $sql1 = "INSERT INTO online_users(session, time)VALUES('$session', '$time')";
            $stmt = $db->prepare($sql1);
            $stmt->execute();
        } // else update the values
        else {
            $sql2 = "UPDATE online_users SET time='$time' WHERE session = '$session'";
            $stmt = $db->prepare($sql2);
            $stmt->execute();
        }

        $sql3 = "SELECT * FROM online_users";
        $stmt = $db->prepare($sql3);
        $stmt->execute();
        $stmt->fetchAll(PDO::FETCH_ASSOC);
        $count_user_online = $stmt->rowCount();

        echo "<b>Users Online : </b> $count_user_online ";

        // after 5 minutes, session will be deleted
        $sql4 = "DELETE FROM online_users WHERE time<$time_check";
        $stmt = $db->prepare($sql4);
        $stmt->execute();


    }
    
}

