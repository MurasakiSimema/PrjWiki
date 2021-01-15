<?php
$servername = "127.0.0.1";
$username = "Wiki";
$password = "Password123";
$dbname = "wiki";

function InsertPage($ID, $title, $lingua, $dir, $descrizione, $truedir, $img, $paragrafo, $text){
    global $servername, $username, $password, $dbname;

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

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
        $conn->close();
        return true;
    } else {
        echo "<br>Errore nella creazione della pagina<br>";
        echo "<br>Error: " . $conn->error;
        echo '<br><a href="../ADMIN/CreaPageIT.php">Back</a>';
        $sql->close();
        $conn->close();
        return false;
    }
}

function ModificaPagina($ID, $lingua, $descrizione, $img, $paragrafo, $text){
    global $servername, $username, $password, $dbname;

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = $conn->prepare("UPDATE pages SET Descrizione = ?, Img = ?, Paragrafo = ?, Text = ? WHERE ID = ? AND Lingua = ?");
    $sql->bind_param("ssssii", $descrizione, $img, $paragrafo, $text, $ID, $lingua);

    if ($sql->execute()) {
        echo "<br>Pagina Modificata con successo<br>";
        $sql->close();
        $conn->close();
        return true;
    } else {
        echo "<br>Errore nella modifica della pagina<br>";
        echo "<br>Error: " . $conn->error;
        echo '<br><a href="../ADMIN/ModPage.php">Back</a>';
        $sql->close();
        $conn->close();
        return false;
    }
}

function LeggiPagina($id, $lingua){
    global $servername, $username, $password, $dbname;

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $sql = $conn->prepare('SELECT Nome, Descrizione, Paragrafo, Text, Img FROM pages WHERE ID = ? AND Lingua = ?');
    $sql->bind_param("ii", $id, $lingua);
    $sql->execute();
    $sql->bind_result($nome, $descrizione, $paragrafo, $text, $img); 

    $sql->fetch();
    $ret = [$nome, $descrizione, $paragrafo, $text, $img];

    $sql->close();
    $conn->close();
    return $ret;
}

function LeggiPaginaFromName($nome, $nomelingua){
    global $servername, $username, $password, $dbname;

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    $dir='/PrjWiki/BraveFrontierWiki/' . $nome . '/' . $nomelingua;

    $sql = $conn->prepare('SELECT pages.ID, Descrizione, Paragrafo, Text, Img FROM pages INNER JOIN lingue ON pages.Lingua = lingue.ID WHERE Dir = ?');
    $sql->bind_param("s", $dir);
    $sql->execute();
    $sql->bind_result($ID, $descrizione, $paragrafo, $text, $img); 

    if($sql->fetch())
        $ret = [$nome, $descrizione, $paragrafo, $text, $img, $ID];
    else
        $ret = false;
        
    $sql->close();
    $conn->close();
    return $ret;
}

function ReadLingue(){
    global $servername, $username, $password, $dbname;

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT Lingua, ID FROM lingue";
    $result = $conn->query($sql);
    $ret = "";
    while($row = $result->fetch_assoc()) {
        $ret = $ret . '<option value = ' . $row["ID"] . '>' . $row["Lingua"] . '</option>';
    }

    $conn->close();
    return $ret;
}

function FindPage(){
    global $servername, $username, $password, $dbname;
    $cont = 0;

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //$sql = "SELECT Nome, Dir FROM pages WHERE Nome LIKE '$search%' LIMIT 5";
    $sql = "SELECT Nome, Dir, lingue.Lingua, Descrizione FROM pages INNER JOIN lingue ON pages.Lingua = lingue.ID ORDER BY pages.ID DESC";
    $result = $conn->query($sql);
    $ret = "";
    while($row = $result->fetch_assoc()) {
        if($cont>5)
            $ret = $ret . '<li class="nav-item"><a href = ' . $row["Dir"] . ' title = "' . $row["Descrizione"] . '">' . $row["Nome"] . ' - ' . $row["Lingua"] . '</a></li>';
        else
            $ret = $ret . '<li class="nav-item" style="display: none;"><a href = ' . $row["Dir"] . ' title = "' . $row["Descrizione"] . '">' . $row["Nome"] . ' - ' . $row["Lingua"] . '</a></li>';
    }

    $conn->close();
    return $ret; 
}

