<?php

$filepath = realpath(dirname(__FILE__));
include_once $filepath.'/../lib/session.php';
sessionAdmin::init();



//logout mechanism is created here
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
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="../index.php">EasyLoc</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
<?php
$userlogin = sessionAdmin::get("login");
if($userlogin == true){ ?>
        <li class="nav-item active">
            <a class="nav-link" href="index.php">Accueil <span class="sr-only">(current)</span></a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="?action=logout">Se déconnecter</a>
        </li>
<?php }else{ ?>
        <li class="nav-item">
            <a class="nav-link" href="login.php">Se connecter</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?action=logout">Se déconnecter</a>
        </li>
<?php } ?>
        </ul>
    </div>
    </nav>
    
