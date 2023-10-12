<?php

//header file is included here
include 'inc/header.php';

//user file is included here
include 'lib/user.php';
$user = new user;

?>

<div class="container w-50 mt-5">
    <div class="card">
        <div class="card-header bg-dark">
            <h5 class="text-white">Mot de passe perdu</h5>
        </div>
        <div class="card-body">
<?php

?>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="username">Nom</label>
                    <input type="text" name="nom" class="form-control" id="nom">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>
                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                    <div class="btn-group me-2" role="group" aria-label="First group">
                        <button type="submit" name="submit" class="btn btn-sm btn-primary mt-4">Modifier</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>