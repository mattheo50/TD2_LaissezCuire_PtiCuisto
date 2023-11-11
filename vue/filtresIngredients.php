<?php ob_start() ?>
    <section id="selectionTitre">
        <form action='index.php?action=filtresIngredients&offset=0' method='post'>
            <label for='dropdownIngredients'>Ingrédient : </label>
            <select id='dropdownIngredients' name='ing_num'>
                <?php
                    while ($ingredient = $ingredients->fetch()) {
                        echo "<option value=".$ingredient['ing_num'].">".$ingredient['intitule_ing']."</option>";
                    }
                ?>
            </select>
            <button type='submit'>Rechercher</button>
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
                echo "<a class='ctrlRecipes' href='index.php?action=filtresIngredients&offset=".($_SESSION['offset'] + 10)."'>+</a>";
            }
        ?>
    </section>
<?php $content = ob_get_clean();
require("vue/template.php"); ?>