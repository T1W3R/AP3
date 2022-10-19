<?php
session_start();

include "../Model/commandes.php";

$idProduit = $_POST['id'];
$id = getIdClient();
$idpanier = getInfoCommande($id);

if (empty($idpanier)) {
    var_dump("pas de panier vreer un");
} else {
    //insert dans le panier
    insertElementDansPanier($idpanier);
}
