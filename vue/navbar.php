<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles/style.css">
        <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
        <title>PtiCuistot</title>
    </head>
    <body>
        <header>
            <nav>
                <img id="logo" src="images/Logo.png" alt="Logo PtiCuistot">

                <div id="headerLinks">
                    <a href="index.php">Accueil</a>
                    <a href="index.php?action=nosRecettes">Nos recettes</a>
                    <div id="filtres">
                        <a id="filtres" href="index.php?action=filtres">Filtres</a>
                        <div id="filtresMenu">
                            <a href="index.php?action=filtresCategorie">Catégories</a>
                            <hr>
                            <a href="index.php?action=filtresTitre">Titre</a>
                            <hr>
                            <a href="index.php?action=filtresIngredients">Ingrédients</a>
                        </div>
                    </div>
                    <?php
                    if (isset($_SESSION['uti_num'])) {
                        echo '<a href="index.php?action=creerRecette">Creer recette</a>';
                        if ($_SESSION['admin']) {
                            echo '<a href="index.php?action=validerRecette"> Valider recette';
                        }
                        echo '<a href="index.php?action=deconnexion">Deconnexion</a>';
                    }
                    else {
                        echo '<a href="index.php?action=connexion">Connexion</a>';
                    }
                    ?>
                </div>
            </nav>
        </header>
    </body>
</html>