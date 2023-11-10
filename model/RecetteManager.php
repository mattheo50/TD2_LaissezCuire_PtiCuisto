<?php
require_once ("connexion.php");
class RecetteManager extends Connexion{
    public function getDernieresRecettes() {
        $bdd = $this->dbConnect();
        $req = "select titre, resume, image from RECETTE order by date_creation desc limit 3";
        $sql = $bdd -> prepare($req);
        $sql -> execute();
        return $sql;
    }

    public function getOffsetRecettes($offset) {
        $bdd = $this->dbConnect();
        $req = "select titre, image from RECETTE where verifie=1 limit 10 offset ".$offset;
        $sql = $bdd -> prepare($req);
        $sql -> execute();
        return $sql;
    }

    public function getSizeRecettes() {
        $bdd = $this->dbConnect();
        $req = "select count(*) from RECETTE where verifie=1";
        $sql = $bdd -> prepare($req);
        $sql -> execute();
        return $sql->fetch()[0];
    }
}