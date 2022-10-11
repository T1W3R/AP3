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
    foreach ($res as $result) {
        $resultGP = getPhotos($result);
        echo '
        <a href="http://localhost/SLAM/AP3/AP3/Controller/produit.php?id=' . $result['pr_reference'] . '">
            <div class="produitIndividuel">
                <img id="imgproduit" src="' . $resultGP[0] . '" width = 450px, height=450px style="border: 1px solid white;">
                <p style="text-decoration: underline; margin-bottom: 0px; font-size: 30px;">' . $result['pr_nom'] . '</p>
                <p style="font-size: 30px;">' . $result['pr_coutHT'] . '€<span style="font-size: 15px;">HT</span></p>
            </div>
        </a>';
    }
    ?>

</div>

</body>

</html>