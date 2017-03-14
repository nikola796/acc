<?php
/**
 * Created by PhpStorm.
 * User: Vladislav Andreev
 * Date: 10.3.2017 г.
 * Time: 14:10 ч.
 */

namespace App\Controllers;

use App\Core\App;

class DocumentsController
{


    public function getIndex()
    {

        $departments = App::get('database')->selectAll('departments');

        return view('documents', compact('departments'));

    }

    public function show($id)
    {

        $documents = App::get('database')->selectDirectories($id);

        return view('show', compact('documents'));

    }


}
