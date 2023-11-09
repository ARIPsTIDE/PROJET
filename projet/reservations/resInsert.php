<?php

//header file is included here
include '../inc/header.php';

//user file is included here
include '../lib/user.php';
$user = new user;


if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    $userRegi = $user->resInsert($_POST);
}

?>

<link rel="stylesheet" href="../assets/css/bootstrap.min.css">


<div class="container w-50 mt-5">
    <a href="resList.php" style="margin-bottom:2vh" class="btn btn-secondary"><img src="../assets/images/fleche_gauche.png" style="height:3vh"> Retour</a>
    <div class="card">
        <div class="card-header bg-dark">
            <h5 class="text-white">Créer un nouveau bien</h5>
        </div>
        <div class="card-body">
<?php

if(isset($userRegi)){
    echo $userRegi;
}

?>
            <form action="resInsert.php" method="POST">
                <div class="form-group">
                    <label for="date_resa">Date de réservation</label>
                    <input type="date" name="date_resa" class="form-control" id="date_resa">
                </div>
                <div class="form-group">
                    <label for="dad_resa">Date de début réservation</label>
                    <input type="date" name="dad_resa" class="form-control" id="dad_resa">
                </div>
                <div class="form-group">
                    <label for="daf_resa">Date de fin réservation</label>
                    <input type="date" name="daf_resa" class="form-control" id="daf_resa">
                </div>
                <div class="form-group">
                    <label for="commentaire">Commentaire</label>
                    <input type="text" name="commentaire" class="form-control" id="commentaire">
                </div>
                <div class="form-group">
                    <label for="moderation">Modération</label>
                    <input type="text" name="moderation" class="form-control" id="moderation">
                </div>
                <div class="form-group">
                    <label for="annul_resa">Annulation réservation</label>
                    <input type="text" name="annul_resa" class="form-control" id="annul_resa">
                </div>
                <div class="form-group">
                    <label for="id_client">Client</label>
                    <input type="text" name="id_client" class="form-control" id="id_client">
                </div>
                <div class="form-group">
                    <label for="id_bien">Bien</label>
                    <input type="text" name="id_bien" class="form-control" id="id_bien">
                </div>
                <button type="submit" name="submit" class="btn btn-sm btn-primary mt-4">Envoyer</button>
            </form>
        </div>
    </div>
</div>