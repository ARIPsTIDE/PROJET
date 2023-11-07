<?php

//sessoin is included for once 
//if it exist it will not work it not then it will load
include_once 'session.php';

//database is included here
include 'database.php';


//all mechanism started from here

class user{
    private $db;

    public function __construct(){
        $this->db = new database;
    }


    //user registration mechanism is created here
    public function userRegistration($data){
        $name       = $data['name'];
        $username   = $data['username'];
        $email      = $data['email'];
        $password   = $data['password'];
        $cpassword  = $data['cpassword'];
        $emailcheck = $this->checkEmail($email);


        //empty validation of fields
        if($name ==  "" OR $username ==  "" OR $email ==  "" OR $password ==  "" OR $cpassword ==  ""){
            $msg = "<div class='alert alert-danger'>* Fileds are required!</div>";
            return $msg;
        }


        //password and confirm password length validation
        if(strlen($password) < 12 && strlen($cpassword) < 12){
            $msg = "<div class='alert alert-danger'>* Password can not be less than 5 characters</div>";
            return $msg;
        }elseif(strlen($password) > 30 && strlen($cpassword) > 30){
            $msg = "<div class='alert alert-danger'>* Password can not be more than 15 characters</div>";
            return $msg;
        }

        //passwords equality validation
        if($password != $cpassword){
            $msg = "<div class='alert alert-danger'>* Password are not the same</div>";
            return $msg;
        }


        //email vaidation
        if(filter_var($email, FILTER_VALIDATE_EMAIL) == false){
            $msg = "<div class='alert alert-danger'>* Email is not valid!</div>";
            return $msg;
        }


        //email existence validation
        if($emailcheck == true){
            $msg = "<div class='alert alert-danger'>* Email already exist!</div>";
            return $msg;
        }


        
        //insert data if there is no error            
        $query = "INSERT INTO `users`(`user_name`, `user_username`, `user_email`, `user_password`) VALUES (:name, :username, :email, :password)";
        $sql = $this->db->pdo->prepare($query);
        $sql->bindValue(':name', $name);
        $sql->bindValue(':username', $username);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':password', $password);
        $result = $sql->execute();

