<?php ob_start();
 $title = 'NouvelleRecette';
?>   

    <div class="container">
        <form id='formEditRecette' action='index.php?action=traitementform<?php if(isset($recette)){echo "&rec_num=".$recette['REC_NUM'];}?>' method='post'>
            <div class="formRecette">
                <label>Quelle est la catégorie de votre recette ? </label>
                <select class="grosField" name="categorie" id="categorie_recette_form_recette" required="required">
                    <option value="">--Choississez une catégorie--</option>
                    <option value="0" <?php if(isset($recette) && $recette['CAT_NUM'] == 0){echo "selected";}?>>Entrée</option>
                    <option value="1" <?php if(isset($recette) && $recette['CAT_NUM'] == 1){echo "selected";}?>>Plat</option>
                    <option value="2" <?php if(isset($recette) && $recette['CAT_NUM'] == 2){echo "selected";}?>>Dessert</option>
                </select><br>
            </div>
            
            <div class="formRecette">
                <label>Séléctionnez le tag correspondant à votre recette</label>
                <input class="grosField" type="search" id="tags_recette_form_recette" name="tags" list="ListTag" autocomplete="off" >
                <button class="ctrlRecipes" id="ajout_tag_bouton" type="button" >+</button>
                <datalist id="ListTag"></datalist><br>

                <label>Tags :</label>
                <label id="ListeTagAjoute"></label><br>
                <input type="hidden" id="TagPost" name="TagPost" required="required">
            </div>

            <div class="formRecette">
                <label>Entrez votre titre: </label>
                <input class="grosField" name="titre" type="text" placeholder="Titre" required="required" <?php if(isset($recette)){echo "value='".$recette['TITRE']."'";}?>></input><br>
            </div>

            <div class="formRecette">
                <label>Entrez la recette complète: </label><br>
                <textarea name="contenu" type="text" rows="8" cols="60" placeholder="recette" required="required"><?php if(isset($recette)){echo $recette['CONTENU'];}?></textarea><br>
            </div>

            <div class="formRecette">
                <label>Saisissez un court résumé de la recette: </label><br>
                <textarea name="resume" type="text" placeholder="résumé" rows="4" cols="30" required="required"><?php if(isset($recette)){echo $recette['RESUME'];}?></textarea><br>
            </div>

            <div class="formRecette">
                <label for="Séléctionnez les ingrédients de la recette:">Séléctionnez les ingrédients de la recette: </label>
                <input class="grosField" type="search" id="ingredient" name="ingredient" list="Listingredient" autocomplete="off" >
                <button class="ctrlRecipes" id="ajout_ing_bouton" type="button" onclick="resetIngbouton()" >+</button>
                <datalist id="Listingredient"></datalist><br>

                <label>Ingredients :</label>
                <label id="ListeIngredientAjoute"></label><br>
                <input type="hidden" id="ingredientPost" name="ingredientPost" required="required">
            </div>

            <div class="formRecette">
                <label>Saisissez un lien d'image: </label>
                <input class="grosField" name="image" type="text" placeholder="Lien" <?php if(isset($recette)){echo "value='".$recette['IMAGE']."'";}?>></input><br>
            </div>
            <input class="grosField" type="submit" value="Envoyer"/>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/scriptFormRecette.js"></script>
    <?php $content = ob_get_clean();
    require("vue/template.php");?>
