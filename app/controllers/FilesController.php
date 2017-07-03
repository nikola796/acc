<?php
/**
 * Created by PhpStorm.
 * User: Vladislav Andreev
 * Date: 10.3.2017 г.
 * Time: 17:07 ч.
 */

namespace App\Controllers;


use App\Core\App;

class FilesController
{

    public function index($id)
    {
        $files = App::get('database')->selectFiles('files', $id);

        return view('files', compact('files'));

    }

    public function indexTest($current_folder,$id)
    {
        $folders = App::get('database')->selectSubFolders($id);

        if(empty($folders)){
            $folders = App::get('database')->getDepartment($id);

        }
//var_dump($folders[0]->dep);
//echo '<pre>' . print_r($folders, true) . '</pre>';die();
        $posts = App::get('database')->getPosts(array('department' => $folders[0]->dep, 'directory' => $id));

        $files = App::get('database')->selectAllFiles(array( 'dep' => $folders[0]->dep, 'directory' => $id));
//die( '<pre>' . print_r($posts, true) . '</pre>');
        return view('files', compact('folders', 'files', 'current_folder', 'posts'));

    }


    public function show($id)
    {
        $files = App::get('database')->selectFiles('files', $id);

        return view('files', compact('files'));

    }

    public function important()
    {

        $important_documents = App::get('database')->selectAll('important');

        return view('important', compact('important_documents'));

    }

    public function downloadFile($stored_name, $real_name)
    {
        $file = realpath('core\files') .DIRECTORY_SEPARATOR . $stored_name;
        $filesize = filesize($file);
        header('Content-Description: File Transfer');
        header("Content-type: application/forcedownload");
        header("Content-disposition: attachment; filename=\"$real_name\"");
        header("Content-Transfer-Encoding: Binary");
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header("Content-length: ".$filesize);
        ob_clean();
        flush();
        readfile("$file");
        exit;
    }



}