<?php
    require_once('utils/XHTML_functions.php');
?>

<!DOCTYPE html>
<html>

    <?php
        echo html_head("Network Configuration - Authentication Error")
    ?>
    
    <body>
        <div class="container text-center">
            <div class="row" style="margin-top: 4em;">
                <div class="col-md-6 col-md-offset-3">
                    <div class="panel panel-danger">
                        <div class='panel-heading'>Errore nell'autenticazione</div>
                            <div class='panel-body'>
                                <p>Le credenziali inserite non sono corrette!</p>
                                <p><a class="btn btn-default" href="index.php"><span class='glyphicon glyphicon-log-out'></span> Torna alla Home</a></p>
                                <p><a href="#">Ho dimenticato la password</a></p>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </body>
</html>