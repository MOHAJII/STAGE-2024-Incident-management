<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapport d'Incident</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding: 20px;
        }

        h1,
        h2,
        h3,
        h4 {
            margin-top: 20px;
        }

        .content-section {
            margin-bottom: 40px;
        }

        @media print {

            /* Cacher le bouton d'impression lors de l'impression */
            button {
                display: none;
            }

            /* Adapter les marges ou d'autres éléments si nécessaire */
            body {
                margin: 0;
                font-size: 12pt;
            }

            /* Ajuster la taille des titres ou autres éléments pour l'impression */
            h1 {
                font-size: 18pt;
            }
        }
    </style>
</head>

<?php

include_once 'main.php';
$query = "select * from incident where id_incident = :id";
$pdostmt = $pdo->prepare($query);
$pdostmt->execute(["id" => $_GET["id"]]);
$incident = $pdostmt->fetch(PDO::FETCH_ASSOC);

$query = "select * from client where id_client = :id";
$pdostmt = $pdo->prepare($query);
$pdostmt->execute(["id" => $incident["id_client"]]);
$client = $pdostmt->fetch(PDO::FETCH_ASSOC);

$query = "select * from agent where id_agent = :id";
$pdostmt = $pdo->prepare($query);
$pdostmt->execute(["id" => $incident["id_agent"]]);
$agent = $pdostmt->fetch(PDO::FETCH_ASSOC);

$query = "select * from technicien where id_technicien = :id";
$pdostmt = $pdo->prepare($query);
$pdostmt->execute(["id" => $incident["id_technicien"]]);
$technicien = $pdostmt->fetch(PDO::FETCH_ASSOC);


?>

<body>

    <!-- Titre du rapport -->
    <div class="content-section">
        <h1 class="text-center">Rapport d'Incident</h1>
        <h2 class="text-center">Numéro de l'Incident : <?= $incident["id_incident"] ?></h2>
        <h4 class="text-center">Date de Déclaration : <?= $incident["date_creation"] ?></h4>
        <h4 class="text-center">Date de Clôture : <?= $incident["date_cloture"] ?></h4>
        <h4 class="text-center">Auteur : <?= $agent["nom"]." ".$agent["prenom"] ?> </h4>
    </div>

    <!-- Détails de l'incident -->
    <div class="content-section">
        <h2>Détails de l'Incident</h2>
        <p><strong>Titre :</strong> <?= $incident["titre"] ?></p>
        <p><strong>Description :</strong> <?= $incident["description"] ?></p>
        <p><strong>Type :</strong> <?= $incident["type_incident"] ?></p>
        <p><strong>Priorité :</strong> <?= $incident["priorite"] ?></p>
        <p><strong>Status :</strong> <?= $incident["status"] ?></p>
    </div>

    <!-- Actions Entreprises -->
    <div class="content-section">
        <h2>Actions Entreprises</h2>
        <p>[Détails_des_Actions]</p>
    </div>

    <!-- Technicien Assigné -->
    <div class="content-section">
        <h2>Technicien Assigné</h2>
        <p><strong>Nom :</strong> <?= $technicien["nom"] . " " . $technicien["prenom"] ?></p>
        <p><strong>Intervention :</strong> [Details_Intervention]</p>
    </div>

    <!-- Conclusion -->
    <div class="content-section">
        <h2>Conclusion</h2>
        <p>[Conclusion_Incident]</p>
    </div>

    <!-- Commentaires Supplémentaires -->
    <div class="content-section">
        <h2>Commentaires Supplémentaires</h2>
        <p>[Commentaires]</p>
    </div>

    <!-- Signature -->
    <div class="content-section">
        <h2>Signature</h2>
        <p><?= $agent["nom"] . " " . $agent["prenom"] ?></p>
        <p>Date : <?= $incident["date_cloture"] ?></p>
    </div>


    <button onclick="window.print()">Imprimer le Rapport</button>

</body>

</html>