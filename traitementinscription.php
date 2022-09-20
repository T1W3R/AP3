<?php
    session_start();

    function construct_() {
        $dsn = 'mysql:dbname=ap3;host=127.0.0.1:3308';

        try {
            $bdd = new PDO($dsn, "root", "");
            return $bdd;
        } catch (PDOExeption $e){
            die('DB Error: '.$e->getMessage());
        }
    }

    if(!empty($_POST['pseudo']) && !empty($_POST['prenom']) && !empty($_POST['nom']) && !empty($_POST['mdp']) && !empty($_POST['cmdp']) && !empty($_POST['adress']) && !empty($_POST['mail'])){
        if($_POST['mdp'] != $_POST['cmdp']){
            echo("Erreur : Mots de passes different !!!");
        } else {
            $mdp = $_POST['mdp'];
            $hash = hash("sha512", $mdp);
            InsertUser($_POST['nom'], $_POST['prenom'], $_POST['mail'], $hash, $_POST['pseudo'], $_POST['adress']);
            header('Location: http://localhost/Projet/connexion.php');
            exit();
        }

    }

    function InsertUser($nom, $prenom, $mail, $hash, $pseudo, $adress){

        $insert = "INSERT INTO utilisateur(ut_nom, ut_prenom, ut_pseudo, ut_mdp, ut_adresse, ut_mail) VALUES(:nom, :prenom, :pseudo, :hash, :adress, :mail);";

        $bdd = construct_();
        $query = $bdd->prepare($insert);
        $query->execute(array(":nom" => $nom,
                              ":prenom" => $prenom,
                              ":pseudo" => $pseudo,
                              ":hash" => $hash,
                              ":adress" => $adress,
                              ":mail" => $mail));

    }
