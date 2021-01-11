<?php
set_time_limit(0);
$servername = "localhost";
$username = "Wiki";
$password = "Password123";
$dbname = "wiki";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function InsertPage($ID, $title, $lingua, $dir, $descrizione, $truedir, $img, $paragrafo, $text){
    global $conn;

    if($ID!=-1){
    $sql = $conn->prepare("INSERT INTO pages (Lingua, ID, Nome, Dir, Descrizione, TrueDir, Img, Paragrafo, Text)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $sql->bind_param("iisssssss", $lingua, $ID, $title, $dir, $descrizione, $truedir, $img, $paragrafo, $text);
    }
    else{
        $result = $conn->query("SELECT MAX(ID) AS MAXID FROM pages");
        $row = $result->fetch_assoc();
        if($row['MAXID']!=null){
            $newid = $row['MAXID'] + 1;
            $sql = $conn->prepare("INSERT INTO pages (Lingua, ID, Nome, Dir, Descrizione, TrueDir, Img, Paragrafo, Text) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $sql->bind_param("iisssssss", $lingua, $newid, $title, $dir, $descrizione, $truedir, $img, $paragrafo, $text);
        }
        else{
            $newid = 1;
            $sql = $conn->prepare('INSERT INTO pages (Lingua, ID, Nome, Dir, Descrizione, TrueDir, Img, Paragrafo, Text)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
            $sql->bind_param("iisssssss", $lingua, $newid, $title, $dir, $descrizione, $truedir, $img, $paragrafo, $text);
        }
    }

    if ($sql->execute()) {
        echo "<br>Pagina creata con successo<br>";     
        echo '<br><a href="../ADMIN/CreaPageIT.php">Back</a>';
        $sql->close();
        return true;
    } else {
        echo "<br>Errore nella creazione della pagina<br>";
        echo "<br>Error: " . $conn->error;
        echo '<br><a href="../ADMIN/CreaPageIT.php">Back</a>';
        $sql->close();
        return false;
    }
}


$firstid = 0;
for ($i = 1; $i <= 1000; $i++) {
    $desc = "Nulla vitae eros augue. Duis imperdiet leo ac finibus semper. Donec eu interdum ex. Nullam convallis nec enim sed fermentum. Nullam id nisi at quam gravida sollicitudin. Integer facilisis, magna vitae mollis efficitur, dolor urna fringilla metus, ut condimentum tortor leo vitae urna. Curabitur luctus condimentum iaculis. Cras ultrices mauris lacus, at scelerisque nulla sodales nec.";
    $text = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tellus ex, ornare id pharetra nec, rhoncus quis libero. Aliquam erat volutpat. Pellentesque vehicula, quam vitae convallis posuere, tellus ipsum aliquet enim, vel iaculis odio libero vel magna. Nullam dignissim, enim vitae imperdiet sagittis, neque ante luctus lorem, in fringilla lorem odio id nunc. Duis feugiat in leo at interdum. Integer rhoncus sem et rhoncus tincidunt. Nam volutpat magna nibh, sit amet mollis felis tempor in. Cras ultricies lacinia eleifend. Proin porttitor, massa nec tincidunt posuere, mi nulla blandit sapien, a euismod ipsum quam eget ante. Nullam blandit diam vitae imperdiet lacinia. Quisque mollis tortor nec odio maximus, non bibendum sem sollicitudin. Praesent varius, est vestibulum ultricies accumsan, justo ante scelerisque justo, in consectetur dui nibh eu ligula. Donec rhoncus, elit ut mattis tempor, sapien libero malesuada est, ac cursus lacus neque et lorem. Aliquam erat volutpat. Etiam ac porttitor orci, eget placerat justo. Mauris vitae malesuada sem, at tristique metus. Nullam nec lacus eu libero facilisis vehicula et vitae urna. Etiam sed ipsum odio. Proin vel imperdiet sapien. Fusce ultrices rutrum risus, nec venenatis elit congue eu. Mauris tempus orci lacus, et condimentum ex malesuada ut. Maecenas vitae viverra sem.";
    $img = "10014";

    InsertPage($i,"PaginaProva$i", 1, '/PrjWiki/BraveFrontierWiki/' . "PaginaProva$i/Italiano", $desc, "/PrjWiki/CACHE/Italiano/PaginaProva$i", $img, "ParagrafoProva$i", $text);
}

for ($i = 1; $i <= 100; $i++) {
    $desc = "Nulla vitae eros augue. Duis imperdiet leo ac finibus semper. Donec eu interdum ex. Nullam convallis nec enim sed fermentum. Nullam id nisi at quam gravida sollicitudin. Integer facilisis, magna vitae mollis efficitur, dolor urna fringilla metus, ut condimentum tortor leo vitae urna. Curabitur luctus condimentum iaculis. Cras ultrices mauris lacus, at scelerisque nulla sodales nec.";
    $text = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tellus ex, ornare id pharetra nec, rhoncus quis libero. Aliquam erat volutpat. Pellentesque vehicula, quam vitae convallis posuere, tellus ipsum aliquet enim, vel iaculis odio libero vel magna. Nullam dignissim, enim vitae imperdiet sagittis, neque ante luctus lorem, in fringilla lorem odio id nunc. Duis feugiat in leo at interdum. Integer rhoncus sem et rhoncus tincidunt. Nam volutpat magna nibh, sit amet mollis felis tempor in. Cras ultricies lacinia eleifend. Proin porttitor, massa nec tincidunt posuere, mi nulla blandit sapien, a euismod ipsum quam eget ante. Nullam blandit diam vitae imperdiet lacinia. Quisque mollis tortor nec odio maximus, non bibendum sem sollicitudin. Praesent varius, est vestibulum ultricies accumsan, justo ante scelerisque justo, in consectetur dui nibh eu ligula. Donec rhoncus, elit ut mattis tempor, sapien libero malesuada est, ac cursus lacus neque et lorem. Aliquam erat volutpat. Etiam ac porttitor orci, eget placerat justo. Mauris vitae malesuada sem, at tristique metus. Nullam nec lacus eu libero facilisis vehicula et vitae urna. Etiam sed ipsum odio. Proin vel imperdiet sapien. Fusce ultrices rutrum risus, nec venenatis elit congue eu. Mauris tempus orci lacus, et condimentum ex malesuada ut. Maecenas vitae viverra sem.";
    $img = "10014";
    $id= $i + 1;

    InsertPage($i,"TestPage$i", 2, '/PrjWiki/BraveFrontierWiki/' . "TestPage$i/English", $desc, "/PrjWiki/CACHE/English/TestPage$i", $img, "TestParagraph$i", $text);
}

for ($i = 1; $i <= 10; $i++) {
    $desc = "Nulla vitae eros augue. Duis imperdiet leo ac finibus semper. Donec eu interdum ex. Nullam convallis nec enim sed fermentum. Nullam id nisi at quam gravida sollicitudin. Integer facilisis, magna vitae mollis efficitur, dolor urna fringilla metus, ut condimentum tortor leo vitae urna. Curabitur luctus condimentum iaculis. Cras ultrices mauris lacus, at scelerisque nulla sodales nec.";
    $text = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tellus ex, ornare id pharetra nec, rhoncus quis libero. Aliquam erat volutpat. Pellentesque vehicula, quam vitae convallis posuere, tellus ipsum aliquet enim, vel iaculis odio libero vel magna. Nullam dignissim, enim vitae imperdiet sagittis, neque ante luctus lorem, in fringilla lorem odio id nunc. Duis feugiat in leo at interdum. Integer rhoncus sem et rhoncus tincidunt. Nam volutpat magna nibh, sit amet mollis felis tempor in. Cras ultricies lacinia eleifend. Proin porttitor, massa nec tincidunt posuere, mi nulla blandit sapien, a euismod ipsum quam eget ante. Nullam blandit diam vitae imperdiet lacinia. Quisque mollis tortor nec odio maximus, non bibendum sem sollicitudin. Praesent varius, est vestibulum ultricies accumsan, justo ante scelerisque justo, in consectetur dui nibh eu ligula. Donec rhoncus, elit ut mattis tempor, sapien libero malesuada est, ac cursus lacus neque et lorem. Aliquam erat volutpat. Etiam ac porttitor orci, eget placerat justo. Mauris vitae malesuada sem, at tristique metus. Nullam nec lacus eu libero facilisis vehicula et vitae urna. Etiam sed ipsum odio. Proin vel imperdiet sapien. Fusce ultrices rutrum risus, nec venenatis elit congue eu. Mauris tempus orci lacus, et condimentum ex malesuada ut. Maecenas vitae viverra sem.";
    $img = "10014";
    $id = $i + 1;

    InsertPage($i,"EssaiPage$i", 3, '/PrjWiki/BraveFrontierWiki/' . "EssaiPage$i/Francais", $desc, "/PrjWiki/CACHE/Francais/EssaiPage$i", $img, "EssaiPage$i", $text);
}

$conn->close();
?>