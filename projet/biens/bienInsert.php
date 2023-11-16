<?php

//header file is included here
include '../inc/header.php';

//user file is included here
include '../lib/class_bien.php';
$user = new bien;


if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    $userRegi = $user->bienInsert($_POST);
}

?>

<link rel="stylesheet" href="../assets/css/bootstrap.min.css">


<div class="container w-50 mt-5">
    <a href="bienList.php" style="margin-bottom:2vh" class="btn btn-secondary"><img src="../assets/images/fleche_gauche.png" style="height:3vh"> Retour</a>
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
            <form action="bienInsert.php" method="POST">
                <div class="form-group">
                    <label for="nom_bien">Nom</label>
                    <input type="text" name="nom_bien" class="form-control" id="nom_bien">
                </div>
                <div class="form-group">
                    <label for="rue_bien">Rue</label>
                    <input type="text" name="rue_bien" class="form-control" id="rue_bien">
                </div>
                <div class="form-group">
                    <label for="cop_bien">Code postal</label>
                    <input type="text" name="cop_bien" class="form-control" id="cop_bien">
                </div>
                <div class="form-group">
                    <label for="vil_bien">Ville</label>
                    <input type="text" name="vil_bien" class="form-control" id="vil_bien">
                </div>
                <div class="form-group">
                    <label for="sup_bien">Superfice</label>
                    <input type="text" name="sup_bien" class="form-control" id="sup_bien">
                </div>
                <div class="form-group">
                    <label for="nb_couchage">Nombre de couchages</label>
                    <input type="text" name="nb_couchage" class="form-control" id="nb_couchage">
                </div>
                <div class="form-group">
                    <label for="nb_pieces">SNombre de pièces</label>
                    <input type="text" name="nb_pieces" class="form-control" id="nb_pieces">
                </div>
                <div class="form-group">
                    <label for="nb_chambres">Nombre de chambres</label>
                    <input type="text" name="nb_chambres" class="form-control" id="nb_chambres">
                </div>
                <div class="form-group">
                    <label for="descriptif">Descriptif</label>
                    <input type="text" name="descriptif" class="form-control" id="descriptif">
                </div>
                <div class="form-group">
                    <label for="ref_bien">Référence</label>
                    <input type="text" name="ref_bien" class="form-control" id="ref_bien">
                </div>
                <div class="form-group">
                    <label for="statut_bien">Statut</label>
                    <input type="text" name="statut_bien" class="form-control" id="statut_bien">
                </div>
                <div class="form-group">
                    <label for="id_type_bien">Type de bien</label>
                    <input type="text" name="id_type_bien" class="form-control" id="id_type_bien">
                </div>
                <button type="submit" name="submit" class="btn btn-sm btn-primary mt-4">Envoyer</button>
            </form>
        </div>
    </div>
</div>