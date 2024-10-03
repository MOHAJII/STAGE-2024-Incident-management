<?php
$incident = true;
include_once 'header.php';
include_once 'main.php';

?>

<h1 class="mt-5">Validation</h1>



<?php
$query = "SELECT * FROM incident WHERE id_incident = :id";
$pdostmt = $pdo->prepare($query);
$pdostmt->execute(["id" => $_GET["id"]]);
$incident = $pdostmt->fetch(PDO::FETCH_ASSOC);

$query2 = "select * from client where id_client = :id";
$pdostmt2 = $pdo->prepare($query2);
$pdostmt2->execute(["id" => $incident["id_client"]]);
$client = $pdostmt2->fetch(PDO::FETCH_ASSOC);

$query4 = "select * from technicien where id_technicien = :id";
$pdostmt4 = $pdo->prepare($query4);
$pdostmt4->execute(["id" => $incident["id_technicien"]]);
$technicien = $pdostmt4->fetch(PDO::FETCH_ASSOC);

$query3 = "select * from technicien where status = :status";
$pdostmt3 = $pdo->prepare($query3);
$pdostmt3->execute(["status" => "disponible"]);

$dateReel = date('Y-m-d H:i:s');



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $pdo->prepare("update incident set status = :status, date_cloture = :date where id_incident = :id");
    $stmt->execute(["status" => "cloture", "id" => $_GET["id"], "date" => $dateReel]);
    header('location:incidents_terminer.php');
}


?>
<div class="container mt-5">
    <form  method="post">
        <!-- ID de l'incident caché -->
        <input type="hidden" name="id_incident" value="<?= $incident["id_incident"] ?>" readonly>

        <div class="mb-3">
            <label for="incidentTitle" class="form-label">Titre de l'incident</label>
            <input type="text" class="form-control" id="incidentTitle" name="titre" value="<?= $incident["titre"] ?>"
                readonly>
        </div>

        <div class="accordion" id="incidentAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Détail du client
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse " aria-labelledby="headingOne"
                    data-bs-parent="#incidentAccordion">
                    <div class="accordion-body">
                        <strong>Id Client : </strong><?= $client["id_client"] ?><br>
                        <strong>Nom : </strong><?= $client["nom"] ?><br>
                        <strong>Prénom : </strong><?= $client["prenom"] ?><br>
                        <strong>Email : </strong><?= $client["login"] ?><br>
                        <strong>Département : </strong><?= $client["departement"] ?><br>
                        <strong>Num Tel : </strong><?= $client["telephone"] ?><br>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="incidentDescription" class="form-label">Description</label>
            <textarea class="form-control" id="incidentDescription" name="description" rows="3"
                readonly><?= $incident["description"] ?></textarea>
        </div>

        <div class="mb-3">
            <label for="incidentPriority" class="form-label">Priorité</label>
            <input type="text" class="form-control" id="incidentPriorite" name="priorite"
                value="<?= $incident["priorite"] ?>" readonly>
        </div>

        <div class="mb-3">
            <input type="hidden" class="form-control" id="incidentStatus" name="status"
                value="<?= $incident["status"] ?>" hidden>
        </div>

        <div class="mb-3">
            <label for="incidentLocal" class="form-label">Local de l'incident</label>
            <input type="text" class="form-control" id="incidenLocal" name="local" value="<?= $incident["local"] ?>"
                readonly>
        </div>

        <div class="accordion" id="incidentAccordion1">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne1">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne1" aria-expanded="true" aria-controls="collapseOne1">
                        Détail du Technicien
                    </button>
                </h2>
                <div id="collapseOne1" class="accordion-collapse collapse " aria-labelledby="headingOne1"
                    data-bs-parent="#incidentAccordion1">
                    <div class="accordion-body">
                        <strong>Id Technicien : </strong><?= $technicien["id_technicien"] ?><br>
                        <strong>Nom : </strong><?= $technicien["nom"] ?><br>
                        <strong>Prénom : </strong><?= $technicien["prenom"] ?><br>
                        <strong>Email : </strong><?= $technicien["login"] ?><br>
                        <strong>Spécialite : </strong><?= $technicien["specialite"] ?><br>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="incidentDate" class="form-label">Date</label>
            <input type="text" class="form-control" id="incidentDate" name="date"
                value="<?= $incident["date_creation"] ?> " readonly required>
        </div>

</div>

<div class="d-flex justify-content-between mt-4">
    <a href="mettre_en_cours.php?id=<?= $incident["id_incident"] ?>" class="btn btn-warning">Mettre en attente</a>
    <button type="submit" class="btn btn-success">Valider</button>
</div>
</form>
</div>


</div>
</main>

<?php include_once 'footer.php'; ?>