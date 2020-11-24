<?php
    $date = explode("/", $_POST["ID"]);
    require '../PHP/MySQL.php';
    require '../..' . DirFromID($date[0], $date[1])["Dir"];

    $text = str_replace("</b>", "|***", str_replace("<b>", "***|", $text));
    $text = str_replace("</mark>", "|**", str_replace("<mark>", "**|", $text));
    $text = str_replace("<br>", "\n", $text);

    $desc = str_replace("</b>", "|***", str_replace("<b>", "***|", $desc));
    $desc = str_replace("</mark>", "|**", str_replace("<mark>", "**|", $desc));
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
<div class="form-group">
    <form action="ModValuePage.php" method="post">
        <label>Titolo:</label>
        <textarea readonly type="text" class="form-control" name="title" rows="1"><?php echo $title; ?></textarea>
        <label>Descrizione:</label>
        <textarea class="form-control" rows="5" name="desc" placeholder="Inserire la Descrizione"><?php echo $desc; ?></textarea>
        <label>Paragrafo:</label>
        <input type="text" class="form-control" name="par" placeholder="Inserire il titolo del Paragrafo" value='<?php echo $par; ?>'>
        <label>Testo:</label>
        <textarea class="form-control" rows="10" name="text" placeholder="Inserire il Testo"><?php echo $text; ?></textarea>
        <label>Codice Unità</label>
        <input type="text" class="form-control" name="img" placeholder="Inserire il codice Unit" value=<?php echo explode(".", explode("thum_", $thum)[1])[0]; ?>>
        <textarea readonly type="text" class="form-control invisible" name="ID" rows="1"><?php echo $date[0]; ?></textarea>
        <textarea readonly type="text" class="form-control invisible" name="lingua" rows="1"><?php echo $date[1]; ?></textarea>
        <input type="submit" class="btn btn-danger"/>        
    </form>
</div>
</body>
</html>
