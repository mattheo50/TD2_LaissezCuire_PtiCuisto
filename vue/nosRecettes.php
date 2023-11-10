<?php ob_start() ?>
    <section id="nosRecettes">   
        <div id="listRecipes">
        <?php
        while($data = $recettes->fetch()){
            echo "<div class='recipe'>";
            echo "<img src='".$data['image']."' alt='Image recette'>";
            echo "<h4>".$data['titre']."</h4>";
            echo "</div>";
        }
        ?>
        </div>

        <?php
            if ($offset < $count - 10) {
                echo "<a id='moreRecipes' href='index.php?action=nosRecettes&offset=".($_SESSION['offset'] + 10)."'>Afficher plus</a>";
            }
        ?>
    </section>
<?php $content = ob_get_clean();
require("vue/template.php"); ?>