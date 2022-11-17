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

function getProduits()
{

    $sql = "SELECT pr_reference, pr_nom, pr_coutHT FROM produit;";
    $bdd = construct_();
    $query = $bdd->prepare($sql);
    $query->execute();
    $result = $query->fetchAll();
    return $result;
}

function getProduitsByRayon($rayon)
{

    $sql = "SELECT pr_reference, pr_nom, pr_coutHT FROM produit WHERE fk_rayon = '" . $rayon . "' ;";
    $bdd = construct_();
    $query = $bdd->prepare($sql);
    $query->execute();
    $result = $query->fetchAll();
    return $result;
}

function getInfos()
{
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


function getIdClient()
{
    $getLogin = "SELECT cl_id FROM `client` WHERE cl_code = '" . $_SESSION['login'] . "';";
    $bdd = construct_();
    $queryGL = $bdd->prepare($getLogin);
    $queryGL->execute();
    $resultGL = $queryGL->fetch();
    return $resultGL;
}

function getInfoCommande($resultGL)
{
    $sql = "SELECT co_id, co_prixTotal, pr_reference, pr_nom, pr_quantite, pr_coutHT FROM `commande` JOIN lie_a ON fk_co = co_id JOIN produit ON fk_pr = pr_reference WHERE co_statut = 'En attente' AND fk_cl =" . $resultGL["cl_id"] . ";";
    $bdd = construct_();
    $query = $bdd->prepare($sql);
    $query->execute();
    $result = $query->fetchAll();
    return $result;
}

function getPhotos($res)
{
    $getPhoto = "SELECT ph_chemin FROM photos WHERE fk_pr = " . $res['pr_reference'] . "; ";
    $bdd = construct_();
    $queryGP = $bdd->prepare($getPhoto);
    $queryGP->execute();
    $resultGP = $queryGP->fetch();
    return $resultGP;
}

function getPhoto($res)
{
    $getPhoto = "SELECT ph_chemin FROM photos WHERE fk_pr = " . $res . " LIMIT 1; ";
    $bdd = construct_();
    $queryGP = $bdd->prepare($getPhoto);
    $queryGP->execute();
    $resultGP = $queryGP->fetch();
    return $resultGP;
}

function getAllCommandes($infosCl)
{
    $getCommandes = "SELECT co_id, co_date, co_prixTotal, cl_adresse
    FROM `commande`
        JOIN client ON fk_cl = cl_id
    WHERE co_statut != 'En attente' AND fk_cl =" . $infosCl["cl_id"] . ";";
    $bdd = construct_();
    $queryGCo = $bdd->prepare($getCommandes);
    $queryGCo->execute();
    $resultGCo = $queryGCo->fetchAll();
    return $resultGCo;
}

function getCommandePassee($resGCo)
{
    $getCoPassee = "SELECT pr_nom, pr_quantite, pr_coutHT, co_prixTotal, ls_libelle, cl_adresse
    FROM `commande` 
        JOIN lie_a ON fk_co = co_id 
        JOIN produit ON lie_a.fk_pr = pr_reference 
        JOIN est_stocke ON est_stocke.fk_pr = pr_reference
        JOIN lieustockage ON ls_id = fk_ls
        JOIN client ON fk_cl = cl_id
    WHERE co_id =" . $resGCo["co_id"] . ";";
    $bdd = construct_();
    $queryGCP = $bdd->prepare($getCoPassee);
    $queryGCP->execute();
    $resultGCP = $queryGCP->fetchAll();
    return $resultGCP;
}

function getInfoArticle()
{
    $sql = "SELECT pr_reference, pr_nom, pr_coutHT, pr_description, pr_stockInternet FROM `produit` WHERE pr_reference=" . $_GET['id'];
    $bdd = construct_();
    $query = $bdd->prepare($sql);
    $query->execute();
    $result = $query->fetch();
    return $result;
}

function getInfoArt($res)
{
    $sql = "SELECT pr_reference, pr_nom, pr_coutHT, pr_description, pr_stockInternet FROM `produit` WHERE pr_reference=" . $res;
    $bdd = construct_();
    $query = $bdd->prepare($sql);
    $query->execute();
    $result = $query->fetch();
    return $result;
}

function getPhotosProduit($result)
{
    $getPhoto = "SELECT ph_chemin FROM photos WHERE fk_pr = " . $result['pr_reference'] . "; ";
    $bdd = construct_();
    $queryGP = $bdd->prepare($getPhoto);
    $queryGP->execute();
    $resultGP = $queryGP->fetchAll();
    return $resultGP;
}

function getStockMagasin($id)
{
    $getStockMagasin = "SELECT pr_stock, ma_lieu FROM a_en_stock JOIN magasin ON fk_ma = ma_id WHERE fk_pr = " . $id;
    $bdd = construct_();
    $queryGST = $bdd->prepare($getStockMagasin);
    $queryGST->execute();
    $resultGST = $queryGST->fetchAll();
    $DispoMagasin = "";
    if ($resultGST != "none") {
        foreach ($resultGST as $resGST) {
            $DispoMagasin .= "<br>" . $resGST["ma_lieu"] . ": " . $resGST["pr_stock"] . " produits disponible(s).";
        }
    }
    return $DispoMagasin;
}

function getRayons()
{
    $sql = "SELECT ra_libelle, ra_id FROM rayon;";
    $bdd = construct_();
    $query = $bdd->prepare($sql);
    $query->execute();
    $result = $query->fetchAll();
    return $result;
}

function InsertCommande($prixTotal, $idClient){
    $insert = "INSERT INTO `commande` (`co_date`, `co_prixTotal`, `co_statut`, `fk_cl`) VALUES (current_timestamp(), :prixTotal, 'transmise', :idClient);";

    $bdd = construct_();
    $query = $bdd->prepare($insert);
    $query->execute(array(
        ":prixTotal" => $prixTotal,
        ":idClient" => $idClient[0]
    ));
}

function getIdCommande($idClient)
{
    $getIdCommande = "SELECT co_id FROM `commande` WHERE fk_cl = ". $idClient[0] ." ORDER BY co_id DESC LIMIT 1;";
    $bdd = construct_();
    $queryIC = $bdd->prepare($getIdCommande);
    $queryIC->execute();
    $resultIC = $queryIC->fetch();
    return $resultIC;
}

function InsertProduitsCommande($idCommande, $ref, $quantite)
{

    $insert = "INSERT INTO `lie_a` (`pr_quantite`, `fk_pr`, `fk_co`) VALUES (:quantite, :ref, :idCommande);";

    $bdd = construct_();
    $query = $bdd->prepare($insert);
    $query->execute(array(
        ":idCommande" => $idCommande[0],
        ":ref" => $ref,
        ":quantite" => $quantite
    ));
}