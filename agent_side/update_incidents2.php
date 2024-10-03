<?php
$index = true;
include_once 'header.php';
include_once 'main.php';

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
    <?php

    include_once 'header.php';
    include_once 'main.php';

    if (!empty($_POST["titre"]) && !empty($_POST["description"]) && !empty($_POST["priorite"]) && !empty($_POST["date"]) && !empty($_POST["status"]) && !empty($_POST["technicien"])) {
        $query = "update incident set titre = :titre, description = :description, priorite = :priorite, date_creation = :date, status = :status, id_technicien = :technicien where id_incident = :id";
        $pdostmt = $pdo->prepare($query);
        $pdostmt->execute(["titre" => $_POST["titre"], "description" => $_POST["description"], "priorite" => $_POST["priorite"], "date" => $_POST["date"], "status" => $_POST["status"], "technicien" => $_POST["technicien"], "id" => $_POST["id_incident"]]);
        header('location:incident.php');
    } else {
        ?>
        <div class="alert alert-warning" role="alert">Veuillez remplire tout les champs</div>
        <?php
    }

    include_once 'footer.php'

        ?>
    <form method="post">
        <!-- ID de l'incident caché -->
        <input type="hidden" name="id_incident" value="<?= $incident["id_incident"] ?>">

        <div class="mb-3">
            <label for="incidentTitle" class="form-label">Titre de l'incident</label>
            <input type="text" class="form-control" id="incidentTitle" name="titre" value="<?= $incident["titre"] ?>"
                required>
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
                required><?= $incident["description"] ?></textarea>
        </div>

        <div class="mb-3">
            <label for="incidentPriority" class="form-label">Priorité</label>
            <select class="form-select" id="incidentPriority" name="priorite" required>
                <option value="haute" <?= $incident["priorite"] === "haute" ? 'selected' : '' ?>>Haute</option>
                <option value="moyenne" <?= $incident["priorite"] === "moyenne" ? 'selected' : '' ?>>Moyenne</option>
                <option value="normale" <?= $incident["priorite"] === "normale" ? 'selected' : '' ?>>Normale</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="incidentStatus" class="form-label">Status</label>
            <select class="form-select" id="incidentStatus" name="status" required>
                <option value="ouvert" <?= $incident["status"] === "ouvert" ? 'selected' : '' ?>>Ouvert</option>
                <option value="fermé" <?= $incident["status"] === "en cours" ? 'selected' : '' ?>>En cours</option>
                <option value="en cours" <?= $incident["status"] === "cloture" ? 'selected' : '' ?>>Cloture</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="incidentDate" class="form-label">Date</label>
            <input type="text" class="form-control" id="incidentDate" name="date"
                value="<?= $incident["date_creation"] ?> " readonly required>
        </div>



        <div class="mb-3">
            <label for="technicianSelect" class="form-label">Select Technician</label>
            <select class="form-select" id="technicianSelect" name="technicien">
                <option value="" selected>Select a technician</option>
                <?php while ($technicien = $pdostmt3->fetch(PDO::FETCH_ASSOC)): ?>
                    <option value="<?= $technicien["id_technicien"] ?>">
                        <?php echo $technicien["nom"] . " " . $technicien["prenom"] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
</div>

<div class="d-flex justify-content-between mt-4">
    <button type="submit" class="btn btn-success">Confirmer</button>
    <a href="index.php" class="btn btn-danger">Annuler</a>
</div>
</form>
</div>


</div>
</main>

<?php include_once 'footer.php'; ?>