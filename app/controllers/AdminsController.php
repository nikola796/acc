<?php
/**
 * Created by PhpStorm.
 * User: Vladislav Andreev
 * Date: 26.4.2017 г.
 * Time: 09:58 ч.
 */

namespace app\controllers;


use App\Core\App;

class AdminsController
{

    public function index()
    {

        $folders = App::get('database')->getUsersFolders($_SESSION['department']);
        return view('admin3', compact('user', 'folders'));

    }

}