<?php $title = 'NouvelleRecette'; 
require_once('Controller/Recette.php');
require('config.php');
$recette = new Recette();
include_once("../templates/navbar.php");
?>   

    <div class="container">
        <form action="traitement_form_recette.php" method="post">

            <div class="formRecette">
                <label>Quelle est la catégorie de votre recette ? </label>
                <select name="categorie" id="categorie_recette_form_recette" required="required">
                    <option value="">--Choississez une catégorie--</option>
                    <option value="0">Entrée</option>
                    <option value="1">Plat</option>
                    <option value="2">Dessert</option>
                </select><br>
            </div>

            <div class="formRecette">
                <label>Séléctionnez le tag correspondant à votre recette</label>
                <select name="tags" id="tags_recette_form_recette" required="required">
                <?php
                $tags = $bdd->query("select INTITULE_TAG,TAG_NUM from TAGS")->fetchAll();
                for($i = 0; $i < count($tags);$i++){
                    echo ('<option value="'.$tags[$i]["TAG_NUM"].'">'.$tags[$i]["INTITULE_TAG"].'</option>');
                }
                ?>
                </select><br>
            </div>

            <div class="formRecette">
                <label>Entrez votre titre: </label>
                <input name="titre" type="text" placeholder="Titre" required="required"></input><br>
            </div>

            <div class="formRecette">
                <label>Entrez la recette complète: </label><br>
                <textarea name="contenu" type="text" rows="10" cols="100" placeholder="recette" required="required"></textarea><br>
                </div>

                <div class="formRecette">
                <label>Saisissez un court résumé de la recette: </label><br>
                <textarea name="resume" type="text" placeholder="résumé" rows="4" cols="30" required="required"></textarea><br>
            </div>

            <div class="formRecette">
                <label for="Séléctionnez les ingrédients de la recette:">Séléctionnez les ingrédients de la recette: </label>
                <input type="search" id="ingredient" name="ingredient" list="Listingredient" autocomplete="off" >
                <button id="ajout_ing_bouton" type="button" onclick="resetbouton()" >+</button>
                <datalist id="Listingredient"></datalist><br>

                <label>Ingredients :</label>
                <label id="ListeIngredientAjoute"></label><br>
                <input type="hidden" id="ingredientPost" name="ingredientPost" required="required">
            </div>

            <div class="formRecette">
                <label>Saisissez un lien d'image: </label>
                <input name="image" type="text" placeholder="Liens"></input><br>
                <input type="submit" value="Send Request"/>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./scriptFormRecette.js"></script>
