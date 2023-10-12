<?php
    class Photo {

        public $bdd;

        function __construct()
        {
         require_once("../include/bdd.inc.php");
        }
        //Requêtes
        
        //Modèle SELECT : lire
        public function selectPhoto(){
            $sql="SELECT * FROM photo;";
            $executesql = $this->bdd->query($sql);                   
            return $executesql;
        }
        
        //Modèle INSERT : créer
        public function insertRobe($nom_photo, $lien_phtot){
            
            //Paramètres pour l'exécution de la requête
            $data = [
                ':nom_photo' => $nom_photo,
                ':lien_photo' => $lien_photo
            ];

            $sql="INSERT INTO photos (nom_photo, lien_photo) "
                    . "VALUES (:nom_photo, :lien_photo);";
            $stmt= $this->bdd->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute($data);

            //Teste si les données ont bien été insérées
            if($stmt->execute($data)){
                echo "Photo inséré";
                return $this->bdd->lastInsertId();
            }
            else {
                echo $stmt->errorInfo();
                return false;
            }
        }
        //Modèle DELETE : supprimer
        public function deletePhoto($id){
             //Paramètres pour l'exécution de la requête
            $data = [
                ':id' => $id
            ];

            $sql="DELETE FROM photos WHERE id_photo = :id;";
            $stmt= $this->bdd->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute($data);



            //Teste si les données ont bien été supprimées
            if($stmt->execute($data)){
                echo "Supression réussie";
                return true;
            }
            else {
                $errorInfo = $stmt->errorInfo(); // Correction ici
                echo "Erreur lors de la suppression : " . $errorInfo[2]; // Affiche l'erreur spécifique
                return false;
            }
        }
        //Modèle UPDATE : modifier
        public function updateRobe($id, $nom_photo, $lien_photo){
            //Paramètres pour l'exécution de la requête
            $data = [
                ':nom_photo' => $nom_photo,
                ':lien_photo' => $lien_photo,
                ':id_photo' => $id_photo
            ];

            $sql=  "UPDATE photos
                    SET nom_photo = :nom_photo, lien_photo = :lien_photo
                    WHERE id_photo = :id_photo;";
            $stmt= $this->bdd->prepare($sql);

            //Teste si les données ont bien été mises à jour
            if($stmt->execute($data)){
                echo "Photo modifié";
                return true;
            }
            else {
                echo $stmt->errorInfo();
                return false;
            }
        }
    }
