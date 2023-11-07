<?php
// Inclure votre fichier de configuration de base de données ici
include "config.php";

// Récupération de la requête de recherche depuis le champ de recherche
$query = $_POST["query"];

// Requête SQL pour récupérer les suggestions

$sql = "SELECT INTITULE_ING FROM INGREDIENT WHERE INTITULE_ING LIKE :query";
$stmt = $bdd->prepare($sql);
$stmt->bindValue(":query", "%$query%");
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Affichage des suggestions sous forme d'options pour la liste de données
if ($results) {
    foreach ($results as $row) {
        echo '<option value="' . $row["INTITULE_ING"] . '">';
    }
}
?>