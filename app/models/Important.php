<?php
/**
 * Created by PhpStorm.
 * User: Vladislav Andreev
 * Date: 05.06.2017
 * Time: 11:17 ч.
 */

namespace app\models;

use App\Core\App;
use Connection;
use PDO;
use PDOException;

class Important
{

    private $db;

    public function __construct()
    {
        $conf = App::get('config');

        $this->db = Connection::make($conf['database']);
    }

    public function getAllDocuments()
    {
        $stmt = $this->db->prepare('SELECT i.id,i.name,i.label,i.added_by,i.added_when,u.name AS author FROM important AS i LEFT JOIN users AS u ON (i.added_by = u.id) WHERE i.active=1');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public function newDocument()
    {
        $data = array('name' => $_FILES['user_file']['name'], 'label' => $_POST['file_label'], 'author' => $_SESSION['user_id']);
        try {
            $stmt = $this->db->prepare('INSERT INTO important (name, label,added_by,added_when) VALUES (:name, :label, :author, ' . time() . ')');
            $stmt->execute($data);
            return $stmt->rowCount();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        echo '<pre>' . print_r($data, true) . '</pre>';
    }

}