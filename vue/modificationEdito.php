<?php ob_start();
require_once("controller/accueilController.php") ;
$controller = new accueilController();?>
            <form id='formEdito' action="index.php?action=EditoModifie" method="post">
                <label >Texte de l'édito : </label>
                    <textarea name="contenu" type="text" rows="8" cols="60"><?php $controller->getEdito(); ?></textarea>
                <input class='grosField' type="submit" value="Modifier"/>
            </form>
<?php $content = ob_get_clean();
require("vue/template.php"); ?>