<?php

class Connection
{

public static function make($connect)
{
		try {
// return  $connect['host'] . '; dbname=' . $connect['db_name'].','.
//           $connect['user'].','.
//           $connect['password'];
// 	return new PDO('mysql:host=localhost;dbname=mytodo', 'root', 'admin123');

	return new PDO(
          $connect['host'] . '; dbname=' . $connect['db_name'],
          $connect['user'],
          $connect['password'],
          $connect['option']
		);

		} catch (Exception $e) {
			die( $e->getMessage());
}
}

}