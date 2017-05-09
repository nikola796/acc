<?php
/**
 * Created by PhpStorm.
 * User: Vladislav Andreev
 * Date: 26.4.2017 г.
 * Time: 09:58 ч.
 */

namespace app\controllers;


use App\Core\App;
use app\models\User;

class AdminsController
{

    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function index()
    {

        $folders = App::get('database')->getUsersFolders($_SESSION['department']);
        return view('admin/admin3', compact('user', 'folders'));

    }

    public function users()
    {
         $users = $this->user->getAllUsers();
        //echo $users;die();
         $roles = $this->user->getRoles();

        $departments = App::get('database')->selectAll('departments');

        $folders = App::get('database')->selectFolders('mynested_category');

        $users_roles_access = $this->user->getUsersRolesAccess();

        if(isset($_POST['param'])){
            header('Content-Type: application/json');
            $data = $data = array('users_roles_access' => $users_roles_access);
            echo json_encode($data);
        } else{
            return view('admin/users', compact('users', 'roles', 'departments', 'folders', 'users_roles_access'));
        }

        //var_dump($users);
    }

    public function posts()
    {
        return view('admin/posts');
    }

    public function createUser()
    {
        $user_data = $_POST;
    $user_info = $this->user->isUserExist($user_data);
        if(count($user_info) === 0){
            if($user_data['action'] == 'add') {
                $access = $user_data['access'];
                unset($user_data['action'],$user_data['id'],$user_data['access']);
                $result = $this->user->createUser($user_data, $access);
                echo ($result == 1 ? 'Успешно създадохте нов потребител' : '');
            }
            elseif ($user_data['action'] == 'edit'){
                $access = $user_data['access'];
                unset($user_data['pass'], $user_data['action'],$user_data['access']);
                $result = $this->user->editUser($user_data, $access);
                echo ($result == 1 ? 'Успешно редактирахте потребителя' : '');
            }
        } else if(count($user_info) === 1){
           echo ($user_info[0]['active'] == 0 ? 'Вече съществува деактивиран потребител с това потребителско име или с този мейл. Използвайте други данни, за да създадете нов потребител или активирайте този потребител от меню Потребители' : 'Вече съществува потребител с това потребителско име или с този мейл');
        } else{
            echo 'Съществуват повече от едни записа с това потребителско име или с този мейл';
        }


        
    }

    public function deActivateUser($id)
    {
        $data = array('id' => intval($id), 'active' => intval($_POST['active']));
        $row_count = $this->user->deActivateUser($data);
        echo ($row_count == 1 ? 'Успешно '. (intval($_POST['active']) === 0 ? 'де' : '' ).'активирахте потребителя!' : '');
    }

    public function table()
    {
       return view('admin/table');
    }

    public function test_table()
    {
        $this->user->allUsersAjax();

    }

    public function tableGet(){

        echo '{ "data": [
    [
      "Tiger Nixon",
      "System Architect",
      "Edinburgh",
      "5421",
      "2011/04/25",
      "$320,800"
    ],
    [
      "Garrett Winters",
      "Accountant",
      "Tokyo",
      "8422",
      "2011/07/25",
      "$170,750"
    ],
    [
      "Ashton Cox",
      "Junior Technical Author",
      "San Francisco",
      "1562",
      "2009/01/12",
      "$86,000"
    ]]}';

    }

}