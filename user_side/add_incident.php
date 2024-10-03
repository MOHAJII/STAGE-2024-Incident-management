<?php 
include_once "../db_connexion.php";
$pdo = new connect ;

if(!empty($_POST["titre"])&&!empty($_POST["type"])&&!empty($_POST["priorite"])&&!empty($_POST["status"])&&!empty($_POST["local"])) {
    $query = "insert into incident(id_client, type_incident, description, priorite, status, titre, local) values(:id, :type, :description, :priorite, :status, :titre, :local)";
    $pdostmt = $pdo->prepare($query);
    $pdostmt->execute(["id"=>$_POST["id"], "type"=>$_POST["type"] ,"titre"=>$_POST["titre"], "description"=>$_POST["description"], "priorite"=>$_POST["priorite"], "status"=> $_POST["status"], "local"=>$_POST["local"]]);
    $pdostmt->closeCursor();

    header('location:index.php');
}








?>