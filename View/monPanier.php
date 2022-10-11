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

echo "<br><hr style='border: none; background-color: aliceblue; height:1px;'>
<h2>Commandes précédentes</h2>";
foreach ($resultGCo as $resGCo) {
    
    if ($resultGCo[0] != $resGCo){
        echo "<hr style='border: none; 
        background-color: aliceblue; 
        height:1px; 
        margin-left: 300px; 
        margin-right: 300px'>";
    }
    //Afficher les commandes Passee
    $resultGCP = getCommandePassee($resGCo);

    $texte = "<div style='padding-left: 200px; 
        padding-right: 200px; 
        font-size:18px'>
    <p><h3 style='text-align: center'><u>Commande numéro " . $resultGCo[0]["co_id"] . ": </h3>Commandée le:</u> " . $resultGCo[0]["co_date"] . "<br><u>Articles commandés:</u> <ul>";
    foreach ($resultGCP as $resGCP) {
        $texte .= "<li>".$resGCP["pr_nom"] . " (X" . $resGCP["pr_quantite"] . ") prix unitaire: " . $resGCP["pr_coutHT"] . " €</li>";
    }
    $texte .= "</ul><u>Expédié depuis:</u> " . $resultGCP[0]["ls_libelle"] . ".<br> <u>Adresse de livraison:</u> " . $resultGCP[0]["cl_adresse"];
    $prixTotal = $resultGCP[0]["co_prixTotal"] * 1.20 + 5;
    $texte .= "<br><u>Prix HT:</u> ".$resultGCP[0]["co_prixTotal"]. "€ <br><span style='font-size:15px; font-style:italic'>&emsp;+ 20 % TVA <br>&emsp;+ 5€ frais de port</span><br> <u>Prix TTC:</u> ".number_format((float)$prixTotal, 2 , '.','')."€ </p>";
    echo $texte."</div>";
}

?>
<br>

</html>