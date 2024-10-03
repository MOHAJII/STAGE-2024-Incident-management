<?php

include_once 'header.php';
include_once 'main.php';

if($_SERVER["REQUEST_METHOD"] == "GET"){
    $stmt = $pdo->prepare("update incident set status = :status where id_incident = :id");
    $stmt->execute(["status"=>"en cours", "id"=>$_GET["id"]]);
    header('location:incidents_terminer.php');
}

?>