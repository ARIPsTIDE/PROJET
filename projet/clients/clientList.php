<?php

//header file is included
include '../inc/header.php';

//user file is included here
include '../lib/class_user.php';
$user = new user;

sessionAdmin::userSession();


?>
<link rel="stylesheet" href="../assets/css/bootstrap.min.css">


<div class="container mt-5">
    <a style="margin-bottom:2vh" href="clientInsert.php" class="btn btn-secondary">Ajouter un client</a>
    <table class="table table-hover">
    <thead class="thead-dark">
        <tr>
        <th scope="col">Id client</th>
        <th scope="col">Prenom</th>
        <th scope="col">Nom</th>
        <th scope="col">Email</th>
        <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
<?php

$userlist = new user;
$result = $userlist->userList();

if($result){
    foreach($result as $data){ ?>
        <tr>
        <th scope="row"><?php echo $data['id_client']; ?></th>
        <td><?php echo $data['prenom_client']; ?></td>
        <td><?php echo $data['nom_client']; ?></td>
        <td><?php echo $data['mail_client']; ?></td>
        <td><a href="traitement_client.php?id=<?php echo $data['id_client']; ?>"><button class="btn btn-primary btn-sm">Afficher</button></a></td>
        </tr>
<?php }
} ?>
    </tbody>
    </table>
</div>