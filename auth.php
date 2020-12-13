<?php

    require_once('utils/XHTML_functions.php');

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    spl_autoload_register(function ($class) {
        include 'model/' . $class . '.php';
    });

    $dl = new DataLayer();
    
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        if(isset($_POST["login-submit"])) {
            if($dl->validUser($_POST["Username"], $_POST["Password"])) {    
                session_start();
                $_SESSION["logged"] = true;
                $_SESSION["loggedName"] = $_POST["Username"];
                if(!empty($_POST["Remember"])) {
                    setcookie("username_login", $_POST["Username"], time() + (60*60*24*365*10));
                } else {
                    if(isset($_COOKIE["username_login"])) {
                        setcookie("username_login", "", time() - 1 );
                    }
                }
                header("location: index.php");
            } else {
                header("location: authErrorPage.php");
            } 
        } elseif (isset ($_POST["register-submit"])) {
            $dl->addUser($_POST["Username"], $_POST["Password"], $_POST["Email"]);
        }
    }
?>

<!DOCTYPE html>
<html>

    <?php
        echo html_head("Network Configurator - Authentication")
    ?>
    
    <body>
        <div class="container">
            <div class="row" style="margin-top: 4em;">
                <div class="col-md-6 col-md-offset-3">
                    <div>
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#login-form" data-toggle="tab">Login</a></li>
                            <li><a href="#register-form" data-toggle="tab">Registrazione</a></li>
                        </ul>
                    </div>
                    
                    <div class="tab-content">
                        <div class="tab-pane active" id="login-form">
                            <form id="login-form" action="#" method="post" style="margin-top: 2em;">
                                <div class="form-group">
                                    <input type="text" name="Username" class="form-control" placeholder="Username" value="<?php if(isset($_COOKIE["username_login"])) {echo $_COOKIE["username_login"];} ?>"/>
                                </div>
                                
                                <div class="form-group">
                                    <input type="password" name="Password" class="form-control" placeholder="Password" value=""/>
                                </div>
                                
                                <div class="form-group text-center">
                                    <input type="checkbox" name="Remember" <?php if(isset($_COOKIE["username_login"])) {echo 'checked';} ?>/>
                                    <label for="remember">Remember me</label>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input class="form-control btn btn-primary" type="submit" name="login-submit" value="Log In"/>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="text-center">
                                        <a href="#">Ho dimenticato la password</a>
                                    </div>
                                </div>
                            </form>

                        </div>
                        
                        <div class="tab-pane" id="register-form">
                            <form id="register-form" action="#" method="post" style="margin-top: 2em;">
                                <div class="form-group">
                                    <input type="text" name="Username" class="form-control" placeholder="Username" value=""/>
                                </div>
                                
                                <div class="form-group">
                                    <input type="text" name="Email" class="form-control" placeholder="Indirizzo Mail" value=""/>
                                </div>
                                
                                <div class="form-group text-center">
                                    <input type="password" name="Password" class="form-control" placeholder="Password" value=""/>
                                </div>
                                
                                <div class="form-group text-center">
                                    <input type="password" name="Confirm-Password" class="form-control" placeholder=" Confirm Password" value=""/>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input class="form-control btn btn-primary" type="submit" name="register-submit" value="Registrati Ora"/>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

</html>