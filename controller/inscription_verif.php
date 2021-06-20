<?php
include '../model/model.php';
$database = new Database;

if ($database->inscription_recup() == true) {

}
else {
    echo "error";
}
?>