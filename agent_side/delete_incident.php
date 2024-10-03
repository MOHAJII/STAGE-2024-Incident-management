<?php 

    include_once 'main.php';

    if(!empty($_GET["id"])) {
        $query = "Delete from incident where id_incident = :id";
        $pdostmt = $pdo->prepare($query);
        $pdostmt->execute(["id"=>$_GET["id"]]);
        header('location:incidents.php');
    }

?>