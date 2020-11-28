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
    <div class="from-group container-fluid">
        <h2>Login</h2>
        <form action="../PHP/ControllaLogin.php" method="post">
            <label>Utente:</label>
            <input type="text" class="form-control" name="utente" size="40">
            <label>Password:</label>
            <input type="password" class="form-control" name="password" size="40" /><br>
            <button type="submit" class="btn btn-danger">Login <span class="glyphicon glyphicon-log-in"></span></button>
            <button class="btn"><a href="../Home">Back <span class="glyphicon glyphicon-home"></span></a></button>
        </form>
    </div>
</body>

</html>