<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="CSS/StyleIndex.css">
    <title>Home</title>
</head>
<body>
<div class="form-group container-fluid">
<?php if(isset($_SESSION["utente"])) {?>
    <form action="ModPage.php" method="post">
        <label>ID:</label>
        <select class="form-control" name="ID">
        <?php
            require '../PHP/MySQL.php';
            
            $res1 = FindIDLingua();
            echo $res1;
        ?>
        </select>
        <button type="submit" class="btn btn-danger">Seleziona <span class="glyphicon glyphicon-check"></button>      
        <button class="btn"><a href="../Home">Back</a></button> 
    </form>
    <?php }else {?>
        <p><br>Solo un Editor può accedere a questa pagine</p>
        <button class="btn"><a href="../Home">Back</a></button> 
    <?php }?>
</div>
</body>
</html>
