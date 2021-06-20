<?php

include "../model/model.php";

$database = new Database;

$user = $database->get_user_info($_POST['username']);
$query = "SELECT * FROM follow INNER JOIN user ON follow.id_user = user.id_user WHERE id_follower = $user[id_user]";

echo $database->number_follower($query);
echo "----";
var_dump($database->list_follower($query));

?>