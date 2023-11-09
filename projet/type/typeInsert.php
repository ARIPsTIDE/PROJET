<?php

//header file is included here
include '../inc/header.php';

//user file is included here
include '../lib/user.php';
$user = new user;


if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    $userRegi = $user->typeInsert($_POST);
}

?>

<link rel="stylesheet" href="../assets/css/bootstrap.min.css">


<div class="container w-50 mt-5">
    <a href="typeList.php" style="margin-bottom:2vh" class="btn btn-secondary"><img src="../assets/images/fleche_gauche.png" style="height:3vh"> Retour</a>
    <div class="card">
        <div class="card-header bg-dark">
            <h5 class="text-white">Créer un nouveau type de bien</h5>
        </div>
        <div class="card-body">
<?php

if(isset($userRegi)){
    echo $userRegi;
}

?>
            <form action="typeInsert.php" method="POST">
                <div class="form-group">
                    <label for="lib_type_bien">Nom</label>
                    <input type="text" name="lib_type_bien" class="form-control" id="lib_type_bien">
                </div>
                <button type="submit" name="submit" class="btn btn-sm btn-primary mt-4">Envoyer</button>
            </form>
        </div>
    </div>
</div>