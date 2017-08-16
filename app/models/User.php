<?php
/**
 * Created by PhpStorm.
 * User: Vladislav Andreev
 * Date: 3.4.2017 г.
 * Time: 11:48 ч.
 */

namespace app\models;


use App\Core\App;
use Connection;
use PDO;
use PDOException;

class User
{

    private $db;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $conf = App::get('config');

        $this->db = Connection::make($conf['database']);
    }


    /**
     * SELECT DATA FOR USER WITH ID FROM PARAMETER
     * @param   USER ID
     * @return ARRAY WIT USER DATA
     */
    public static function getUser($id)
    {

        $conf = App::get('config');

        $db = Connection::make($conf['database']);

        $stmt = $db->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute(array('id' => $id));
        $user = $stmt->fetchAll(PDO::FETCH_CLASS);

        return $user;
        // die(var_dump($user));
    }


    /**
     * Check is user registered. IF is register user we start session and redirect to admin page
     * return array with user data
     */
    public function userLogin()
    {

        $name_input = $_POST['username'];
        $user_password = $_POST['password'];

        $stmt = $this->db->prepare('SELECT * FROM users WHERE name=:name AND pass=:pass');
        $stmt->execute(array('name' => $name_input, 'pass' => static::saltPassword($user_password)));
        $user = $stmt->fetchAll(PDO::FETCH_CLASS);

        return $user;
    }

    /**
     * SELECT ALL USERS FROM DATABASE
     * @return ARRAY WIRH ALL USERS
     */
    public function getAllUsers()
    {
        $sql = 'SELECT * FROM users';
        if (!isset($_POST['param']) || $_POST['param'] !== 'all') {
            $sql .= ' WHERE active = 1';
        }
        //return $sql;
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_CLASS);

        return $users;
    }

    /**
     * GET ALL ACTIVE ROLES
     * @return array
     */
    public function getRoles()
    {

        $stmt = $this->db->prepare('SELECT id, role FROM roles WHERE active = 1');
        $stmt->execute();
        $roles = $stmt->fetchAll(PDO::FETCH_CLASS);

        return $roles;
    }

    /**
     * CREATE USER. DEPENDING OF HIS ROLE WE USE TRANSACTION OR NOT FOR USERS ACCESS
     * @param $user_data
     * @param $access
     * @return AFFECTED ROWS AFTER CREATING NEW USER
     */
    public function createUser($user_data, $access)
    {

        $user_data['pass'] = $this->saltPassword($user_data['pass']);

        if ($user_data['role'] > 1) {
            try {

                $this->db->beginTransaction();

                $stmt = $this->db->prepare('    INSERT INTO users (name, pass, email, user_added_when, department, role)
                                                    VALUES (:name, :pass, :email, NOW(), :department, :role)');
                $stmt->execute($user_data);
                $user_id = $this->db->lastInsertId();

                    $stmt = $this->db->prepare('INSERT INTO users_folders (user_id, folder_id) VALUES (?, ?)');
                    foreach ($access as $folder) {
                        $stmt->execute(array($user_id, $folder));
                    }



                $this->db->commit();

                return $stmt->rowCount();

            } catch (PDOException $e) {

                $this->db->rollBack();
                echo $e->getMessage();
            }
        }
        try {
            $stmt = $this->db->prepare('    INSERT INTO users (name, pass, email, user_added_when, department, role)
                                                    VALUES (:name, :pass, :email, NOW(), :department, :role)');
            $stmt->execute($user_data);

            return $stmt->rowCount();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    /**
     * EDIT USER
     * @param array $user_data
     * @param $access
     * @return int
     */
    public function editUser($user_data = array(), $access)
    {

        if ($user_data['role'] > 1) {
            try {
                $this->db->beginTransaction();

                $stmt = $this->db->prepare('UPDATE `users` SET name = :name, email = :email, role = :role, department = :department WHERE id = :id ');
                $stmt->execute($user_data);

                $stmt = $this->db->prepare('DELETE FROM users_folders WHERE user_id = :id');
                $stmt->execute(array('id' => $user_data['id']));

                $stmt = $this->db->prepare('INSERT INTO users_folders (user_id, folder_id) VALUES (?, ?)');
                foreach ($access as $folder) {
                    $stmt->execute(array($user_data['id'], $folder));
                }

                $this->db->commit();

                return $stmt->rowCount();
            } catch (PDOException $ex) {
                echo $ex->getMessage();
                $this->db->rollBack();
            }
        } else {
            try {
                $stmt = $this->db->prepare('UPDATE `users` SET name = :name, email = :email, role = :role, department = :department WHERE id = :id ');
                $stmt->execute($user_data);

                $stmt = $this->db->prepare('DELETE FROM users_folders WHERE user_id = :id');
                $stmt->execute(array('id' => $user_data['id']));

                return $stmt->rowCount();
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }

    /**
     * ACTIVATE AND DEACTIVATE USER
     * @param $data
     * @return int
     */
    public function deActivateUser($data)
    {
        $stmt = $this->db->prepare('UPDATE users SET active = :active WHERE id = :id');
        $stmt->execute($data);

        return $stmt->rowCount();
    }

    /**
     * SALT PASSWORD AND CRYPT
     * @param $pass
     * @return string
     */
    private function saltPassword($pass)
    {
        $salt = '$2a$07$usesomadasdsadsadsadasdasdasdsadesillystringfors';
        $digest = crypt($pass, $salt);

        return $digest;
    }

    /**
     * GET USERS ACCESS TO FOLDERS
     * @return array
     */
    public function getUsersRolesAccess()
    {

        $sql = 'SELECT u.id, u.name, u.email, d.name AS dep,d.id AS dep_id, r.role,r.id AS role_id, group_concat( f.name SEPARATOR ", "  ) AS access, group_concat(f.category_id) AS access_id
                FROM `users` AS u
                LEFT JOIN departments AS d ON ( u.department = d.id )
                LEFT JOIN roles AS r ON ( u.role = r.id )
                LEFT JOIN users_folders AS uf ON ( u.id = uf.user_id )
                LEFT JOIN ' . NESTED_CATEGORIES . ' AS f ON ( f.category_id = uf.folder_id )';

        if (!isset($_POST['param']) || $_POST['param'] !== 'all') {
            $sql .= ' WHERE u.active = 1 ';
        }

        $sql .= ' GROUP BY u.id';

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $users_roles_access = $stmt->fetchAll(PDO::FETCH_CLASS);

        return $users_roles_access;
    }

    /**
     * GET ALL USERS WITH AJAX
     */
    public function allUsersAjax()
    {
        $requestData = $_REQUEST;

        $columns = array(
// datatable column index  => database column name
            0 => 'name',
            1 => 'email',
            2 => 'department',
            3 => 'role',
            4 => 'access',
            5 => 'active'
        );

        // getting total number records without any search
        // $totalData = $users_count[0]['cnt'];
        // when there is no search parameter then total number rows = total number filtered rows.

        $sql = 'SELECT u.id, u.name, u.email, u.active, d.name AS dep,d.id AS dep_id, r.role,r.id AS role_id, group_concat( f.name SEPARATOR ", "  ) AS access, group_concat(f.category_id) AS access_id
                FROM `users` AS u
                LEFT JOIN departments AS d ON ( u.department = d.id )
                LEFT JOIN roles AS r ON ( u.role = r.id )
                LEFT JOIN users_folders AS uf ON ( u.id = uf.user_id )
                LEFT JOIN ' . NESTED_CATEGORIES . ' AS f ON ( f.category_id = uf.folder_id )';

        if (empty($requestData['columns'][3]['search']['value'])) {   //name
            $sql .= " WHERE u.active = 1 ";
            //echo $sql;
        }

        $sql .= ' GROUP BY u.id';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $totalData = $stmt->rowCount();
        if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
            $sql .= " HAVING u.name LIKE '%" . $requestData['search']['value'] . "%' ";
            $sql .= " OR u.email LIKE '%" . $requestData['search']['value'] . "%' ";
            $sql .= " OR d.name LIKE '%" . $requestData['search']['value'] . "%' ";
            $sql .= " OR r.role LIKE '%" . $requestData['search']['value'] . "%' ";
            $sql .= " OR access LIKE '%" . $requestData['search']['value'] . "%' ";
        }

//$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $totalFiltered = $stmt->rowCount(); // when there is a search parameter then we have to modify total number filtered rows as per search result.

        $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "  LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $data = array();

        foreach ($rows as $row) {

            $actions = '<div class="text-center">';

            if ($row['active'] == 1) {
                $actions .= '<button id="' . $row['id'] . '" class="btn btn-primary btn-xs user_id" title="Редактирай"><i class="glyphicon glyphicon-pencil"></i></button>&nbsp';
                $actions .= '<button id="' . $row['id'] . '" class="btn btn-danger btn-xs del_user" title="Премахни"><i class="glyphicon glyphicon-remove"></i></button>';
            } else {
                $actions .= '<button class="btn btn-success btn-xs activate_user" style="margin-left:5%" id="' . $row['id'] . '"><i class="glyphicon glyphicon-triangle-right"></i> Activate</button>';
            }
            $actions .= '</div >';

            $nestedData = array();

            $nestedData[] = $row["name"];
            $nestedData[] = $row["email"];
            $nestedData[] = $row["dep"] . '<input type="hidden" class="dep_id" name="dep_id" value="' . $row["dep_id"] . '" />';
            $nestedData[] = $row["role"] . '<input type="hidden" class="role_id" name="role_id" value="' . $row["role_id"] . '" />';
            if ($row["role_id"] == 1) {
                $nestedData[] = 'Всички папка';
            } else {
                $nestedData[] = $row["access"] . '<input type="hidden" class="access_id" name="access_id" value="' . $row["access_id"] . '" />';
            }

            if ($row['active'] == 1) {
                $nestedData[] = 'Активен';
            } else {
                $nestedData[] = 'Деактивиран';
            }
            $nestedData[] = $actions;

            $data[] = $nestedData;
        }

        $json_data = array(
            "draw" => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal" => intval($totalData),  // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data   // total data array
        );

        echo json_encode($json_data);  // send data as json format

    }

    /**
     * CHECK IS USER EXIST
     * @param $user_data
     * @return array
     */
    public function isUserExist($user_data)
    {

        $user_name = $user_data['name'];
        $user_email = $user_data['email'];
        try {
            $stmt = $this->db->prepare('SELECT * FROM users WHERE name = :name OR email = :email');
            $stmt->execute(array('name' => $user_name, 'email' => $user_email));
            $user_info = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $user_info;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }


    }

    /**
     * GET USER`S ACCESS
     * @param $user_id
     * @return array
     */
    public function getUserAccess($user_id)
    {
        $stmt = $this->db->prepare('SELECT folder_id FROM users_folders WHERE user_id = ?');
        $stmt->execute(array($user_id));
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    /**
     * CHENGE USER`S PASSWORD
     * @return int|string
     */
    public function changePassword()
    {
        $new_pass = trim($_POST['new_pass']);
        $old_pass = trim($_POST['old_pass']);
        if (strlen($new_pass) > 3 and strlen($old_pass) > 3) {
            $stmt = $this->db->prepare('SELECT count(*) AS cnt FROM users WHERE pass = :pass AND id = :id');
            $stmt->execute(array('pass' => $this->saltPassword($old_pass), 'id' => $_SESSION['user_id']));

            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($res[0]['cnt'] == 1) {
                $stmt = $this->db->prepare('UPDATE users SET pass = :pass WHERE id = :id');
                $stmt->execute(array('pass' => $this->saltPassword($new_pass), 'id' => $_SESSION['user_id']));
                return $stmt->rowCount();
            }
        } else {
            return 'Подадени са некоректни данни за смяна на парола!';
        }
    }


    /**
     * GET USER ID AND MAIL FOR STORE IN DB WHEN PROCESS RECOVER PASSWORD
     * @param $password
     * @return array
     */
    public function check_password($password)
    {
        $stmt = $this->db->prepare('SELECT id, email, name  FROM users WHERE email = :email');
        $stmt->execute($password);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * SAVE PASSWORD RESET REQUEST IN DATABASE
     * @param $tokenHashForDatabase
     * @param $userId
     * @param $userEmail
     * @return int
     */
    public function savePasswordResetToDatabase($tokenHashForDatabase, $userId, $userEmail)
    {
        try {
            $stmt = $this->db->prepare('INSERT INTO password_resets (user_id, email, token) VALUES (:userId, :userEmail, :token)');
            $stmt->execute(array('userId' => $userId, 'userEmail' => $userEmail, 'token' => $tokenHashForDatabase));
            return $stmt->rowCount();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * GET RESET PASSWORD DATA TO CHECK IS REQUEST CORRECT.
     * @param $tokenHashFromLink
     * @param $userId
     * @param $creationDate
     * @return bool
     */
    public function loadPasswordResetFromDatabase($tokenHashFromLink, &$userId, &$creationDate)
    {
        try {
            $stmt = $this->db->prepare('SELECT * FROM password_resets WHERE token = ? AND used = 0');
            $stmt->execute(array($tokenHashFromLink));
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (count($res) == 1) {
                $userId = $res[0]['user_id'];
                $creationDate = $res[0]['created_at'];
                return true;
            }

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * WHEN ALL CHECKS ARE PASSED WE UPDATE RESET PASSWORD REQUEST TO USED.
     * @param $userId
     * @return int
     */
    public function letUserChangePassword($userId)
    {
        try {
            $stmt = $this->db->prepare('UPDATE password_resets SET used = 1 WHERE user_id = ?');
            $stmt->execute(array($userId));
            return $stmt->rowCount();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }

    /**
     *  USER CHANGE HIS PASSWORD
     * @param $data
     * @return int
     */
    public function new_password($data)
    {
        $data['pass'] = $this->saltPassword($data['pass']);
        $stmt = $this->db->prepare('UPDATE users SET pass = :pass WHERE id = :id');
        $stmt->execute($data);
        return $stmt->rowCount();
    }

    /**
     * CHECK IF IN SELECTED FOLDER HAS SUBFOLDER FOR SOME OF SELECTED
     * @param $access
     * @return array
     */
    public function checkFoldersReations($access)
    {
        $sql = 'SELECT node.category_id
                FROM nested_categories AS node,
                nested_categories AS parent
                WHERE node.lft BETWEEN parent.lft AND parent.rgt
                AND parent.category_id = :id
                ORDER BY node.lft';
        foreach ($access as $folder){
            $stmt = $this->db->prepare($sql);
            $stmt->execute(array('id' => $folder));
            $res[] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        foreach($res as $k => $v){
            foreach ($v as $kk => $vv){
                $re[] = $vv['category_id'];
            }
        }
        $cnt = array_count_values($re);
        $key = array_keys($cnt, 2);
        $acc = array_diff($access, $key);

        return $acc;
    }

}