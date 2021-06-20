<?php

include "../model/model.php";

$recherche_hashtag = $_POST['recherche_hashtag'];
$bdd = new Database;

    $bdd->show_hashtag($recherche_hashtag);

?>