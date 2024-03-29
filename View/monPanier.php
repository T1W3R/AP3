<?php

if (isset($_SESSION["login"])) {
    include("../View/header_connected.php");
} else {
    include("../View/header_unconnected.php");
};

?>



<center>
    <div>
        <h2>Mon panier</h2>
</center>

<?php
if (isset($_SESSION["panier"])) {
    $prixTotal = 0;
    foreach ($_SESSION["panier"] as $key => $value) {

        // Avoir un photo pour chaque produit.
        $photo = getPhoto($key);

        // Avoir les infos chaque(s) article(s)
        $infos = getInfoArt($key);

        // Avoir le Prix TTC chaque(s) article(s)
        $prix = getPrixTTC($infos);

        // Avoir le Prix de chaque(s) article(s)    
        $prixTTC = GetPrixTotal($prix, $value);



        //Afficher chaque produits du panier avec le nombre de produits
        echo "<form method='POST' action='ValidationPanier.php'>
                <div style='display: flex; align-items: center;'>
                    <a href='produit.php?id=" . $infos["pr_reference"] . "' style='display: flex; align-items: center;'>
                        <img  style='margin-left: 15px; margin-top: 15px; margin-bottom: 15px' src='" . $photo[0] . "' width = '100px', height='100px'>
                        <p style='margin-left: 15px; font-size: 20px; text-decoration: underline;'>" . $infos["pr_nom"] . "</p>
                    </a>
                    <div>
                        <input type='text' value='" . $value . "' min='0' style='color: aliceblue; background-color: #B19D7F; margin-left: 15px; margin-right: 5px; height: 20px; width: 76px; font-size: 15px; border-radius: 5px 5px 0px 0px; border: none; text-align: center;'> 
                        <div style='display: flex; margin-left: 15px;'>
                            <a style='background-color: aliceblue; color: #c1B89F; border-radius: 0px 0px 0px 5px; height: 20px; width: 40px' href='MoinSession.php?id=" . $infos["pr_reference"] . "'><center>-</center></a>
                            <a style='background-color: aliceblue; color: #c1B89F; border-radius: 0px 0px 5px 0px; height: 20px; width: 40px' href='PlusSession.php?id=" . $infos["pr_reference"] . "'><center>+</center></a>
                        </div>
                    </div>
                    <p> x " . $infos["pr_coutHT"] . " €</p>
                    <p style='margin-left: 30px; font-size: 30px;'>" . $prixTTC . " €</p>
                </div>
               <br>";

        $prixTotal += $prixTTC;
    }

    echo "  <span style='font-size:15px; font-style:italic; margin-left: 110px'>&emsp;+ 20 % TVA </span>
        <br>
            <span style='font-size:15px; font-style:italic; margin-left: 110px'>&emsp;+ 5€ frais de port</span>";

    //Afficher le prix total
    echo "<center><p> Total du panier : <span style='font-size: 30px; text-decoration: underline;'>" . round($prixTotal * 1.2 + 5, 2) . " €</span>
        <input type='hidden' name='prixTotal' value='" . $prixTotal . "'>";

    if (isset($_SESSION['login'])) {
        //Bouton valider et payer panier
        echo '<br><button type="submit">Valider</button></form></center>';
    } else {
        //Bouton valider et payer panier
        echo '<br></form><a href="connexion.php" id="boutton">Valider</a></center>';
    }
} else {
    echo "<center><h3>Votre panier est vide</h3></center>";
}

if (isset($_SESSION["login"])) {


    echo '</div></center>';

    echo "<br><hr style='border: none; background-color: aliceblue; height:1px;'><h2>Commandes précédentes</h2>";

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
                                        font-size:18px;'>
                <p><h3><u>Commande numéro " . $resGCo["co_id"] . ": </h3>Commandée le:</u> " . $resGCo["co_date"] . "<br><u>Articles commandés:</u> <ul>";
        foreach ($resultGCP as $resGCP) {
            $texte .= "<li>" . $resGCP["pr_nom"] . " (X" . $resGCP["pr_quantite"] . ") prix unitaire: " . round($resGCP["pr_coutHT"], 2) . " €</li>";
        }
        $texte .= "</ul> " . //<u>Expédié depuis:</u> " . $resultGCP["ls_libelle"] . ".<br> //
            "<u>Adresse de livraison:</u> " . $resGCo["cl_adresse"];
        $prixTotal = $resGCo["co_prixTotal"] + 5;
        $texte .= "<br><u>Prix HT:</u> " . round($resGCo["co_prixTotal"] / 1.2, 2) . "€ <br><span style='font-size:15px; font-style:italic'>&emsp;+ 20 % TVA <br>&emsp;+ 5€ frais de port</span><br> <u>Prix TTC:</u> <b>" . round($prixTotal, 2) . "€ </b></p>";
        echo $texte . "</div>";
    }
}

?>



<br>

</html>