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

if (!empty($_POST['telephone']) && !empty($_POST['prenom']) && !empty($_POST['nom']) && !empty($_POST['mdp']) && !empty($_POST['cmdp']) && !empty($_POST['adress']) && !empty($_POST['mail']) && !empty($_POST['birthdate'])) {
    if ($_POST['mdp'] != $_POST['cmdp']) {
        echo ("Erreur : Mots de passes different !!!");
    } else {
        $mdp = $_POST['mdp'];
        $hash = hash("sha512", $mdp);
        InsertUser($_POST['nom'], $_POST['prenom'], $_POST['mail'], $hash, $_POST['adress'], $_POST['telephone'], $_POST['birthdate']);
        header('Location: http://localhost/connexion.php');
        exit();
    }
}

function InsertUser($nom, $prenom, $mail, $hash, $adress, $telephone, $birthdate)
{

    $insert = "INSERT INTO client(cl_nom, cl_prenom, cl_email, cl_mdp, cl_adresse, cl_telephone, cl_dateNaissance) VALUES(:nom, :prenom, :mail, :hash, :adress, :telephone, :birthdate);";

    $bdd = construct_();
    $query = $bdd->prepare($insert);
    $query->execute(array(
        ":nom" => $nom,
        ":prenom" => $prenom,
        ":mail" => $mail,
        ":hash" => $hash,
        ":adress" => $adress,
        ":telephone" => $telephone,
        ":birthdate" => $birthdate
    ));
}
