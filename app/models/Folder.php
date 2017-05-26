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


class Folder
{

    public static function createFolder()
    {
        //die(var_dump($_POST['parent']));
//TODO GET USER_ID ADN DEPARTMENT FROM SESSION AND PUT IN SQL QUERY ABOVE
        $conf = App::get('config');
//die(var_dump($_POST['parent']));
        $db = Connection::make($conf['database']);

        $db->beginTransaction();

        if ($_POST['parent'] == 0) {

            try {
                $stmt = $db->prepare('SELECT max(rgt) as rgt FROM nested_categorys');
                $stmt->execute();
                $res = $stmt->fetchAll(PDO::FETCH_CLASS);
                $sql = 'INSERT INTO nested_categorys (parent_id, name, lft, rgt, dep) VALUES(?,?, ?, ?, 4)';
                //die(var_dump($sql));
                $stmt = $db->prepare($sql);

                $stmt->execute(array($_POST['parent'], $_POST['name'], ($res[0]->rgt + 1), ($res[0]->rgt + 2)));
                $affected_rows = $stmt->rowCount();

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
                $stmt = $db->query("LOCK TABLE nested_categorys WRITE");
                $stmt = $db->query("SELECT @myRight := rgt, @myDep := dep FROM nested_categorys WHERE category_id = {$_POST['parent']}");
                $stmt = $db->query("UPDATE nested_categorys SET rgt = rgt + 2 WHERE rgt >= @myRight");
                $stmt = $db->query("UPDATE nested_categorys SET lft = lft + 2 WHERE lft >= @myRight");
                $stmt = $db->prepare("INSERT INTO nested_categorys(name, lft, rgt,dep,parent_id) VALUES(?, @myRight, @myRight + 1, @myDep, ?)");

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

}