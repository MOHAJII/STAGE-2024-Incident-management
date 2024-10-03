<?php 
include_once 'header.php';
include_once 'main.php';
if(isset($_POST["submit"])){
    $stmt = $pdo->prepare("update incident set status = :status where id_incident = :id");
    $stmt->execute(["status"=>"terminer", "id"=>$_GET["id"]]);
    header('location:mes_incidents.php');
}

?>