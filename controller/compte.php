<?php

include '../model/model.php';

$database = new Database;
session_start();

$user = $_SESSION['user_name'];

$userInfo = $database->get_user_info($user);

for ($i=0; $i < count($userInfo) / 2; $i++) { 
    echo $userInfo[$i];
    echo "----";
}

?>