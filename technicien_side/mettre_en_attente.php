<?php

include_once 'header.php';
include_once 'main.php';

if($_SERVER["REQUEST_METHOD"] == "GET"){
    $stmt = $pdo->prepare("update incident set status = :status where id_incident = :id");
    $stmt->execute(["status"=>"en attente", "id"=>$_GET["id"]]);
    header('location:mes_incidents.php');
}

?>