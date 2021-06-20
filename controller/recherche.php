<?php

include "../model/model.php";
$bdd = new Database;

    $bdd->search_user();
    $bdd->search_hashtag();

?>