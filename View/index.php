<?php
session_start();

if (isset($_SESSION["login"])) {
    include("../View/header_connected.php");
} else {
    include("../View/header_unconnected.php");
};

?>

<h2>Rayons</h2>

<div class="rayons">
    <?php
    foreach ($ray as $rayon) {
        echo '
            <a href="rayon.php?id=' . $rayon['ra_libelle'] . '">
                <div class="rayon" width="50%">
                    <p><b>' . $rayon['ra_libelle'] . '</b></p>
                </div>
            </a>';
    };
    ?>
</div>

<h2>Actualités</h2>

<div class="produits">

    <?php
    foreach ($res as $result) {
        $resultGP = getPhotos($result);
        echo '
        <a href="produit.php?id=' . $result['pr_reference'] . '">
            <div class="produitIndividuel" width="50%">
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