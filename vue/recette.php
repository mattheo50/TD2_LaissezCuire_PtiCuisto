<?php ob_start() ?>
    <section id="recipePage">
        <?php
        $data = $recette->fetch();
        echo "<div id='containerTitre'>
              <div id='titreRecipe'>
              <h2>".$data['TITRE']."</h2>
              <h3>".$data['INTITULE_CAT']."</h3>";
        while ($tag = $tags->fetch()) {
            echo "<p>".$tag['intitule_tag']."</p>";
        }
        echo "<h4>".$data['RESUME']."</h4>
              </div>
              <img src='".$data['IMAGE']."' alt='Image recette'>
              </div>
              <p>".$data['CONTENU']."</p>";
        
        if (isset($_SESSION['uti_num']) && isset($_SESSION['admin'])) {
            if ($data['UTI_NUM'] == (int)$_SESSION['uti_num'] || isset($_SESSION['admin'])) {
                echo "<div id='editDiv'>
                        <a class='editButton' id='modifButton' href='index.php?action=modifRecette&rec_num=".$data['REC_NUM']."'>Modifier la recette</a>
                        <button class='editButton' id='supprButton' onclick='supprConfirm(".$data['REC_NUM'].")'>Supprimer la recette</button>
                      </div>";
            }
        }
        ?>
        <script>
            function supprConfirm(rec_num) {
                let res = confirm('Voulez vous vraiment supprimer cette recette ?');
                if (res) {
                    document.location='index.php?action=suppr&rec_num='+rec_num;
                }
            }
        </script>
    </section>
<?php $content = ob_get_clean();
require("vue/template.php"); ?>