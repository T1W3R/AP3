<?php
session_start();
include "../Model/commandes.php";

$idProduit = $_GET["id"];
$stockInternet = getStockInternet($idProduit);
//var_dump($id);

if (isset($_SESSION["panier"][$idProduit])) {
    if ($_SESSION["panier"][$idProduit] > intval($stockInternet)) {
        $_SESSION["panier"][$idProduit] +=  1;
    }
}

header('Location: MonPanier.php');
exit();
