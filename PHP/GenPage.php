﻿<?php 
require 'MySQL.php';
class Template {
    const TEMPLATE_DIR = '/PrjWiki/PHP/';
    public static function parse($data = []) {
        $file = $_SERVER['DOCUMENT_ROOT'] . self::TEMPLATE_DIR . 'TemplatePage.php';
        $html = file_get_contents($file);
        $variables = ['{{title}}', '{{desc}}', '{{par}}', '{{text}}', '{{thum}}', '{{full}}', '{{ID}}'];
        $html_content = str_replace($variables, $data, $html);
        return $html_content;
    }
    public static function save($data = [], $filename = 'post.php', $lingua) {   
        $dir = '/PrjWiki/HTML/' . $lingua . '/' . $filename . '.php';
        if(InsertPage((int)$_POST["ID"], $_POST["title"], (int)$_POST["lingua"], '/PrjWiki/HTML/' . $lingua . '/' . $filename, $_POST["desc"], $dir)){
            $html = self::parse($data);
            if(!empty($html)) {
                file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/PrjWiki/HTML/' . $lingua . '/' . $filename, $html);
            }
        }
    }
}

$text = $_POST["text"];
$text = str_replace('"','\"', $text);
$text = str_replace("\n", "<br>", $text);
$text = str_replace("|***", "</b>", str_replace("***|", "<b>", $text));
$text = str_replace("|**", "</mark>", str_replace("**|", "<mark>", $text));

$des = $_POST["desc"];
$des = str_replace('"','\"', $des);
$des = str_replace("|***", "</b>", str_replace("***|", "<b>", $des));
$des = str_replace("|**", "</mark>", str_replace("**|", "<mark>", $des));

if($_POST["ID"]!=-1)
    $data=array($_POST["title"], $des, $_POST["par"], $text, "../../IMG/Unit_ills_thum_" . $_POST["img"] . ".png", "../../IMG/Unit_ills_full_" . $_POST["img"] . ".png", $_POST["ID"]);   
else 
    $data=array($_POST["title"], $des, $_POST["par"], $text, "../../IMG/Unit_ills_thum_" . $_POST["img"] . ".png", "../../IMG/Unit_ills_full_" . $_POST["img"] . ".png", LastID());     

Template::save($data, "$data[0].php", LinguaFromID((int)$_POST["lingua"]));
?>