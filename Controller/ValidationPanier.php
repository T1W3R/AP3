<?php
session_start();

function construct_()
{

    $dsn = 'mysql:dbname=ap3;host=127.0.0.1:3308';

    try {
        $bdd = new PDO($dsn, "root", "");
        return $bdd;
    } catch (PDOException $e) {
        die('DB Error: ' . $e->getMessage());
    }
}

$updateStatus = "UPDATE `commande` SET `co_statut`='transmise' WHERE co_id =" . $_GET["id"];
$bdd = construct_();
$queryUs = $bdd->prepare($updateStatus);
$queryUs->execute();

header('Location: http://localhost/SLAM/AP3/AP3/Controller/monPanier.php');
