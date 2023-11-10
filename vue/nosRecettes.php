<?php ob_start() ?>
    <section id="nosRecettes">   
        <div id="listRecipes">
        <?php
        while($data = $recettes->fetch()){
            echo "<div class='recipe'>";
            echo "<div id='divimg'>";
            echo "<img src='".$data['image']."' alt='Image recette'>";
            echo "</div>";
            echo "<h4>".$data['titre']."</h4>";
            echo "</div>";
        }
        ?>
        </div>

        <div id="divButton">
        <?php
            if ($offset != 10) {
                echo "<a class='ctrlRecipes' href='index.php?action=nosRecettes&offset=".($_SESSION['offset'] - 10)."'>Précédent</a>";
            }
            if ($offset < $count - 3) {
                echo "<a class='ctrlRecipes' href='index.php?action=nosRecettes&offset=".($_SESSION['offset'] + 10)."'>Suivant</a>";
            }
        ?>
        </div>
    </section>
<?php $content = ob_get_clean();
require("vue/template.php"); ?>