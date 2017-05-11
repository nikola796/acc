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

        $posts = App::get('database')->getPosts(array('department' => $folders[0]->dep, 'directory' => $id));

        $files = App::get('database')->selectAllFiles(array( 'dep' => $folders[0]->dep, 'directory' => $id));
//die( '<pre>' . print_r($files, true) . '</pre>');
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

}