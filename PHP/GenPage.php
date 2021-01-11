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

$filename = $_POST["title"] . '.php';
$lingua = LinguaFromID((int)$_POST["lingua"]);
$dir = '/PrjWiki/CACHE/' . $lingua . '/' . $filename;

if($_POST["ID"]!=-1)
    InsertPage((int)$_POST["ID"], $_POST["title"], (int)$_POST["lingua"], '/PrjWiki/BraveFrontierWiki/' . $_POST["title"] . '/' . $lingua, $des, $dir, $_POST["img"], $_POST["par"], $text);
else 
    InsertPage(LastID(), $_POST["title"], (int)$_POST["lingua"], '/PrjWiki/BraveFrontierWiki/' . $_POST["title"] . '/' . $lingua, $des, $dir, $_POST["img"], $_POST["par"], $text);

?>