<?php

include 'inc/header.php';

include_once 'lib/user.php';
$user = new user;

//vérifier s'il existe un id qui vient de la page resList par l'URL
if(isset($_GET['id'])){
    $id = $_GET['id'];
}


//fonction update clients
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    $typeUpdate = $user->typeUpdate($id, $_POST);
}

//fonction delete clients
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])){
    $typeDelete = $user->typeDelete($id, $_POST);
}

?>


<div class="container w-50 mt-5">
    <div class="card">
        <div class="card-header bg-dark">
            <h5 class="text-white">Update your details</h5>
        </div>
        <div class="card-body">
            <form action="" method="POST">
<?php

if(isset($typeUpdate)){
    echo $typeUpdate;
}

$userdata = $user->typeById($id);

if($userdata){
    foreach($userdata as $data){ ?>

                <div class="form-group">
                    <label for="name">Nom du type de biens</label>
                    <input type="text" name="lib_type_bien" class="form-control" value="<?php echo $data['lib_type_bien'] ?>" id="lib_type_bien">
                </div>
                
                <button type="submit" name="submit" class="btn btn-sm btn-primary mt-4">Submit</button>
                <button type="submit" name="delete" class="btn btn-sm btn-danger mt-4">Delete</button>
    <?php }
} ?>
            </form>
        </div>
    </div>
</div>
