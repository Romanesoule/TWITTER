<?php
include '../model/model.php';
$database = new Database;

if ($database->getIdForMsgIndex() == true) {
    $arrayId = explode("&", $_SESSION['id_receiver']);
    $arrayPseudo = explode("&", $_SESSION['user_name']);
    
    array_pop($arrayId);
    array_pop($arrayPseudo);
    $i = 0;
    foreach ($arrayId as $key => $value) {
            echo '<a href="http://localhost:8000/view/messagerie.php?id=' . $value . '"><div class="receiver" id="' . $value . '">' . $arrayPseudo[$i] . '</div></a>';
            $i++;       
    }
}
else {
    echo "error";
}

?>