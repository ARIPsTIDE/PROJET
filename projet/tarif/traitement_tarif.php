<?php

include '../inc/header.php';

include_once '../lib/user.php';
$user = new user;

//vérifier s'il existe un id qui vient de la page resList par l'URL
if(isset($_GET['id'])){
    $id = $_GET['id'];
}


//fonction update clients
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    $tarifUpdate = $user->tarifUpdate($id, $_POST);
}

//fonction delete clients
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])){
    $tarifDelete = $user->tarifDelete($id, $_POST);
}

?>
<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
<script type="text/javascript" src="../autocomplete/jquery.min.js"></script>
<script type="text/javascript" src="../autocomplete/script.js"></script>


<div class="container w-50 mt-5">
    <div class="card">
        <div class="card-header bg-dark">
            <h5 class="text-white">Mettre à jour les informations</h5>
        </div>
        <div class="card-body">
            <form action="" method="POST">
<?php

if(isset($tarifUpdate)){
    echo $tarifUpdate;
}

$tarifdata = $user->tarifById($id);

if($tarifdata){
    foreach($tarifdata as $data){ ?>

                <div class="form-group">
                    <label for="name">Date début tarif</label>
                    <input type="date" name="dd_tarif" class="form-control" value="<?php echo $data['dd_tarif'] ?>" id="dd_tarif">
                </div>
                <div class="form-group">
                    <label for="username">Date de fin tarif</label>
                    <input type="date" name="dd_tarif" class="form-control" value="<?php echo $data['dd_tarif'] ?>" id="dd_tarif">
                </div>
                <div class="form-group">
                    <label for="name">Prix de la location</label>
                    <input type="text" name="prix_loc" class="form-control" value="<?php echo $data['prix_loc'] ?>" id="prix_loc">
                </div>
                <!-- <div class="form-group">
                    <label for="username">Id du Bien</label>
                    <input type="text" name="id_bien" class="form-control" value="<?php echo $data['id_bien'] ?>" id="id_bien">
                </div> -->
                <h1 class="main_title">Autocomplétion</h1>
                <div class="content">
                    <form>
                        <div class="label_div">Saisir une lettre: </div>
                        <div class="input_container">
                            <input type="text" id="nom_id" onkeyup="autocomplet()">
                            <input type="text" id="nom2_id">
                            <ul id="nom_list_id"></ul>
                        </div>
                    </form>
                </div><!-- content -->    
                
                <button type="submit" name="submit" class="btn btn-sm btn-primary mt-4">Submit</button>
                <button type="submit" name="delete" class="btn btn-sm btn-danger mt-4">Delete</button>
    <?php }
} ?>
            </form>
        </div>
    </div>
</div>