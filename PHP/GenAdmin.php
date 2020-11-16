<?php 
require 'MySQL.php';

if($_POST["password"] == $_POST["confirm"])
    InsertAdmin($_POST["utente"], $_POST["password"]);
else{
    echo 'conferma password diverso';
    echo '<br><a href="../ADMIN/CreaAdmin.php">Back</a>';
}
?>