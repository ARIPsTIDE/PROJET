<?php

include '../inc/header.php';

include_once '../lib/class_bien.php';
$user = new bien;

//vérifier s'il existe un id qui vient de la page resList par l'URL
if(isset($_GET['id'])){
    $id = $_GET['id'];
}


//fonction update clients
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    $bienUpdate = $user->bienUpdate($id, $_POST);
}

//fonction delete clients
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])){
    $bienDelete = $user->bienDelete($id, $_POST);
}

?>
<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
<script type="text/javascript" src="scriptCommune.js"></script>



<div class="container w-50 mt-5">
    <a href="bienList.php" style="margin-bottom:2vh" class="btn btn-secondary"><img src="../assets/images/fleche_gauche.png" style="height:3vh"> Retour</a>
    <div class="card">
        <div class="card-header bg-dark">
            <h5 class="text-white">Mettre à jour les informations</h5>
        </div>
        <div class="card-body">
            <form action="" method="POST">
<?php

if(isset($bienUpdate)){
    echo $bienUpdate;
}

$biendata = $user->bienById($id);

if($biendata){
    foreach($biendata as $data){ ?>

                <div class="form-group">
                    <label for="name">Nom du bien</label>
                    <input type="text" name="nom_bien" class="form-control" value="<?php echo $data['nom_bien'] ?>" id="nom_bien">
                </div>
                <div class="form-group">
                    <label for="username">rue du bien</label>
                    <input type="text" name="rue_bien" class="form-control" value="<?php echo $data['rue_bien'] ?>" id="rue_bien">
                </div>
                <div class="form-group"> 
                        <label for="name">Ville et code postal fff</label>
                        <p name="communes" class="form-control" id="communes"><?php echo $data['commune'] ?><p>
                        <div class="input_container">
                            <input type="text" class="form-control" name="commune" id="commune" onkeyup="autocompletCommune()">
                            <ul id="commune_list"></ul>
                        </div>
                </div>  
                <div class="form-group">
                    <label for="name">Superficie du bien</label>
                    <input type="text" name="sup_bien" class="form-control" value="<?php echo $data['sup_bien'] ?>" id="sup_bien">
                </div>
                <div class="form-group">
                    <label for="username">Nombre de couchage</label>
                    <input type="text" name="nb_couchage" class="form-control" value="<?php echo $data['nb_couchage'] ?>" id="nb_couchage">
                </div>
                <div class="form-group">
                    <label for="name">Nombres de pièces</label>
                    <input type="text" name="nb_pieces" class="form-control" value="<?php echo $data['nb_pieces'] ?>" id="nb_pieces">
                </div>
                <div class="form-group">
                    <label for="username">Nombres de chambres</label>
                    <input type="text" name="nb_chambres" class="form-control" value="<?php echo $data['nb_chambres'] ?>" id="nb_chambres">
                </div>
                <div class="form-group">
                    <label for="name">Descriptif du bien</label>
                    <input type="text" name="descriptif" class="form-control" value="<?php echo $data['descriptif'] ?>" id="descriptif">
                </div>
                <div class="form-group">
                    <label for="username">Référence du bien</label>
                    <input type="text" name="ref_bien" class="form-control" value="<?php echo $data['ref_bien'] ?>" id="ref_bien">
                </div>
                <div class="form-group">
                    <label for="name">Statut du bien</label>
                    <input type="text" name="statut_bien" class="form-control" value="<?php echo $data['statut_bien'] ?>" id="statut_bien">
                </div>
                <div class="form-group"> 
                        <label for="id_type_bien">Type de bien</label>
                        <p name="id_type_bien" class="form-control" id="id_type_bien"><?php echo $data['id_type_bien'] ?><p>
                        <div class="input_container">
                            <input type="text" class="form-control" name="nom_id" id="nom_id" onkeyup="autocomplet()">
                            <ul id="nom_list_id"></ul>
                        </div>
                </div>
                
                <button type="submit" name="submit" class="btn btn-sm btn-primary mt-4">Submit</button>
                <button type="submit" name="delete" class="btn btn-sm btn-danger mt-4">Delete</button>
    <?php }
} ?>
            </form>
        </div>
    </div>
</div>