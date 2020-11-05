<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../../CSS/StylePage.css">
    <script src="../../JS/script.js"></script>
    <title>{{title}}</title>
</head>

<body>
    <div class="jumbotron text-center">
        <h1>{{title}}</h1>
        <p>{{desc}}</p>
    </div>
    <div class="col-sm-9 text-centre">
        <h2><img class="thum" src="{{thum}}" alt="{{thum}}">{{par}}</h2>
        <p>
            <img class="full" src="{{full}}" alt="{{full}}"> {{text}}
        </p>
    </div>
    <div class="col-sm-3 container-fluid">
        <div class="row content col-sm-10">
            <input type="text" class="form-control" id="searchbar" placeholder="Search Blog.." onkeyup="search()">
            <br>
            <span>
            <h4>Sezioni Wiki</h4>
            <ul class="nav nav-pills nav-stacked" id="searchlist"> 
                <li class="active"><a href="PHP/CreaPageIT.php">Home</a></li>                                           
                    <?php
                        require '../../PHP/MySQL.php';
            
                        $res = FindPage("");
                        echo $res;
                    ?>
                </ul>  
            </span>
        </div>
        <nav class="navbar navbar-inverse navbar-fixed-bottom">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Altre Lingue</a>
                </div>
                <ul class="nav navbar-nav">
                    <?php
                        $res = FindLingue({{ID}});
                        echo $res;
                    ?>
                </ul>
            </div>
        </nav>
    </div>
</body>
</html>