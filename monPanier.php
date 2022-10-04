<?php  
include("header_connected.php");
session_start();

function construct_(){

    $dsn = 'mysql:dbname=ap3;host=127.0.0.1:3308';

    try {
        $bdd = new PDO($dsn, "root", "");
        return $bdd;
    } catch (PDOExeption $e) {
        die('DB Error: ' . $e->getMessage());
    }
}

echo "<h2>Mon panier</h2>";

// Avoir les infos du client
    $getLogin = "SELECT cl_id FROM `client` WHERE cl_code = '".$_SESSION['login']."';";
    $bdd = construct_();
    $queryGL = $bdd->prepare($getLogin);
    $queryGL->execute();
    $resultGL = $queryGL->fetch();

//Avoir les infos de la commande
    $sql = "SELECT co_id, co_prixTotal, pr_reference, pr_nom, pr_quantite, pr_coutHT FROM `commande` JOIN lie_a ON fk_co = co_id JOIN produit ON fk_pr = pr_reference WHERE co_statut = 'En attente' AND fk_cl =".$resultGL["cl_id"].";";
    $query = $bdd->prepare($sql);
    $query->execute();
    $result = $query->fetchAll();


foreach($result as $res){
    // Avoir un photo pour chaque produit. 
    $getPhoto = "SELECT ph_chemin FROM photos WHERE fk_pr = " . $res['pr_reference'] . "; ";
    $queryGP = $bdd->prepare($getPhoto);
    $queryGP->execute();
    $resultGP = $queryGP->fetch();

    //Avoir le prix total de chaque(s) article(s)
    $prixTTC = ($res["pr_coutHT"] + 0.20 * $res["pr_coutHT"])* $res["pr_quantite"];
    $prixTTC = number_format((float)$prixTTC, 2, '.', '');

    //Afficher chaque produits du panier avec le nombre de produits 
    echo "<a href='http://localhost/SLAM/AP3/AP3/produit.php?id=".$res["pr_reference"]."'><div style='border: 1px solid black'>".$res["pr_nom"]." (X".$res["pr_quantite"].") ".$prixTTC." €<br><img src='" . $resultGP[0] . "' width = '350px', height='350px'></a></div><br>";
}
if (sizeof($result) >= 1){
    //Afficher le prix total 
    echo "<p> Prix total: ".$result[0]["co_prixTotal"]." €";

    //Bouton valider et payer panier 
    $link = "'ValidationPanier.php?id=".$result[0]["co_id"]."'";
    echo '<br><button type="button" onclick="window.location.href='.$link.'">Valider</button>';
} else {
    echo "<center><h3>Votre panier est vide</h3></center>";
}




// Avoir toutes les commandes passées.
$getCommandes = "SELECT co_id, co_date, co_prixTotal, cl_adresse
FROM `commande`
    JOIN client ON fk_cl = cl_id
WHERE co_statut != 'En attente' AND fk_cl =".$resultGL["cl_id"].";";
$queryGCo = $bdd->prepare($getCommandes);
$queryGCo->execute();
$resultGCo = $queryGCo->fetchAll();

foreach ($resultGCo as $resGCo){
    $getCoPassee = "SELECT pr_nom, pr_quantite, pr_coutHT, co_prixTotal, ls_libelle, cl_adresse
    FROM `commande` 
        JOIN lie_a ON fk_co = co_id 
        JOIN produit ON lie_a.fk_pr = pr_reference 
        JOIN est_stocke ON est_stocke.fk_pr = pr_reference
        JOIN lieustockage ON ls_id = fk_ls
        JOIN client ON fk_cl = cl_id
    WHERE co_id =".$resGCo["co_id"].";";
    $queryGCP = $bdd->prepare($getCoPassee);
    $queryGCP->execute();
    $resultGCP = $queryGCP->fetchAll();

    $texte = "Commande numéro: ".$resultGCo[0]["co_id"]." commandée le: ".$resultGCo[0]["co_date"]."<br>Articles commandés: ";
    foreach ($resultGCP as $resGCP){
        $texte .= $resGCP["pr_nom"]." (X".$resGCP["pr_quantite"].") prix unitaire: ".$resGCP["pr_coutHT"]." €<br>";
    }
    $texte .= "Expédié depuis: ".$resultGCP[0]["ls_libelle"].". Adresse de livraison: ".$resultGCP[0]["cl_adresse"];
    echo $texte;
}





    
?>
<br>

</html>