<?php
session_start();

include("../Model/commandes.php");

if (!empty($_POST['mail']) && !empty($_POST['mdp'])) {

    $mail = $_POST['mail'];
    $mdp = $_POST['mdp'];
    $hash = hash("sha512", $mdp);

    $res = VerifUser($hash, $mail);

    if (!empty($res['cl_code'])) {
        $_SESSION["login"] = $res['cl_code'];
        header('Location: index.php');
        exit();
    } else {
        header('Location: connexion.php');
        exit();
        $message = "probleme de connection";
        echo '<script type="text/javascript"> alert(' . $message . ')</script>';
    }

} else {
    header('Location: connexion.php');
    exit();
}