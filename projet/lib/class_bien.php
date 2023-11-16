<?php

//sessoin is included for once 
//if it exist it will not work it not then it will load
include_once 'session.php';

//database is included here
include 'database.php';


//all mechanism started from here

class bien{
    private $db;

    public function __construct(){
        $this->db = new database;
    }

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
        $commune     = $data['commune'];
        $sup_bien      = $data['sup_bien'];
        $nb_couchage     = $data['nb_couchage'];
        $nb_pieces     = $data['nb_pieces'];
        $nb_chambres     = $data['nb_chambres'];
        $descriptif      = $data['descriptif'];
        $ref_bien     = $data['ref_bien'];
        $statut_bien     = $data['statut_bien'];
        $id_type_bien     = $data['id_type_bien'];

        
        //insertion des données s'il ny a pas d'erreurs          
        $query = "UPDATE biens SET nom_bien =:nom_bien, rue_bien =:rue_bien, commune =:commune, sup_bien =:sup_bien, nb_couchage =:nb_couchage,  
                                    nb_pieces =:nb_pieces, nb_chambres =:nb_chambres, descriptif =:descriptif, ref_bien =:ref_bien, statut_bien =:statut_bien, id_type_bien =:id_type_bien  
                                WHERE id_bien = :id_bien";
        $sql = $this->db->pdo->prepare($query);
        $sql->bindValue(':nom_bien', $nom_bien);
        $sql->bindValue(':rue_bien', $rue_bien);
        $sql->bindValue(':commune', $commune);
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

    public function bienInsert($data){
        $nom_bien      = $data['nom_bien'];
        $rue_bien     = $data['rue_bien'];
        $vil_bien     = $data['vil_bien'];
        $sup_bien      = $data['sup_bien'];
        $nb_couchage     = $data['nb_couchage'];
        $nb_pieces     = $data['nb_pieces'];
        $nb_chambres     = $data['nb_chambres'];
        $descriptif      = $data['descriptif'];
        $ref_bien     = $data['ref_bien'];
        $statut_bien     = $data['statut_bien'];
        $id_type_bien     = $data['id_type_bien'];

        
        //insert data if there is no error            
        $query = "INSERT INTO biens (nom_bien, rue_bien, vil_bien, sup_bien, nb_couchage, nb_pieces, nb_chambres, descriptif, ref_bien, statut_bien, id_type_bien ) VALUES (:nom_bien, :rue_bien, :vil_bien, :sup_bien, :nb_couchage, :nb_pieces, :nb_chambres, :descriptif, :ref_bien, :statut_bien, :id_type_bien)";
        $sql = $this->db->pdo->prepare($query);
        $sql->bindValue(':nom_bien', $nom_bien);
        $sql->bindValue(':rue_bien', $rue_bien);
        $sql->bindValue(':vil_bien', $vil_bien);
        $sql->bindValue(':sup_bien', $sup_bien);
        $sql->bindValue(':nb_couchage', $nb_couchage);
        $sql->bindValue(':nb_pieces', $nb_pieces);
        $sql->bindValue(':nb_chambres', $nb_chambres);
        $sql->bindValue(':descriptif', $descriptif);
        $sql->bindValue(':ref_bien', $ref_bien);
        $sql->bindValue(':statut_bien', $statut_bien);
        $sql->bindValue(':id_type_bien', $id_type_bien);
        $result = $sql->execute();

        if($result){
            $msg = "<div class='alert alert-success'>Votre bien à était créer</div>";
            return $msg;
            header("location: biens/bienInsert.php");
        }
    }
}
