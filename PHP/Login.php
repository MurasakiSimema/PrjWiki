<?php
require 'MySQL.php';


$utente = $_POST["utente"];
$password = $_POST["password"];




$result=FindAdmin($utente, $password);


if($result!=0){
    session_start();
    $_SESSION['utente'] = $utente;
    $_SESSION['password'] = $password;
    header("Location: ../Home");
}
else {
    echo "Identificazione non riuscita: nome utente o password errati <br />";
    echo "Torna a pagina di <a href=\"login.htm\">login</a>";
}
?>
