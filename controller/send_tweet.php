<?php

include "../model/model.php";


$tweet_content = $_POST['tweet_content'];
$media = $_POST['media'];

session_start();
$id_user = $_SESSION['id_user'];


$bdd = new Database;

    $bdd->send_tweet($tweet_content, $media, $id_user);

?>