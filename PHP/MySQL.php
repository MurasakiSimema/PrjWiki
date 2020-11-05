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

    if($ID!=null){
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

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT Nome, Dir FROM pages WHERE Nome LIKE '$search' LIMIT 5";
    $result = $conn->query($sql);
    $ret = "";
    while($row = $result->fetch_assoc()) {
        $ret = $ret . '<li href = ' . $row["Dir"] . '>' . $row["Nome"] . '</li>';
    }

    return $ret;
    ?>
    <script>

    </script>
    <?php
    $conn->close();
}
?>