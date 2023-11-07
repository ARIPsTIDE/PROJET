<?php

include 'inc/header.php';

//include '../../loginUser/lib/user.php';
include 'lib/user.php';
$user = new user;

sessionAdmin::userSession();


?>


<div class="container mt-5">
    <table class="table table-hover">
    <thead class="thead-dark">
        <tr>
        <th scope="col">Id bien</th>
        <th scope="col">Nom</th>
        <th scope="col">Référence</th>
        <th scope="col">Statut</th>
        <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
<?php

$userlist = new user;
$result = $userlist->bienList();

if($result){
    foreach($result as $data){ ?>
        <tr>
        <th scope="row"><?php echo $data['id_bien']; ?></th>
        <td><?php echo $data['nom_bien']; ?></td>
        <td><?php echo $data['ref_bien']; ?></td>
        <td><?php echo $data['statut_bien']; ?></td>
        <td><a href="traitement_bien.php?id=<?php echo $data['id_bien']; ?>"><button class="btn btn-primary btn-sm">Afficher</button></a></td>
        </tr>
<?php }
} ?>
    </tbody>
    </table>
</div>