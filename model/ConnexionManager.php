<?php
require ("connexion.php");

class ConnexionManager extends Connexion{

    //renvoie 0 si l'utilisateur existe pas, 1 si il existe, 2 si c'est un admin
    public function getUtilisateur($pseudo, $motDePasse)
    {
        $bdd = $this->dbConnect();
        //la requête renvoie 1 si l'utilisateur existe, 0 sinon
        $req = 'select count(*) as nb from UTILISATEUR where (PSEUDO = ? and MOT_DE_PASSE = ? )
        or (ADRESSE_MAIL = ? and MOT_DE_PASSE = ? )';
        $sql = $bdd -> prepare($req);
        $sql -> execute(array($pseudo, $motDePasse, $pseudo, $motDePasse));

        //récupère le resultat de la requête
        $reponse = $sql -> fetch();

        //vérifie si l'utilisateur éxiste, renvoie 0 sinon
        if ($reponse['nb'] == 0) {
            return 0;
        }

        //Récupère le numéro d'uttilisateur
        $req = 'select UTI_NUM as uti_num from UTILISATEUR where (PSEUDO = ? and MOT_DE_PASSE = ? )
        or (ADRESSE_MAIL = ? and MOT_DE_PASSE = ? )';
        $sql = $bdd -> prepare($req);
        $sql -> execute(array($pseudo, $motDePasse, $pseudo, $motDePasse));
        $num = $sql -> fetch();
        //place le numéro d'utilisateur dans la variable session uti_num
        $_SESSION['uti_num'] = $num['uti_num'];

        //Récupère le tag utilisateur de l'utilisateur afin de vérifié si c'est un admin
        $req = 'select TYPE_UTI as type from UTILISATEUR where UTI_NUM = ?';
        $sql = $bdd -> prepare($req);
        $sql -> execute(array($_SESSION['uti_num']));
        $type = $sql -> fetch();
        
        //Si l'utilisateur est l'admin, met la variable session admin à true
        if ($type['type'] == 0) {
            $_SESSION['admin']=true;
            return 2;
        }
        $_SESSION['admin']=false;
        return 1;
    }


    public function updateFormText($n)
	{  
		if (!empty($_POST[$n]))
		{
		  $var = $_POST[$n];
		  if ($var <> "")
			echo $var; 
		}
		else 
		  echo ""; 
	}


}