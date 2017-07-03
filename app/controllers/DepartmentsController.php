<?php
/**
 * Created by PhpStorm.
 * User: Vladislav Andreev
 * Date: 09.06.2017
 * Time: 09:14 ч.
 */

namespace app\controllers;


use App\Core\App;
use app\models\Department;
use app\models\Folder;
use Connection;

class DepartmentsController
{

    private $db;

    private $department;

    public function __construct()
    {
        $conf = App::get('config');

        $this->db = Connection::make($conf['database']);

        $this->department = new Department();
    }

    public function index()
    {
        // $departments = $this->department->getAllDeparments();
        return view('admin/departments');
    }

    public function index_ajax()
    {
        $this->department->getDepartmentAjax();
    }

    public function store()
    {
        $new_department_id = $this->department->newDepartment();
        $res = Folder::createFolder($new_department_id);
        echo $res;
    }

    public function update()
    {
        $res = $this->department->editDepartment();
        if ($res['dep'] == 1 && $res['cat'] == 1) {
            echo 'success';
        }
    }

    public function delete($id)
    {
        $res = $this->department->de_activateDepartment(array('id' => $id, 'active' => $_POST['active']));
        if ($res['dep'] == 1 && $res['cat'] >= 1) {
            $msg = 'Успешно ';
            if( $_POST['active'] == 0){
                $msg .= 'де';
            }
            $msg .= 'активирахте звеното!';
            echo $msg;
        } else {
            echo 'Неуспех!';
        }
    }


}