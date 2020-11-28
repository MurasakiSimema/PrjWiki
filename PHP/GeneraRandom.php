<?php
set_time_limit(0);
$servername = "localhost";
$username = "Wiki";
$password = "password123";
$dbname = "wiki";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function InsertPage($ID, $title, $lingua, $dir, $descrizione="", $truedir){
    global $conn;
    
    $descrizione = str_replace("'","\'", $descrizione);
    if($ID!=-1){
    $sql = "INSERT INTO pages (Lingua, ID, Nome, Dir, Descrizione, TrueDir)
    VALUES ($lingua, $ID, '$title', '$dir', '$descrizione', '$truedir')";
    }
    else{
        $result = $conn->query("SELECT MAX(ID) AS MAXID FROM pages");
        $row = $result->fetch_assoc();
        if($row['MAXID']!=null){
            $newid = $row['MAXID']++;
            $sql = "INSERT INTO pages (Lingua, ID, Nome, Dir, Descrizione, TrueDir) 
            VALUES ($lingua, $newid, '$title', '$dir', '$descrizione', '$truedir')";
        }
        else{
            $sql = 'INSERT INTO pages (Lingua, ID, Nome, Dir, Descrizione, TrueDir)
            VALUES (' . $lingua . ', 1, "' . $title . '", "' . $dir . '", "' . $descrizione . '", "' . $truedir .')'; 
        }
    }
    
    if ($conn->query($sql) === TRUE) {
        echo "<br>Pagina creata con successo<br>";
        echo '<br><a href="../ADMIN/CreaPageIT.php">Back</a>';
        return true;
    } else {
        echo "<br>Errore nella creazione della pagina<br>";
        echo "<br>Error: " . $sql . "<br>" . $conn->error;
        echo '<br><a href="../ADMIN/CreaPageIT.php">Back</a>';
        return false;
    }
}

class Template
{
    const TEMPLATE_DIR = '/PrjWiki/PHP/';
    public static function parse($data = [])
    {
        $file = $_SERVER['DOCUMENT_ROOT'] . self::TEMPLATE_DIR . 'TemplatePage.php';
        $html = file_get_contents($file);
        $variables = ['{{title}}', '{{desc}}', '{{par}}', '{{text}}', '{{thum}}', '{{full}}', '{{ID}}'];
        $html_content = str_replace($variables, $data, $html);
        return $html_content;
    }
    public static function save($data = [], $filename = 'post', $lingua, $idlingua) {   
        $dir = '/PrjWiki/PAGINE/' . $lingua . '/' . $filename . '.php';
        if(InsertPage((int)$data[6], $data[0], (int)$idlingua, '/PrjWiki/BraveFrontierWiki/' . $filename . '/' . $lingua, $data[1], $dir)){
            $html = self::parse($data);
            if(!empty($html)) {
                file_put_contents($_SERVER['DOCUMENT_ROOT'] . $dir, $html);
            }
        }
    }
}

$firstid = 7;
for ($i = 1; $i <= 1000; $i++) {
    $desc = "Nulla vitae eros augue. Duis imperdiet leo ac finibus semper. Donec eu interdum ex. Nullam convallis nec enim sed fermentum. Nullam id nisi at quam gravida sollicitudin. Integer facilisis, magna vitae mollis efficitur, dolor urna fringilla metus, ut condimentum tortor leo vitae urna. Curabitur luctus condimentum iaculis. Cras ultrices mauris lacus, at scelerisque nulla sodales nec.";
    $text = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tellus ex, ornare id pharetra nec, rhoncus quis libero. Aliquam erat volutpat. Pellentesque vehicula, quam vitae convallis posuere, tellus ipsum aliquet enim, vel iaculis odio libero vel magna. Nullam dignissim, enim vitae imperdiet sagittis, neque ante luctus lorem, in fringilla lorem odio id nunc. Duis feugiat in leo at interdum. Integer rhoncus sem et rhoncus tincidunt. Nam volutpat magna nibh, sit amet mollis felis tempor in. Cras ultricies lacinia eleifend. Proin porttitor, massa nec tincidunt posuere, mi nulla blandit sapien, a euismod ipsum quam eget ante. Nullam blandit diam vitae imperdiet lacinia. Quisque mollis tortor nec odio maximus, non bibendum sem sollicitudin. Praesent varius, est vestibulum ultricies accumsan, justo ante scelerisque justo, in consectetur dui nibh eu ligula. Donec rhoncus, elit ut mattis tempor, sapien libero malesuada est, ac cursus lacus neque et lorem. Aliquam erat volutpat. Etiam ac porttitor orci, eget placerat justo. Mauris vitae malesuada sem, at tristique metus. Nullam nec lacus eu libero facilisis vehicula et vitae urna. Etiam sed ipsum odio. Proin vel imperdiet sapien. Fusce ultrices rutrum risus, nec venenatis elit congue eu. Mauris tempus orci lacus, et condimentum ex malesuada ut. Maecenas vitae viverra sem.";
    $img = "10014";

    $data = array("Pagina_di_prova_n$i", $desc, "Paragrafo di prova n$i", $text, "../../IMG/Unit_ills_thum_" . $img . ".png", "../../IMG/Unit_ills_full_" . $img . ".png", $firstid + $i - 1);
    Template::save($data, "$data[0]", "Italiano", 1);
}

for ($i = 0; $i < 100; $i++) {
    $desc = "Nulla vitae eros augue. Duis imperdiet leo ac finibus semper. Donec eu interdum ex. Nullam convallis nec enim sed fermentum. Nullam id nisi at quam gravida sollicitudin. Integer facilisis, magna vitae mollis efficitur, dolor urna fringilla metus, ut condimentum tortor leo vitae urna. Curabitur luctus condimentum iaculis. Cras ultrices mauris lacus, at scelerisque nulla sodales nec.";
    $text = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tellus ex, ornare id pharetra nec, rhoncus quis libero. Aliquam erat volutpat. Pellentesque vehicula, quam vitae convallis posuere, tellus ipsum aliquet enim, vel iaculis odio libero vel magna. Nullam dignissim, enim vitae imperdiet sagittis, neque ante luctus lorem, in fringilla lorem odio id nunc. Duis feugiat in leo at interdum. Integer rhoncus sem et rhoncus tincidunt. Nam volutpat magna nibh, sit amet mollis felis tempor in. Cras ultricies lacinia eleifend. Proin porttitor, massa nec tincidunt posuere, mi nulla blandit sapien, a euismod ipsum quam eget ante. Nullam blandit diam vitae imperdiet lacinia. Quisque mollis tortor nec odio maximus, non bibendum sem sollicitudin. Praesent varius, est vestibulum ultricies accumsan, justo ante scelerisque justo, in consectetur dui nibh eu ligula. Donec rhoncus, elit ut mattis tempor, sapien libero malesuada est, ac cursus lacus neque et lorem. Aliquam erat volutpat. Etiam ac porttitor orci, eget placerat justo. Mauris vitae malesuada sem, at tristique metus. Nullam nec lacus eu libero facilisis vehicula et vitae urna. Etiam sed ipsum odio. Proin vel imperdiet sapien. Fusce ultrices rutrum risus, nec venenatis elit congue eu. Mauris tempus orci lacus, et condimentum ex malesuada ut. Maecenas vitae viverra sem.";
    $img = "10014";
    $id= $i + 1;

    $data = array("Pagina_di_prova_n$id", $desc, "Paragrafo di prova n$i", $text, "../../IMG/Unit_ills_thum_" . $img . ".png", "../../IMG/Unit_ills_full_" . $img . ".png", $i + $firstid);
    Template::save($data, "$data[0]", "English", 2);
}

for ($i = 0; $i <10; $i++) {
    $desc = "Nulla vitae eros augue. Duis imperdiet leo ac finibus semper. Donec eu interdum ex. Nullam convallis nec enim sed fermentum. Nullam id nisi at quam gravida sollicitudin. Integer facilisis, magna vitae mollis efficitur, dolor urna fringilla metus, ut condimentum tortor leo vitae urna. Curabitur luctus condimentum iaculis. Cras ultrices mauris lacus, at scelerisque nulla sodales nec.";
    $text = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tellus ex, ornare id pharetra nec, rhoncus quis libero. Aliquam erat volutpat. Pellentesque vehicula, quam vitae convallis posuere, tellus ipsum aliquet enim, vel iaculis odio libero vel magna. Nullam dignissim, enim vitae imperdiet sagittis, neque ante luctus lorem, in fringilla lorem odio id nunc. Duis feugiat in leo at interdum. Integer rhoncus sem et rhoncus tincidunt. Nam volutpat magna nibh, sit amet mollis felis tempor in. Cras ultricies lacinia eleifend. Proin porttitor, massa nec tincidunt posuere, mi nulla blandit sapien, a euismod ipsum quam eget ante. Nullam blandit diam vitae imperdiet lacinia. Quisque mollis tortor nec odio maximus, non bibendum sem sollicitudin. Praesent varius, est vestibulum ultricies accumsan, justo ante scelerisque justo, in consectetur dui nibh eu ligula. Donec rhoncus, elit ut mattis tempor, sapien libero malesuada est, ac cursus lacus neque et lorem. Aliquam erat volutpat. Etiam ac porttitor orci, eget placerat justo. Mauris vitae malesuada sem, at tristique metus. Nullam nec lacus eu libero facilisis vehicula et vitae urna. Etiam sed ipsum odio. Proin vel imperdiet sapien. Fusce ultrices rutrum risus, nec venenatis elit congue eu. Mauris tempus orci lacus, et condimentum ex malesuada ut. Maecenas vitae viverra sem.";
    $img = "10014";
    $id= $i + 1;

    $data = array("Pagina_di_prova_n$id", $desc, "Paragrafo di prova n$i", $text, "../../IMG/Unit_ills_thum_" . $img . ".png", "../../IMG/Unit_ills_full_" . $img . ".png", $i + $firstid);
    Template::save($data, "$data[0]", "Francais", 3);
}

$conn->close();
?>