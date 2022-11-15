<?php
session_start();

include("../Model/commandes.php");

if (!empty($_POST['telephone']) && !empty($_POST['prenom']) && !empty($_POST['nom']) && !empty($_POST['mdp']) && !empty($_POST['cmdp']) && !empty($_POST['adress']) && !empty($_POST['mail']) && !empty($_POST['birthdate'])) {
    if ($_POST['mdp'] != $_POST['cmdp']) {
        echo ("Erreur : Mots de passes different !!!");
    } else {
        $mdp = $_POST['mdp'];
        $hash = hash("sha512", $mdp);
        InsertUser($_POST['nom'], $_POST['prenom'], $_POST['mail'], $hash, $_POST['adress'], $_POST['telephone'], $_POST['birthdate']);
        header('Location: connexion.php');
        exit();
    }
}
