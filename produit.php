<?php
session_start();
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
        } catch (PDOException $e) {
            die('DB Error: ' . $e->getMessage());
        }
    }
    //Avoir les infos de l'article 
    $sql = "SELECT pr_reference, pr_nom, pr_coutHT, pr_description, pr_stockInternet FROM `produit` WHERE pr_reference=" . $_GET['id'];
    $bdd = getConnexion();
    $query = $bdd->prepare($sql);
    $query->execute();
    $result = $query->fetch();

    //Avoir les photos
    $getPhoto = "SELECT ph_chemin FROM photos WHERE fk_pr = " . $result['pr_reference'] . "; ";
    $queryGP = $bdd->prepare($getPhoto);
    $queryGP->execute();
    $resultGP = $queryGP->fetchAll();

    //Avoir stock magasin
    $getStockMagasin = "SELECT pr_stock, ma_lieu FROM a_en_stock JOIN magasin ON fk_ma = ma_id WHERE fk_pr = " . $_GET['id'];
    $queryGST = $bdd->prepare($getStockMagasin);
    $queryGST->execute();
    $resultGST = $queryGST->fetchAll();
    $DispoMagasin = "";
    if ($resultGST != "none") {
        foreach ($resultGST as $resGST) {
            $DispoMagasin .= "<br>" . $resGST["ma_lieu"] . ": " . $resGST["pr_stock"] . " produits disponible(s).";
        }
    }

    //Calcul prix total
    $prixTTC = $result["pr_coutHT"] + 0.20 * $result["pr_coutHT"];
    $prixTTC = number_format((float)$prixTTC, 2, '.', '');

    //Affichage produit 
    echo "<div class='big-container'><div class='container'>";

    foreach ($resultGP as $resGP) {
        $image = 'changerImage("' . $resGP[0] . '")';
        echo "<div><img src='" . $resGP[0] . "' id='" . $resGP[0] . "' onclick='" . $image . "' width = '350px', height='350px'></div>";
    }

    $image_initial = $resultGP[0]["ph_chemin"];

    echo "</div>
    <div> <img src='" . $image_initial . "' id='grande_image'> </div>
    
    <script type='text/javascript'>

        function changerImage(id){
            document.getElementById('grande_image').src= id;
        }    

    </script>
    

    ";


    echo "
    <div>
        <p>" . $result["pr_nom"] . "
            <br>
            " . $result["pr_description"] . "
            <br>
            " . $result['pr_coutHT'] . " € HT<br>+20% TVA
            <br>
            " . $prixTTC . "€ TTC " . $DispoMagasin . "
            <br>
            Stock internet: " . $result["pr_stockInternet"] . " disponibilités.
        </p>
    </div>
    </div>";
} else {
    header("Location: http://localhost/SLAM/AP3/AP3/");
    exit;
}




?>
</body>

</html>