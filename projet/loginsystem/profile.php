<?php

//header file is included here
include 'inc/header.php';

//user file is included here
include_once 'lib/user.php';
$user = new user;

//catching the id which is thrown from index page
if(isset($_GET['id'])){
    $id = $_GET['id'];
}


//user update function is created here
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    $userupdate = $user->userUpdate($id, $_POST);
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])){
    $userupdate = $user->userDelete($id, $_POST);
}

?>

<!-- body area started form here -->

<div class="container w-50 mt-5">
    <div class="card">
        <div class="card-header bg-dark">
            <h5 class="text-white">Update your details</h5>
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
                    <input type="text" name="nom" class="form-control" value="<?php echo $data['nom_client'] ?>" id="nom">
                </div>
                <div class="form-group">
                    <label for="username">Prenom</label>
                    <input type="text" name="prenom" class="form-control" value="<?php echo $data['prenom_client'] ?>" id="prenom">
                </div>
                <div class="form-group">
                    <label for="name">Rue</label>
                    <input type="text" name="rue" class="form-control" value="<?php echo $data['rue_client'] ?>" id="rue">
                </div>
                <div class="form-group">
                    <label for="username">Code postal</label>
                    <input type="text" name="cop" class="form-control" value="<?php echo $data['cop_client'] ?>" id="cop">
                </div>
                <div class="form-group">
                    <label for="email">Ville</label>
                    <input type="text" name="ville" class="form-control" value="<?php echo $data['vil_client'] ?>" id="ville">
                </div>
                <div class="form-group">
                    <label for="email">Adresse email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo $data['mail_client'] ?>" id="email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" name="password" class="form-control" value="<?php echo $data['pass_client'] ?>" id="password">
                </div>
                <div class="form-group">
                    <label for="cpassword">Confirm Password</label>
                    <input type="text" name="cpassword" class="form-control" value="<?php echo $data['pass_client'] ?>" id="cpassword">
                </div>
                <div class="form-group">
                    <label for="password">Satut</label>
                    <input type="text" name="statut" class="form-control" value="<?php echo $data['statut_client'] ?>" id="statut">
                </div>
                <div class="form-group">
                    <label for="password">Validation du compte</label>
                    <input type="text" name="valid" class="form-control" value="<?php echo $data['valid_client'] ?>" id="valid">
                </div>
                
                <button type="submit" name="submit" class="btn btn-sm btn-primary mt-4">Submit</button>
                <button type="submit" name="delete" class="btn btn-sm btn-danger mt-4">Delete</button>
    <?php }
} ?>
            </form>
        </div>
    </div>
</div>