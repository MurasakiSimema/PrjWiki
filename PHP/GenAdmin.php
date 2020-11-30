<?php 
require 'MySQL.php';

if($_POST["password"] == $_POST["confirm"]){
    if (!strpos($_POST["password"],"'") && !strpos($_POST["utente"],"'"))
        InsertAdmin($_POST["utente"], $_POST["password"]);
    else{
        echo 'Il carattere \' non può essere usato';
        echo '<br><a href="../ADMIN/CreaAdmin.php">Back</a>';
    }
}
else{
    echo 'Le due password non coincidono';
    echo '<br><a href="../ADMIN/CreaAdmin.php">Back</a>';
}
?>