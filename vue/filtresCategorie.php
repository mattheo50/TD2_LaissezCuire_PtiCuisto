<?php ob_start() ?>
    <section class="selectionRecherche" id="selectionIngredients">
        <form action='index.php?action=filtresCategorie&offset=0' method='post'>
            <label for='dropdownCategorie'>Catégorie : </label>
            <select class='selectionSelect' id='dropdownCategorie' name='cat_num'>
                <?php
                    while ($categorie = $categories->fetch()) {
                        echo "<option value=".$categorie['cat_num'].">".$categorie['intitule_cat']."</option>";
                    }
                ?>
            </select>
            <button class='selectionButton' type='submit'>Rechercher</button>
        </form>
    </section>
    <section id="nosRecettes">   
        <div id="listRecipes">
        <?php
        foreach ($recettes as $data){
            echo "<a class='recipe' href='index.php?action=recette&rec_num=".$data['rec_num']."'>";
            echo "<div id='divimg'>";
            echo "<img src='".$data['image']."' alt='Image recette'>";
            echo "</div>";
            echo "<div id='contenuRecipe'>";
            echo "<h2>".$data['titre']."</h2>";
            echo "<h3>".$data['intitule_cat']."</h3>";
            foreach ($data['tags'] as $tag) {
                echo "<p>".$tag['intitule_tag']."</p>";
            }
            echo "<h4>".$data['resume']."</h4>";
            echo "</div>";
            echo "</a>";
        }
        ?>
        </div>
        <?php
            if ($offset < $count - 10) {
                echo "<a class='ctrlRecipes' href='index.php?action=filtresCategorie&offset=".($_SESSION['offset'] + 10)."'>+</a>";
            }
        ?>
    </section>
<?php $content = ob_get_clean();
require("vue/template.php"); ?>