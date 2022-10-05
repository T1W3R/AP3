<?php

include("header_connected.php");

?>

<br>
<h2>Mes Infos</h2>
<br>
<center>
    <div>
        <div class="containers">
            <div><h3>Code Client : </h3></div>
            <?php
                foreach ($res as $r) {
                    $code = $r["cl_code"];
                    $nom = $r["cl_nom"];
                    $prenom = $r["cl_prenom"];
                    $mail = $r["cl_email"];
                    $adress = $r["cl_adresse"];
                    $telephone = $r["cl_telephone"];
                    $dN = $r["cl_dateNaissance"]; echo'<div>' . $code . '</div>';
            ?>
        </div>
        <div class="containers">
            <div><h3>Nom : </h3></div>
            <?php echo'<div>' . $nom . '</div>'; ?>
        </div>
        <div class="containers">
            <div><h3>Prenom : </h3></div>
            <?php echo'<div>' . $prenom . '</div>'; ?>
        </div>
        <div class="containers">
            <div><h3>Email : </h3></div>
            <?php echo'<div>' . $mail . '</div>'; ?>
        </div>
        <div class="containers">
            <div><h3>Adresse : </h3></div>
            <?php echo'<div>' . $adress . '</div>'; ?>
        </div>
        <div class="containers">
            <div><h3>Telephone : </h3></div>
            <?php echo'<div>' . $telephone . '</div>'; ?>
        </div>
        <div class="containers">
            <div><h3>Date de Naissance : </h3></div>
            <?php echo'<div>' . $dN . '</div>'; }?>
        </div>
    </div>

    <a href="deconnexion.php" class="boutton">Se déconnecter</a>
</center>