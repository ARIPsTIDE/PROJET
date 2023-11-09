<?php

//header file is included here
include 'inc/header.php';

//user file is included here
include 'lib/user.php';
$user = new user;


//if user logged in redirect user to index page
sessionAdmin::userLogin();

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    $userLog = $user->adminLogin($_POST);
}

?>

<!-- body area started form here -->

<div class="container w-50 mt-5">
    <div class="card">
        <div class="card-header bg-dark">
            <h5 class="text-white">Connexion à votre compte admin</h5>
        </div>
        <div class="card-body">
<?php

if(isset($userLog)){
    echo $userLog;
}

?>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="username">Nom</label>
                    <input type="text" name="username" class="form-control" id="username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>
                <button type="submit" name="submit" class="btn btn-sm btn-primary mt-4">Connexion</button>
            </form>
        </div>
    </div>
</div>