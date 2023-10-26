<?php
// Inclure votre fichier de configuration de base de données ici
include "config.php";

// Vérifier si un terme de recherche est présent dans la requête
if (isset($_GET['term'])) {
    $term = $_GET['term'];
    
    // Requête SQL pour récupérer les ingrédients correspondant au terme de recherche
    $sql = "SELECT INTITULE_ING FROM INGREDIENT WHERE INTITULE_ING LIKE :term";
    $stmt = $bdd->prepare($sql);
    $stmt->execute(['term' => '%' . $term . '%']);

    // Créer un tableau des résultats
    $results = array();
    while ($row = $stmt->fetch()) {
        $results[] = $row['INTITULE_ING'];
    }

    // Renvoyer les résultats au format JSON
    echo json_encode($results);
}
?>