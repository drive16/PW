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
    $switches_list = $dl->listSwitches($userID);
?>

<html>
    <?php
        echo html_head("Network Configurator - Switches");
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
            </ul>
        </div>
        
        <div class="container">
            <header class="header-section">
                <h1>Switches</h1>
            </header>
        </div>
        
        <div class="container">
            <div class="row">
                <div class="col-md-offset-10 col-xs-5">
                    <p>
                        <a class="btn btn-default" href="editSwitches.php"><span class="glyphicon glyphicon-plus"></span> Insert new switch</a>
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
                            foreach ($switches_list as $switches) {
                                echo '<tr>';
                                echo '<td>' . $switches->getName() . '</td>';
                                echo '<td>' . $switches->getModel() . '</td>';
                                echo '<td>' . $switches->getFirmware() . '</td>';
                                echo '<td>' . $switches->getSerialNumber() . '</td>';
                                echo '<td>';
                                echo '<a class="btn btn-primary" href="editSwitches.php?serialNumber=' . $switches->getSerialNumber() . '"><span class="glyphicon glyphicon-pencil"></span> Edit</a>';
                                echo '</td>';
                                echo '<td>';
                                echo '<a class="btn btn-danger" href="deleteSwitches.php?serialNumber=' . $switches->getSerialNumber() . '"><span class="glyphicon glyphicon-remove"></span> Delete</a>';
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