<?php
include "../model/model.php";

session_start();
$user_name = $_SESSION['user_name'];

$bdd = new Database;

    $bdd->display_tweet($user_name);

?>