<?php

//sessoin is included for once 
//if it exist it will not work it not then it will load
include_once 'session.php';

//database is included here
include 'database.php';


//all mechanism started from here

class type{
    private $db;

    public function __construct(){
        $this->db = new database;
    }






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
        $lib_type_bien      = $data['lib_type_bien'];

        if($lib_type_bien==  ""){
            $msg = "<div class='alert alert-danger'>* Fileds are required!</div>";
            return $msg;
        }

        
        //insertion des données s'il ny a pas d'erreurs          
        $query = "UPDATE type_bien SET lib_type_bien =:lib_type_bien WHERE id_type_bien = :id_type";
        $sql = $this->db->pdo->prepare($query);
        $sql->bindValue(':lib_type_bien', $lib_type_bien);
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

    public function typeInsert($data){
        $lib_type_bien     = $data['lib_type_bien'];

        
        //insert data if there is no error            
        $query = "INSERT INTO type_bien (lib_type_bien ) VALUES (:lib_type_bien)";
        $sql = $this->db->pdo->prepare($query);
        $sql->bindValue(':lib_type_bien', $lib_type_bien);
        $result = $sql->execute();

        if($result){
            $msg = "<div class='alert alert-success'>Votre type de bien à était créer</div>";
            return $msg;
            header("location: type/typeInsert.php");
        }
    }
}