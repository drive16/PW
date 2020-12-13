<?php

    require_once('utils/XHTML_functions.php');

    spl_autoload_register(function ($class) {
        include 'model/' . $class . '.php';
    });
    
    session_start();
    if(!$_SESSION['logged']) {
        header("location: auth.php");
    }
    
    if(isset($_GET['logout'])) {
        session_destroy();
        header("location: index.php");
    }
    
    $dl = new DataLayer();
    
    if (isset($_GET['confirm'])) {
        if (isset($_GET['serialNumber'])) {
            $dl->deleteRouter($_GET['serialNumber']);
        }
        header("location: routers.php");
    }

?>

<!DOCTYPE html>
<html>
    <?php
        echo html_head("Network Configurator - Delete Router");
    ?>
    
    <body>
        <nav class="navbar-inverse navbar-expand-md navbar-dark bg-dark">
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
                        <li><a href='index.php'>Home</a></li>
                        <li class="dropdown active">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Devices<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class="active"><a href="routers.php">Routers</a></li>
                                <li><a href="switches.php">Switches</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <?php
                            if(isset($_SESSION['logged'])) {
                                echo '<li><a>Welcome ' . $_SESSION["loggedName"] . '</a></li>';
                                echo '<li><a href="' . $_SERVER["PHP_SELF"] . '?logout=logout">Logout <span class="glyphicon glyphicon-log-out"></span></a></li>';
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
        
        <div class="container">
            <ul class="breadcrumb pull-right">
                <li><a href="index.php">Home</a></li>
                <li class="active">My Devices</li>
                <li class="active">Routers</li>
                <li class="active">Delete router</li>
            </ul>
        </div>
        
        <?php
            $router = null;
            if (isset($_GET['serialNumber'])) {
                $router = $dl->findRouterBySerial($_GET['serialNumber']);
        ?>
        
        <div class="container text-center">
            <div class="row">
                <div class="col-md-12">
                    <header>
                        <h2>
                            <?php
                                echo 'Elimina il router "' . $router->getName() . '" dalla tua lista';
                            ?>
                        </h2>
                    </header>
                    <p class='lead'>
                        Stai per eliminare il router. Confermi?
                    </p>
                </div>
            </div>
        </div>
        
        <div class="container text-center">
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Annulla
                        </div>
                        <div class="panel-body">
                            <p>Il router <strong>non sarà rimosso</strong> dal database.</p>
                            <p><a class="btn btn-default" href="routers.php"><span class='glyphicon glyphicon-arrow-left'></span> Torna alla lista dei router</a></p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Elimina
                        </div>
                        <div class="panel-body">
                            <p>Il router <strong>sarà definitivamente rimosso</strong> dal database.</p>
                            <?php
                                echo '<p><a class="btn btn-danger" href="deleteRouters.php?serialNumber=' . $_GET['serialNumber'] . '&confirm=confirm"><span class=\'glyphicon glyphicon-trash\'></span> Delete</a></p>';
                            ?>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
        <?php
            } else {
        ?>
        
        <div class="container text-center">
            <div class="row">
                <div class="col-md-12">
                    <header>
                        <h1>
                            Elimina il router dalla lista
                        </h1>
                    </header>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-danger">
                        <div class='panel-heading'>
                            Illegal page access
                        </div>
                        <div class='panel-body'>
                            <p>Qualcosa è andato storto</p>
                            <p><a class="btn btn-default" href="index.php"><span class='glyphicon glyphicon-log-out'></span> Torna alla home</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
            }
        ?>
            
        
    </body>
</html>
