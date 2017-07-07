<?php

namespace App\Controllers;

use App\Core\App;
use app\models\User;

class UsersController
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function index()
    {
        $users = App::get('database')->selectAll('users');

        return view('users', compact('users'));
    }

    public function store()
    {

        App::get('database')->insert('users',
            array('name' => $_POST['name']));

        return redirect('router/users');

    }

    public function show()
    {
       return view('admin/profile');
    }

    public function changePassword()
    {
        $res = $this->user->changePassword();
       if($res == 1){
           echo 'Успешно променихте паролата си!';
       } else {
           echo $res;
       }

    }

    public function new_password()
    {
        $data = array('id' => intval($_POST['user_id']), 'pass' => trim($_POST['pass']));
        $res = $this->user->new_password($data);
        if ($res == 1){
            echo 'Успешно променихте паролата си!';
        }
    }

}