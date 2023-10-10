<?php
class Tarif {

    private $bdd;
    
    function __construct()
    {
     require_once("../include/bdd.inc.php");
    }

    // Modèle SELECT : lire
    public function selectReservation()
    {
        $sql = "SELECT * FROM tarif;";
        $executesql = $this->bdd->query($sql);
        return $executesql;
    }

    // Modèle INSERT : créer
    public function insertUtilisateur($dd_tarif, $df_tarif, $prix_loc)
    {
        // Paramètres pour l'exécution de la requête
        $data = [
            ':dd_tarif' => $dd_tarif,
            ':df_tarif' => $df_tarif,
            ':prix_loc' => $prix_loc
        ];

        $sql = "INSERT INTO utilisateur (dd_tarif, df_tarif, prix_loc) "
            . "VALUES (:dd_tarif, :df_tarif, :prix_loc);";
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
    public function deleteReservation($id)
    {
        // Paramètres pour l'exécution de la requête
        $data = [
            ':id' => $id
        ];

        $sql = "DELETE FROM tarif WHERE id_tarif = :id;";
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
    public function updateReservation($dd_tarif, $df_tarif, $prix_loc, $id_bien)
    {
        // Paramètres pour l'exécution de la requête
        $data = [
            ':dd_tarif' => $dd_tarif,
            ':df_tarif' => $df_tarif,
            ':prix_loc' => $prix_loc,
            ':id_bien' => $id_bien
        ];

        $sql = "UPDATE reservations
                SET dd_tarif = :dd_tarif, df_tarif = :df_tarif, prix_loc = :prix_loc,  id_bien = :id_bien
        $stmt = $this->bdd->prepare($sql);

        // Teste si les données ont bien été mises à jour
        try {
            if ($stmt->execute($data)) {
                echo "Tarif modifié";
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
