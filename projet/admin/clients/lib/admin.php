<?php

include_once 'session.php';

include 'database.php';



class admin{
    private $db;

    public function __construct(){
        $this->db = new database;
    }

    //vérifie s'il existe déjà une adresse mail identique
    public function checkEmail($mail){

        $query = "SELECT * FROM admin WHERE mail = :mail";
        $sql = $this->db->pdo->prepare($query);
        $sql->bindValue(':mail', $mail);
        $sql->execute();

        if($sql->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }



    public function adminLogin($data){
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

        //validation mdp
        if(strlen($password) <5 && strlen($password) > 15){
            $msg = "<div class='alert alert-danger'>* Password should be between 5-15 characters</div>";
            return $msg;
        }


        //insertion d'un client s'il n'y a pas d'erreur 

        $result = $this->getLoginAdminData($nom, $password);
        
        if($result){
            sessionAdmin::init();
            sessionAdmin::set("login", true);
            sessionAdmin::set("id", $result->id);
            sessionAdmin::set("nom", $result->name);
            sessionAdmin::set("prenom", $result->username);
            sessionAdmin::set("mail", $result->email);
            sessionAdmin::set("loginmsg", "<div class='container'><div class='alert alert-success'>You are logged in</div></div>");
            header("location: ../index.php");
        }else{
            echo "<div class='container mt-5'><div class='alert alert-danger'>Username and Passwords are not correct</div></div>";
        }
    }


    
    public function getLoginAdminData($nom, $password){
        $query = "SELECT * FROM admin WHERE nom = :nom AND password = :password ";
        $sql = $this->db->pdo->prepare($query);
        $sql->bindParam(':nom', $nom, PDO::PARAM_STR);
        $sql->bindParam(':password', $password, PDO::PARAM_STR);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    


    //grécupère les informations de tout les clients
    public function userList(){
        
        $query = "SELECT * FROM clients";
        $sql = $this->db->pdo->prepare($query);
        $sql->execute();
        $result = $sql->fetchAll();
        return $result;
    }

    //récupère les informations d'un client par rapports a son id
    public function userById($id_client){

        $query = "SELECT * FROM clients WHERE id_client = :id LIMIT 1";
        $sql = $this->db->pdo->prepare($query);
        $sql->bindValue(':id', $id_client);
        $sql->execute();
        $result = $sql->fetchAll();
        return $result;
    }

    //suppression d'un client
    public function userDelete($id) {
        // Prépare la requête SQL pour supprimer un utilisateur en fonction de son ID
        $query = "DELETE FROM clients WHERE id_client = :id";
        $sql = $this->db->pdo->prepare($query);
        
        // Lie la valeur de :id à la variable $id
        $sql->bindValue(':id', $id);
        
        // Exécute la requête SQL
        $result = $sql->execute();

        header('location: userList.php');
    }


    //modification d'un client
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


        if($nom==  "" OR $prenom ==  "" OR $rue == "" OR $cop == "" OR $ville == "" OR $email ==  "" OR $password ==  "" OR $cpassword ==  "" OR $statut == "" OR $valid == ""){
            $msg = "<div class='alert alert-danger'>* Fileds are required!</div>";
            return $msg;
        }

        

        //nombres de caractères prénom valide
        if(strlen($nom) < 1){
            $msg = "<div class='alert alert-danger'>* Name can not be less than 3 character!</div>";
            return $msg;
        }elseif(strlen($nom) > 30){
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

        //nombres de caractères des mdp valide 
        if(strlen($password) < 5 && strlen($cpassword) < 5){
            $msg = "<div class='alert alert-danger'>* Password can not be less than 5 characters</div>";
            return $msg;
        }elseif(strlen($password) > 30 && strlen($cpassword) > 30){
            $msg = "<div class='alert alert-danger'>* Password can not be more than 15 characters</div>";
            return $msg;
        }

        //contrainte mdp validé
        if($password != $cpassword){
            $msg = "<div class='alert alert-danger'>* Password are not the same</div>";
            return $msg;
        }


        //validation adresse mail
        if(filter_var($email, FILTER_VALIDATE_EMAIL) == false){
            $msg = "<div class='alert alert-danger'>* Email is not valid!</div>";
            return $msg;
        }


        
        //insertion des données s'il ny a pas d'erreurs          
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