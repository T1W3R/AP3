<?php

include("bdd.php");

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
    var_dump($res);
    return $res;
}

function SelectProduits(){
    
    $sql = "SELECT pr_reference, pr_nom, pr_coutHT FROM `produit`;";
    $bdd = construct_();
    $query = $bdd->prepare($sql);
    $query->execute();
    $result = $query->fetchAll();
    return $result;
}

function SelectInfos(){
    $sql = "SELECT cl_code, cl_nom, cl_prenom, cl_adresse, cl_telephone, cl_dateNaissance , cl_email FROM client WHERE cl_code = :code; ";
    $code = $_SESSION['login'];
    $bdd = construct_();
    $query = $bdd->prepare($sql);
    $query->execute(array(":code" => $code));
    $res = $query->fetchAll();
    return $res;
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