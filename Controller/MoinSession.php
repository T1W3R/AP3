<?php
    session_start();

    $idProduit = $_GET["id"];
    //var_dump($id);

    if (isset($_SESSION["panier"][$idProduit])) {
        if ($_SESSION["panier"][$idProduit] > 1){
            $_SESSION["panier"][$idProduit] -= 1;
        } else {
            unset($_SESSION['panier'][$idProduit]);
        }
    }

    header('Location: MonPanier.php');
    exit();
?>