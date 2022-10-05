<?php
session_start();

if (isset($_SESSION["login"])) {
    include("../View/header_connected.php");
} else {
    include("../View/header_unconnected.php");
};

?>

<h2>Actualité</h2>


<div class="produits">

    <?php
        foreach ($result as $res){
            
            $getPhoto = "SELECT ph_chemin FROM photos WHERE fk_pr = " . $res['pr_reference'] . "; ";
            $bdd = construct_();
            $queryGP = $bdd->prepare($getPhoto);
            $queryGP->execute();
            $resultGP = $queryGP->fetch();
            echo '<a href="http://localhost/SLAM/AP3/AP3/Controller/produit.php?id=' . $res['pr_reference'] . '"> <div class="produitIndividuel"><img id="imgproduit" src="' . $resultGP[0] . '" width = 450px, height=450px><br>' . $res['pr_nom'] . " <p>" . $res['pr_coutHT'] . '€ HT</p></div> </a>';
        }
    ?>

</div>

</body>

</html>