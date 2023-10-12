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
        $nom      = $data['nom'];
        $prenom   = $data['prenom'];
        $rue        = $data['rue'];
        $cop        = $data['cop'];
        $ville      = $data['ville'];
        $email      = $data['email'];
        $password   = $data['password'];
        $cpassword  = $data['cpassword'];
        // $statut     = $data['statut'];
        // $valid      = $data['valid'];
        $emailcheck = $this->checkEmail($email);


        //empty validation of fields
        if($nom==  "" OR $prenom ==  "" OR $rue == "" OR $cop == "" OR $ville == "" OR $email ==  "" OR $password ==  "" OR $cpassword ==  ""){
            $msg = "<div class='alert alert-danger'>* Fileds are required!</div>";
            return $msg;
        }

        
        //length validatoin

        //name length validation
        if(strlen($nom) < 3){
            $msg = "<div class='alert alert-danger'>* Name can not be less than 3 character!</div>";
            return $msg;
        }elseif(strlen($nom) > 15){
            $msg = "<div class='alert alert-danger'>* Name can not be more than 15 characters</div>";
            return $msg;
        }

        // //username validation
        // if(strlen($prenom) < 1){
        //     $msg = "<div class='alert alert-danger'>* Username can not be more than 1 characters</div>";
        //     return $msg;
        // }elseif(strlen($prenom) > 50){
        //     $msg = "<div class='alert alert-danger'>* Username can not be more than 50 characters</div>";
        //     return $msg;
        // }

        //password and confirm password length validation
        if(strlen($password) < 12 && strlen($cpassword) < 12){
            $msg = "<div class='alert alert-danger'>* Password can not be less than 12 characters</div>";
            return $msg;
        }elseif(strlen($password) > 30 && strlen($cpassword) > 30){
            $msg = "<div class='alert alert-danger'>* Password can not be more than 30 characters</div>";
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
        $query = "INSERT INTO clients (nom_client, prenom_client, rue_client, cop_client, vil_client, mail_client, pass_client) VALUES (:nom, :prenom, :rue, :cop, :ville, :email, :password)";
       //$query = "INSERT INTO `users`(`user_name`, `user_username`, `user_email`, `user_password`) VALUES (:name, :username, :email, :password)";
        $sql = $this->db->pdo->prepare($query);
        //$sql->bindValue(':user_id', $id);
        $sql->bindValue(':nom', $nom);
        $sql->bindValue(':prenom', $prenom);
        $sql->bindValue(':rue', $rue);
        $sql->bindValue(':cop', $cop);
        $sql->bindValue(':ville', $ville);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':password', $password);
        // $sql->bindValue(':statut', $statut);
        // $sql->bindValue(':valid', $valid);
        $result = $sql->execute();

        // if($result){
        //     $msg = "<div class='alert alert-success'>* Your account is created successfully</div>";
        //     return $msg;
        // }

        
}


    //email existence check before account registering
    public function checkEmail($email){

        $query = "SELECT * FROM clients WHERE mail_client = :email";
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
    public function userLogin($data){
        $nom = $data['nom'];
        $password = $data['password'];

        //empty value validation
        if($nom == "" OR $password == ""){
            $msg = "<div class='alert alert-danger'>* Fields are required</div>";
            return $msg;
        }


        //length validation
        
        // //username length validation
        // if(strlen($prenom) <5 && strlen($prenom) > 15){
        //     $msg = "<div class='alert alert-danger'>* Username should be between 5-15 characters</div>";
        //     return $msg;
        // }

        //password validation
        if(strlen($password) <5 && strlen($password) > 15){
            $msg = "<div class='alert alert-danger'>* Password should be between 5-15 characters</div>";
            return $msg;
        }


        //user will be login if there is no error

        $result = $this->getLoginUserData($nom, $password);
        
        if($result){
            session::init();
            session::set("login", true);
            session::set("id", $result->id);
            session::set("nom", $result->name);
            session::set("prenom", $result->username);
            session::set("email", $result->email);
            session::set("loginmsg", "<div class='container'><div class='alert alert-success'>You are logged in</div></div>");
            header("location: index.php");
        }else{
            echo "<div class='container mt-5'><div class='alert alert-danger'>Username and Passwords are not correct</div></div>";
        }
    }


    
    public function getLoginUserData($nom, $password){
        $query = "SELECT * FROM clients WHERE nom_client = :nom AND pass_client = :password ";
        $sql = $this->db->pdo->prepare($query);
        $sql->bindParam(':nom', $nom, PDO::PARAM_STR);
        $sql->bindParam(':password', $password, PDO::PARAM_STR);
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

        $query = "SELECT * FROM clients WHERE id_client = :id LIMIT 1";
        $sql = $this->db->pdo->prepare($query);
        $sql->bindValue(':id', $id_client);
        $sql->execute();
        $result = $sql->fetchAll();
        return $result;
    }

    public function userDelete($id) {
        // Prépare la requête SQL pour supprimer un utilisateur en fonction de son ID
        $query = "DELETE FROM clients WHERE id_client = :id";
        $sql = $this->db->pdo->prepare($query);
        
        // Lie la valeur de :id à la variable $id
        $sql->bindValue(':id', $id);
        
        // Exécute la requête SQL
        $result = $sql->execute();

        header('location: index.php');
    }


    //user update mechanism is created here
    public function userUpdate($id, $data){
        $nom      = $data['nom'];
        $prenom   = $data['prenom'];
        $rue        = $data['rue'];
        $cop        = $data['cop'];
        $ville      = $data['ville'];
        $email      = $data['email'];
        $password   = $data['password'];
        $cpassword  = $data['cpassword'];
        $statut     = $data['statut'];
        $valid      = $data['valid'];
        $emailcheck = $this->checkEmail($email);


        //empty validation of fields
        if($nom==  "" OR $prenom ==  "" OR $rue == "" OR $cop == "" OR $ville == "" OR $email ==  "" OR $password ==  "" OR $cpassword ==  "" OR $statut == "" OR $valid == ""){
            $msg = "<div class='alert alert-danger'>* Fileds are required!</div>";
            return $msg;
        }

        
        //length validatoin

        //name length validation
        if(strlen($nom) < 3){
            $msg = "<div class='alert alert-danger'>* Name can not be less than 3 character!</div>";
            return $msg;
        }elseif(strlen($nom) > 15){
            $msg = "<div class='alert alert-danger'>* Name can not be more than 15 characters</div>";
            return $msg;
        }

        // //username validation
        // if(strlen($prenom) < 5){
        //     $msg = "<div class='alert alert-danger'>* Username can not be more than 5 characters</div>";
        //     return $msg;
        // }elseif(strlen($prenom) > 15){
        //     $msg = "<div class='alert alert-danger'>* Username can not be more than 15 characters</div>";
        //     return $msg;
        // }

        //password and confirm password length validation
        if(strlen($password) < 5 && strlen($cpassword) < 5){
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


        
        //insert data if there is no error            
        $query = "UPDATE clients SET nom_client=:nom, prenom_client=:prenom, rue_client=:rue, cop_client=:cop, vil_client=:ville, mail_client=:email, pass_client=:password, statut_client=:statut, valid_client=:valid WHERE id_client = :id";
        $sql = $this->db->pdo->prepare($query);
        $sql->bindValue(':nom', $nom);
        $sql->bindValue(':prenom', $prenom);
        $sql->bindValue(':rue', $rue);
        $sql->bindValue(':cop', $cop);
        $sql->bindValue(':ville', $ville);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':password', $password);
        $sql->bindValue(':statut', $statut);    
        $sql->bindValue(':valid', $valid);
        $sql->bindValue(':id', $id);
        $result = $sql->execute();

        if($result){
            $msg = "<div class='alert alert-success'>* Your updated successfully</div>";
            return $msg;
        }
    }

}