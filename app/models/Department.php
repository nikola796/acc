<?php
/**
 * Created by PhpStorm.
 * User: Vladislav Andreev
 * Date: 09.06.2017
 * Time: 09:15 ч.
 */

namespace app\models;


use App\Core\App;
use Connection;
use PDO;

class Department
{

    private $db;

    public function __construct()
    {
        $conf = App::get('config');

        $this->db = Connection::make($conf['database']);
    }

    public function getAllDeparments()
    {
        $stmt = $this->db->prepare('SELECT d.name, d.added_when, d.modified, u.name as user FROM departments as d LEFT JOIN users as u ON(d.added_by=u.id)');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);

    }

    public function getDepartmentAjax()
    {


        $requestData = $_REQUEST;


        $columns = array(
// datatable column index  => database column name
            0 => 'name',
            1 => 'user',
            2 => 'added_when',
            3 => 'modified',
            4 => 'active',
        );

        // getting total number records without any search
        // $totalData = $users_count[0]['cnt'];
        // when there is no search parameter then total number rows = total number filtered rows.

        $sql = 'SELECT d.id, d.name, d.added_when, d.modified, u.name as user, d.active FROM departments as d LEFT JOIN users as u ON(d.added_by=u.id)';

        if (empty($requestData['columns'][3]['search']['value'])) {   //name
            $sql .= " WHERE d.active = 1 ";
            //echo $sql;die();
        }
//echo $sql;die();
        // $sql .= ' GROUP BY u.id';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $totalData = $stmt->rowCount();
        if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
            $sql .= " HAVING d.name LIKE '%" . $requestData['search']['value'] . "%' ";
            $sql .= " OR u.name LIKE '%" . $requestData['search']['value'] . "%' ";
            $sql .= " OR d.added_when LIKE '%" . $requestData['search']['value'] . "%' ";
            $sql .= " OR d.modified LIKE '%" . $requestData['search']['value'] . "%' ";
            $sql .= " OR d.active LIKE '%" . $requestData['search']['value'] . "%' ";

        }
//echo $sql;die();
//$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $totalFiltered = $stmt->rowCount(); // when there is a search parameter then we have to modify total number filtered rows as per search result.

        $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "  LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $data = array();
        //echo '<pre>' . print_r($rows, true) . '</pre>';die();
        foreach ($rows as $row) {

            $actions = '<div class="text-center">';

            if ($row['active'] == 1) {

                $actions .= '<button id="' . $row['id'] . '" class="btn btn-primary btn-xs department_id" title="Редактирай"><i class="glyphicon glyphicon-pencil"></i></button>&nbsp';
                $actions .= '<button id="' . $row['id'] . '" class="btn btn-danger btn-xs del_department" title="Премахни"><i class="glyphicon glyphicon-remove"></i></button>';
            } else {
                $actions .= '<button class="btn btn-success btn-xs activate_user" style="margin-left:5%" id="' . $row['id'] . '"><i class="glyphicon glyphicon-triangle-right"></i> Activate</button>';
            }
            $actions .= '</div >';

            $nestedData = array();

            $nestedData[] = $row["name"];
            $nestedData[] = $row["user"];
            $nestedData[] = date('Y-m-d H:i:s', $row["added_when"]);
            $nestedData[] = $row["modified"];
            if ($row['active'] == 1) {
                $nestedData[] = 'Активен';
            } else {
                $nestedData[] = 'Деактивиран';
            }
            $nestedData[] = $actions;

            $data[] = $nestedData;
        }


        // echo '<pre>' . print_r($totalData, true) . '</pre>';;
        $json_data = array(
            "draw" => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal" => intval($totalData),  // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data   // total data array
        );

        echo json_encode($json_data);  // send data as json format
    }

    public function newDepartment()
    {
        $dep_name = $_POST['name'];
        //$sql = 'INSERT INTO departments (name, added_by, added_when) VALUES (:dep_name, ' .$_SESSION['user_id'] . ', ' . time() . ')';
        // echo $sql;die();
        $stmt = $this->db->prepare('INSERT INTO departments (name, added_by, added_when) VALUES (:dep_name, ' . $_SESSION['user_id'] . ', ' . time() . ')');
        $stmt->execute(array('dep_name' => $dep_name));
        return $this->db->lastInsertId();

    }

    public function editDepartment()
    {
        $data = array('id' => $_POST['id'], 'name' => $_POST['name'], 'user_id' => $_SESSION['user_id']);

        $stmt = $this->db->prepare('UPDATE departments SET name = :name, modified_from = :user_id WHERE id = :id');
        $stmt->execute($data);
        $updatedDepCount = $stmt->rowCount();

        $stmt = $this->db->prepare('UPDATE nested_categorys SET name = :name WHERE dep = :dep AND parent_id = 0');
        $stmt->execute(array('name' => $data['name'], 'dep' => $data['id']));
        $updateCatCount = $stmt->rowCount();

        return array('dep' => $updatedDepCount, 'cat' => $updateCatCount);

    }

    public function de_activateDepartment($data = array())
    {
        $stmt = $this->db->prepare('UPDATE  departments SET active = :active WHERE id = :id');
        $stmt->execute($data);
        $de_activate_departments = $stmt->rowCount();

        $stmt = $this->db->prepare('UPDATE  nested_categorys SET active = :active WHERE dep = :id');
        $stmt->execute($data);
        $de_activate_nested_categories = $stmt->rowCount();

        return array('dep' => $de_activate_departments, 'cat' => $de_activate_nested_categories);

    }


}