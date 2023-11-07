<?php

include_once '../clients/lib/session.php';

include '../clients/lib/database.php';



class reservation{
    private $db;

    public function __construct(){
        $this->db = new database;
    }

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
    public function userById($id_client){

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

}