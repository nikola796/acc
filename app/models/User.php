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

class User
{
    public static function getUser($id)
    {

        $conf = App::get('config');

        $db = Connection::make($conf['database']);

        $stmt = $db->prepare('SELECT * FROM users WHERE id=1');
        $stmt->execute();
        $user = $stmt->fetchAll(\PDO::FETCH_CLASS);

        return $user;
       // die(var_dump($user));
    }

}