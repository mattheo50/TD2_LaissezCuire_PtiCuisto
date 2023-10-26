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
        
        <form action="autocomplete.php" method="post">
        <label for="Séléctionnez les ingrédients de la recette:">Séléctionnez les ingrédients de la recette: </label>
        <input type="search" id="ingredient" name="ingredient" list="Listingredient" autocomplete="off">
        <button id="ajout_ing_bouton" type="button" >+</button>
        <datalist id="Listingredient"></datalist>
        <p id="ListeIngredientAjoute">Ingredients : </p>
    </form>
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
        console.log(recherche);
        
        const ajoutIngredient = document.getElementById("ajout_ing_bouton");
        let premierIngredient = true;
        ajoutIngredient.addEventListener("click",(event)=>{
            if(premierIngredient == true){
                document.getElementById("ListeIngredientAjoute").innerHTML += (recherche);
                premierIngredient = false;
            }else{
                document.getElementById("ListeIngredientAjoute").innerHTML += (", "+recherche);
            }
        });
    </script>
       

        <label>Saisissez un lien d'image: </label>
        <input name="image" type="text" placeholder="Titre"></input><br>
        <input type="submit" value="Send Request" />
    </form>
    </body>
</hmtl>