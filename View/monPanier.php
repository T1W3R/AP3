<?php

include("header_connected.php");

?>


<h2>Mon panier</h2>


<?php

foreach ($_SESSION["panier"] as $key => $value) {

    // Avoir un photo pour chaque produit.
    $photo = getPhoto($key);

    // Avoir les infos chaque(s) article(s)
    $infos = getInfoArt($key);

    // Avoir le Prix TTC chaque(s) article(s)
    $prixTTC = GetPrixTotal($infos, $key);

    //Afficher chaque produits du panier avec le nombre de produits
    echo "<div style='border: 1px solid black;'><a href='produit.php?id=" . $infos["pr_reference"] . "' style='display: flex;align-items: center;''><img src='" . $photo[0] . "' width = '100px', height='100px'><p>" . $infos["pr_nom"] . " (X" . $value . ") " . $prixTTC . " €</p></a></div><br>";
}


if (isset($_SESSION["panier"])) {

    $prixTotal = 0;
    foreach ($_SESSION["panier"] as $key => $value) {
        $infos = getInfoArt($key);
        $prixTTC = GetPrixTotal($infos, $key);

        $prixTotal += $prixTTC;
    }

    //Afficher le prix total
    echo "<p> Prix total: " . $prixTotal . " €";

    //Bouton valider et payer panier
    echo '<br><button type="button" onclick="Commande.php">Valider</button>';

} else {
    echo "<center><h3>Votre panier est vide</h3></center>";
} 


echo "<br><hr style='border: none; background-color: aliceblue; height:1px;'>
<h2>Commandes précédentes</h2>";
foreach ($resultGCo as $resGCo) {

    if ($resultGCo[0] != $resGCo) {
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
        font-size:18px;
        text-align: center'>
    <p><h3><u>Commande numéro " . $resultGCo[0]["co_id"] . ": </h3>Commandée le:</u> " . $resultGCo[0]["co_date"] . "<br><u>Articles commandés:</u> <ul>";
    foreach ($resultGCP as $resGCP) {
        $texte .= "<li>" . $resGCP["pr_nom"] . " (X" . $resGCP["pr_quantite"] . ") prix unitaire: " . $resGCP["pr_coutHT"] . " €</li>";
    }
    $texte .= "</ul><u>Expédié depuis:</u> " . $resultGCP[0]["ls_libelle"] . ".<br> <u>Adresse de livraison:</u> " . $resultGCP[0]["cl_adresse"];
    $prixTotal = $resultGCP[0]["co_prixTotal"] * 1.20 + 5;
    $texte .= "<br><u><b>Prix HT:</b></u> " . $resultGCP[0]["co_prixTotal"] . "€ <br><span style='font-size:15px; font-style:italic'>&emsp;+ 20 % TVA <br>&emsp;+ 5€ frais de port</span><br> <u>Prix TTC:</u> " . number_format((float)$prixTotal, 2, '.', '') . "€ </p>";
    echo $texte . "</div>";
}

?>
<br>

</html>