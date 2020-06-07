<?php
    require_once('utils/XHTML_functions.php');
    
    spl_autoload_register(function ($class) {
        include 'model/' . $class . '.php';
    });

    $dl = new DataLayer();
    $routers_list = $dl->listRouters();
?>

<html>
    <?php
        echo html_head("Network Configurator - Routers");
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
                        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
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
                        <a class="btn btn-default" href="insertRouter.php"><span class="glyphicon glyphicon-plus"></span> Insert new router</a>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-hover table-responsive" style="width:100%">
                        <col width="10%">
                        <col width="70%">
                        <col width="10%">
                        <col width="10%">

                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Serial Number</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                            foreach ($routers_list as $switches) {
                                echo '<tr>';
                                echo '<td>' . $switches->getName() . '</td>';
                                echo '<td>' . $switches->getSerialNumber() . '</td>';
                                echo '<td>';
                                echo '<a class="btn btn-primary" href="editRouters.php?serialNumber=' . $switches->getSerialNumber() . '"><span class="glyphicon glyphicon-pencil"></span> Edit</a>';
                                echo '</td>';
                                echo '<td>';
                                echo '<a class="btn btn-danger" href="deleteRouters.php?serialNumber=' . $switches->getSerialNumber() . '"><span class="glyphicon glyphicon-remove"></span> Delete</a>';
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