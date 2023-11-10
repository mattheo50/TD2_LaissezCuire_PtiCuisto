<?php

// Inclure votre fichier de configuration de base de données ici
$dotenv = parse_ini_file("../auth.env");
$DB_TYPE = $dotenv['DB_TYPE'];
$DB_HOST = $dotenv['DB_HOST'];
$DB_NAME = $dotenv['DB_NAME'];
$bdd = new PDO("$DB_TYPE:host=$DB_HOST;dbname=$DB_NAME;charset=utf8", $dotenv['DB_USER'], $dotenv['DB_PASS']);

// Récupération de la requête de recherche depuis le champ de recherche
$query = $_POST["query"];

// Requête SQL pour récupérer les suggestions
$sql = "SELECT INTITULE_ING FROM INGREDIENT WHERE INTITULE_ING LIKE :query";
$stmt = $bdd->prepare($sql);
$stmt->bindValue(":query", "%$query%");
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo ("<pre>");
print_r($results);
echo ("</pre>");

// Affichage des suggestions sous forme d'options pour la liste de données
if ($results) {
    foreach ($results as $row) {
        echo '<option value="' . $row["INTITULE_ING"] . '">';
    }
}
?>