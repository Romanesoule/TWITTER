<?php

include "../model/model.php";

$user_info = $_POST['user'];

$database = new Database;

$user = $database->find_user($user_info);

echo $user;

?>