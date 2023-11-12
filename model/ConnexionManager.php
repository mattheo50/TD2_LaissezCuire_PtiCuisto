<?php
require ("connexion.php");

class ConnexionManager extends Connexion{

    /*---------------------------AUTHENTIFICATION---------------------------*/
    //renvoie 0 si l'utilisateur existe pas ou que le mot de passe est faux,
    //1 si il existe, 2 si c'est un admin
    public function getUtilisateur($pseudo, $motDePasse)
    {
        //se connecte à la base de données
        $bdd = $this->dbConnect();

        //la requête renvoie 1 si l'utilisateur existe, 0 sinon
        $req = 'select count(*) as nb from UTILISATEUR where PSEUDO = ? or ADRESSE_MAIL = ?';
        $sql = $bdd -> prepare($req);
        $sql -> execute(array($pseudo, $pseudo));
        $reponse = $sql -> fetch();

        //vérifie si l'utilisateur éxiste, renvoie 0 sinon
        if ($reponse['nb'] == 0) {
            return 0;
        }

        //récupère le mot de passe haché de l'utilisateur
        $req = 'select MOT_DE_PASSE as hashpass from UTILISATEUR where PSEUDO = ? or ADRESSE_MAIL = ?';
        $sql = $bdd -> prepare($req);
        $sql -> execute(array($pseudo, $pseudo));
        $reponse = $sql -> fetch();

        //renvoie 0 en cas de mauvais mot de passe
        if (!(password_verify($motDePasse, $reponse['hashpass'])) ) {
            return 0;
        }

        //Récupère le numéro d'uttilisateur
        $req = 'select UTI_NUM as uti_num from UTILISATEUR where PSEUDO = ? or ADRESSE_MAIL = ?';
        $sql = $bdd -> prepare($req);
        $sql -> execute(array($pseudo, $pseudo));
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

    //code pour remettre à jour les input du formulaire
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

    /*---------------------------INSCRIPTION---------------------------*/
    //vérifie si l'utilisateur existe ou non, renvoie true s'il existe, false sinon
    public function existeUilisateur($pseudo) {
        //se connecte à la base de données
        $bdd = $this->dbConnect();

        //la requête renvoie 1 si l'utilisateur existe, 0 sinon
        $req = 'select count(*) as nb from UTILISATEUR where PSEUDO = ? or ADRESSE_MAIL = ?';
        $sql = $bdd -> prepare($req);
        $sql -> execute(array($pseudo, $pseudo));
        $reponse = $sql -> fetch();

        if ($reponse['nb'] == 0) {
            return false;
        }
        return true;
    }

    public function creerUtilisateur($pseudo, $motDePasse, $mail, $prenom, $nom) {
        //se connecte à la base de données
        $bdd = $this->dbConnect();

        //récupération du prochain numéro d'utilisateur
        $max_uti_num = $bdd->query("select max(UTI_NUM)+1 from UTILISATEUR");
        $uti_num = $max_uti_num->fetch();

        //insertion d'un utilisateur à la base de donnée
        $req = "INSERT INTO UTILISATEUR(UTI_NUM, TYPE_UTI, PSEUDO, MOT_DE_PASSE, ADRESSE_MAIL, PRENOM, NOM, DATE_INSCRIPTION, STATUT) VALUES (?, ?, ?, ?, ?, ?, ?,sysdate() ,?)";
        $insert = $bdd->prepare($req);
        $insert->execute(array($uti_num[0], 1, $pseudo, password_hash($motDePasse, PASSWORD_DEFAULT), $mail, $prenom, $nom, 1) );

    }

}