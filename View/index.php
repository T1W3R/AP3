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
        foreach ($res as $result){
            $resultGP = getPhotos($result);
            echo '<a href="http://localhost/SLAM/AP3/AP3/Controller/produit.php?id=' . $result['pr_reference'] . '"> <div class="produitIndividuel"><img id="imgproduit" src="' . $resultGP[0] . '" width = 450px, height=450px><br>' . $result['pr_nom'] . " <p>" . $result['pr_coutHT'] . '€ HT</p></div> </a>';
        }
    ?>

</div>

</body>

</html>