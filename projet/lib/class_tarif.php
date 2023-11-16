<?php

//sessoin is included for once 
//if it exist it will not work it not then it will load
include_once 'session.php';

//database is included here
include 'database.php';


//all mechanism started from here

class tarif{
    private $db;

    public function __construct(){
        $this->db = new database;
    }





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

    public function tarifInsert($data){
        $dd_tarif      = $data['dd_tarif'];
        $df_tarif     = $data['df_tarif'];
        $prix_loc     = $data['prix_loc'];
        $id_bien     = $data['id_bien'];

        
        //insert data if there is no error            
        $query = "INSERT INTO tarif (dd_tarif, df_tarif, prix_loc, id_bien ) VALUES (:dd_tarif, :df_tarif, :prix_loc, :id_bien)";
        $sql = $this->db->pdo->prepare($query);
        $sql->bindValue(':dd_tarif', $dd_tarif);
        $sql->bindValue(':df_tarif', $df_tarif);
        $sql->bindValue(':prix_loc', $prix_loc);
        $sql->bindValue(':id_bien', $id_bien);
        $result = $sql->execute();

        if($result){
            $msg = "<div class='alert alert-success'>Votre type de bien à était créer</div>";
            return $msg;
            header("location: tarif/tarifInsert.php");
        }
    }
}