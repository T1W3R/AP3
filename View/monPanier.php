<?php

include("header_connected.php");

?>


<h2>Mon panier</h2>


<?php
foreach ($infosCo as $res) {

    // Avoir un photo pour chaque produit. 
    $resultGP = getPhotos($res);

    // Avoir le prix total de chaque(s) article(s)
    $prixTTC = GetPrixTotal($res);

    //Afficher chaque produits du panier avec le nombre de produits 
    echo "<a href='http://localhost/SLAM/AP3/AP3/Controller/produit.php?id=" . $res["pr_reference"] . "'><div style='border: 1px solid black'>" . $res["pr_nom"] . " (X" . $res["pr_quantite"] . ") " . $prixTTC . " €<br><img src='" . $resultGP[0] . "' width = '350px', height='350px'></a></div><br>";
}


if (sizeof($infosCo) >= 1) {

    //Afficher le prix total 
    echo "<p> Prix total: " . $infosCo[0]["co_prixTotal"] . " €";

    //Bouton valider et payer panier 
    $link = "'http://localhost/SLAM/AP3/AP3/Controller/ValidationPanier.php?id=" . $infosCo[0]["co_id"] . "'";
    echo '<br><button type="button" onclick="window.location.href=' . $link . '">Valider</button>';
} else {

    echo "<center><h3>Votre panier est vide</h3></center>";
}


foreach ($resultGCo as $resGCo) {

    //Afficher les commandes Passee
    $resultGCP = getCommandePassee($resGCo);

    $texte = "Commande numéro: " . $resultGCo[0]["co_id"] . " commandée le: " . $resultGCo[0]["co_date"] . "<br>Articles commandés: ";
    foreach ($resultGCP as $resGCP) {
        $texte .= $resGCP["pr_nom"] . " (X" . $resGCP["pr_quantite"] . ") prix unitaire: " . $resGCP["pr_coutHT"] . " €<br>";
    }
    $texte .= "Expédié depuis: " . $resultGCP[0]["ls_libelle"] . ". Adresse de livraison: " . $resultGCP[0]["cl_adresse"];
    echo $texte;
}


?>
<br>

</html>