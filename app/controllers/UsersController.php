<?php

namespace App\Controllers;

use App\Core\App;
use app\models\User;

class UsersController
{
    private $user;

    /**
     * UsersController constructor.
     */
    public function __construct()
    {
        $this->user = new User();
    }

    /**
     * GET ALL USERS
     * @return mixed
     */
    public function index()
    {
        $users = App::get('database')->selectAll('users');

        return view('users', compact('users'));
    }

    /**
     * STORE NEW USER
     */
    public function store()
    {

        App::get('database')->insert('users',
            array('name' => $_POST['name']));

        return redirect('router/users');

    }

    /**
     * SHOW USERS PROFILE
     * @return mixed
     */
    public function show()
    {
        return view('admin/profile');
    }

    /**
     * CHANGE USERS PASSWORD
     */
    public function changePassword()
    {
        $res = $this->user->changePassword();
        if ($res == 1) {
            echo 'Успешно променихте паролата си!';
        } else {
            echo $res;
        }

    }

    /**
     * SET NEW PASSWORD FOR USER
     */
    public function new_password()
    {
        $data = array('id' => intval($_POST['user_id']), 'pass' => trim($_POST['pass']));
        $res = $this->user->new_password($data);
        if ($res == 1) {
            echo 'Успешно променихте паролата си!';
        }
    }

}