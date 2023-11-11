<?php ob_start() ?>
    <section id="recipePage">
        <?php
        $data = $recette->fetch();
        echo "<div id='containerTitre'>
              <img src='".$data['IMAGE']."' alt='Image recette'>
              <div id='titreRecipe'
              <h2>".$data['TITRE']."</h2>
              <h3>".$data['INTITULE_CAT']."</h3>";
        while ($tag = $tags->fetch()) {
            echo "<p>".$tag['intitule_tag']."</p>";
        }
        echo "<h4>".$data['RESUME']."</h4>
              </div>
              </div>
              <p>".$data['CONTENU']."</p>";
        ?>
    </section>
<?php $content = ob_get_clean();
require("vue/template.php"); ?>