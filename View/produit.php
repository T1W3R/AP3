<div class='big-container'><div class='container'>

<?php
    foreach ($resultGP as $resGP) {
        $image = 'changerImage("' . $resGP[0] . '")';
        echo "<div><img src='" . $resGP[0] . "' id='" . $resGP[0] . "' onclick='" . $image . "' width = '350px', height='350px'></div>";
    }

    $image_initial = $resultGP[0]["ph_chemin"];

    ?></div>
    <?php
    echo "<div> <img src='" . $image_initial . "' id='grande_image'> </div>";
    ?>
    <script type='text/javascript'>

        function changerImage(id){
            document.getElementById('grande_image').src= id;
        }    

    </script>
    
    <div>
    <?php
    echo "
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

?>



</html>