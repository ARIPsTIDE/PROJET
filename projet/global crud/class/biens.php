<?php
class Biens {

    private $bdd;
    
    function __construct()
    {
     require_once("../include/bdd.inc.php");
    }

    // Modèle SELECT : lire
    public function selectBien()
    {
        $sql = "SELECT * FROM biens;";
        $executesql = $this->bdd->query($sql);
        return $executesql;
    }

    // Modèle INSERT : créer
    public function insertBien($nom_bien, $rue_bien, $cop_bien, $vil_bien, $sup_bien, $nb_couchage, $nb_pieces, $nb_chambres, $descriptif, $ref_bien, $statut_bien)
    {
        // Paramètres pour l'exécution de la requête
        $data = [
            ':nom_bien' => $nom_bien,
            ':rue_bien' => $rue_bien,
            ':cop_bien' => $cop_bien,
            ':vil_bien' => $vil_bien,
            ':sup_bien' => $sup_bien,
            ':nb_couchage' => $nb_couchage,
            ':nb_pieces' => $nb_pieces,
            ':nb_chambres' => $nb_chambres,
            ':descriptif' => $descriptif,
            ':ref_bien' => $ref_bien,
            ':statut_bien' => $statut_bien
        ];

        $sql = "INSERT INTO biens (nom_bien, rue_bien, cop_bien, vil_bien, sup_bien, nb_couchage, nb_pieces, nb_chambres, descriptif, ref_bien, statut_bien) "
            . "VALUES (:nom_bien, :rue_bien, :cop_bien, :vil_bien, :sup_bien, :nb_couchage, :nb_pieces, :nb_chambres, :descriptif, :ref_bien, :statut_bien);";
        $stmt = $this->bdd->prepare($sql);

        // Teste si les données ont bien été insérées
        try {
            if ($stmt->execute($data)) {
                echo "Bien inséré";
                return $this->bdd->lastInsertId();
            } else {
                print_r($stmt->errorInfo()); // Affiche les informations d'erreur
                return false;
            }
        } catch (PDOException $e) {
            echo "Erreur d'exécution de la requête : " . $e->getMessage();
            return false;
        }
    }

    // Modèle DELETE : supprimer
    public function deleteBien($id)
    {
        // Paramètres pour l'exécution de la requête
        $data = [
            ':id' => $id
        ];

        $sql = "DELETE FROM biens WHERE id_bien = :id;";
        $stmt = $this->bdd->prepare($sql);

        // Teste si les données ont bien été supprimées
        try {
            if ($stmt->execute($data)) {
                echo "Suppression réussie";
                return true;
            } else {
                $errorInfo = $stmt->errorInfo();
                echo "Erreur lors de la suppression : " . $errorInfo[2]; // Affiche l'erreur spécifique
                return false;
            }
        } catch (PDOException $e) {
            echo "Erreur d'exécution de la requête : " . $e->getMessage();
            return false;
        }
    }

    // Modèle UPDATE : modifier
    public function updateBien($nom_bien, $rue_bien, $cop_bien, $vil_bien, $sup_bien, $nb_couchage, $nb_pieces, $nb_chambres, $descriptif, $ref_bien, $statut_bien)
    {
        // Paramètres pour l'exécution de la requête
        $data = [
            ':nom_bien' => $nom_bien,
            ':rue_bien' => $rue_bien,
            ':cop_bien' => $cop_bien,
            ':vil_bien' => $vil_bien,
            ':sup_bien' => $sup_bien,
            ':nb_couchage' => $nb_couchage,
            ':nb_pieces' => $nb_pieces,
            ':nb_chambres' => $nb_chambres,
            ':descriptif' => $descriptif,
            ':ref_bien' => $ref_bien,
            ':statut_bien' => $statut_bien
        ];

        $sql = "UPDATE biens
                SET nom_bien = :nom_bien, rue_bien = :rue_bien, cop_bien = :cop_bien, vil_bien = :vil_bien, sup_bien = :sup_bien, nb_couchage = :nb_couchage, nb_pieces = :nb_pieces, nb_chambres = :nb_chambres, descriptif = :descriptif, ref_bien = :ref_bien, statut_bien = :statut_bien
                WHERE id_bien = :id_bien;";
        $stmt = $this->bdd->prepare($sql);

        // Teste si les données ont bien été mises à jour
        try {
            if ($stmt->execute($data)) {
                echo "Bien modifié";
                return true;
            } else {
                print_r($stmt->errorInfo()); // Affiche les informations d'erreur
                return false;
            }
        } catch (PDOException $e) {
            echo "Erreur d'exécution de la requête : " . $e->getMessage();
            return false;
        }
    }
}
?>
