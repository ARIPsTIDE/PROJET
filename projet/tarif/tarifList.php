<?php

include '../inc/header.php';

//include '../../loginUser/lib/user.php';
include '../lib/class_tarif.php';
$user = new tarif;

sessionAdmin::userSession();


?>
<link rel="stylesheet" href="../assets/css/bootstrap.min.css">


<div class="container mt-5">
    <a style="margin-bottom:2vh" href="tarifInsert.php" class="btn btn-secondary">Ajouter un tarif</a>
    <table class="table table-hover">
    <thead class="thead-dark">
        <tr>
        <th scope="col">Id tarif</th>
        <th scope="col">prix</th>
        <th scope="col">ID Bien</th>
        <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
<?php

$userlist = new tarif;
$result = $userlist->tarifList();

if($result){
    foreach($result as $data){ ?>
        <tr>
        <th scope="row"><?php echo $data['id_tarif']; ?></th>
        <td><?php echo $data['prix_loc']; ?></td>
        <td><?php echo $data['id_bien']; ?></td>
        <td><a href="traitement_tarif.php?id=<?php echo $data['id_tarif']; ?>"><button class="btn btn-primary btn-sm">Afficher</button></a></td>
        </tr>
<?php }
} ?>
    </tbody>
    </table>
</div>