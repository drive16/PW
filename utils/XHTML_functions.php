<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function html_head($titolo) {
    $result = '  <head>';
    $result .= '    <meta charset="UTF-8">';
    $result .= '    <title>'.$titolo.'</title>';
    $result .= '    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">';
    $result .= '    <!-- Fogli di stile -->';
    $result .= '    <link rel="stylesheet" href="css/bootstrap.css">';
    $result .= '    <link rel="stylesheet" href="css/style.css"';
    $result .= '    <!-- jQuery e plugin JavaScript -->';
    $result .= '    <script src="http://code.jquery.com/jquery.js"></script>';
    $result .= '    <script src="js/bootstrap.min.js"></script>';
    $result .= '  </head>';
    
    return $result;
}

?>