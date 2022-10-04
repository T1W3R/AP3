<?php
session_start();
include "header_connected.php";


function construct_()
{
    $dsn = 'mysql:dbname=ap3;host=127.0.0.1:3308';

    try {
        $bdd = new PDO($dsn, "root", "");
        return $bdd;
    } catch (PDOException $e) {
        die('DB Error: ' . $e->getMessage());
    }
}

$sql = "SELECT cl_code, cl_nom, cl_prenom, cl_adresse, cl_telephone, cl_dateNaissance , cl_email FROM client WHERE cl_code = :code; ";
$code = $_SESSION['login'];
$bdd = construct_();
$query = $bdd->prepare($sql);
$query->execute(array(":code" => $code));
$res = $query->fetchAll();

foreach ($res as $r) {
    $code = $r["cl_code"];
    $nom = $r["cl_nom"];
    $prenom = $r["cl_prenom"];
    $mail = $r["cl_email"];
    $adress = $r["cl_adresse"];
    $telephone = $r["cl_telephone"];
    $dN = $r["cl_dateNaissance"];

    echo '
<br>
<h2>Mes Infos</h2>
<br>
<center>
    <div>
        <div class="containers">
            <div><h3>Code Client </h3></div>
            <div>' . $code . '</div>
        </div>
        <div class="containers">
            <div><h3>Nom : </h3></div>
            <div>' . $nom . '</div>
        </div>
        <div class="containers">
            <div><h3>Prenom: </h3></div>
            <div>' . $prenom . '</div>
        </div>
        <div class="containers">
            <div><h3>Email: </h3></div>
            <div>' . $mail . '</div>
        </div>
        <div class="containers">
            <div><h3>Adresse: </h3></div>
            <div>' . $adress . '</div>
        </div>
        <div class="containers">
            <div><h3>Telephone: </h3></div>
            <div>' . $telephone . '</div>
        </div>
        <div class="containers">
            <div><h3>Date de Naissance: </h3></div>
            <div>' . $dN . '</div>
        </div>
    </div>

    <a href="deconnexion.php" class="boutton">Se déconnecter</a>
</center>
';
};
