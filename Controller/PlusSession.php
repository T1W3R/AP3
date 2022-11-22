<?php
session_start();
include "../Model/commandes.php";

$idProduit = $_GET["id"];
$stockInternet = getStockInternet($idProduit);


if (isset($_SESSION["panier"][$idProduit])) {
    if ($_SESSION["panier"][$idProduit] < intval($stockInternet[0])) {
        $_SESSION["panier"][$idProduit] +=  1;
    }
}


header('Location: MonPanier.php');

exit();
