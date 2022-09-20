<?php

if (session_status() === PHP_SESSION_NONE) {
    include "header_unconnected.php";
} else {
    include "header_connected.php";
};

if (isset($_GET["id"])) {
    function getConnexion()
    {
        $dsn = 'mysql:dbname=ap3;host=127.0.0.1:3308';

        try {
            $bdd = new PDO($dsn, "root", "");
            return $bdd;
        } catch (PDOExeption $e) {
            die('DB Error: ' . $e->getMessage());
        }
    }
    //Avoir les infos de l'article 
    $sql = "SELECT pr_id, pr_nom, pr_coutHT, pr_description, pr_stockInternet FROM `produit` WHERE pr_id=" . $_GET['id'];
    $bdd = getConnexion();
    $query = $bdd->prepare($sql);
    $query->execute();
    $result = $query->fetch();

    //Avoir les photos
    $getPhoto = "SELECT ph_chemin FROM photos WHERE fk_pr = " . $result['pr_id'] . "; ";
    $queryGP = $bdd->prepare($getPhoto);
    $queryGP->execute();
    $resultGP = $queryGP->fetchAll();

    //Avoir stock magasin
    $getStockMagasin = "SELECT pr_stock, ma_lieu FROM a_en_stock JOIN magasin ON fk_ma = ma_id WHERE fk_pr = ".$_GET['id']; 
    $queryGST = $bdd->prepare($getStockMagasin);
    $queryGST->execute();
    $resultGST = $queryGST->fetchAll();
    $DispoMagasin = "";
    if($resultGST != "none"){
        foreach($resultGST as $resGST){
            $DispoMagasin .= "<br>".$resGST["ma_lieu"].": ".$resGST["pr_stock"]." disponibilités."; 
        }
    }

    //Calcul prix total
    $prixTTC = $result["pr_coutHT"] + 0.20 * $result["pr_coutHT"];
    $prixTTC = number_format((float)$prixTTC, 2, '.', '');

    //Affichage produit 
    echo "<p>" . $result["pr_nom"] . "<br>" . $result["pr_description"] . "<br>" . $result['pr_coutHT'] . " € HT<br>+20% TVA<br>" . $prixTTC . "€ TTC ".$DispoMagasin." <br> Stock internet: ".$result["pr_stockInternet"]." disponibilités.</p>";
    
    foreach ($resultGP as $resGP) {
        echo "<img src='" . $resGP[0] . "' width = '350px', height='350px'>";
    }
} else {
    header("Location: http://localhost/SLAM/AP3/AP3/");
    exit;
}




?>
</body>

</html>