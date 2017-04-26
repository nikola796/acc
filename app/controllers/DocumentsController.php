<?php
/**
 * Created by PhpStorm.
 * User: Vladislav Andreev
 * Date: 10.3.2017 г.
 * Time: 14:10 ч.
 */

namespace App\Controllers;

use App\Core\App;

use app\models\Folder;
use app\models\User;
use Connection;
use Exception;
use HTML_BBCodeParser2;

class DocumentsController
{


    public function getIndex()
    {

        $departments = App::get('database')->selectAll('departments');

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


        $dep_id = App::get('database')->getId('id', $dep, 'departments');


        //$posts = App::get('database')->getPosts(array('department' => $dep_id[0]->id));
        $posts = App::get('database')->getPosts(array('department' => $dep_id[0]->id));
        //dd($posts);

        $folders = App::get('database')->selectAllFolders($dep_id[0]->id);

       // $files = App::get('database')->selectAllFiles($id);
        $files = App::get('database')->selectAllFiles(0);

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
            return Folder::createFolder();
        }
    }

    public function admin_store2()
    {

        $response = array();

        /***************** CHECK IS USER CREATE POST **********************/
        if (!empty($_POST['text'])) {

            $post_id = $this->savePost();
            $response['new_post'] = $post_id;

        }

        /*** UPLOAD FILE ***/
        if (isset($_FILES['userfile'])) {

            $response['new_file'] = $this->fileUpload($post_id);

        }
        foreach ($response as $res) {
          //  echo $res;
        }
        redirect('admin2');

    }

    /**
     * GET DATA FOR USER AND HIS PERMISSION TO FOLDERS
     * @return VIEW FOR ADMIN PAGE
     */
    public function admin2()
    {

        $user = User::getUser(1);

        $folders = App::get('database')->getUsersFolders($user[0]->section);


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
     * @internal param $files
     */
    private function fileUpload($post_id = null)
    {


        if ($_FILES['userfile']['error'][0] === 0) {
            $files = $_FILES['userfile'];
            $files['label'] = $_POST['label'];
            $files['folder'] = $_POST['folder'];

            foreach ($files as $k => $f) {

                if (is_array($f)) {
                    foreach ($f as $kk => $v) {
                        //echo '<pre>' . print_r($k .'=>'. $v, true) . '</pre>';die();
                        $narr[$kk][$k] = $v;
                        $narr[$kk]['folder'] = $files['folder'];
                        $narr[$kk]['post_id'] = $post_id;

                    }
                }


            }
            // echo '<pre>' . print_r($narr, true) . '</pre>';die();
            App::get('database')->saveFile($narr);

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
                $output = array('success' => 'Successfully uploaded file ');
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

// return a json encoded response for plugin to process successfully
            return json_encode($output);

        } else {
            echo '<pre>' . print_r($_FILES['userfile']['error'], true) . '</pre>';
        }

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
     */
    private function savePost()
    {

        if (isset($_POST['save'])) {

            $id = App::get('database')->insertPost($_POST['text'], $_POST['folder'], intval($_FILES['userfile']));

        }
        return $id;

    }

}