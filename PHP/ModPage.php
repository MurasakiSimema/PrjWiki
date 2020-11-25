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
<div class="form-group container-fluid">
    <form action="ModValuePage.php" method="post">
        <label>Titolo:</label>
        <textarea readonly type="text" class="form-control" name="title" rows="1"><?php echo $title; ?></textarea>
        <label>Descrizione:</label>
        <textarea class="form-control" rows="5" name="desc" placeholder="Inserire la Descrizione" resize="none"><?php echo $desc; ?></textarea>
        <label>Paragrafo:</label>
        <input type="text" class="form-control" name="par" placeholder="Inserire il titolo del Paragrafo" value='<?php echo $par; ?>'>
        <label>Testo:</label>
        <textarea class="form-control" rows="20" name="text" placeholder="Inserire il Testo"  resize="none"><?php echo $text; ?></textarea>
        <label>Codice Unità</label>
        <input type="text" class="form-control" name="img" placeholder="Inserire il codice Unit" value=<?php echo explode(".", explode("thum_", $thum)[1])[0]; ?>>
        <textarea readonly type="text" class="form-control" style="display:none" name="ID" rows="1"><?php echo $date[0]; ?></textarea>
        <textarea readonly type="text" class="form-control" style="display:none" name="lingua" rows="1"><?php echo $date[1]; ?></textarea>
        <input type="submit" class="btn btn-danger"/>        
    </form>
    <br>
    <button class="btn"><a href="../Home">Back</a></button>
</div>
</body>
</html>
