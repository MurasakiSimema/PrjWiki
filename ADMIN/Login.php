<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="JS/script.js"></script>
    <link rel="stylesheet" href="CSS/StyleIndex.css">
    <title>Login</title>
</head>

<body>
    <div class="container-fluid">
        <h2>Login</h2>
        <form action="../PHP/Login.php" method="post">
            <label>Utente:</label>
            <input type="text" class="form-control" name="utente" size="40">
            <label>Password:</label>
            <input type="password" class="form-control" name="password" size="40" /><br>
            <input type="submit" class="btn btn-danger">
        </form>
        <button class="btn"><a href="../Home">Back</a></button>
    </div>
</body>

</html>