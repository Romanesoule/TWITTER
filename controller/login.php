<?php

include '../model/model.php';

$database = new Database;

$password = $_POST["password"];
$salt = 'vive le projet tweet_academy';

$password = hash_hmac('ripemd160', $password, $salt);

if ($database->to_connect($_POST['user'], $password) == true) {
    session_start();
    echo "Success";
} else {
    //echo $password;
}
?>