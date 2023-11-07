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