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
    $userID = $dl->getUserID($_SESSION['loggedName']);
    
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        
        $switches = $dl->findSwitchBySerial($_GET['serialNumber']);
        
        if (isset($_POST['serialNumber']) && $switches->getUserID() == $userID) {
            //edit
            $dl->editSwitch($_POST['name'],$_POST['model'],$_POST['firmware'],$_POST['ports'],$_POST['serialNumber']);
            header("location: switches.php");            
        } else {
            // create
            $dl->addSwitch($_POST['name'],$_POST['model'],$_POST['firmware'],$_POST['ports'],$_POST['serialNumber'],$userID);
            header("location: switches.php");
        }
    }
    
    if (isset($_GET['serialNumber'])) {
        $switches = $dl->findSwitchBySerial($_GET['serialNumber']);
    }

?>

<!DOCTYPE html>
<html>
    <?php
        if (isset($_GET['serialNumber'])) 
        {
            echo html_head("Network Configurator - Edit Switch");
        }
        else 
        {
            echo html_head("Network Configurator - Add Switch");
        }
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
                                <li><a href="routers.php">Routers</a></li>
                                <li class="active"><a href="switches.php">Switches</a></li>
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
                <li class="active">Switches</li>
                <?php
                    if (isset($_GET['serialNumber']))
                    {
                        echo '<li class="active">Edit Switch</li>';
                    }
                    else
                    {
                        echo '<li class="active">Add Switch</li>';
                    }
                ?>
            </ul>
        </div>
        
        <div class="container">
            <header class="header-section">
                <h1>
                    <?php
                        if (isset($_GET['serialNumber'])) {
                            echo 'Edit Switch';
                        } else {
                            echo 'Add Switch';
                        }
                    ?>
                </h1>
            </header>
        </div>
        
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <form class="form-horizontal" name="router" method="post" action="#">
                        <div class="form-group">
                            <label for="name" class="col-md-3">Name</label>
                            <div class="col-sm-9">
                                <?php
                                if (isset($_GET['serialNumber'])) {
                                    echo '<input class="form-control" type="text" id="name" name="name" placeholder="Switch\'s actual name" value="' . $switches->getName() . '">';
                                } else {
                                    echo '<input class="form-control" type="text" id="name" name="name" placeholder="Switch\'s name">';
                                }
                                ?>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="model" class="col-md-3">Model</label>
                            <div class="col-sm-9">
                                <?php
                                if (isset($_GET['serialNumber'])) {
                                    echo '<select class="form-control" id="model" name="model" value="' . $switches->getModel() . '"><option selected>'.$switches->getModel().'</option><option>C2960-X</option><option>C2960-S</option></select>';
                                } else {
                                    echo '<select class="form-control" id="model" name="model"><option selected>Modello</option><option>C2960-X</option><option>C2960-S</option></select>';
                                }
                                ?>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="firmware" class="col-md-3">Firmware</label>
                            <div class="col-sm-9">
                                <?php
                                if (isset($_GET['serialNumber'])) {
                                    echo '<input class="form-control" type="text" id="firmware" name="firmware" placeholder="Switch\'s actual firmware" value="' . $switches->getFirmware() . '">';
                                } else {
                                    echo '<input class="form-control" type="text" id="firmware" name="firmware" placeholder="Switch\'s firmware">';
                                }
                                ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ports" class="col-md-3">Ports</label>
                            <div class="col-sm-9">
                                <?php
                                if (isset($_GET['serialNumber'])) {
                                    echo '<input class="form-control" type="text" id="ports" name="ports" placeholder="Switch\'s actual ports" value="' . $switches->getPorts() . '">';
                                } else {
                                    echo '<input class="form-control" type="text" id="ports" name="ports" placeholder="Switch\'s ports">';
                                }
                                ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="serialNumber" class="col-md-3">Serial Number</label>
                            <div class="col-sm-9">
                                <?php
                                if (isset($_GET['serialNumber'])) {
                                    echo '<input class="form-control form-control-plaintext" type="text" readonly id="serialNumber" name="serialNumber" placeholder="Switch\'s actual S/N" value="' . $switches->getSerialNumber() . '">';
                                } else {
                                    echo '<input class="form-control" type="text" id="serialNumber" name="serialNumber" placeholder="Switch\'s S/N">';
                                }
                                ?>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-3">
                                <?php
                                if (isset($_GET['serialNumber'])) {
                                    echo '<input type="hidden" name="id" value="' . $switches->getSerialNumber() . '"/>';
                                    echo '<label for="mySubmit" class="btn btn-primary btn-large btn-block"><span class="glyphicon glyphicon-save"></span> Save</label>';
                                    echo '<input id="mySubmit" type="submit" value=\'Save\' class="hidden"/>';
                                } else {
                                    echo '<label for="mySubmit" class="btn btn-primary btn-large btn-block"><span class="glyphicon glyphicon-save"></span> Add</label>';
                                    echo '<input id="mySubmit" type="submit" value=\'Create\' class="hidden"/>';
                                }
                                ?>
                            </div>
                        </div>
                        
                            
                            <div class="form-group">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <a href="switches.php" class="btn btn-danger btn-large btn-block"><span class="glyphicon glyphicon-remove"></span> Cancel</a>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
        
    </body>
</html>

