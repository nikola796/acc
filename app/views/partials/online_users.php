<?php

use App\Core\App;

session_start();
$session    = session_id();
$time       = time();
$time_check = $time-300;     //We Have Set Time 5 Minutes

$conf = App::get('config');

$db = Connection::make($conf['database']);

$stmt = $db->prepare("SELECT * FROM online_users WHERE session='$session'");
$stmt->execute();
$stmt->fetchAll(PDO::FETCH_ASSOC);
$count = $stmt->rowCount();

//If count is 0 , then enter the values
if($count == 0){
    $sql1    = "INSERT INTO online_users(session, time)VALUES('$session', '$time')";
    $stmt = $db->prepare($sql1);
    $stmt->execute();
}
// else update the values
else {
    $sql2    = "UPDATE online_users SET time='$time' WHERE session = '$session'";
    $stmt = $db->prepare($sql2);
    $stmt->execute();
}

$sql3 = "SELECT * FROM online_users";
$stmt = $db->prepare($sql3);
$stmt->execute();
$stmt->fetchAll(PDO::FETCH_ASSOC);
$count_user_online = $stmt->rowCount();

echo "<div><p class='text-center' style='font-size: .8em;color:green;margin:0 auto'><b>Потребители на линия: </b> $count_user_online </p></div>";

// after 5 minutes, session will be deleted
$sql4    = "DELETE FROM online_users WHERE time<$time_check";
$stmt = $db->prepare($sql4);
$stmt->execute();