<?php
session_start();

include "../Model/commandes.php";

$idProduit = $_POST['idProduit'];
$quantite = $_POST['quantite'];
$stockInternet = getStockInternet($idProduit);
var_dump($stockInternet);

if ($stockInternet[0] >= $quantite + $_SESSION["panier"][$idProduit]) {
    if (!isset($_SESSION["panier"])) {
        $_SESSION["panier"] = [];
    }

    if (isset($_SESSION["panier"][$idProduit])) {
        $_SESSION["panier"][$idProduit] +=  $quantite;
    } else {
        $_SESSION["panier"] += [$idProduit => $quantite];
    }
}

header('Location: MonPanier.php');
exit();