        if($result){
            $msg = "<div class='alert alert-success'>* Your account is created successfully</div>";
            return $msg;
            header("location: login.php");
        }

        
}


    //email existence check before account registering
    public function checkEmail($email){

        $query = "SELECT * FROM admin WHERE `mail` = :email";
        $sql = $this->db->pdo->prepare($query);
        $sql->bindValue(':email', $email);
        $sql->execute();

        if($sql->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }



    //user login mechanism is created here
    public function adminLogin($data){
        $username = $data['username'];
        $password = $data['password'];

        //empty value validation
        if($username == "" OR $password == ""){
            $msg = "<div class='alert alert-danger'>* Fields are required</div>";
            return $msg;
        }


        //password validation
        if(strlen($password) <12 && strlen($password) > 30){
            $msg = "<div class='alert alert-danger'>* Password should be between 5-15 characters</div>";
            return $msg;
        }


        //user will be login if there is no error

        $result = $this->getLoginUserData($username, $password);
        
        if($result){
            sessionAdmin::init();
            sessionAdmin::set("login", true);
            // sessionAdmin::set("id", $result->id);
            // sessionAdmin::set("name", $result->name);
            // sessionAdmin::set("username", $result->username);
            // sessionAdmin::set("email", $result->email);
            sessionAdmin::set("loginmsg", "<div class='container'><div class='alert alert-success'>You are logged in</div></div>");
            header("location: index.php");
        }else{
            echo "<div class='container mt-5'><div class='alert alert-danger'>Username and Passwords are not correct</div></div>";
        }
    }


    
    //user data fetch form database
    public function getLoginUserData($username, $password){

        $query = "SELECT * FROM admin WHERE `nom` = :username AND `password` = :password";
        $sql = $this->db->pdo->prepare($query);
        $sql->bindValue(':username', $username);
        $sql->bindValue(':password', $password);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_OBJ);
        return $result;
    }


    //get all data from the database
    public function userList(){
        
        $query = "SELECT * FROM clients";
        $sql = $this->db->pdo->prepare($query);
        $sql->execute();
        $result = $sql->fetchAll();
        return $result;
    }

    //get all data from database based on id
    public function userById($id_client){

        $query = "SELECT * FROM clients WHERE `id_client` = :id_client";
        $sql = $this->db->pdo->prepare($query);
        $sql->bindValue(':id_client', $id_client);
        $sql->execute();
        $result = $sql->fetchAll();
        return $result;
    }


    //user update mechanism is created here
    public function userUpdate($id_client, $data){
        $nom_client       = $data['nom_client'];
        $prenom_client   = $data['prenom_client'];
        $rue_client      = $data['rue_client'];
        $cop_client   = $data['cop_client'];
        $vil_client  = $data['vil_client'];
        $mail_client      = $data['mail_client'];
        $pass_client   = $data['pass_client'];
        $statut_client  = $data['statut_client'];
        $valid_client  = $data['valid_client'];
        $emailcheck = $this->checkEmail($mail_client);


        //empty validation of fields
        if($nom_client ==  "" OR $prenom_client ==  "" OR $rue_client ==  "" OR $cop_client ==  "" OR $vil_client ==  "" OR $mail_client ==  "" OR $pass_client ==  "" OR $statut_client ==  "" 
            OR $valid_client ==  ""){
            $msg = "<div class='alert alert-danger'>* Fileds are required!</div>";
            return $msg;
        }

        //password and confirm password length validation
        if(strlen($pass_client) < 12 && strlen($pass_client) < 12){
            $msg = "<div class='alert alert-danger'>* Password can not be less than 5 characters</div>";
            return $msg;
        }elseif(strlen($pass_client) > 30 && strlen($pass_client) > 30){
            $msg = "<div class='alert alert-danger'>* Password can not be more than 15 characters</div>";
            return $msg;
        }

        //passwords equality validation
        if($pass_client != $pass_client){
            $msg = "<div class='alert alert-danger'>* Password are not the same</div>";
            return $msg;
        }


        //email vaidation
        if(filter_var($mail_client, FILTER_VALIDATE_EMAIL) == false){
            $msg = "<div class='alert alert-danger'>* Email is not valid!</div>";
            return $msg;
        }


        //email existence validation
        if($emailcheck == true){
            $msg = "<div class='alert alert-danger'>* Email already exist!</div>";
            return $msg;
        }


        
        //insert data if there is no error            
        $query = "UPDATE `clients` SET `nom_client`=:nom_client,`prenom_client`=:prenom_client,`rue_client`=:rue_client,`cop_client`=:cop_client, vil_client=:vil_client, 
                                        mail_client=:mail_client, pass_client=:pass_client, statut_client=:statut_client, valid_client=:valid_client WHERE `id_client` = :id_client";
        $sql = $this->db->pdo->prepare($query);
        $sql->bindValue(':nom_client', $nom_client);
        $sql->bindValue(':prenom_client', $prenom_client);
        $sql->bindValue(':rue_client', $rue_client);
        $sql->bindValue(':cop_client', $cop_client);
        $sql->bindValue(':vil_client', $vil_client);
        $sql->bindValue(':mail_client', $mail_client);
        $sql->bindValue(':pass_client', $pass_client);
        $sql->bindValue(':statut_client', $statut_client);
        $sql->bindValue(':valid_client', $valid_client);
        $sql->bindValue(':id_client', $id_client);
        $result = $sql->execute();

        if($result){
            $msg = "<div class='alert alert-success'>* Your updated successfully</div>";
            return $msg;
        }
    }

