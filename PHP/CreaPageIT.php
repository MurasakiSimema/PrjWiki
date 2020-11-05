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
<div class="form-group">
    <form action="Template.php" method="post">
        <label>Titolo:</label>
        <input type="text" class="form-control" name="title" placeholder="Inserire il Titolo">
        <label>Lingua:</label>
        <select class="form-control" name="lingua">
        <?php
            require 'MySQL.php';
            
            $res = ReadLingue();
            echo $res;
        ?>
        </select>
        <label>Descrizione:</label>
        <textarea class="form-control" rows="5" name="desc" placeholder="Inserire la Descrizione"></textarea>
        <label>Paragrafp:</label>
        <input type="text" class="form-control" name="par" placeholder="Inserire il titolo del Paragrafo">
        <label>Testo:</label>
        <textarea class="form-control" rows="10" name="text" placeholder="Inserire il Testo"></textarea>
        <label>Codice Unità</label>
        <input type="text" class="form-control" name="img" placeholder="Inserire il codice Unit">
        <input type="submit" class="btn btn-danger"/>
        
    </form>
</div>
</body>
</html>
