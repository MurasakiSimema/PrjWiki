<?php
function InsertPage($ID, $title, $lingua, $dir, $descrizione=""){
    $servername = "localhost";
    $username = "Wiki";
    $password = "password123";
    $dbname = "wiki";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if($ID!=-1){
    $sql = "INSERT INTO pages (Lingua, ID, Nome, Dir, Descrizione)
    VALUES ($lingua, $ID, '$title', '$dir', '$descrizione')";
    }
    else{
        $result = $conn->query("SELECT MAX(ID) AS MAXID FROM pages");
        $row = $result->fetch_assoc();
        if($row['MAXID']!=null){
            $row['MAXID']++;
            $sql = "INSERT INTO pages (Lingua, ID, Nome, Dir, Descrizione)
            VALUES ($lingua, $row[MAXID], '$title', '$dir', '$descrizione')"; 
        }
        else{
            $sql = "INSERT INTO pages (Lingua, ID, Nome, Dir, Descrizione)
            VALUES ($lingua, 1, '$title', '$dir', '$descrizione')"; 
        }
    }
    
    if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
}

function ReadLingue(){
    $servername = "localhost";
    $username = "Wiki";
    $password = "password123";
    $dbname = "wiki";

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

function FindPage($search){
    $servername = "localhost";
    $username = "Wiki";
    $password = "password123";
    $dbname = "wiki";
    $cont = 0;

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //$sql = "SELECT Nome, Dir FROM pages WHERE Nome LIKE '$search%' LIMIT 5";
    $sql = "SELECT Nome, Dir FROM pages";
    $result = $conn->query($sql);
    $ret = "";
    while($row = $result->fetch_assoc()) {
        if($cont>5)
            $ret = $ret . '<li class="nav-item"><a href = ' . $row["Dir"] . '>' . $row["Nome"] . '</a></li>';
        else
            $ret = $ret . '<li class="nav-item" style="display: none;"><a href = ' . $row["Dir"] . '>' . $row["Nome"] . '</a></li>';
    }

    return $ret;
    $conn->close();
}

function FindLingue($id){
    $servername = "localhost";
    $username = "Wiki";
    $password = "password123";
    $dbname = "wiki";

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

function LinguaFromID($id){
    $servername = "localhost";
    $username = "Wiki";
    $password = "password123";
    $dbname = "wiki";

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
    $servername = "localhost";
    $username = "Wiki";
    $password = "password123";
    $dbname = "wiki";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql="SELECT Nome, pages.ID, lingue.Lingua FROM pages LEFT JOIN lingue ON pages.Lingua = lingue.ID";

    $result = $conn->query($sql);
    $ret = '<option value = ' . -1 . '>Nuova Pagina</option>';
    while($row = $result->fetch_assoc()) {
        $ret = $ret . '<option value = ' . $row["ID"] . '>' . $row["Nome"] . ', ' . $row["ID"] . ', ' . $row["Lingua"] . '</option>';
    }

    return $ret;
    $conn->close();
}

function LastID(){
    $servername = "localhost";
    $username = "Wiki";
    $password = "password123";
    $dbname = "wiki";

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
?>