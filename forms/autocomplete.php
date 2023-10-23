<?php

try
{
    $bdd = new PDO('mysql:host=mysql.info.unicaen.fr;dbname=22013679_1;charset=utf8', '22013679', 'goh8sheeRaemohxa');
}

catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

// Récupérez la valeur de la requête de l'utilisateur
$query = $_GET["query"];

// Recherchez des correspondances dans la base de données
$stmt = $pdo->prepare("SELECT TITRE FROM RECETTE WHERE TITRE LIKE :query");
$stmt->execute(['query' => '%' . $query . '%']);
$matches = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Renvoyez les titres des recettes correspondantes sous forme de JSON
echo json_encode($matches);
?>