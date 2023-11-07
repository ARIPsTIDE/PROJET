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
    $photoUpdate = $user->photoUpdate($id, $_POST);
}

//fonction delete clients
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])){
    $photoDelete = $user->photoDelete($id, $_POST);
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

if(isset($photoUpdate)){
    echo $photoUpdate;
}

$photodata = $user->photoById($id);

if($photodata){
    foreach($photodata as $data){ ?>

                <div class="form-group">
                    <label for="name">Nom de la photo</label>
                    <input type="text" name="nom_photo" class="form-control" value="<?php echo $data['nom_photo'] ?>" id="nom_photo">   
                </div>
                <div class="form-group">
                    <label for="name">Lien de la photo</label>
                    <input type="text" name="lien_photo" class="form-control" value="<?php echo $data['lien_photo'] ?>" id="lien_photo">   
                </div>
                <div class="form-group">
                    <label for="name">ID bien</label>
                    <input type="text" name="id_bien" class="form-control" value="<?php echo $data['id_bien'] ?>" id="id_bien">   
                </div>
                
                <button type="submit" name="submit" class="btn btn-sm btn-primary mt-4">Submit</button>
                <button type="submit" name="delete" class="btn btn-sm btn-danger mt-4">Delete</button>
    <?php }
} ?>
            </form>
        </div>
    </div>
</div>
