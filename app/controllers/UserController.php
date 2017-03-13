<?php

use App\Core\App;

/**
 * Created by PhpStorm.
 * User: Vladislav Andreev
 * Date: 10.3.2017 г.
 * Time: 13:01 ч.
 */
class UserController
{

    public function getIndex()
    {
        $authors = App::get('database')->selectAll('authors');

        return view('api', compact('authors'));
    }

}