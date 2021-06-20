<?php
include '../model/model.php';
$database = new Database;
session_start();
if ($database->send_msg($_POST['id'], $_POST['content'], $_SESSION['id_user']) == true) {

}
else {
  return false;  
}
?>