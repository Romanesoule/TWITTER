<?php

include "../model/model.php";


$avatar = $_POST['avatar'];
$nick_name = $_POST['nick_name'];
$birthday = $_POST['birthday'];
$biography = $_POST['biography'];
$website = $_POST['website'];
$location = $_POST['location'];


session_start();
$user_name = $_SESSION['user_name'];

$bdd = new Database;

    $bdd->edit_profil($user_name, $avatar, $nick_name, $birthday, $biography, $website, $location );

?>