<?php
error_reporting(E_ALL);
require 'MySQL.php';
//echo 'Lingua:' . $_GET["Lin"] . '</br>';
//echo 'Pagina:' . $_GET["Pag"] . '</br>';

class Template {
    const TEMPLATE_DIR = '/membri/hoilserveracasa/PrjWiki/PHP';
    public static function parse($data = []) {
        $file = '/membri/hoilserveracasa/PrjWiki/PHP/TemplatePage.php';
        $html = file_get_contents($file);
        $variables = ['{{title}}', '{{desc}}', '{{par}}', '{{text}}', '{{img}}', '{{ID}}'];
        $html_content = str_replace($variables, $data, $html);
        return $html_content;
    }
    public static function save($data = [], $filename = 'post.php', $lingua) {   
        $html = self::parse($data);
        if(!empty($html)) {
            file_put_contents('/membri/hoilserveracasa/PrjWiki/CACHE/' . $lingua . '/' . $filename, $html);
            header("Refresh:0");
        }
    }
}

$data = LeggiPaginaFromName($_GET["Pag"], $_GET["Lin"]);
if($data){
    $arr = array($data[0], $data[1], $data[2], $data[3], $data[4], $data[5]);   
    Template::save($arr, "$arr[0].php", $_GET["Lin"]);
}
else{?>
    <head>
    <link href="../../CSS/Style404.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/4b9ba14b0f.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="mainbox">
        <div class="err">4</div>
        <i class="far fa-question-circle fa-spin"></i>
        <div class="err2">4</div>
        <div class="msg">Maybe this page moved? Got deleted? Is hiding out in quarantine? Never existed in the first place?<p>Let's go <a href="../../Home">home</a> and try from there.</p></div>
        </div>
    </body>
    <?php }
?>