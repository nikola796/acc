<?php
/**
 * Created by PhpStorm.
 * User: Vladislav Andreev
 * Date: 13.4.2017 г.
 * Time: 13:31 ч.
 */

namespace app\models;

use App\Core\App;
use Connection;
use PDO;
use PDOException;


class Folder
{
    private $db = null;

    public function __construct()
    {
        $conf = App::get('config');
        $this->db = Connection::make($conf['database']);
    }

    public static function createFolder($data = array())
    {
        //die(var_dump($_POST));
//TODO GET USER_ID ADN DEPARTMENT FROM SESSION AND PUT IN SQL QUERY ABOVE
        $conf = App::get('config');
//die(var_dump($_POST['parent']));
        $db = Connection::make($conf['database']);

        $db->beginTransaction();

        if (intval($_POST['parent']) === 0) {

            try {
                $stmt = $db->prepare('SELECT max(rgt) AS rgt FROM ' . NESTED_CATEGORIES);
                $stmt->execute();
                $res = $stmt->fetchAll(PDO::FETCH_CLASS);
                $data['lft'] = $res[0]->rgt + 1;
                $data['rgt'] = $res[0]->rgt + 2;
                $sql = 'INSERT INTO ' . NESTED_CATEGORIES . ' (parent_id, name, lft, rgt, dep, added_when,added_from) VALUES(:parent_id,:folder_name, :lft, :rgt, :department, ' . time() . ', ' . $_SESSION["user_id"] . ')';
                //die(var_dump($sql));
                $stmt = $db->prepare($sql);

                $stmt->execute($data);
                $dep_id = $db->lastInsertId();

                $stmt = $db->prepare('UPDATE ' . NESTED_CATEGORIES . ' SET dep = ? WHERE category_id = ' . $dep_id);
                $stmt->execute(array($dep_id));

                $db->commit();

                return 'success';

            } catch (Exception $e) {
                //Print out the error message.
                return $e->getMessage();
                //Rollback the transaction.
                $db->rollBack();
            }
        } else {
            try {
                /**************************************** ADD NEW FOLDER IN SAME FOLDER AS PARENT **********************************************************************************/
                $db->query("LOCK TABLE NESTED_CATEGORIES WRITE");
                $db->query("SELECT @myRight := rgt, @myDep := dep FROM NESTED_CATEGORIES WHERE category_id = {$_POST['parent']}");
                $db->query("UPDATE NESTED_CATEGORIES SET rgt = rgt + 2 WHERE rgt >= @myRight");
                $db->query("UPDATE NESTED_CATEGORIES SET lft = lft + 2 WHERE lft >= @myRight");
                $stmt = $db->prepare('INSERT INTO ' . NESTED_CATEGORIES . ' (name, lft, rgt,dep,parent_id, added_when,added_from) VALUES(?, @myRight, @myRight + 1, @myDep, ?, ' . time() . ', ' . $_SESSION["user_id"] . ')');

//                $stmt = $db->query("LOCK TABLE nested_categorys WRITE");
//                $stmt = $db->query("SELECT @myLeft := lft, @myDep := dep FROM nested_categorys WHERE category_id = {$_POST['parent']}");
//                $stmt = $db->query("UPDATE nested_categorys SET rgt = rgt + 2 WHERE rgt >= @myLeft");
//                $stmt = $db->query("UPDATE nested_categorys SET lft = lft + 2 WHERE lft >= @myRight");
//                $stmt = $db->prepare("INSERT INTO nested_categorys(name, lft, rgt,dep) VALUES(?, @myLeft + 1, @myLeft + 2, @myDep)");
                $stmt->execute(array($_POST['name'], $_POST['parent']));
                $stmt = $db->query("UNLOCK TABLES");

                $db->commit();

                echo 'success';

            } catch (Exception $e) {
                //Print out the error message.
                echo $e->getMessage();
                //Rollback the transaction.
                $db->rollBack();
            }

        }

    }

