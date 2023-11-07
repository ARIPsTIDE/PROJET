<?php


 // puis création de votre requete  dans l'exemple ci dessous on sélectionne les eleves d'une BDDD 
 
	include 'bdd.php';


$keyword = '%'.$_POST['keyword'].'%';  // récupère la lettre saisie dans le champ texte en provenance de JS 


$sql = "SELECT * FROM v_commune_2023 WHERE ville LIKE (:var) or cp LIKE (:var) ORDER BY ville ASC LIMIT 0, 10";  // création de la requete avec sélection des résultats sur la lettre 
$req = $conn->prepare($sql);
$req->bindParam(':var', $keyword, PDO::PARAM_STR);
$req->execute();
$list = $req->fetchAll();
foreach ($list as $res) {
	//  affichage
	$Listeeleve = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $res['ville'].' '.$res['cp']);
	// sélection 
    echo '<li onclick="set_item(\''.str_replace("'", "\'", $res['ville'].' '.$res['cp']).'\')">'.$Listeeleve.'</li>';
}
?>