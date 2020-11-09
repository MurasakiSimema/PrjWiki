<?php 
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
        $html = self::parse($data);
        if(!empty($html)) {
            file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/PrjWiki/HTML/' . $lingua . '/' . $filename, $html);
            InsertPage((int)$_POST["ID"], $_POST["title"], (int)$_POST["lingua"], '/PrjWiki/HTML/' . $lingua . '/' . $filename, $_POST["desc"]);
        }
    }
}
if($_POST["ID"]!=-1)
    $data=array($_POST["title"], $_POST["desc"], $_POST["par"], $_POST["text"], "../../IMG/Unit_ills_thum_" . $_POST["img"] . ".png", "../../IMG/Unit_ills_full_" . $_POST["img"] . ".png", $_POST["ID"]);   
else 
    $data=array($_POST["title"], $_POST["desc"], $_POST["par"], $_POST["text"], "../../IMG/Unit_ills_thum_" . $_POST["img"] . ".png", "../../IMG/Unit_ills_full_" . $_POST["img"] . ".png", LastID());     

Template::save($data, "$data[0].php", LinguaFromID((int)$_POST["lingua"]));
?>