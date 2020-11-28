<?php
    $servername = "localhost";
    $username = "Wiki";
    $password = "password123";
    $dbname = "wiki";

function InsertPage($ID, $title, $lingua, $dir, $descrizione="", $truedir){
    global $servername, $username, $password, $dbname;

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
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
    
    $conn->close();
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

    return $ret;
    $conn->close();
}

function FindPage(){
    global $servername, $username, $password, $dbname;
    $cont = 0;

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //$sql = "SELECT Nome, Dir FROM pages WHERE Nome LIKE '$search%' LIMIT 5";
    $sql = "SELECT Nome, Dir, lingue.Lingua, Descrizione FROM pages INNER JOIN lingue ON pages.Lingua = lingue.ID";
    $result = $conn->query($sql);
    $ret = "";
    while($row = $result->fetch_assoc()) {
        if($cont>5)
            $ret = $ret . '<li class="nav-item"><a href = ' . $row["Dir"] . ' title = "' . $row["Descrizione"] . '">' . $row["Nome"] . ' - ' . $row["Lingua"] . '</a></li>';
        else
            $ret = $ret . '<li class="nav-item" style="display: none;"><a href = ' . $row["Dir"] . ' title = "' . $row["Descrizione"] . '">' . $row["Nome"] . ' - ' . $row["Lingua"] . '</a></li>';
    }

    return $ret; 
    $conn->close();
}

function FindLingue($id){
    global $servername, $username, $password, $dbname;

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT Dir, lingue.Lingua FROM lingue INNER JOIN pages ON pages.Lingua = lingue.ID WHERE pages.ID = $id";
    $result = $conn->query($sql);
    $ret = "";
    while($row = $result->fetch_assoc()){
        $ret = $ret . '<li><a href="' . $row["Dir"] . '">' . $row["Lingua"] . '</a></li>';
    }
    return $ret;
    $conn->close();
}

function FindLingueInternal($id){
    global $servername, $username, $password, $dbname;

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT Dir, lingue.Lingua FROM lingue INNER JOIN pages ON pages.Lingua = lingue.ID WHERE pages.ID = $id";
    $result = $conn->query($sql);
    $ret = "";
    while($row = $result->fetch_assoc()){
        $ret = $ret . $row["Lingua"] . ', ';
    }
    return $ret;
    $conn->close();
}

function LinguaFromID($id){
    global $servername, $username, $password, $dbname;

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT Lingua FROM lingue WHERE ID = $id";
    $result = $conn->query($sql);

    $row = $result->fetch_assoc();
    return $row["Lingua"];
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

    return $ret;
    $conn->close();
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

    return $ret;
    $conn->close();
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

    return $res;
}

function FindAdmin($utente, $pass){
    global $servername, $username, $password, $dbname;

    $pass = hash("sha256", $pass, false);

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql="SELECT * FROM utenze WHERE Utente='$utente' AND Password='$pass'";

    $result = $conn->query($sql);
    return $result->num_rows;
    $conn->close();
}

function DirFromID($ID, $lingua){
    global $servername, $username, $password, $dbname;

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT TrueDir FROM pages WHERE ID = $ID AND Lingua = $lingua";
    $result = $conn->query($sql);

    return $result->fetch_assoc();
    $conn->close();
}

function InsertAdmin($user, $pass){
    global $servername, $username, $password, $dbname;

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $pass=hash("sha256", $pass, false);
    $sql = "INSERT INTO utenze (Utente, Password)
    VALUES ('$user', '$pass')";

    if ($conn->query($sql) === TRUE) {
        echo "<br>Pagina Modificata con successo<br>";
        echo '<br><a href="../ADMIN/CreaAdmin.php">Back</a>';
    } else {
        echo "<br>Errore nella modifica della pagina<br>";
        echo "<br>Error: " . $sql . "<br>" . $conn->error;
        echo '<br><a href="../ADMIN/CreaAdmin.php">Back</a>';
    }
    $conn->close();
}
?>