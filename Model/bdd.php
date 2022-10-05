<?php

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