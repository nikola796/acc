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
//TODO GET USER_ID ADN DEPARTMENT FROM SESSION AND PUT IN SQL QUERY ABOVE
        $conf = App::get('config');
//die(var_dump($_POST['parent']));
        $db = Connection::make($conf['database']);

        $db->beginTransaction();

        if ($_POST['parent'] == 0) {

            try {
                $stmt = $db->prepare('SELECT max(rgt) as rgt FROM mynested_category');
                $stmt->execute();
                $res = $stmt->fetchAll(PDO::FETCH_CLASS);
                $sql = 'INSERT INTO mynested_category (parent_id, name, lft, rgt, dep) VALUES(?,?, ?, ?, 1)';
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
                $stmt = $db->query("LOCK TABLE mynested_category WRITE");
                $stmt = $db->query("SELECT @myRight := rgt FROM mynested_category WHERE parent_id = {$_POST['parent']}");
                $stmt = $db->query("UPDATE mynested_category SET rgt = rgt + 2 WHERE rgt > @myRight");
                $stmt = $db->query("UPDATE mynested_category SET lft = lft + 2 WHERE lft > @myRight");
                $stmt = $db->prepare("INSERT INTO mynested_category(parent_id,name, lft, rgt,dep) VALUES(?, ?, @myRight + 1, @myRight + 2, 1)");
                $stmt->execute(array($_POST['parent'], $_POST['name']));
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