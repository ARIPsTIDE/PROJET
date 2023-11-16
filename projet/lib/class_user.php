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

    public function clientInsert($data){
        $nom_client       = $data['nom_client'];
        $prenom_client   = $data['prenom_client'];
        $rue_client      = $data['rue_client'];
        $cop_client   = $data['cop_client'];
        $vil_client  = $data['vil_client'];
        $mail_client  = $data['mail_client'];
        $pass_client  = $data['pass_client'];
        $statut_client  = $data['statut_client'];
        $valid_client  = $data['valid_client'];
        //$mailCheck = $this->checkEmail($mail_client);





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


        // //email vaidation
        // if(filter_var($mailCheck, FILTER_VALIDATE_EMAIL) == false){
        //     $msg = "<div class='alert alert-danger'>* Email is not valid!</div>";
        //     return $msg;
        // }


        // //email existence validation
        // if($mailCheck == true){
        //     $msg = "<div class='alert alert-danger'>* Email already exist!</div>";
        //     return $msg;
        // }


        
        //insert data if there is no error            
        $query = "INSERT INTO clients (nom_client, prenom_client, rue_client, cop_client, vil_client, mail_client, pass_client, statut_client, valid_client ) VALUES (:nom_client, :prenom_client, :rue_client, :cop_client, :vil_client, :mail_client, :pass_client, :statut_client, :valid_client)";
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
        $result = $sql->execute();

        if($result){
            $msg = "<div class='alert alert-success'>* Your account is created successfully</div>";
            return $msg;
            header("location: clients/clientInsert.php");
        }
    }
}