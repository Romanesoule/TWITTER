<?php

include '../model/model.php';

$database = new Database;

session_start();

$user = $_SESSION['user_name'];

$user_to_follow = $_POST['username_follow'];

$database->follow_user($user, $user_to_follow);

echo $user;
?>