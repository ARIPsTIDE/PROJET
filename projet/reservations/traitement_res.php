<?php

include '../inc/header.php';

include_once '../lib/class_res.php';
$user = new reservation;

//vérifier s'il existe un id qui vient de la page resList par l'URL
if(isset($_GET['id'])){
    $id = $_GET['id'];
}


//fonction update clients
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    $resUpdate = $user->resUpdate($id, $_POST);
}

//fonction delete clients
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])){
    $resDelete = $user->resDelete($id, $_POST);
}

?>
<link rel="stylesheet" href="../assets/css/bootstrap.min.css">


<div class="container w-50 mt-5">
<a href="resList.php" style="margin-bottom:2vh" class="btn btn-secondary"><img src="../assets/images/fleche_gauche.png" style="height:3vh"> Retour</a>
    <div class="card">
        <div class="card-header bg-dark">
            <h5 class="text-white">Mettre à jour les informations</h5>
        </div>
        <div class="card-body">
            <form action="" method="POST">
<?php

if(isset($resUpdate)){
    echo $resUpdate;
}

$userdata = $user->userByIdRes($id);

if($userdata){
    foreach($userdata as $data){ ?>

                <div class="form-group">
                    <label for="name">Date réservation</label>
                    <p type="text" name="date_resa" class="form-control" id="date_resa"><?php echo $data['date_resa'] ?></p>
                </div>
                <div class="form-group">
                    <label for="username">Date de début de réservation</label>
                    <p type="text" name="dad_resa" class="form-control" id="dad_resa"><?php echo $data['dad_resa'] ?></p>
                </div>
                <div class="form-group">
                    <label for="name">Date de fin de réservation</label>
                    <p type="text" name="daf_resa" class="form-control" id="daf_resa"><?php echo $data['daf_resa'] ?></p>
                </div>
                <div class="form-group">
                    <label for="username">Commentaire</label>
                    <input type="text" name="commentaire" class="form-control" value="<?php echo $data['commentaire'] ?>" id="commentaire">
                </div>
                <div class="form-group">
                    <label for="email">Modération</label>
                    <input type="text" name="moderation" class="form-control" value="<?php echo $data['moderation'] ?>" id="moderation">
                </div>
                <div class="form-group">
                    <label for="email">Annulation de réservation</label>
                    <input type="text" name="annul_resa" class="form-control" value="<?php echo $data['annul_resa'] ?>" id="annul_resa">
                </div>
                <div class="form-group">
                    <label for="password">Nom du client</label>
                    <input type="text" name="nom_client" class="form-control" value="<?php echo $data['nom_client'] ?>" id="nom_client">
                </div>
                <div class="form-group">
                    <label for="cpassword">Bien</label>
                    <input type="text" name="nom_bien" class="form-control" value="<?php echo $data['nom_bien'] ?>" id="nom_bien">
                </div>
                
                <button type="submit" name="submit" class="btn btn-sm btn-primary mt-4">Submit</button>
                <button type="submit" name="delete" class="btn btn-sm btn-danger mt-4">Delete</button>
    <?php }
} ?>
            </form>
        </div>
    </div>
</div>