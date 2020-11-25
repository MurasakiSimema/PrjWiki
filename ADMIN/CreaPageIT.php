<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="../JS/script.js"></script>
    <title>Home</title>
</head>
<body>
<div class="form-group container-fluid">
    <form action="../PHP/GenPage.php" method="post">
        <label>ID:</label>
        <select class="form-control" name="ID" id="id" onchange="ControlloLingua()">
            <option value = '-1'>Nuova Pagina</option>
        <?php
            require '../PHP/MySQL.php';
            
            
            $res1 = FindID();
            echo $res1;
        ?>
        </select>
        <label>Titolo:</label>
        <input type="text" class="form-control" name="title" placeholder="Inserire il Titolo">
        <label>Lingua:</label>
        <select class="form-control" id="lingua" name="lingua">
        <?php
            $res2 = ReadLingue();
            echo $res2;
        ?>
        </select>
        <label>Descrizione:</label>
        <textarea class="form-control" rows="5" name="desc" placeholder="Inserire la Descrizione" resize="none"></textarea>
        <label>Paragrafo:</label>
        <input type="text" class="form-control" name="par" placeholder="Inserire il titolo del Paragrafo">
        <label>Testo:</label>
        <textarea class="form-control" rows="18" name="text" placeholder="Inserire il Testo"></textarea>
        <label>Codice Unità</label>
        <input type="text" class="form-control" name="img" placeholder="Inserire il codice Unit">
        <input type="submit" class="btn btn-danger" id="btn"/>        
    </form>
    <br>
    <button class="btn"><a href="../Home">Back</a></button>
</div>
</body>
</html>
