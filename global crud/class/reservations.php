<?php
class Reservation {

    private $bdd;
    
    function __construct()
    {
     require_once("../include/bdd.inc.php");
    }

    // Modèle SELECT : lire
    public function selectReservation()
    {
        $sql = "SELECT * FROM utilisateur;";
        $executesql = $this->bdd->query($sql);
        return $executesql;
    }

    // Modèle INSERT : créer
    public function insertUtilisateur($date_resa, $dad_resa, $daf_resa, $commentaire, $moderation, $annul_resa)
    {
        // Paramètres pour l'exécution de la requête
        $data = [
            ':date_resa' => $date_resa,
            ':dad_resa' => $dad_resa,
            ':daf_resa' => $daf_resa,
            ':commentaire' => $commentaire,
            ':moderation' => $moderation,
            ':annul_resa' => $annul_resa
        ];

        $sql = "INSERT INTO utilisateur (date_resa, dad_resa, daf_resa, commentaire, moderation, annul_resa) "
            . "VALUES (:date_resa, :dad_resa, :daf_resa, :commentaire, :moderation, :annul_resa);";
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

        $sql = "DELETE FROM reservations WHERE id_reservation = :id;";
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
    public function updateReservation($date_resa, $dad_resa, $daf_resa, $commentaire, $moderation, $annul_resa, $id_client, $id_bien)
    {
        // Paramètres pour l'exécution de la requête
        $data = [
            ':date_resa' => $date_resa,
            ':dad_resa' => $dad_resa,
            ':daf_resa' => $daf_resa,
            ':commentaire' => $commentaire,
            ':moderation' => $moderation,
            ':annul_resa' => $annul_resa,
            ':id_client' => $id_client,
            ':id_bien' => $id_bien
        ];

        $sql = "UPDATE reservations
                SET date_resa = :date_resa, dad_resa = :dad_resa, daf_resa = :daf_resa, commentaire = :commentaire, moderation = :moderation, annul_resa = :annul_resa, id_client = :id_client, id_bien = :id_bien
                WHERE id_reservation = :id_reservation;";
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
