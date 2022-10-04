<?php
session_start();

if (isset($_SESSION["login"])) {
    include "header_connected.php";
} else {
    include "header_unconnected.php";
};

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
?>

<h2>Actualité</h2>


<div class="produits">

    <?php

    $sql = "SELECT pr_reference, pr_nom, pr_coutHT FROM `produit`";
    $bdd = getConnexion();
    $query = $bdd->prepare($sql);
    $query->execute();
    $result = $query->fetchAll();

    foreach ($result as $res) {
        $getPhoto = "SELECT ph_chemin FROM photos WHERE fk_pr = " . $res['pr_reference'] . "; ";
        $queryGP = $bdd->prepare($getPhoto);
        $queryGP->execute();
        $resultGP = $queryGP->fetch();
        echo '<a href="http://localhost/SLAM/AP3/AP3/produit.php?id=' . $res['pr_reference'] . '"> <div class="produitIndividuel"><img id="imgproduit" src="' . $resultGP[0] . '" width = 450px, height=450px><br>' . $res['pr_nom'] . " <p>" . $res['pr_coutHT'] . '€ HT</p></div> </a>';
    }




    ?>

</div>

</body>

</html>