<?php
    class Type {

        public $type;

        function __construct()
        {
         require_once("../include/bdd.inc.php");
        }
        //Requêtes
        
        //Modèle SELECT : lire
        public function selectType(){
            $sql="SELECT * FROM type_bien;";
            $executesql = $this->type->query($sql);                   
            return $executesql;
        }
        
        //Modèle INSERT : créer
        public function insertRobe($lib_type_bien){
            
            //Paramètres pour l'exécution de la requête
            $data = [
                ':lib_type_bien' => $lib_type_bien
            ];

            $sql="INSERT INTO type_bien (lib_type_bien) "
                    . "VALUES (:lib_type_bien);";
            $stmt= $this->type->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute($data);

            //Teste si les données ont bien été insérées
            if($stmt->execute($data)){
                echo "type de bien inséré";
                return $this->type->lastInsertId();
            }
            else {
                echo $stmt->errorInfo();
                return false;
            }
        }
        //Modèle DELETE : supprimer
        public function deleteType($id){
             //Paramètres pour l'exécution de la requête
            $data = [
                ':id' => $id
            ];

            $sql="DELETE FROM type_bien WHERE id_type_bien = :id;";
            $stmt= $this->type->prepare($sql);
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
        public function updateRobe($id, $lib_type_bien){
            //Paramètres pour l'exécution de la requête
            $data = [
                ':lib_type_bien' => $lib_type_bien,
                ':id_type_bien' => $id_type_bien
            ];

            $sql=  "UPDATE type_bien
                    SET lib_type_bien = :lib_type_bien
                    WHERE id_type_bien = :id_type_bien;";
            $stmt= $this->type->prepare($sql);

            //Teste si les données ont bien été mises à jour
            if($stmt->execute($data)){
                echo "Robe modifié";
                return true;
            }
            else {
                echo $stmt->errorInfo();
                return false;
            }
        }
    }
