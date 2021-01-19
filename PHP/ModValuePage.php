<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<?php 
require 'MySQL.php';

$text = $_POST["text"];
$text = str_replace('"','\"', $text);
$text = str_replace("\n", "<br>", $text);
$text = str_replace("|***", "</b>", str_replace("***|", "<b>", $text));
$text = str_replace("|**", "</mark>", str_replace("**|", "<mark>", $text));

$des = $_POST["desc"];
$des = str_replace('"','\"', $des);
$des = str_replace("|***", "</b>", str_replace("***|", "<b>", $des));
$des = str_replace("|**", "</mark>", str_replace("**|", "<mark>", $des));

$title = $_POST['title'];
$lingua = LinguaFromID($_POST["lingua"]);

$data=array($title, $des, $_POST["par"], $text, "../../IMG/Unit_ills_thum_" . $_POST["img"] . ".png", "../../IMG/Unit_ills_full_" . $_POST["img"] . ".png", $_POST["ID"]);   

if(ModificaPagina($_POST["ID"], $_POST["lingua"], $des, $_POST["img"],$_POST["par"], $text)){
    echo '<br><button class="btn btn-danger"><a href="../ADMIN/SelectPage.php">Back</a></button>';
    if(file_exists("/membri/hoilserveracasa/PrjWiki/CACHE/$lingua/$title.php"))
        unlink("/membri/hoilserveracasa/PrjWiki/CACHE/$lingua/$title.php");
}
?>