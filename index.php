<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>AP3</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
</head>

<body>
    <?php
    if (session_status() === PHP_SESSION_NONE) {
        include "header_unconnected.php";
    } else {
        include "header_connected.php";
    };

    function getConnexion()
    {
        $dsn = 'mysql:dbname=ap3;host=127.0.0.1:3308';

        try {
            $bdd = new PDO($dsn, "root", "");
            return $bdd;
        } catch (PDOExeption $e) {
            die('DB Error: ' . $e->getMessage());
        }
    }

    $sql = "SELECT pr_id, pr_nom, pr_coutHT FROM `produit`";
    $bdd = getConnexion();
    $query = $bdd->prepare($sql);
    $query->execute();
    $result = $query->fetchAll();

    foreach ($result as $res) {
        $getPhoto = "SELECT ph_chemin FROM photos WHERE fk_pr = " . $res['pr_id'] . "; ";
        $queryGP = $bdd->prepare($getPhoto);
        $queryGP->execute();
        $resultGP = $queryGP->fetch();
        echo "<img src='" . $resultGP[0] . "' width = '350px', height='350px'><br><p><a href='http://localhost/SLAM/AP3/AP3/produit.php?id=" . $res['pr_id'] . "'>" . $res['pr_nom'] . "</a> " . $res['pr_coutHT'] . "€ HT</p> ";
    }




    ?>

</body>

</html>