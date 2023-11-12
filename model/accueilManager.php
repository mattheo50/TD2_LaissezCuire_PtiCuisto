<?php
require_once ("connexion.php");
class accueilManager extends Connexion{

    public function getEditoBDD(){
        $bdd = $this->dbConnect();
        $req = "SELECT message from EDITO where (sysdate()-date_edition) <= all (select (sysdate()-date_edition) from EDITO)";
        $sql = $bdd->prepare($req);
        $sql->execute();
        return $sql->fetch()[0];
    }

    public function setEdito($msg){
        $bdd = $this->dbConnect();
        $req = "SELECT max(num_message)+1 from EDITO";
        $sql = $bdd->prepare($req);
        $sql->execute();
        $num = $sql->fetch()[0];
        $insert = "INSERT INTO EDITO values(?,sysdate(),?)";
        $stmt = $bdd->prepare($insert);
        $stmt->execute([$num,$msg]);
    }
}