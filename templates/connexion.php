<?php
    $dotenv = parse_ini_file("../auth.env");
    $DB_TYPE = $dotenv['DB_TYPE'];
    $DB_HOST = $dotenv['DB_HOST'];
    $DB_NAME = $dotenv['DB_NAME'];

    try {
        $bdd = new PDO("$DB_TYPE:host=$DB_HOST;dbname=$DB_NAME;charset=utf8", $dotenv['DB_USER'], $dotenv['DB_PASS']);
    } catch(Exception $e) {
        die('Erreur : '.$e->getMessage());
    }
?>