<?php 
session_start();

include_once "header.php";
$count1 = 0;
$count2 = 0;
$count3 = 0;

$client = $_SESSION["user"];
?>

<body>

    <nav class="navbar navbar-expand-lg rounded-4 m-2 text-center" style="background-color: #f6f5fc;">
        <div class="container-fluid text-center">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <img src="../img/N7-logo.png" alt="Logo de l'école" height="80" class="d-inline-block align-text-top">
                <div class="separator">X</div>
                <img src="../img/ocp-group.png" alt="Logo OCP" height="90" class="d-inline-block align-text-top">
            </a>
            <span class="navbar-text">
                Gestion des incidents
            </span>
            <button class="custom-btn" type="button" id="nav-btn" data-bs-toggle="modal"
                data-bs-target="#incidentModal">+ Déclarer incident</button>
        </div>
    </nav>

    <!-- Dans le body, remplacer les placeholders par les appels PHP -->
    <main class="container mt-4">
        <div class="row">
            <?php
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

            $query = "SELECT * FROM incident";
            $pdostmt = $pdo->prepare($query);
            $pdostmt->execute();

            $resultats = [];
            while ($ligne = $pdostmt->fetch(PDO::FETCH_ASSOC)) {
                $resultats[] = $ligne;
            }


            ?>
            <!-- Card pour les nouvelles demandes -->
            <div class="col-12 col-md-4 mb-4">
                <div class="card h-100 nouveau-demandes">
                    <div class="card-header">
                        Nouveaux incidents
                    </div>
                    <div class="card-body text-dark">
                        <?php foreach ($resultats as $ligne): ?>
                            <div class="accordion <?php echo (strtolower($ligne["status"]) === "ouvert") ? "" : "d-none"; ?> mb-3"
                                id="incidentAccordion">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne<?= $count1 ?>" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            Incident #<?= $ligne["id_incident"] ?> - <?= $ligne["priorite"] ?> Priorité
                                        </button>
                                    </h2>
                                    <div id="collapseOne<?= $count1++ ?>" class="accordion-collapse collapse "
                                        aria-labelledby="headingOne" data-bs-parent="#incidentAccordion">
                                        <div class="accordion-body">
                                            <strong>Titre : </strong><?= $ligne["titre"] ?><br>
                                            <strong>Description : </strong><?= $ligne["description"] ?><br>
                                            <strong>Priorité : </strong>
                                            <div class="badge <?= detect_color($ligne["priorite"]) ?>">
                                                <?= $ligne["priorite"] ?>
                                            </div> <br>
                                            <strong>Date de déclaration : </strong><?= $ligne["date_creation"] ?><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>



            <!-- Card pour les demandes en cours -->
            <div class="col-12 col-md-4 mb-4">
                <div class="card h-100 demandes-en-cours">
                    <div class="card-header">
                        Incidents En Cours
                    </div>
                    <div class="card-body text-dark">
                        <?php foreach ($resultats as $ligne): ?>
                            <div class="accordion <?php echo (strtolower($ligne["status"]) === "en cours") ? "" : "d-none"; ?> mb-3"
                                id="incidentAccordion">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne<?= $count2 ?>" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            Incident #<?= $ligne["id_incident"] ?> - <?= $ligne["priorite"] ?> Priorité
                                        </button>
                                    </h2>
                                    <div id="collapseOne<?= $count2++ ?>" class="accordion-collapse collapse "
                                        aria-labelledby="headingOne" data-bs-parent="#incidentAccordion">
                                        <div class="accordion-body">
                                            <strong>Titre : </strong><?= $ligne["titre"] ?><br>
                                            <strong>Description : </strong><?= $ligne["description"] ?><br>
                                            <strong>Priorité : </strong>
                                            <div class="badge <?= detect_color($ligne["priorite"]) ?>">
                                                <?= $ligne["priorite"] ?>
                                            </div> <br>
                                            <strong>Date de déclaration : </strong><?= $ligne["date_creation"] ?><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Card pour les demandes clôturées -->
            <div class="col-12 col-md-4 mb-4">
                <div class="card h-100 demandes-cloture">
                    <div class="card-header">
                        Incidents Clôturés
                    </div>
                    <div class="card-body text-dark">
                        <?php foreach ($resultats as $ligne): ?>
                            <div class="accordion <?php echo (strtolower($ligne["status"]) === "cloture") ? "" : "d-none"; ?> mb-3"
                                id="incidentAccordion">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne<?= $count3 ?>" aria-expanded=""
                                            aria-controls="collapseOne">
                                            Incident #<?= $ligne["id_incident"] ?> - <?= $ligne["priorite"] ?> Priorité
                                        </button>
                                    </h2>
                                    <div id="collapseOne<?= $count3++ ?>" class="accordion-collapse collapse "
                                        aria-labelledby="headingOne" data-bs-parent="#incidentAccordion">
                                        <div class="accordion-body">
                                            <strong>Titre : </strong><?= $ligne["titre"] ?><br>
                                            <strong>Description : </strong><?= $ligne["description"] ?><br>
                                            <strong>Priorité : </strong>
                                            <div class="badge <?= detect_color($ligne["priorite"]) ?>">
                                                <?= $ligne["priorite"] ?>
                                            </div> <br>
                                            <strong>Date de déclaration :
                                            </strong><?= $ligne["date_creation"] ?><br>
                                            <strong>Date de colture : </strong> <?= $ligne["date_cloture"] ?><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal pour ajouter une nouvelle demande -->
    <div class="modal fade" id="incidentModal" tabindex="-1" aria-labelledby="incidentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="incidentModalLabel">Crée une nouvelle incident</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="incidentForm" action="add_incident.php">
                        <div class="mb-3">
                            <label for="title" class="form-label">Titre<span style="color : red;">*</span></label>
                            <input type="text" class="form-control" id="title" name="titre"
                                placeholder="Entrez le titre de l'incident" required>
                        </div>
                        <div class="mb-3">
                            <label for="type" class="form-label">Type<span style="color : red;">*</span></label>
                            <select class="form-select" id="type" name="type">
                                <option value="Problèmes de réseau">Problèmes de réseau</option>
                                <option value="Défaillances matérielles">Défaillances matérielles</option>
                                <option value="Bugs logiciels">Bugs logiciels</option>
                                <option value="Problèmes électriques">Problèmes électriques</option>
                                <option value="Problèmes dans les laboratoires">Problèmes dans les laboratoires</option>
                                <option value="Maintenance des infrastructures">Maintenance des infrastructures</option>
                                <option value="Sécurité">Sécurité</option>
                                <option value="Problèmes de communication">Problèmes de communication</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"
                                placeholder="Décrivez l'incident"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="priority" class="form-label">Priorité<span style="color : red;">*</span></label>
                            <select class="form-select" id="priority" name="priorite" required>
                                <option value="normale" class="text-success">Normale</option>
                                <option value="moyenne" class="text-warning">Moyenne</option>
                                <option value="haute" class="text-danger">Haute</option>


                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label" hidden>status<span
                                    style="color : red;">*</span></label>
                            <input class="form-select" id="status" name="status" hidden value="ouvert" required>
                        </div>
                        <div class="mb-3">
                            <label for="local" class="form-label">Local<span style="color : red;">*</span></label>
                            <input type="text" class="form-control" id="local" name="local"
                                placeholder="ex: Bureau 2, salle info 5" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="id" name="id"
                             value="<?= $client["id_client"] ?>" hidden>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <?php include_once ("footer.php"); ?>
</body>

</html>