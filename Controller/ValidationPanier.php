<?php
session_start();
include("../Model/commandes.php");

$prixTotal = $_POST['prixTotal'];
$idClient = getIdClient();

//creer une commande
InsertCommande($prixTotal, $idClient);

//creer recuperer l'id de la commande
$idCommande = getIdCommande($idClient);

//inserer dans les lie a
foreach ($_SESSION["panier"] as $ref => $quantite) {
    InsertProduitsCommande($idCommande, $ref, $quantite);
    subNbProduit($ref,$quantite);
}

unset($_SESSION['panier']);

header('Location: http://localhost/SLAM/AP3/AP3/Controller/monPanier.php');
exit();
