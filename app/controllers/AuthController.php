<?php
/**
 * Created by PhpStorm.
 * User: Vladislav Andreev
 * Date: 24.4.2017 г.
 * Time: 16:50 ч.
 */

namespace app\controllers;


use App\Core\App;
use app\models\User;
use Connection;

class AuthController
{

    public function login()
    {
        $user = User::userLogin();
        if(count($user) == 1){
            session_start();
            $_SESSION['is_logged'] = true;
            $_SESSION['username'] = $user[0]->name;
            $_SESSION['user_id'] = $user[0]->id;
            $_SESSION['department'] = $user[0]->department;
            $_SESSION['section'] = $user[0]->section;
            //echo '<pre>' . print_r($_SESSION, true) . '</pre>';die();
            redirect('admin');
        }

        redirect(uri());

    }

    public function logout()
    {
        session_start();
        session_destroy();
        redirect(uri());
    }

}