<?php

$filepath = realpath(dirname(__FILE__));
include_once $filepath.'/../clients/lib/session.php';
sessionAdmin::init();



if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action'])){
    sessionAdmin::destroy();
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EasyLoc</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="height: 5vw">
    <a class="navbar-brand" href="index.php">EasyLoc</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
<?php
$adminlogin = sessionAdmin::get("login");
if($adminlogin == true){ ?>
        <li class="nav-item active">
            <a class="nav-link" href="index.php">Accueil<span class="sr-only">(current)</span></a>
        </li>
        <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" style="color:white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Traitement
            </a>

            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="userList.php">Clients</a></li>
                <li><a class="dropdown-item" href="#">Biens</a></li>
                <li><a class="dropdown-item" href="#">Photos</a></li>
                <li><a class="dropdown-item" href="#">Réservations</a></li>
                <li><a class="dropdown-item" href="#">Tarifs</a></li>
                <li><a class="dropdown-item" href="#">Type de biens</a></li>
            </ul>
        </div>
        
        <li class="nav-item">
            <a class="nav-link" href="?action=logout">Se déconnecter</a>
        </li>
<?php }else{ ?>
        <li class="nav-item">
            <a class="nav-link" href="login.php">Se connecter</a>
        </li>
<?php } ?>
        </ul>
    </div>
    </nav>
    
