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
class DocumentsController
{


    public function getIndex()
    {

        $departments = App::get('database')->selectAllSpaces();

        return view('documents', compact('departments'));

    }

    public function getTestIndex()
    {

        $departments = App::get('database')->selectAll('departments'); //getParents();

        return view('documents_test', compact('departments'));

    }

    public function show($id)
    {

        $documents = App::get('database')->selectDirectories($id);

        return view('show', compact('documents'));

    }

    public function showTest($dep)
    {
//        if($_SERVER['REDIRECT_URL'] == '/intranet_test/Документи/Важно'){
//            echo "Важно";
//        } else {
//            echo 'Не е важно';
//        }


        //$dep_id = App::get('database')->getId('id', $dep, 'departments');
        $dep_id = App::get('database')->getId('category_id', $dep, NESTED_CATEGORIES);
        //die(var_dump($dep_id[0]->category_id));
        //$posts = App::get('database')->getPosts(array('department' => $dep_id[0]->id));
        $dep_folder_id = App::get('database')->getDepartmentFolderId($dep_id[0]->category_id);
        //dd($dep_folder_id);
        $posts = App::get('database')->getPosts(array('department' => $dep_id[0]->category_id, 'directory' => $dep_folder_id[0]->category_id));
        //dd($posts);

        $folders = App::get('database')->selectAllFolders($dep_id[0]->category_id);
        //dd($folders);
        // $files = App::get('database')->selectAllFiles($id);
        $files = App::get('database')->selectAllFiles(array('directory' => $dep_folder_id[0]->category_id, 'dep' => $dep_id[0]->category_id));
       // dd($files);
        // $documents = App::get('database')->selectDirectories($id);
        $current_folder = $dep;
        //return view('show', compact('folders', 'dep', 'posts'));
        return view('files', compact('folders', 'files', 'current_folder', 'posts'));

    }

    public function showTestFolders($dep)
    {

    }

    public function bb()
    {
        $posts = App::get('database')->getAllPosts();

        return view('bb', compact('posts'));
    }

    public function bb_store()
    {

        if (!empty($_POST['text'])) {

            $options = @parse_ini_file('core/BBCodeParser.ini');
            $parser = new HTML_BBCodeParser2($options);

            if ($_POST['save']) {
                App::get('database')->insertPost($_POST['text']);

                header('Location: bb_test');
                exit();
            }

            $posts = App::get('database')->getAllPosts();

            $review = $parser->qParse(htmlspecialchars($_POST['text']));

            return view('bb', compact('review', 'posts'));


        }

    }

    public function admin_store()
    {
        //die(var_dump($_POST));

        if (!empty($_POST['text'])) {

            $options = @parse_ini_file('core/BBCodeParser.ini');
            $parser = new HTML_BBCodeParser2($options);

            if ($_POST['save']) {
                App::get('database')->insertPost($_POST['text']);

                header('Location: bb_test');
                exit();
            }

            $posts = App::get('database')->getAllPosts();

            $review = $parser->qParse(htmlspecialchars($_POST['text']));

            return view('form', compact('review', 'posts'));


        }

    }

    public function previewPost()
    {
        $config = parse_ini_file('core/BBCodeParser2.ini', true);
        $options = $config['HTML_BBCodeParser2'];
        $parser = new HTML_BBCodeParser2($options);

        $review = $parser->qParse(htmlspecialchars($_POST['text']));
        echo $review;
    }

    /*** CREATE NEW FOLDER ***/
    public function createFolder()
    {
        if (isset($_POST['parent'])) {
            $department_id = Folder::getParentDepartment($_POST['parent']);
           // dd($department_id);
            return Folder::createFolder($department_id);
        }
    }

    public function admin_store2()
    {
        //echo '<pre>' . print_r($_POST, true) . '</pre>';die();
        if (isset($_POST['save']) && $_POST['save'] == 1) {
            //TODO METHOD FOR INSERT
            $response = array();

            /***************** CHECK IS USER CREATE POST **********************/
            if (!empty($_POST['text'])) {

                $folder_id = intval($_POST['folder']);
                $department_id = App::get('database')->getFolderDepartment($folder_id);
                //die(var_dump($department_id));
                $post_id = $this->savePost(array('text' => $_POST['text'], 'file' => intval($_FILES['userfile']), 'directory_id' => $folder_id, 'department_id' => $department_id));
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
        // echo '<pre>' . print_r($_POST, true) . '</pre>';die();
//        var_dump(intval($_FILES['userfile']));
//        die();


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

    public function getFolder($folder)
    {
        // echo $folder;
        $dir = 'public/folders/' . $folder;
        if (file_exists($dir)) {
//
            header('Location: public/folders/' . $folder);
            exit();
        } else {
            echo 'No Folder ' . $folder . ' on the server';
        }
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

            if(count($res['all_files']) > 0){
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

    public function delete_file()
    {
        if (isset($_POST['file_id'])) {
            $file_id = $_POST['file_id'];
        }
        $file = new File();

        echo $response = $file->deleteFile(array('id' => $file_id));
    }

    /**
     * SHOW TO USER THE POST WHICH HE TYPE BEFORE SUBMIT
     * @return PARSED TEXT
     */
//    private function viewPost()
//    {
//        $options = @parse_ini_file('core/BBCodeParser.ini');
//        $parser = new HTML_BBCodeParser2($options);
//
//        $review = $parser->qParse(htmlspecialchars($_POST['text']));
//
//        return $review;
//    }

    /**
     * INSERT USER`S POST INTO DB
     * @param $params
     * @return
     */
    private function savePost($params)
    {

        if (isset($_POST['save'])) {

            $id = App::get('database')->insertPost($params);

        }
        return $id;

    }

    /**
     * UPDATE POST FROM USER
     */
    private function updatePost()
    {
        //var_dump($_POST['removed_file_name'][0]);
        // list($f_name, $f_ext) = explode('.',$_POST['removed_file_name'][0]);
        // $_SESSION['tt'] = array($f_name, $f_ext);
        //$_SESSION['tt'] = implode(', ', $_POST['removed_file_name']);
        // echo '<pre>' . print_r($_POST, true) . '</pre>';die();
        $post = new Post();
        if (isset($_POST['file_id'])) {
            $existing_files = implode(', ', $_POST['file_id']);
        } else {
            $existing_files = 0;
        }

        if (isset($_POST['removed_file_id'])) {

            //$removed_files = implode(', ', $_POST['removed_file_id']);
            $removed_files =  $_POST['removed_file_id'];

        } else {
            $removed_files = 0;
        }

        if (isset($_POST['removed_file_name'])) {
            $removed_files_names = App::get('database')->getFileName($_POST['removed_file_id']);
            //$removed_files_names =  $_POST['removed_file_name'];
        } else {
            $removed_files_names = '';
        }

        //echo '<pre>' . print_r($removed_files_names, true) . '</pre>';die();
        // echo '<pre>' . print_r($removed_files, true) . '</pre>';die();
        return $post->updatePost(array('post_id' => $_POST['postId'], 'post' => $_POST['text'], 'folder' => $_POST['folder'], 'existing_file' => $existing_files, 'removed_files' => $removed_files, 'removed_files_name' => $removed_files_names));

    }

    public function showGet($filename)
    {
       echo $filename;
    }

}