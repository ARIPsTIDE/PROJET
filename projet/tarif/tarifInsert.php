<?php

//header file is included here
include '../inc/header.php';

//user file is included here
include '../lib/user.php';
$user = new user;


if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    $userRegi = $user->tarifInsert($_POST);
}

?>

<link rel="stylesheet" href="../assets/css/bootstrap.min.css">


<div class="container w-50 mt-5">
    <a href="tarifList.php" style="margin-bottom:2vh" class="btn btn-secondary"><img src="../assets/images/fleche_gauche.png" style="height:3vh"> Retour</a>
    <div class="card">
        <div class="card-header bg-dark">
            <h5 class="text-white">Créer un nouveau tarif</h5>
        </div>
        <div class="card-body">
<?php

if(isset($userRegi)){
    echo $userRegi;
}

?>
            <form action="tarifInsert.php" method="POST">
                <div class="form-group">
                    <label for="dd_tarif">Date début</label>
                    <input type="date" name="dd_tarif" class="form-control" id="dd_tarif">
                </div>
                <div class="form-group">
                    <label for="df_tarif">Date fin</label>
                    <input type="date" name="df_tarif" class="form-control" id="df_tarif">
                </div>
                <div class="form-group">
                    <label for="prix_loc">Prix</label>
                    <input type="text" name="prix_loc" class="form-control" id="prix_loc">
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