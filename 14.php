<!--  E.Porcq	14.php 04/09/2014 -->

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Essais de redirection</title>
  </head>
 <?php
	echo "redir.php <hr/>";  // cela fonctionne ?????
	$x=$_GET['param'];
	echo $x."<hr/>"; 
	if ($x ==1)
	{
		echo '<script>alert("toto");</script>';  // s'affichera sur une page que l'on ne verra plus !!
		header("location:fic1.php");
		exit();
	}
	else if ($x == 2)
		header('Location:fic2.php?var=123&nom=martin&val='.$x);
	else if ($x == 3)
		echo '<script>document.location="fic3.php?id='.$x.'"</script>';  
	else if ($x == 4)
	{
?>

  <body>
  	<div id="navigation">
		<ul>
			<li><a href="fic4.php">Accueil</a></li>
			<li><a href="fic5.php">Connexion</a></li>
		</ul>
	</div>
  
    <input id="btQuit1" type="button" onClick="window.location.assign('fic6.php?page=page 6&val=SQL');" value="page 6">
	<input id="btQuit2" type="button" onClick="window.location.href='fic7.php';" value="page 7">
    <form name="monFormulaire" action= "fic8.php" method="post" >
	  <input name="btQuit3" type="hidden" value="<?php echo $x; ?>">
	  <input type="submit" value="valider">
	</form>
  </body>
 <?php
  }
  else
       header("location:fic9.php");
?>
</html>