//*************************   PARTIES RESERVATION ***************************************** */

    //récupère les informations de tout les clients et leurs réservations
    public function resList(){
        
        $query = "SELECT res.id_reservation, res.date_resa, clients.nom_client, clients.mail_client, clients.id_client FROM reservations res
                    INNER JOIN clients clients 
                    ON clients.id_client = res.id_client";
        $sql = $this->db->pdo->prepare($query);
        $sql->execute();
        $result = $sql->fetchAll();
        return $result;
    }
    //récupère les informations d'un client par rapports a son id
    public function userByIdRes($id_client){

        $query = "SELECT * FROM reservations res
                    INNER JOIN clients clients 
                    ON clients.id_client = res.id_client
                    INNER JOIN biens biens 
                    ON biens.id_bien = res.id_bien 
                    WHERE clients.id_client = :id";
        $sql = $this->db->pdo->prepare($query);
        $sql->bindValue(':id', $id_client);
        $sql->execute();
        $result = $sql->fetchAll();
        return $result;
    }

    //suppression d'un client
    public function resDelete($id) {
        // Prépare la requête SQL pour supprimer un utilisateur en fonction de son ID
        $query = "DELETE FROM reservations WHERE id_reservation = :id";
        $sql = $this->db->pdo->prepare($query);
        
        // Lie la valeur de :id à la variable $id
        $sql->bindValue(':id', $id);
        
        // Exécute la requête SQL
        $result = $sql->execute();

        header('location: resList.php');
    }


    //modification d'un client
    public function resUpdate($id, $data){
        $date_resa      = $data['date_resa '];
        $dad_resa   = $data['dad_resa'];
        $daf_resa        = $data['daf_resa'];
        $commentaire        = $data['commentaire'];
        $moderation      = $data['moderation'];
        $annul_resa      = $data['annul_resa'];
        $id_client   = $data['id_client'];
        $id_bien  = $data['id_bien'];


        if($date_resa==  "" OR $dad_resa ==  "" OR $daf_resa == "" OR $commentaire == "" OR $moderation == "" OR $annul_resa ==  "" OR $id_client ==  "" OR $id_bien ==  ""){
            $msg = "<div class='alert alert-danger'>* Fileds are required!</div>";
            return $msg;
        }

        
        //insertion des données s'il ny a pas d'erreurs          
        $query = "UPDATE reservations SET date_resa=:date_resa, dad_resa=:dad_resa, daf_resa=:daf_resa, commentaire=:commentaire, moderation=:moderation, annul_resa=:annul_resa, id_client=:id_client, id_bien=:id_bien WHERE id_reservation = :id";
        $sql = $this->db->pdo->prepare($query);
        $sql->bindValue(':date_resa', $date_resa);
        $sql->bindValue(':dad_resa', $dad_resa);
        $sql->bindValue(':daf_resa', $daf_resa);
        $sql->bindValue(':commentaire', $commentaire);
        $sql->bindValue(':moderation', $moderation);
        $sql->bindValue(':annul_resa', $annul_resa);
        $sql->bindValue(':id_client', $id_client);    
        $sql->bindValue(':id_bien', $id_bien);
        $sql->bindValue(':id', $id);
        $result = $sql->execute();

        if($result){
            $msg = "<div class='alert alert-success'>* Your updated successfully</div>";
            return $msg;
        }
    }

    //*******************************************PARTIE TYPE_BIENS************************************/


    public function typeList(){
        
        $query = "SELECT * FROM type_bien";
        $sql = $this->db->pdo->prepare($query);
        $sql->execute();
        $result = $sql->fetchAll();
        return $result;
    }

    //suppression d'un client
    public function typeDelete($id_type) {
        // Prépare la requête SQL pour supprimer un utilisateur en fonction de son ID
        $query = "DELETE FROM type_bien WHERE id_type_bien = :id_type";
        $sql = $this->db->pdo->prepare($query);
        
        // Lie la valeur de :id à la variable $id
        $sql->bindValue(':id_type', $id_type);
        
        // Exécute la requête SQL
        $result = $sql->execute();

        header('location: typeList.php');
    }


    //modification d'un client
    public function typeUpdate($id_type, $data){
        $date_resa      = $data['lib_type_biens'];

        if($date_resa==  ""){
            $msg = "<div class='alert alert-danger'>* Fileds are required!</div>";
            return $msg;
        }

        
        //insertion des données s'il ny a pas d'erreurs          
        $query = "UPDATE type_bien SET lib_type_bien =:lib_type_bien WHERE id_type_bien = :id_type";
        $sql = $this->db->pdo->prepare($query);
        $sql->bindValue(':date_resa', $date_resa);
        $sql->bindValue(':id', $id_type);
        $result = $sql->execute();

        if($result){
            $msg = "<div class='alert alert-success'>* Your updated successfully</div>";
            return $msg;
        }
    }

    public function typeById($id_type){

        $query = "SELECT * FROM type_bien
                    WHERE id_type_bien = :id_type";
        $sql = $this->db->pdo->prepare($query);
        $sql->bindValue(':id_type', $id_type);
        $sql->execute();
        $result = $sql->fetchAll();
        return $result;
    }

    //*******************************************PARTIE PHOTOS************************************/

    public function photoList(){
        
        $query = "SELECT * FROM photos";
        $sql = $this->db->pdo->prepare($query);
        $sql->execute();
        $result = $sql->fetchAll();
        return $result;
    }

    //suppression d'un client
    public function photoDelete($id_photo) {
        // Prépare la requête SQL pour supprimer un utilisateur en fonction de son ID
        $query = "DELETE FROM photos WHERE id_photo = :id_photo";
        $sql = $this->db->pdo->prepare($query);
        
        // Lie la valeur de :id à la variable $id
        $sql->bindValue(':id_photo', $id_photo);
        
        // Exécute la requête SQL
        $result = $sql->execute();

        header('location: photoList.php');
    }


    //modification d'un client
    public function photoUpdate($id_photo, $data){
        $nom_photo      = $data['nom_photo'];
        $lien_photo     = $data['lien_photo'];
        $id_bien     = $data['id_bien'];

        
        //insertion des données s'il ny a pas d'erreurs          
        $query = "UPDATE photos SET nom_photo =:nom_photo, lien_photo =:lien_photo, id_bien =:id_bien WHERE id_photo = :id_photo";
        $sql = $this->db->pdo->prepare($query);
        $sql->bindValue(':nom_photo', $nom_photo);
        $sql->bindValue(':lien_photo', $lien_photo);
        $sql->bindValue(':id_bien', $id_bien);
        $sql->bindValue(':id_photo', $id_photo);
        $result = $sql->execute();

    }

    public function photoById($id_photo){

        $query = "SELECT * FROM photos
                    WHERE id_photo = :id_photo";
        $sql = $this->db->pdo->prepare($query);
        $sql->bindValue(':id_photo', $id_photo);
        $sql->execute();
        $result = $sql->fetchAll();
        return $result;
    }

    //*******************************************PARTIE TARIF************************************/

    public function tarifList(){
        
        $query = "SELECT * FROM tarif";
        $sql = $this->db->pdo->prepare($query);
        $sql->execute();
        $result = $sql->fetchAll();
        return $result;
    }

    //suppression d'un client
    public function tarifDelete($id_tarif) {
        // Prépare la requête SQL pour supprimer un utilisateur en fonction de son ID
        $query = "DELETE FROM tarif WHERE id_tarif = :id_tarif";
        $sql = $this->db->pdo->prepare($query);
        
        // Lie la valeur de :id à la variable $id
        $sql->bindValue(':id_tarif', $id_tarif);
        
        // Exécute la requête SQL
        $result = $sql->execute();

        header('location: tarifList.php');
    }


    //modification d'un client
    public function tarifUpdate($id_tarif, $data){
        $dd_tarif      = $data['dd_tarif'];
        $df_tarif     = $data['df_tarif'];
        $prix_loc     = $data['prix_loc'];
        $id_bien     = $data['id_bien'];

        
        //insertion des données s'il ny a pas d'erreurs          
        $query = "UPDATE tarif SET dd_tarif =:dd_tarif, df_tarif =:df_tarif,prix_loc =:prix_loc, id_bien =:id_bien WHERE id_tarif = :id_tarif";
        $sql = $this->db->pdo->prepare($query);
        $sql->bindValue(':dd_tarif', $dd_tarif);
        $sql->bindValue(':df_tarif', $df_tarif);
        $sql->bindValue(':prix_loc', $prix_loc);
        $sql->bindValue(':id_bien', $id_bien);
        $sql->bindValue(':id_tarif', $id_tarif);
        $result = $sql->execute();

    }

    public function tarifById($id_tarif){

        $query = "SELECT * FROM tarif
                    WHERE id_tarif = :id_tarif";
        $sql = $this->db->pdo->prepare($query);
        $sql->bindValue(':id_tarif', $id_tarif);
        $sql->execute();
        $result = $sql->fetchAll();
        return $result;
    }

    //*******************************************PARTIE TARIF************************************/

    public function bienList(){
        
        $query = "SELECT * FROM biens";
        $sql = $this->db->pdo->prepare($query);
        $sql->execute();
        $result = $sql->fetchAll();
        return $result;
    }

    //suppression d'un client
    public function bienDelete($id_bien) {
        // Prépare la requête SQL pour supprimer un utilisateur en fonction de son ID
        $query = "DELETE FROM biens WHERE id_bien = :id_bien";
        $sql = $this->db->pdo->prepare($query);
        
        // Lie la valeur de :id à la variable $id
        $sql->bindValue(':id_bien', $id_bien);
        
        // Exécute la requête SQL
        $result = $sql->execute();

        header('location: bienList.php');
    }


    //modification d'un client
    public function bienUpdate($id_bien, $data){
        $nom_bien      = $data['nom_bien'];
        $rue_bien     = $data['rue_bien'];
        $cop_bien     = $data['cop_bien'];
        $vil_bien     = $data['vil_bien'];
        $sup_bien      = $data['sup_bien'];
        $nb_couchage     = $data['nb_couchage'];
        $nb_pieces     = $data['nb_pieces'];
        $nb_chambres     = $data['nb_chambres'];
        $descriptif      = $data['descriptif'];
        $ref_bien     = $data['ref_bien'];
        $statut_bien     = $data['statut_bien'];
        $id_type_bien     = $data['id_type_bien'];

        
        //insertion des données s'il ny a pas d'erreurs          
        $query = "UPDATE biens SET nom_bien =:nom_bien, rue_bien =:rue_bien, cop_bien =:cop_bien, vil_bien =:vil_bien, sup_bien =:sup_bien, nb_couchage =:nb_couchage,  
                                    nb_pieces =:nb_pieces, nb_chambres =:nb_chambres, descriptif =:descriptif, ref_bien =:ref_bien, statut_bien =:statut_bien, id_type_bien =:id_type_bien  
                                WHERE id_bien = :id_bien";
        $sql = $this->db->pdo->prepare($query);
        $sql->bindValue(':nom_bien', $nom_bien);
        $sql->bindValue(':rue_bien', $rue_bien);
        $sql->bindValue(':cop_bien', $cop_bien);
        $sql->bindValue(':vil_bien', $vil_bien);
        $sql->bindValue(':sup_bien', $sup_bien);
        $sql->bindValue(':nb_couchage', $nb_couchage);
        $sql->bindValue(':nb_pieces', $nb_pieces);
        $sql->bindValue(':nb_chambres', $nb_chambres);
        $sql->bindValue(':descriptif', $descriptif);
        $sql->bindValue(':ref_bien', $ref_bien);
        $sql->bindValue(':statut_bien', $statut_bien);
        $sql->bindValue(':id_type_bien', $id_type_bien);
        $sql->bindValue(':id_bien', $id_bien);
        $result = $sql->execute();

    }

    public function bienById($id_bien){

        $query = "SELECT * FROM biens
                    WHERE id_bien = :id_bien";
        $sql = $this->db->pdo->prepare($query);
        $sql->bindValue(':id_bien', $id_bien);
        $sql->execute();
        $result = $sql->fetchAll();
        return $result;
    }
}
