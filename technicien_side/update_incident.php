<?php
session_start();
$m_incident = true;
include_once 'header.php';
include_once 'main.php';

$technicien = $_SESSION["user"];

function detect_color($color)
{
    switch ($color) {
        case "haute":
            return "bg-danger";    // Retourne "bg-danger" pour "haute"
        case "moyenne":
            return "bg-warning";   // Retourne "bg-warning" pour "moyenne"
        case "normale":
            return "bg-success";   // Retourne "bg-success" pour "normale"
        default:
            return "bg-secondary"; // Option par défaut si aucune correspondance
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $pdo->prepare("update incident set status = :status where id_incident = :id");
    $stmt->execute(["status" => "terminer", "id" => $_GET["id"]]);
    header('location:mes_incidents.php');
}

?>

<h1 class="mt-5">Détail de l'incident</h1>

<?php
$query = "SELECT * FROM incident WHERE id_incident = :id";
$pdostmt = $pdo->prepare($query);
$pdostmt->execute(["id" => $_GET["id"]]);
$incident = $pdostmt->fetch(PDO::FETCH_ASSOC);

$query2 = "select * from client where id_client = :id";
$pdostmt2 = $pdo->prepare($query2);
$pdostmt2->execute(["id" => $incident["id_client"]]);
$client = $pdostmt2->fetch(PDO::FETCH_ASSOC);

$query3 = "select * from technicien where status = :status";
$pdostmt3 = $pdo->prepare($query3);
$pdostmt3->execute(["status" => "disponible"]);


?>
<div class="container mt-5">
    <form method="post">
        <!-- ID de l'incident caché -->
        <input type="hidden" name="id_incident" value="<?= $incident["id_incident"] ?>">

        <input type="hidden" class="form-control" id="incidentTitle" name="id_technicien"
            value="<?= $technicien["id_technicien"] ?>">


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
            Priorite
            <div class="badge <?= detect_color($incident["priorite"]) ?>">
                <?= $incident["priorite"] ?>
            </div>
        </div>

        <div class="mb-3">
            <input type="text" name="status" id="incidentStatus" value="<?= $incident["status"] ?>" hidden>
        </div>

        <div class="mb-3">
            <label for="incidentDate" class="form-label">Date</label>
            <input type="text" class="form-control" id="incidentDate" name="date"
                value="<?= $incident["date_creation"] ?> " readonly>
        </div>

        <div class="mb-3">
            <label for="incidentLocal" class="form-label">Local de l'incident</label>
            <input type="text" class="form-control" id="incidenLocal" name="local" value="<?= $incident["local"] ?>"
                readonly>
        </div>

</div>

<div class="d-flex justify-content-between mt-4">
    <a href="index.php" class="btn btn-danger">Annuler</a>
    <a href="mettre_en_attente.php?id=<?= $incident["id_incident"] ?>" class="btn btn-warning">Mettre en attente</a>
    <button type="submit" class="btn btn-success">Incident résolu</button>

</div>
</form>
</div>


</div>
</main>

<?php include_once 'footer.php'; ?>