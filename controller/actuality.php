<?php
include "../model/model.php";

session_start();
$id_user = $_SESSION['id_user'];

$bdd = new Database;

$bdd->display_actuality($id_user);

?>