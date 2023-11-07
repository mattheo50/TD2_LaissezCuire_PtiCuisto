<?php ob_start() ?>
            <section id="imageHeader">
                <img src="https://brandsitesplatform-res.cloudinary.com/image/fetch/w_1540,c_scale,q_auto:eco,f_auto,fl_lossy,dpr_1.0,e_sharpen:85/https://assets.brandplatform.generalmills.com%2F-%2Fmedia%2Fproject%2Fgmi%2Foldelpaso%2Foldelpaso-fr%2Foepp%2Fnri%2Frub-cycle%2Fpoulet-roti-facon-fajita-hero.png%3Fw%3D480%26rev%3D6b4feaec3e3b47f38a9094d32cb52c1d%201540w">
            </section>

            <section id="alignSect">
                <section id="sectionLast">
                    <h2>Les dernières recettes</h2>
                    <div id="lastRecipes">
                    <?php
                    while($data = $recettes->fetch()){
                    ?> 
                            <div class="lastRecipe">
                                <img src="<?php echo $data['image']?>" alt="Petit Cuistot">
                                <h4><?php echo $data['titre'] ?></h4>
                                <p><?php echo $data['resume']?></p>
                            </div>
                        <?php }?>
                    </div>
                </section>
                <section id="edito">
                    <img id="imgCuistot" src="images/Pticuisto.png" alt="Petit Cuistot">
                    <h2>Edito</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing
                       elit. Duis sodales commodo sapien, eget egestas diam
                       vulputate sit amet. Duis ut semper magna, eu lobortis
                       sem. In mollis lectus dolor, vitae tincidunt tellus
                       hendrerit eu. Sed consequat diam sed orci fringilla
                       dapibus. Etiam sed leo eget metus facilisis tristique
                       eget sit amet risus. Cras purus risus, interdum porta
                       lorem venenatis, suscipit pulvinar mauris.</p>
                </section>
            </section>
<?php $content = ob_get_clean();
require("vue/template.php"); ?>