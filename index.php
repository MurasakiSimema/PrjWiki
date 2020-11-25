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
    <script src="JS/script.js"></script>
    <link rel="stylesheet" href="CSS/StyleIndex.css">
    <title>Brave Frontier RPG</title>
</head>

<body onload="search()">

    <div class="jumbotron text-center">
        <h1>Pagina Principale</h1>
        <p>
            Brave Frontier è un popolare RPG (iOS e Android) sviluppato da gumi Asia Pte. Ltd.. <br /> Questa Wiki tratta la versione Europea (RPG) di Brave Frontier portata avanti dalla divisione gumi Europe.<br /> Cattura e evoca centinaia di potentissime
            unità, allenale per liberare i loro devastanti poteri, equipaggiale con tantissime potenti sfere e combatti per salvare Grand Gaia!
        </p>
    </div>
    <div class="col-sm-9 text-center">
        <h2>Lore</h2>
        <p>
            Ora ti starai forse chiedendo: che cos'è il Lore?<br /> Ebbene, sta per folklore ossia la cultura e la storia che gira intorno a un popolo o a un mondo, Lore è storia, Lore è conoscenza, in questo caso riguardante tutto ciò che forse prima
            d'ora avevi ignorato a proposito dei luoghi che visiti tra Missione e Portale, o delle Unità che usi nelle tue battaglie, perfino riguardo alcune sfere o oggetti che hai creato. Prima di iniziare a sfogliare queste antiche pergamene, permettimi
            di introdurti all'argomento con alcune essenziali informazioni.
        </p>
        <h2>Grand Gaia e gli altri mondi</h2>
        <p>
            Grand Gaia è la misteriosa terra che esplorerai nel corso della tua avventura. Qui convissero pacificamente umani e dei per innumerevoli secoli, qui nacquero leggendari eroi che compirono imprese immortali. Vi erano in principio sei grandi nazioni ad
            occupare le numerose lande di Grand Gaia, nazioni che tuttavia vennero totalmente distrutte quando, per ragioni ancora da chiarire (lo scoprirete giocando e leggendo) scoppiò la Grande Guerra tra uomini e dei. L'umanità venne quasi del tutto
            sterminata, e solo pochi superstiti riuscirono a fuggire ad ElGaia, misera patria rispetto ai precedenti stati, ma pur sempre un luogo da chiamare casa. E qui gli esseri umani tornarono a prosperare, dividendosi poi in due fazioni, l'Impero
            di Randall e la Sala degli Evocatori di Akras. E qui entri in scena Tu. Tu sei un Evocatore della Sala, dotato del misterioso potere di richiamare nel mondo dei viventi gli spiriti degli eroi dei tempi passati per combattere al tuo fianco.
            A te spetta l'arduo compito di riscoprire le terre abbandonate dagli avi e sventare eventuali minacce. Ma non finirà qui! Il tuo viaggio ti porterà ad esplorare la misteriosa terra di Ishgria e gli altri mondi di cui alcune unità parlano...
        </p>
        <h2>Le Unit&agrave;</h2>
        <p>
            I più ignorano chi o cosa siano in realtà le Unità di cui si servono quotidianamente. Si tratta infatti dei grandi spiriti di leggende, Uomini e Bestie, talvolta perfino Dei che vissero al tempo della Grande Guerra o in epoche da questa poco distanti,
            compiendo imprese eccezionali ed impossibili per comuni mortali. Gli Evocatori hanno l'innata capacità di chiamarle a sé e sfruttarne i molteplici e differenti talenti. Ma queste Unità possono anche raccontare interessanti storie riguardo
            la propria vita e le proprie azioni, che qui potrai scoprire.
        </p>
    </div>
    <div class="col-sm-3 container-fluid">
        <div class="row content col-sm-10">
            <input type="text" class="form-control" id="searchbar" placeholder="Search Blog.." onkeyup="search()">
            <br>
            <h4>Sezioni Wiki</h4>
            <ul class="nav nav-pills nav-stacked" id="searchlist">                
                <?php
                    if(isset($_SESSION["utente"])){                        
                        echo '<li class="active"><a href="ADMIN/Logout.php">Logout</a></li>';
                        echo '<li class="active"><a href="ADMIN/CreaPageIT.php">Crea Pagina</a></li>';
                        echo '<li class="active"><a href="ADMIN/SelectPage.php">Modifica Pagina</a></li>';
                        echo '<li class="active"><a href="ADMIN/CreaAdmin.php">Aggiungi Utente</a></li>';
                        /*echo '<li class="active"><a href="PHP/GeneraRandom.php">Random</a></li>';*/      
                    }
                    else
                        echo '<li class="active"><a href="ADMIN/Login.php">Login</a></li>';
                    
                    require 'PHP/MySQL.php';
            
                    $res = FindPage("");
                    echo $res;
                ?>
            </ul>
        </div>
    </div>
</body>
</html>