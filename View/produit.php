<?php
session_start();

if (isset($_SESSION["login"])) {
    include("../View/header_connected.php");
} else {
    include("../View/header_unconnected.php");
};
?>


<div class='big-container'>
    <div class='images'>
        <div class='container'>

            <?php
            foreach ($resultGP as $resGP) {
                $image = 'changerImage("' . $resGP[0] . '")';
                echo "<div class='petiteImage'><img src='" . $resGP[0] . "' id='" . $resGP[0] . "' onclick='" . $image . "' height='150px' width='150px'></div>";
            }

            $image_initial = $resultGP[0]["ph_chemin"];

            ?>
        </div>

        <?php
        echo "<div> <img src='" . $image_initial . "' id='grande_image' style='border: 1px solid white; margin-left: 100px; margin-right: 100px; border-radius: 15px' height='700px' width='700px'> </div>";
        ?>
        <script type='text/javascript'>
            function changerImage(id) {
                document.getElementById('grande_image').src = id;
            }
        </script>
    </div>

    <div style="margin-right: 50px">
        <?php
        echo "
        <h1 style='font-size: 50px; text-decoration: underline;'>" . $result["pr_nom"] . "</h1>
            <p style='font-size: 20px; '>
                " . $result["pr_description"] . "
            </p>
            <p>
                " . $result['pr_coutHT'] . " € (+20% TVA)
            </p>
            <p style='font-size: 50px;'>
                <b>" . $prixTTC . "€  </b><span style='font-size: 20px;'>TTC</span>
            </p>
            <p>
                " . $DispoMagasin . "
            </p>
            <p>
                Stock internet: " . $result["pr_stockInternet"] . " disponibilités.
            </p>"; ?>
            <form method='POST' action='../Controller/traitementPanier.php'>
                <input id="input" name="quantite" value="1" type="number" min="1" style='color: aliceblue; background-color: #B19D7F; margin-bottom: 15px; height: 40px; font-size: 15px; width:100px; border-radius: 5px; border: none; text-align: center;'>
                    <br>
                <button type="submit" class="bouttonAjoutPanier">
                    <p> Ajouter au Panier </p>
                </button>
                <?php echo'<input type="hidden" value="'. $_GET["id"] .'" name="idProduit">';?>
                
                    
            </form>
    </div>
</div>


</html>