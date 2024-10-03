<?php 
   
    include_once 'header.php';
    include_once 'main.php';
    
    if(!empty($_POST["titre"]) && !empty($_POST["description"]) && !empty($_POST["priorite"]) && !empty($_POST["date"]) && !empty($_POST["status"]) && !empty($_POST["local"]) && !empty($_POST["id_agent"])) {
        $query = "update incident set titre = :titre, description = :description, priorite = :priorite, date_creation = :date, status = :status, local = :local, id_agent = :id_agent where id_incident = :id";
        $pdostmt = $pdo->prepare($query);
        $pdostmt->execute(["titre"=>$_POST["titre"], "description"=>$_POST["description"], "priorite"=>$_POST["priorite"], "date"=>$_POST["date"], "status"=>"en cours", "id"=>$_POST["id_incident"], "local"=>$_POST["local"], "id_agent"=>$_POST["id_agent"]]);
        header('location:index.php');
    }
    else {
        ?> <div class="alert alert-warning" role="alert">Veuillez remplire tout les champs</div> <?php
    }

    include_once 'footer.php'

?>