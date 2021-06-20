<?php
include '../model/model.php';
$database = new Database;

$pwd = $_POST['pwd'];
$salt = 'vive le projet tweet_academy';

$pwd = hash_hmac('ripemd160', $pwd, $salt);

if ($database->add_user_to_db($_POST['nickname'], $_POST['pseudo'], $_POST['date'], $_POST['location'], $_POST['mail'], $_POST['tel'], $pwd) == true) {
    if($database->getID($_POST['mail']) == true) {
        echo "true";
        return "true";
    }
    else {
        echo "false";    
    }   
}
else {
    echo "false";
}
?>