    public static function getParentDepartment($parent_id)
    {
        $conf = App::get('config');

        $db = Connection::make($conf['database']);

        $stmt = $db->prepare(' SELECT dep FROM ' . NESTED_CATEGORIES . ' WHERE category_id = ?');
        $stmt->execute(array($parent_id));
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectFolders($table)
    {
        $sql = 'SELECT CONCAT( REPEAT( "* ", COUNT( parent.name ) -1) , nc.name) AS name, nc.category_id
                                              FROM ' . $table . ' AS nc, ' . $table . ' AS parent
                                              WHERE nc.lft
                                              BETWEEN parent.lft
                                              AND parent.rgt AND nc.active = 1';

        $sql = $this->userAccess($sql);
        // echo '<pre>' . print_r($_SESSION, true) . '</pre>';
        // die($_SESSION['role']);
        $sql .= ' GROUP BY nc.name ORDER BY nc.lft';
        // die($sql);
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public function getFoldersAjax()
    {
        $requestData = $_REQUEST;

        $columns = array(
// datatable column index  => database column name
            0 => 'name',
            1 => 'parent_dir',
            2 => 'department',
            3 => 'added_when',
            4 => 'added_by',
            5 => 'modified',
            6 => 'modified_by',
            7 => 'active'
        );

        // getting total number records without any search
        // $totalData = $users_count[0]['cnt'];
        // when there is no search parameter then total number rows = total number filtered rows.

        $sql = 'SELECT nc.category_id, nc.name,nc.parent_id, parent.name AS parent_dir, d.name AS department,nc.added_when,u.name AS added_by, nc.modified, u2.name AS modified_by, nc.active FROM ' . NESTED_CATEGORIES . ' AS nc
LEFT JOIN users AS u ON (nc.added_from = u.id)
LEFT JOIN users AS u2 ON (nc.modified_from = u2.id)
LEFT JOIN ' . NESTED_CATEGORIES . ' AS d ON (nc.dep = d.category_id)
LEFT JOIN ' . NESTED_CATEGORIES . ' AS parent ON (nc.parent_id= parent.category_id)';

        if (empty($requestData['columns'][3]['search']['value'])) {   //name
            $sql .= " WHERE nc.active = 1 ";
            //echo $sql;die();
        } else {
            $sql .= " WHERE 1=1 ";
        }

        $sql = $this->userAccess($sql);

//echo $sql;die();
        // $sql .= ' GROUP BY u.id';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $totalData = $stmt->rowCount();
        if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
            $sql .= " AND (nc.name LIKE '%" . $requestData['search']['value'] . "%' ";
            $sql .= " OR nc.added_when LIKE '%" . $requestData['search']['value'] . "%' ";
            $sql .= " OR u.name LIKE '%" . $requestData['search']['value'] . "%' ";
            $sql .= " OR nc.modified LIKE '%" . $requestData['search']['value'] . "%' ";
            $sql .= " OR u2.name LIKE '%" . $requestData['search']['value'] . "%' ";
            $sql .= " OR d.name LIKE '%" . $requestData['search']['value'] . "%' ";
            $sql .= " OR parent.name LIKE '%" . $requestData['search']['value'] . "%' )";

        }


//echo $sql;die();
//$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $totalFiltered = $stmt->rowCount(); // when there is a search parameter then we have to modify total number filtered rows as per search result.

        //dd($sql);

        $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "  LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $data = array();
        $cnt = 1;
        //echo '<pre>' . print_r($rows, true) . '</pre>';die();
        foreach ($rows as $row) {

            $actions = '<div class="text-center">';

            if ($row['active'] == 1) {

                $actions .= '<button id="' . $row['category_id'] . '" class="btn btn-primary btn-xs folder_id" title="Редактирай"><i class="glyphicon glyphicon-pencil"></i></button>&nbsp';
                $actions .= '<button id="' . $row['category_id'] . '" class="btn btn-danger btn-xs del_folder" title="Премахни"><i class="glyphicon glyphicon-remove"></i></button>';
            } else {
                $actions .= '<button class="btn btn-success btn-xs activate_folder" style="margin-left:5%" id="' . $row['category_id'] . '"><i class="glyphicon glyphicon-triangle-right"></i> Activate</button>';
            }
            $actions .= '</div >';

            $nestedData = array();

            $nestedData[] = $row["name"];
            $nestedData[] = $row["parent_dir"] . '<input type="hidden" name="parent_id" class="parent_id" value="' . $row['parent_id'] . '" />';
            $nestedData[] = $row["department"];
            $nestedData[] = date('Y-m-d H:i:s', $row["added_when"]);
            $nestedData[] = $row["added_by"];
            $nestedData[] = $row["modified"];
            $nestedData[] = $row["modified_by"];
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

    public function getAllFolders()
    {
        $this->db->prepare('SELECT category_id, name');
    }

    /**
     * CHANGE FOLDER NAME
     * @param $data
     * @return int
     */
    public function updateFolderName($data)
    {
        //echo '<pre>' . print_r($data, true) . '</pre>';die();
        $stmt = $this->db->prepare('UPDATE ' . NESTED_CATEGORIES . ' SET name = :name WHERE category_id = :cat_id');
        $stmt->execute(array('name' => $data['name'], 'cat_id' => $data['folder_id']));
        return $stmt->rowCount();
    }

    /**
     * UPDATE FOLDER PLACE
     * @param array $data
     * @return string
     */
    public function updateFolderPlace($data = array())
    {
        try {
            //   $this->db->beginTransaction();

            $sql = 'LOCK TABLE ' . NESTED_CATEGORIES . ' WRITE;

                SELECT 
                    @node_id := category_id, 
                    @node_pos_left := lft,
                    @node_pos_right := rgt
                    FROM ' . NESTED_CATEGORIES . '
                    WHERE category_id = ' . $data['folder_id'] . ';
                
                SELECT 
                    @parent_id := category_id,
                    @parent_pos_right := rgt,
                    @parent_dep := dep
                    FROM ' . NESTED_CATEGORIES . '
                    WHERE category_id = ' . $data['new_parent'] . ';
                    
                SELECT
                    @node_size := @node_pos_right - @node_pos_left + 1;
                    
                UPDATE `' . NESTED_CATEGORIES . '`
                SET `lft` = 0-(`lft`), `rgt` = 0-(`rgt`)
                WHERE `lft` >= @node_pos_left AND `rgt` <= @node_pos_right;
                
                UPDATE `' . NESTED_CATEGORIES . '`
                SET `lft` = `lft` - @node_size
                WHERE `lft` > @node_pos_right;
                UPDATE `' . NESTED_CATEGORIES . '`
                SET `rgt` = `rgt` - @node_size
                WHERE `rgt` > @node_pos_right;
                
                UPDATE `' . NESTED_CATEGORIES . '`
                SET `lft` = `lft` + @node_size
                WHERE `lft` >= IF(@parent_pos_right > @node_pos_right, @parent_pos_right - @node_size, @parent_pos_right);
                UPDATE `' . NESTED_CATEGORIES . '`
                SET `rgt` = `rgt` + @node_size
                WHERE `rgt` >= IF(@parent_pos_right > @node_pos_right, @parent_pos_right - @node_size, @parent_pos_right);
                
                UPDATE `' . NESTED_CATEGORIES . '`
                SET
                    `lft` = 0-(`lft`)+IF(@parent_pos_right > @node_pos_right, @parent_pos_right - @node_pos_right - 1, @parent_pos_right - @node_pos_right - 1 + @node_size),
                    `rgt` = 0-(`rgt`)+IF(@parent_pos_right > @node_pos_right, @parent_pos_right - @node_pos_right - 1, @parent_pos_right - @node_pos_right - 1 + @node_size),
                    `dep` =  @parent_dep, modified_from = ' . $_SESSION["user_id"] . '
                WHERE `lft` <= 0-@node_pos_left AND `rgt` >= 0-@node_pos_right;
                UPDATE `' . NESTED_CATEGORIES . '`
                SET `parent_id` = @parent_id
                WHERE `category_id` = @node_id;
                
               UNLOCK TABLES;';
//return $sql;
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            // $this->db->commit();
            return 'success';
        } catch (PDOException $ex) {
            //   $this->db->rollBack();
            echo $ex->getMessage();
        }
    }

    /**
     * HERE WE CHECK USER ACCESS TO FOLDERS IF USER IS NOT SUPERVISOR AND SHOW HIM ONLY THIS ONE WHICH HE HAVE A RIGHTS.
     * @param $sql
     * @return string
     */
    private function userAccess($sql)
    {
        if ($_SESSION['role'] > 1) {
            $user = new User();
            $user_access = $user->getUserAccess($_SESSION['user_id']);
            foreach ($user_access as $ua) {
                //echo $ua->folder_id;
                $stmt = $this->db->prepare('SELECT  `lft`,  `rgt` FROM nested_categories  WHERE category_id = ?');
                $stmt->execute(array( $ua->folder_id));
                $params[] = $stmt->fetchAll(PDO::FETCH_CLASS);
            }
            //echo '<pre>' . print_r($params, true) . '</pre>';
            //  echo count($params);
            $sql .= '  AND (';
            foreach ($params as $k => $param) {
                $sql .= ' nc.lft BETWEEN ' . $param[0]->lft . ' AND ' . $param[0]->rgt;
                // echo $k.'<br />';
                if (($k + 1) < count($params)) {
                    $sql .= ' OR ';
                }
            }
            $sql .= ' )';

        }
        return $sql;
    }

    /**
     * DELETE FOLDER AND SUBFOLDERS
     * @param $id
     * @return string
     */
    public function deleteFoldersAndSubFolder($id)
    {

        try {
            $this->db->beginTransaction();

            $this->db->query('LOCK TABLE ' . NESTED_CATEGORIES . ' WRITE;');

            $stmt = $this->db->prepare('SELECT lft, rgt, parent_id, @myWidth := rgt - lft + 1 FROM ' . NESTED_CATEGORIES . ' WHERE category_id = :id');
            $stmt->execute(array('id' => $id));
            $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $lft = $r[0]['lft'];
            $rgt = $r[0]['rgt'];

            $width = $r[0]['@myWidth := rgt - lft + 1'];

            if($this->db->exec('DELETE FROM ' . NESTED_CATEGORIES . ' WHERE lft BETWEEN '.$lft.' AND '.$rgt)){
                $this->db->exec('UPDATE  ' . NESTED_CATEGORIES . ' SET rgt = rgt - '.$width.' WHERE rgt > '.$rgt);

                $this->db->exec('UPDATE ' . NESTED_CATEGORIES . ' SET lft = lft - '.$width.' WHERE lft > '.$rgt);

                $this->db->exec('UNLOCK TABLES');

                $this->db->commit();

                return 'Успех';
            } else{
                $this->db->rollBack();
            }




//            $sql = 'LOCK TABLE ' . NESTED_CATEGORIES . ' WRITE;
//
//                    SELECT @myLeft := lft, @myRight := rgt, @myWidth := rgt - lft + 1
//                    FROM ' . NESTED_CATEGORIES . '
//                    WHERE category_id = '.$id.';
//
//                    DELETE FROM ' . NESTED_CATEGORIES . ' WHERE lft = @myLeft;
//
//                    UPDATE ' . NESTED_CATEGORIES . ' SET rgt = rgt - 1, lft = lft - 1 WHERE lft BETWEEN @myLeft AND @myRight;
//                    UPDATE ' . NESTED_CATEGORIES . ' SET rgt = rgt - 2 WHERE rgt > @myRight;
//                    UPDATE ' . NESTED_CATEGORIES . ' SET lft = lft - 2 WHERE lft > @myRight;
//
//                    UNLOCK TABLES;';

            //  $stmt = $this->db->prepare($sql);
            //  $stmt->execute();
            //  return 'Успех';
        } catch (PDOException $ex) {
            $this->db->rollBack();
            echo $ex->getMessage();
        }

//            $sql = 'LOCK TABLE ' . NESTED_CATEGORIES . ' WRITE;
//
//                SELECT @myLeft := lft, @myRight := rgt, @myWidth := rgt - lft + 1
//                FROM ' . NESTED_CATEGORIES . ' WHERE category_id = :id;
//
//                DELETE FROM ' . NESTED_CATEGORIES . ' WHERE lft BETWEEN @myLeft AND @myRight;
//
//                UPDATE ' . NESTED_CATEGORIES . ' SET rgt = rgt - @myWidth WHERE rgt > @myRight;
//                UPDATE ' . NESTED_CATEGORIES . ' SET lft = lft - @myWidth WHERE lft > @myRight;
//
//                UNLOCK TABLES;';
//
//             $stmt = $this->db->prepare($sql);
//             $stmt->execute(array(':id' => $id));
//            //$res = $stmt->fetchAll(PDO::FETCH_CLASS);
//
//            return 'Успех';

    }

    public function deleteOnlyFolder($id)
    {
        try {
            $this->db->beginTransaction();

            $this->db->query('LOCK TABLE ' . NESTED_CATEGORIES . ' WRITE;');

            $stmt = $this->db->prepare('SELECT lft, rgt, parent_id FROM ' . NESTED_CATEGORIES . ' WHERE category_id = :id');
            $stmt->execute(array('id' => $id));
            $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $lft = $r[0]['lft'];
            $rgt = $r[0]['rgt'];
            $parent = $r[0]['parent_id'];
            //$width = $r[0]['@myWidth := rgt - lft + 1'];

            $del_folders = $this->db->exec('DELETE FROM ' . NESTED_CATEGORIES . ' WHERE lft = '.$lft);

            if($del_folders > 0){

                $this->db->exec('UPDATE ' . NESTED_CATEGORIES . ' SET rgt = rgt - 1, lft = lft - 1, parent_id = '.$parent.' WHERE lft BETWEEN '.$lft.' AND '. $rgt);

                $this->db->exec('UPDATE ' . NESTED_CATEGORIES . ' SET rgt = rgt - 2 WHERE rgt > '.$rgt);

                $this->db->exec('UPDATE ' . NESTED_CATEGORIES . ' SET lft = lft - 2 WHERE lft > '.$rgt);

                $this->db->exec('UNLOCK TABLES');

                $this->db->commit();

                return 'Успех';
            } else {
                $this->db->rollBack();
            }


//            $sql = 'LOCK TABLE ' . NESTED_CATEGORIES . ' WRITE;
//
//                    SELECT @myLeft := lft, @myRight := rgt, @myWidth := rgt - lft + 1
//                    FROM ' . NESTED_CATEGORIES . '
//                    WHERE category_id = '.$id.';
//
//                    DELETE FROM ' . NESTED_CATEGORIES . ' WHERE lft = @myLeft;
//
//                    UPDATE ' . NESTED_CATEGORIES . ' SET rgt = rgt - 1, lft = lft - 1 WHERE lft BETWEEN @myLeft AND @myRight;
//                    UPDATE ' . NESTED_CATEGORIES . ' SET rgt = rgt - 2 WHERE rgt > @myRight;
//                    UPDATE ' . NESTED_CATEGORIES . ' SET lft = lft - 2 WHERE lft > @myRight;
//
//                    UNLOCK TABLES;';

          //  $stmt = $this->db->prepare($sql);
          //  $stmt->execute();
          //  return 'Успех';
        } catch (PDOException $ex) {
            $this->db->rollBack();
            echo $ex->getMessage();
        }

    }

}