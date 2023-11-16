<?php

//header file is included here
include '../inc/header.php';

//user file is included here
include_once '../lib/class_user.php';
$user = new user;

//catching the id which is thrown from index page
if(isset($_GET['id'])){
    $id = $_GET['id'];
}


//user update function is created here
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    $userupdate = $user->userUpdate($id, $_POST);
}

?>
<link rel="stylesheet" href="../assets/css/bootstrap.min.css">

<!-- body area started form here -->

<div class="container w-50 mt-5">
<a href="clientList.php" style="margin-bottom:2vh" class="btn btn-secondary"><img src="../assets/images/fleche_gauche.png" style="height:3vh"> Retour</a>
    <div class="card">
        <div class="card-header bg-dark">
            <h5 class="text-white">Mettre à jour les informations</h5>
        </div>
        <div class="card-body">
            <form action="" method="POST">
<?php

if(isset($userupdate)){
    echo $userupdate;
}

$userdata = $user->userById($id);

if($userdata){
    foreach($userdata as $data){ ?>

                <div class="form-group">
                    <label for="name">Nom</label>
                    <input type="text" name="nom_client" class="form-control" value="<?php echo $data['nom_client'] ?>" id="nom_client">
                </div>
                <div class="form-group">
                    <label for="username">Prenom</label>
                    <input type="text" name="prenom_client" class="form-control" value="<?php echo $data['prenom_client'] ?>" id="prenom_client">
                </div>
                <div class="form-group">
                    <label for="username">Rue</label>
                    <input type="text" name="rue_client" class="form-control" value="<?php echo $data['rue_client'] ?>" id="rue_client">
                </div>
                <div class="form-group">
                    <label for="username">Code postal</label>
                    <input type="text" name="cop_client" class="form-control" value="<?php echo $data['cop_client'] ?>" id="cop_client">
                </div>
                <div class="form-group">
                    <label for="username">Ville</label>
                    <input type="text" name="vil_client" class="form-control" value="<?php echo $data['vil_client'] ?>" id="vil_client">
                </div>
                <div class="form-group">
                    <label for="email">adresse email</label>
                    <input type="email" name="mail_client" class="form-control" value="<?php echo $data['mail_client'] ?>" id="mail_client">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" name="pass_client" class="form-control" value="<?php echo $data['pass_client'] ?>" id="pass_client">
                </div>
                <div class="form-group">
                    <label for="cpassword">Confirm Password</label>
                    <input type="text" name="pass_client" class="form-control" value="<?php echo $data['pass_client'] ?>" id="pass_client">
                </div>
                <div class="form-group">
                    <label for="cpassword">statut</label>
                    <input type="text" name="statut_client" class="form-control" value="<?php echo $data['statut_client'] ?>" id="statut_client">
                </div>
                <div class="form-group">
                    <label for="cpassword">Validation</label>
                    <input type="text" name="valid_client" class="form-control" value="<?php echo $data['valid_client'] ?>" id="valid_client">
                </div>
                
                <button type="submit" name="submit" class="btn btn-sm btn-primary mt-4">Submit</button>
                <a href=""><button type="submit" name="submit" class="btn btn-sm btn-danger mt-4">Delete</button></a>
    <?php }
} ?>
            </form>
        </div>
    </div>
</div>