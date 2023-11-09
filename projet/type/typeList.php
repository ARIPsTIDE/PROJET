<?php

include '../inc/header.php';

//include '../../loginUser/lib/user.php';
include '../lib/user.php';
$user = new user;

sessionAdmin::userSession();


?>
<link rel="stylesheet" href="../assets/css/bootstrap.min.css">


<div class="container mt-5">
    <a style="margin-bottom:2vh" href="typeInsert.php" class="btn btn-secondary">Ajouter un type de bien</a>
    <table class="table table-hover">
    <thead class="thead-dark">
        <tr>
        <th scope="col">Id type</th>
        <th scope="col">Nom</th>
        <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
<?php

$userlist = new user;
$result = $userlist->typeList();

if($result){
    foreach($result as $data){ ?>
        <tr>
        <th scope="row"><?php echo $data['id_type_bien']; ?></th>
        <td><?php echo $data['lib_type_bien']; ?></td>
        <td><a href="traitement_type.php?id=<?php echo $data['id_type_bien']; ?>"><button class="btn btn-primary btn-sm">Afficher</button></a></td>
        </tr>
<?php }
} ?>
    </tbody>
    </table>
</div>