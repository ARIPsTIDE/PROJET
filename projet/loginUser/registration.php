<?php

//header file is included here
include 'inc/header.php';

//user file is included here
include 'lib/user.php';
$user = new user;



//if user logged in redirect user to index page
session::userLogin();



if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    $userRegi = $user->userRegistration($_POST);
}

?>

<!-- body area started form here -->

<div class="container w-50 mt-5">
    <div class="card">
        <div class="card-header bg-dark">
            <h5 class="text-white">Crée votre compte</h5>
        </div>
        <div class="card-body">
<?php

if(isset($userRegi)){
    echo $userRegi;
}

?>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="name">Nom</label>
                    <input type="text" name="nom" class="form-control" id="nom">
                </div>
                <div class="form-group">
                    <label for="username">Prenom</label>
                    <input type="text" name="prenom" class="form-control" id="prenom">
                </div>
                <div class="form-group">
                    <label for="username">Rue</label>
                    <input type="text" name="rue" class="form-control" id="rue">
                </div>
                <div class="form-group">
                    <label for="username">Code postal</label>
                    <input type="text" name="cop" class="form-control" id="cop">
                </div>
                <div class="form-group">
                    <label for="username">Ville</label>
                    <input type="text" name="ville" class="form-control" id="ville">
                </div>
                <div class="form-group">
                    <label for="email">Adresse email</label>
                    <input type="email" name="email" class="form-control" id="email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>
                <div class="form-group">
                    <label for="cpassword">Confirm Password</label>
                    <input type="password" name="cpassword" class="form-control" id="cpassword">
                </div>
                <!-- <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>
                <div class="form-group">
                    <label for="cpassword">Confirm Password</label>
                    <input type="password" name="cpassword" class="form-control" id="cpassword">
                </div> -->
                <div class="form-check">
                    <input type="checkbox" name="terms" class="form-check-input" id="terms">
                    <label class="form-check-label" for="terms">J'accepte les conditions et les termes d'utilisation</label>
                </div>
                <button type="submit" id="submit" name="submit" class="btn btn-sm btn-primary mt-4">Submit</button>
              
            </form>
        </div>
    </div>
</div>