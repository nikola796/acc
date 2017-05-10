<?php

namespace app\controllers;


use App\Core\App;
use app\models\User;
use Connection;
session_start();
class AuthController
{

    public function login()
    {

        if(isset($_SESSION['username']) && $_SESSION['username'] == $_POST['username']){
            echo 'Logged';
           // redirect('admin/home');
        } else{
            $user = User::userLogin();
            //echo '<pre>' . print_r($user, true) . '</pre>';die();
            if (count($user) == 1) {
                if($user[0]->active == 1){
                    $_SESSION['is_logged'] = true;
                    $_SESSION['username'] = $user[0]->name;
                    $_SESSION['user_id'] = $user[0]->id;
                    $_SESSION['department'] = $user[0]->department;
                    $_SESSION['section'] = $user[0]->section;
                    // var_dump( $_SESSION['is_logged']);

                    echo 'Logged';
                } else{
                    echo 'Вашият профил е деактивиран. Моля обърнете се към супурвайзор на системата';
                }


            } else{
                echo 'Подадената от Вас комбинация потребител-парола не е открита';
            }
        }


        //redirect(uri());

    }

    public function logout()
    {

        session_destroy();
        redirect(uri());
    }

}