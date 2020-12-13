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
    $routers_list = $dl->listRouters($userID);
?>

<!DOCTYPE html>
<html>
    <?php
        echo html_head("Network Configurator - Routers");
    ?>
    
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
            </ul>
        </div>
        
        <div class="container">
            <header class="header-section">
                <h1>Routers</h1>
            </header>
        </div>
        
        <div class="container">
            <div class="row">
                <div class="col-md-offset-10 col-xs-5">
                    <p>
                        <a class="btn btn-default" href="editRouters.php"><span class="glyphicon glyphicon-plus"></span> Insert new router</a>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-hover table-responsive" style="width:100%">
                        <col width="15%">
                        <col width="15%">
                        <col width="15%">
                        <col width="35%">

                        
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Model</th>
                                <th>Firmware version</th>
                                <th>Serial Number</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                            foreach ($routers_list as $routers) {
                                echo '<tr>';
                                echo '<td>' . $routers->getName() . '</td>';
                                echo '<td>' . $routers->getModel() . '</td>';
                                echo '<td>' . $routers->getFirmware() . '</td>';
                                echo '<td>' . $routers->getSerialNumber() . '</td>';
                                echo '<td>';
                                echo '<a class="btn btn-primary" href="editRouters.php?serialNumber=' . $routers->getSerialNumber() . '"><span class="glyphicon glyphicon-pencil"></span> Edit</a>';
                                echo '</td>';
                                echo '<td>';
                                echo '<a class="btn btn-danger" href="deleteRouters.php?serialNumber=' . $routers->getSerialNumber() . '"><span class="glyphicon glyphicon-remove"></span> Delete</a>';
                                /*echo '<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#cancelModal">Delete</button>';
                                echo '<div class="modal fade" id="cancelModal" role="dialog" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel" aria-hidden="true">'
                                . '<div class="modal-dialog" role="document">'
                                    . '<div class="modal-content">'
                                        . '<div class="modal-header">'
                                        . '<h5 class="modal-title" id="cancelModalLabel">Delete router</h5>'
                                        . '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'
                                        . '<span aria-hidden="true">&times;</span>'
                                        . '</button></div>'
                                        . '<div class="modal-body">Sei sicuro di voler eliminare <strong>definitivamente</strong> il router?</div>'
                                        . '<div class="modal-footer">'
                                        . '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>'
                                        . '<button type="button" class="btn btn-danger"><a href="routers.php?serialNumber='.$routers->getSerialNumber().'&confirm=confirm"><span class=\'glyphicon glyphicon-trash\'></span> Delete</a></button>'
                                        . '</div></div></div></div>';*/
                                echo '</td>';
                                echo '</tr>';
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>