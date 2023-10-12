
<?php
include '../inc/header.php';

include 'lib/admin.php';
$user = new admin;

//si l'admin se log il est rediriger vers la page index
sessionAdmin::adminLogin();

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    $adminLog = $user->adminLogin($_POST);
}

?>


<div class="container w-50 mt-5">
    <div class="card">
        <div class="card-header bg-dark">
            <h5 class="text-white">Connexion à votre compte administrateur</h5>
        </div>
        <div class="card-body">
<?php

if(isset($adminLog)){
    echo $adminLog;
}

?>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="username">Nom</label>
                    <input type="text" name="nom" class="form-control" id="nom">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>
                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                    <div class="btn-group me-2" role="group" aria-label="First group">
                        <button type="submit" name="submit" class="btn btn-sm btn-primary mt-4">Créer</button>
                    </div>
                    <div class="btn-group me-2" role="group" aria-label="Second group">
                        <a type="button" href="resetMDP.php" style="margin-left: 10px" class="btn btn-sm btn-secondary mt-4">Mot de passe oublié ?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>