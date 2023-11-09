<?php

include '../inc/header.php';

//include '../../loginUser/lib/user.php';
include '../lib/user.php';
$user = new user;

sessionAdmin::userSession();


?>
<link rel="stylesheet" href="../assets/css/bootstrap.min.css">


<div class="container mt-5">
    <table class="table table-hover">
    <thead class="thead-dark">
        <tr>
        <th scope="col">Id photo</th>
        <th scope="col">Nom</th>
        <th scope="col">Lien</th>
        <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
<?php

$userlist = new user;
$result = $userlist->photoList();

if($result){
    foreach($result as $data){ ?>
        <tr>
        <th scope="row"><?php echo $data['id_photo']; ?></th>
        <td><?php echo $data['nom_photo']; ?></td>
        <td><?php echo $data['lien_photo']; ?></td>
        <td><a href="traitement_photo.php?id=<?php echo $data['id_photo']; ?>"><button class="btn btn-primary btn-sm">Afficher</button></a></td>
<?php }
} ?>
    </tbody>
    </table>
</div>