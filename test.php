<?php
require("controller/testController.php");
session_start();

try{
    if (isset($_GET['action'])) {
    }
    else{
        $blog = new TestController();
        $blog->afficheContenu();
    }
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