function FindLingue($id){
    global $servername, $username, $password, $dbname;

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = $conn->prepare('SELECT Dir, lingue.Lingua FROM lingue INNER JOIN pages ON pages.Lingua = lingue.ID WHERE pages.ID = ?');
    $sql->bind_param("i", $id);
    $sql->execute();
    $sql->bind_result($dir, $lingua); 
    $ret = "";
    while($sql->fetch()){
        $ret = $ret . '<li><a href="' . $dir . '">' . $lingua . '</a></li>';
    }
    $sql->close();
    $conn->close();
    return $ret;
}

function FindLingueInternal($id){
    global $servername, $username, $password, $dbname;

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = $conn->prepare('SELECT lingue.Lingua FROM lingue INNER JOIN pages ON pages.Lingua = lingue.ID WHERE pages.ID = ?');
    $sql->bind_param("i", $id);
    $sql->execute();
    $sql->bind_result($lingua); 
    $ret = "";
    while($sql->fetch()){
        $ret = $ret . $lingua . ', ';
    }
    $sql->close();
    $conn->close();
    return $ret;
}

function LinguaFromID($id){
    global $servername, $username, $password, $dbname;

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = $conn->prepare("SELECT Lingua FROM lingue WHERE ID = ?");
    $sql->bind_param("i", $id);
    $sql->execute();
    $sql->bind_result($lingua); 

    $sql->fetch();
    
    $sql->close();
    $conn->close();
    return $lingua;
}

function FindID(){
    global $servername, $username, $password, $dbname;

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql="SELECT Nome, pages.ID, lingue.Lingua FROM pages LEFT JOIN lingue ON pages.Lingua = lingue.ID";
    $ret="";

    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
        $ret = $ret . '<option value = ' . $row["ID"] . '>' . $row["Nome"] . ', ' . $row["ID"] . ', ' . $row["Lingua"] . '</option>';
    }

    $conn->close();
    return $ret;
}

function FindIDLingua(){
    global $servername, $username, $password, $dbname;

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql="SELECT Nome, pages.ID, lingue.Lingua, pages.Lingua AS NomeLingua FROM pages LEFT JOIN lingue ON pages.Lingua = lingue.ID";
    $ret="";

    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
        $ret = $ret . '<option value = ' . $row["ID"] . '/' . $row["NomeLingua"] . '>' . $row["Nome"] . ', ' . $row["ID"] . ', ' . $row["Lingua"] . '</option>';
    }

    $conn->close();
    return $ret;
}

function LastID(){
    global $servername, $username, $password, $dbname;

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $result = $conn->query("SELECT MAX(ID) AS MAXID FROM pages");
    $row = $result->fetch_assoc();
    if($row['MAXID']!=null){
        $res = ++$row['MAXID'];
    }
    else
        $res = 1;

    $conn->close();
    return $res;
}

function FindAdmin($utente){
    global $servername, $username, $password, $dbname;

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = $conn->prepare("SELECT Password FROM utenze WHERE Utente=?");
    $sql->bind_param("s", $utente);
    $sql->execute();
    $sql->bind_result($result); 

    $sql->fetch();
    
    $sql->close();
    $conn->close();
    return $result;
}

function DirFromID($ID, $lingua){
    global $servername, $username, $password, $dbname;

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = $conn->prepare("SELECT TrueDir FROM pages WHERE ID = ? AND Lingua = ?");

    $sql->bind_param("ii", $ID, $lingua);
    $sql->execute();
    $sql->bind_result($result); 

    $sql->fetch();
    
    $sql->close();
    $conn->close();
    return $result;
}

function InsertAdmin($user, $pass){
    global $servername, $username, $password, $dbname;

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $pass = password_hash($pass, PASSWORD_DEFAULT);
    $sql = $conn->prepare("INSERT INTO utenze (Utente, Password)
    VALUES (?, ?)");

    $sql->bind_param("ss", $user, $pass);
     
    if ($sql->execute()) {
        echo "<br>Editor creato con successo<br>";
        echo '<br><a href="../ADMIN/CreaAdmin.php">Back</a>';
    } else {
        echo "<br>Errore nella creazione dell'user<br>";
        echo "<br>Error: " . $conn->error;
        echo '<br><a href="../ADMIN/CreaAdmin.php">Back</a>';
    }
    $conn->close();
}
?>