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
        
        <form>
        <label for="Séléctionnez les ingrédients de la recette:">Séléctionnez les ingrédients de la recette: </label>
        <input type="text" id="ingredient" name="ingredient">
        </form>
        <div id="ingredientList"></div>

<script>

// JavaScript pour la gestion de l'autocomplétion
document.addEventListener("DOMContentLoaded", function() {
    const ingredientInput = document.getElementById("ingredient");
    const ingredientList = document.getElementById("ingredientList");

    ingredientInput.addEventListener("input", function() {
        const term = ingredientInput.value;

        if (term.length >= 2) {
            fetch(`autocomplete.php?term=${term}`)
                .then(response => response.json())
                .then(data => {
                    ingredientList.innerHTML = "";

                    data.forEach(ingredient => {
                        const suggestion = document.createElement("div");
                        suggestion.textContent = ingredient;
                        ingredientList.appendChild(suggestion);

                        suggestion.addEventListener("click", function() {
                            ingredientInput.value = ingredient;
                            ingredientList.innerHTML = "";
                        });
                    });
                });
        } else {
            ingredientList.innerHTML = "";
        }
    });
});

</script>
       

        <label>Saisissez un lien d'image: </label>
        <input name="image" type="text" placeholder="Titre"></input><br>
        <input type="submit" value="Send Request" />
    </form>
    </body>
</hmtl>