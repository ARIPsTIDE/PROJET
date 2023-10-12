<?php

include '../inc/header.php';

//include '../../loginUser/lib/user.php';
include 'class_res.php';
$user = new reservation;

sessionAdmin::adminSession();


?>


<div class="container mt-5">
    <table class="table table-hover">
    <thead class="thead-dark">
        <tr>
        <th scope="col">Id clients</th>
        <th scope="col">Nom</th>
        <th scope="col">Email</th>
        <th scope="col">Date de réservation</th>
        <th scope="col">Id réservation</th>
        <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
<?php

$userlist = new reservation;
$result = $userlist->resList();

if($result){
    foreach($result as $data){ ?>
        <tr>
        <th scope="row"><?php echo $data['id_client']; ?></th>
        <td><?php echo $data['nom_client']; ?></td>
        <td><?php echo $data['mail_client']; ?></td>
        <td><?php echo $data['date_resa']; ?></td>
        <td><?php echo $data['id_reservation']; ?></td>
        <td><a href="traitement_res.php?id=<?php echo $data['id_client']; ?>"><button class="btn btn-primary btn-sm">Afficher</button></a></td>
        </tr>
<?php }
} ?>
    </tbody>
    </table>
</div>