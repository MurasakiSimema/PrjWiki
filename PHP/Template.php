<?php 
require 'MySQL.php';
class Template {
    const TEMPLATE_DIR = '/Wiki Test/HTML/IT/';
    public static function parse($data = []) {
        $file = $_SERVER['DOCUMENT_ROOT'] . self::TEMPLATE_DIR . 'TemplateIT.html';
        $html = file_get_contents($file);
        $variables = ['{{title}}', '{{desc}}', '{{par}}', '{{text}}', '{{thum}}', '{{full}}'];
        $html_content = str_replace($variables, $data, $html);
        return $html_content;
    }
    public static function save($data = [], $filename = 'post.html') {
        $html = self::parse($data);
        if(!empty($html)) {
            file_put_contents( $_SERVER['DOCUMENT_ROOT'] . '/Wiki Test/HTML/IT/' . $filename, $html);
            InsertPage($ID=null, $_POST["title"], (int)$_POST["lingua"], '/Wiki Test/HTML/IT/' . $filename, $_POST["desc"]);
        }
    }
}

$data=array($_POST["title"], $_POST["desc"], $_POST["par"], $_POST["text"], "../../IMG/Unit_ills_thum_" . $_POST["img"] . ".png", "../../IMG/Unit_ills_full_" . $_POST["img"] . ".png");
Template::save($data, "$data[0].html");
?>