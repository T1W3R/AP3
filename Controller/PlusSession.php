<?php
    session_start();

    $idProduit = $_GET["id"];
    //var_dump($id);

    if (isset($_SESSION["panier"][$idProduit])) {
        $_SESSION["panier"][$idProduit] +=  1;
    }

    header('Location: MonPanier.php');
    exit();
?>


