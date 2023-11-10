<?php
require ("connexion.php");
class RecetteManager extends Connexion{
    public function getDernieresRecettes()
    {
        $bdd = $this->dbConnect();
        $req = "select titre, resume, image from RECETTE where verifie = 1 order by date_creation desc limit 3";
        $sql = $bdd -> prepare($req);
        $sql -> execute();
        return $sql;
    }

}