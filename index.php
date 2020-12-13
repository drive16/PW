<?php
    require_once('utils/XHTML_functions.php');
    
    session_start();
    
    if(isset($_GET['logout'])) {
        session_destroy();
        header("location: index.php");
    }
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html> <!--<![endif]-->
    <?php
        echo html_head("Network Configurator");
    ?>
    <!--<head>
        <meta charset="utf-8">
        <title>Bootstrap Hello World! Example</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"> 
        <!-- Fogli di stile
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">

        <!-- jQuery e plugin JavaScript
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>-->
    <body>
        <nav class="navbar-inverse navbar-expand-md">
            <div class="container">
                <div class="container-fluid">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span> 
                    </button>
                    <a class="navbar-brand" href="index.php">Network Configurator</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href='index.php'>Home</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Devices<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="routers.php">Routers</a></li>
                                <li><a href="switches.php">Switches</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <?php
                            if(isset($_SESSION['logged'])) {
                                echo '<li><a>Welcome ' . $_SESSION["loggedName"] . '</a></li>';
                                echo '<li><a href="' . $_SERVER["PHP_SELF"] . '?logout=logout">Logout <span class="glyphicon glyphicon-log-out"></span></a></li>';
                            } else {
                                echo '<li><a href="auth.php"><span class="glyphicon glyphicon-log-in"></span> Login/Registrazione</a></li>';
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <ul class="breadcrumb pull-right">
                <li><a class="active">Home</a></li>
            </ul>
        </div>

        <div class="container">
            <header class="header-section">
                <h1>Networking Devices Configurator</h1>
            </header>
        </div>
        
        <div class="container">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <div class="row">
                    <div class="col-sm-9">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <div class="item active">
                                <img src="img/isr4000.jpg" alt="ISR serie 4000">
                                <div class="carousel-caption hidden-xs hidden-sm hidden-md">
                                    <h4>Cisco ISR serie 4000</h4>
                                    <p>Ultima generazione</p>
                                </div>
                            </div>

                            <div class="item">
                                <img src="img/2900.jpg" alt="ISR serie 2000">
                                <div class="carousel-caption hidden-xs hidden-sm hidden-md">
                                    <h4>Cisco ISR serie 2000</h4>
                                    <p>Vecchia generazione</p>
                                </div>
                            </div>
                        </div>

                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>

                    <div class="col-sm-3">
                        <p>Benvenuti nel sito "Network Configurator". Se state cercando una maniera rapida per configurare un router o uno switch, questo è lo strumento giusto!</p>
                        <p>Per il momento è possibile generare la configurazione solamente per gli apparati nelle immagini di fianco: in futuro aggiungeremo il supporto anche per altro.</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container">
            <header class="header-section">
                <h3>Perché affidarsi a questo sito?</h3>
            </header>
        </div>
        
        <div class="container">
            <p>Questo sito nasce con l'idea di rendere più facile la vita di tutti quei Network Engineer, System Administrator e professionisti del mondo IT che devono configurare switch e router.
               Basta inserire pochi dati e si potrà subito avere a disposizione uno "scheletro" di configurazione adeguato all'apparato selezionato e alla sua sintassi dei comandi.</p>
        </div>
    </body>
</html>