<?php ob_start();
require_once("controller/accueilController.php") ;
$controller = new accueilController();?>
            <form action="index.php?action=EditoModifie" method="post">
                <label >Texte de l'édito : </label><br>
                    <textarea name="contenu" type="text" rows="10" cols="100"><?php $controller->getEdito(); ?></textarea><br>
                <input type="submit" value="Modifier"/>
            </form>
<?php $content = ob_get_clean();
require("vue/template.php"); ?>