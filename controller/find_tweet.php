<?php

include "../model/model.php";


$id_tweet = $_POST['id_tweet'];

$bdd = new Database;

    $bdd->find_tweet($id_tweet);
    $bdd->count_replied($id_tweet);

?>