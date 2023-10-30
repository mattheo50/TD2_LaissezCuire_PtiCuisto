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
            <label>Entrez la recette complète: </label><br>
                <textarea name="contenu" type="text" rows="10" cols="100" placeholder="recette"></textarea><br>
            <label>Saisissez un court résumé de la recette: </label><br>
            <textarea name="resume" type="text" placeholder="résumé" rows="4" cols="30"></textarea><br>
            <label for="Séléctionnez les ingrédients de la recette:">Séléctionnez les ingrédients de la recette: </label>
                <input type="search" id="ingredient" name="ingredient" list="Listingredient" autocomplete="off">
            <button id="ajout_ing_bouton" type="button" onclick="resetbouton()" >+</button>
            <datalist id="Listingredient"></datalist><br>
            <label>Ingredients :</label>
            <label id="ListeIngredientAjoute"></label><br>
            <input type="hidden" id="ingredientPost" name="ingredientPost" >
            <label>Saisissez un lien d'image: </label>
                <input name="image" type="text" placeholder="Liens"></input><br>
                <input type="submit" value="Send Request"/>
        </form>
    </body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let recherche;
        $(document).ready(function() {
            $("#ingredient").on("input", function() {
                recherche = document.getElementById("ingredient").value;
                var query = $(this).val();

                if (query !== "") {
                    $.ajax({
                        url: "autocomplete.php",
                        method: "POST",
                        data: { query: query },
                        success: function(data) {
                            var datalist = $("#Listingredient");
                            datalist.empty();
                            datalist.html(data);
                        }
                    });
                }
            });
        });
        let ListeIngredientAjouteTab = [];
        const ajoutIngredient = document.getElementById("ajout_ing_bouton");
        let premierIngredient = true;
        ajoutIngredient.addEventListener("click",(event)=>{
            if(!(recherche == undefined)){
                if(premierIngredient == true){
                    document.getElementById("ListeIngredientAjoute").innerHTML += recherche;
                    document.getElementById("ingredientPost").value += recherche;
                    premierIngredient = false;
                }else{
                    document.getElementById("ListeIngredientAjoute").innerHTML += (", "+recherche);
                    document.getElementById("ingredientPost").value += "/"+recherche;
                }
                ListeIngredientAjouteTab.push(recherche);
                console.log(document.getElementById("ingredientPost").value);
            }
        });

        function resetbouton(){
            var bouton = document.getElementById("ajout_ing_bouton");
            bouton.value = undefined;
            //chercher a faire plus propre
        }

    </script>
</hmtl>