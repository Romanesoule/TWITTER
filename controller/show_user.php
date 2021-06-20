<?php

include "../model/model.php";

$recherche_user = $_POST['recherche_user'];
$bdd = new Database;

    $bdd->show_user($recherche_user);

?>