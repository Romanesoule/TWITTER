<?php

include '../model/model.php';

$database = new Database;

session_start();

$user = $_SESSION['user_name'];
$user_to_unfollow = $_POST['username_follow'];

$database->unfollowed($user, $user_to_unfollow)
?>