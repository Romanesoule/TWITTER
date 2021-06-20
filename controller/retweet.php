<?php

include "../model/model.php";

session_start();
$user_name = $_SESSION['user_name'];
$id_user = $_SESSION['id_user'];

$id_tweet = $_POST['id_tweet'];

$bdd = new Database;

    $bdd->count_retweet($id_tweet);
    $bdd->retweet($id_tweet, $user_name, $id_user);