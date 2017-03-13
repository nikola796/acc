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