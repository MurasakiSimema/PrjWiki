<?php
require 'MySQL.php';


$utente = $_POST["utente"];
$pass = $_POST["password"];

if(!strpos($utente, "'") && !strpos($utente, "'"))
    $result = FindAdmin($utente, $pass);
else
    $result = "";



if($result!="" and password_verify($pass, $result)){
    session_start();
    $_SESSION['utente'] = $utente;
    $_SESSION['password'] = $pass;
    header("Location: ../Home");
}
else {
    echo "Identificazione non riuscita: nome utente o password errati <br />";
    echo "Torna a pagina di <a href=\"../ADMIN/login.php\">login</a>";
}
?>
