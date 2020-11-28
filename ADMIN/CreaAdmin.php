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
        <form action="../PHP/GenAdmin.php" method="post">
            <label>Utente:</label>
            <input type="text" class="form-control" name="utente" placeholder="Inserire Utente">
            <label>Password:</label>
            <input type="password" class="form-control" name="password" placeholder="Inserire Password">  
            <label>Conferma Password:</label>
            <input type="password" class="form-control" name="confirm" placeholder="Reinserire Password"> 
            <br> 
            <button type="submit" class="btn btn-danger">Crea <span class="glyphicon glyphicon-check"></span></button> 
            <button class="btn"><a href="../Home">Back <span class="glyphicon glyphicon-check"></span></a></button> 
        </form>
    </div>
</body>
</html>