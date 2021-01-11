<?php
    session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../../CSS/StylePage.css">
    <script src="../../JS/script.js"></script>
    <title><?php echo $title ?></title>
</head>

<body onload="search()">
    <div class="jumbotron text-center">
        <h1><?php echo $title; ?></h1>
        <p><?php echo $desc; ?></p>
    </div>
    <div class="col-sm-9 text-centre">
        <h2><img class="thum" src='<?php echo "../../IMG/Unit_ills_thum_$img.png";?>' alt='<?php echo "Unit_ills_thum_$img.png";?>'><?php echo $par;?></h2>
        <p>
            <img class="full" src="<?php echo "../../IMG/Unit_ills_full_$img.png";?>" alt='<?php echo "Unit_ills_full_$img.png";?>'> <?php echo $text;?>
        </p>
    </div>
    <div class="col-sm-3 container-fluid">
        <div class="row content col-sm-10">
            <input type="text" class="form-control" id="searchbar" placeholder="Search Blog.." onkeyup="search()">
            <br>
            <span>
            <h4>Sezioni Wiki</h4>
            <ul class="nav nav-pills nav-stacked" id="searchlist"> 
                <li class="active"><a href="../../Home">Home</a></li>                                           
                    <?php
                        if(isset($_SESSION["utente"])){                        
                            echo '<li class="active"><a href="../../ADMIN/Logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>';
                            echo '<li class="active"><a href="../../ADMIN/CreaPageIT.php"><span class="glyphicon glyphicon-new-window"></span> Crea Pagina</a></li>';
                            echo '<li class="active"><a href="../../ADMIN/SelectPage.php"><span class="glyphicon glyphicon-pencil"></span> Modifica Pagina</a></li>';
                            echo '<li class="active"><a href="../../ADMIN/CreaAdmin.php"><span class="glyphicon glyphicon-user"></span> Aggiungi Utente</a></li>';
                            /*echo '<li class="active"><a href="../../PHP/GeneraRandom.php">Random</a></li>';*/      
                        }
                        else
                            echo '<li class="active"><a href="../../ADMIN/Login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
                            
                        require '../../PHP/MySQL.php';
            
                        $res = FindPage("");
                        echo $res;
                    ?>
                </ul>  
            </span>
        </div>
        </div>
        <nav class="navbar navbar-inverse navbar-fixed-bottom">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Altre Lingue</a>
                </div>
                <ul class="nav navbar-nav">
                    <?php
                        $res = FindLingue($ID);
                        echo $res;
                    ?>
                </ul>
            </div>
        </nav>
</body>
</html>