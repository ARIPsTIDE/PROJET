<?php

include '../inc/header.php';

//include '../../loginUser/lib/user.php';
include 'lib/admin.php';
$user = new admin;

sessionAdmin::adminSession();


?>


<div class="container mt-5">
    <table class="table table-hover">
    <thead class="thead-dark">
        <tr>
        <th scope="col">Id client</th>
        <th scope="col">Nom</th>
        <th scope="col">Prenom</th>
        <th scope="col">Email</th>
        <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
<?php

$userlist = new admin;
$result = $userlist->userList();

if($result){
    foreach($result as $data){ ?>
        <tr>
        <th scope="row"><?php echo $data['id_client']; ?></th>
        <td><?php echo $data['prenom_client']; ?></td>
        <td><?php echo $data['nom_client']; ?></td>
        <td><?php echo $data['mail_client']; ?></td>
        <td><a href="profile.php?id=<?php echo $data['id_client']; ?>"><button class="btn btn-primary btn-sm">View</button></a></td>
        </tr>
<?php }
} ?>
    </tbody>
    </table>
</div>