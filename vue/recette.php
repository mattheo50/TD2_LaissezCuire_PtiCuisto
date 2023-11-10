<?php ob_start() ?>
    <section id="recipePage">
        <?php
        $data = $recette->fetch();
        echo "<img src='".$data['IMAGE']."' alt='Image recette'>";
        echo "<div id='titreRecipe'>";
        echo "<h2>".$data['TITRE']."</h2>";
        echo "<h3>".$data['INTITULE_CAT']."</h3>";
        echo "<h4>".$data['RESUME']."</h4>";
        echo "</div>";
        echo "<p>".$data['CONTENU']."</p>";
        ?>
    </section>
<?php $content = ob_get_clean();
require("vue/template.php"); ?>