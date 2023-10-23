<?php include_once("../templates/navbar.php")?>
<html>
    <body>
    <form action="traitement_form_recette.php" method="post">
        <label>Quelle est la catégorie de votre recette ? </label>
        <select name="categorie" id="categorie_recette_form_recette">
            <option value="">--Choississez une catégorie--</option>
            <option value="Entree">Entrée</option>
            <option value="Plat">Plat</option>
            <option value="Dessert">Dessert</option>
        </select><br>
        <label>Entrez votre titre: </label>
        <input name="titre" type="text" placeholder="Titre"></input><br>
        <label>Entrez la recette: </label>
        <input name="contenu" type="text" placeholder="recette"></input><br>
        <label>Saisissez un court résumé de la recette: </label>
        <input name="resume" type="text" placeholder="résumé"></input><br>
        <label>Séléctionnez les ingrédients de la recette: </label>

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
$query = "Pâ";

// Recherchez des correspondances dans la base de données
$stmt = $pdo->prepare("SELECT TITRE FROM RECETTE WHERE TITRE LIKE :query");
$stmt->execute(['query' => '%' . $query . '%']);
$matches = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Renvoyez les titres des recettes correspondantes sous forme de JSON
echo json_encode($matches);
?>


        <input type="text" id="autocomplete-input" placeholder="Recherche de recettes">
<div id="autocomplete-results"></div>

<script>
    const input = document.getElementById("autocomplete-input");
    const resultsContainer = document.getElementById("autocomplete-results");

    // Définissez une fonction pour effectuer la recherche et mettre à jour les résultats
    function updateResults() {
        const inputValue = input.value.trim();

        // Assurez-vous que la saisie n'est pas vide
        if (inputValue !== "") {
            // Effectuez une requête AJAX pour obtenir les résultats depuis le serveur PHP
            fetch("./autocomplete.php?query=" + inputValue)
                .then(response => response.json())
                .then(data => {
                    resultsContainer.innerHTML = "";
                    data.forEach(result => {
                        resultsContainer.innerHTML += `<div>${result.title}</div>`;
                    });
                })
                .catch(error => {
                    console.error("Erreur de requête AJAX : " + error);
                });
        } else {
            // Si la saisie est vide, effacez les résultats
            resultsContainer.innerHTML = "";
        }
    }

    // Ajoutez un gestionnaire d'événement "input" pour déclencher la recherche à chaque saisie
    input.addEventListener("input", updateResults);
</script>

       

        <label>Saisissez un lien d'image: </label>
        <input name="image" type="text" placeholder="Titre"></input><br>
        <input type="submit" value="Send Request" />
    </form>
    </body>
</hmtl>