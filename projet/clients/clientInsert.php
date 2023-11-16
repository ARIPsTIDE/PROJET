<?php

//header file is included here
include '../inc/header.php';

//user file is included here
include '../lib/class_user.php';
$user = new user;


if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    $userRegi = $user->clientInsert($_POST);
}

?>

<link rel="stylesheet" href="../assets/css/bootstrap.min.css">


<div class="container w-50 mt-5">
    <a href="clientList.php" style="margin-bottom:2vh" class="btn btn-secondary"><img src="../assets/images/fleche_gauche.png" style="height:3vh"> Retour</a>
    <div class="card">
        <div class="card-header bg-dark">
            <h5 class="text-white">Créer un nouveau compte client</h5>
        </div>
        <div class="card-body">
<?php

if(isset($userRegi)){
    echo $userRegi;
}

?>
            <form action="clientInsert.php" method="POST">
                <div class="form-group">
                    <label for="nom_client">nom</label>
                    <input type="text" name="nom_client" class="form-control" id="nom_client">
                </div>
                <div class="form-group">
                    <label for="prenom_client">Prenom</label>
                    <input type="text" name="prenom_client" class="form-control" id="prenom_client">
                </div>
                <div class="form-group">
                    <label for="rue_client">Rue</label>
                    <input type="text" name="rue_client" class="form-control" id="rue_client">
                </div>
                <div class="form-group">
                    <label for="cop_client">Code postal</label>
                    <input type="text" name="cop_client" class="form-control" id="cop_client">
                </div>
                <div class="form-group">
                    <label for="vil_client">Ville</label>
                    <input type="text" name="vil_client" class="form-control" id="vil_client">
                </div>
                <div class="form-group">
                    <label for="mail_client">email</label>
                    <input type="email" name="mail_client" class="form-control" id="mail_client">
                </div>
                <div class="form-group">
                    <label for="pass_client">password</label>
                    <input type="password" name="pass_client" class="form-control" id="pass_client">
                </div>
                <div class="form-group">
                    <label for="statut_client">Statut</label>
                    <input type="text" name="statut_client" class="form-control" id="statut_client">
                </div>
                <div class="form-group">
                    <label for="valid_client">Validation</label>
                    <input type="text" name="valid_client" class="form-control" id="valid_client">
                </div>
                <button type="submit" name="submit" class="btn btn-sm btn-primary mt-4">Envoyer</button>
            </form>
        </div>
    </div>
</div>