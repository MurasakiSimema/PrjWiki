<?php 
require 'MySQL.php';

if($_POST["password"] == $_POST["confirm"])
    InsertAdmin($_POST["utente"], $_POST["password"]);
else{
    echo 'Le due password non coincidono';
    echo '<br><a href="../ADMIN/CreaAdmin.php">Back</a>';
}
?>