<?php 

    include_once 'main.php';

    if(!empty($_GET["id"])) {
        $query = "Update incident set id_technicien = NULL where id_incident = :id";
        $pdostmt = $pdo->prepare($query);
        $pdostmt->execute(["id"=>$_GET["id"]]);
        header('location:mes_incidents.php');
    }

?>