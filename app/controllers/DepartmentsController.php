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

    /**
     * DepartmentsController constructor.
     */
    public function __construct()
    {
        $conf = App::get('config');

        $this->db = Connection::make($conf['database']);

        $this->department = new Department();
    }

    /**
     * ALL DEPARTMENTS
     * @return mixed
     */
    public function index()
    {
        return view('admin/departments');
    }

    /**
     * GET ALL DEPARTMENTS WITH AJAX
     */
    public function index_ajax()
    {
        $this->department->getDepartmentAjax();
    }

    /**
     * STORE NEW DEPARTMENT
     */
    public function store()
    {
        $new_department_id = $this->department->newDepartment();
        $res = Folder::createFolder($new_department_id);
        echo $res;
    }

    /**
     * UPDATE DEPARTMENT
     */
    public function update()
    {
        $res = $this->department->editDepartment();
        if ($res['dep'] == 1 && $res['cat'] == 1) {
            echo 'success';
        }
    }

    /**
     * DELETE DEPARTMENT
     * @param $id
     */
    public function delete($id)
    {
        $res = $this->department->de_activateDepartment(array('id' => $id, 'active' => $_POST['active']));
        if ($res['dep'] == 1 && $res['cat'] >= 1) {
            $msg = 'Успешно ';
            if ($_POST['active'] == 0) {
                $msg .= 'де';
            }
            $msg .= 'активирахте звеното!';
            echo $msg;
        } else {
            echo 'Неуспех!';
        }
    }
}