<?php
if (session_status() === PHP_SESSION_NONE) {
    include "header_unconnected.php";
} else {
    include "header_connected.php";
};

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
?>

<div class="produits">

    <?php

    $sql = "SELECT pr_id, pr_nom, pr_coutHT FROM `produit`";
    $bdd = getConnexion();
    $query = $bdd->prepare($sql);
    $query->execute();
    $result = $query->fetchAll();

    foreach ($result as $res) {
        $getPhoto = "SELECT ph_chemin FROM photos WHERE fk_pr = " . $res['pr_id'] . "; ";
        $queryGP = $bdd->prepare($getPhoto);
        $queryGP->execute();
        $resultGP = $queryGP->fetch();
        echo '<div class="produitIndividuel"><img id="imgproduit" src="' . $resultGP[0] . '" width = 450px, height=450px><br><a href="http://localhost/SLAM/AP3/AP3/produit.php?id=' . $res['pr_id'] . '">' . $res['pr_nom'] . "</a> <p>" . $res['pr_coutHT'] . '€ HT</p></div> ';
    }




    ?>

</div>

</body>

</html>