<?php
session_start();

function construct_()
{
    $dsn = 'mysql:dbname=ap3;host=127.0.0.1:3308';

    try {
        $bdd = new PDO($dsn, "root", "");
        return $bdd;
    } catch (PDOExeption $e) {
        die('DB Error: ' . $e->getMessage());
    }
}

function VerifUser($hash, $mail)
{

    $verif = "SELECT cl_code FROM client WHERE cl_email = :mail AND cl_mdp = :mdp";
    $bdd = construct_();
    $query = $bdd->prepare($verif);
    $query->execute(array(
        ":mail" => $mail,
        ":mdp" => $hash
    ));
    $res = $query->fetch();

    return $res;
}

if (!empty($_POST['mail']) && !empty($_POST['mdp'])) {

    $mail = $_POST['mail'];
    $mdp = $_POST['mdp'];
    $hash = hash("sha512", $mdp);

    $res = VerifUser($hash, $pseudo);

    if (!empty($res['cl_code'])) {
        $_SESSION["login"] = $res['cl_code'];
        var_dump('oui');
        //header('Location: http://localhost/Projet');
        //exit();
    } else {
        var_dump('non');
        //header('Location: http://localhost/Projet/connexion.php');
        //exit();
        //$message = "probleme de connection";
        //echo'<script type="text/javascript"> alert('.$message.')</script>';
    }
} else {
    header('Location: http://localhost/Projet/connexion.php');
    exit();
}
