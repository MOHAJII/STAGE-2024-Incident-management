<?php
$incident = true;
include_once 'header.php';
include_once 'main.php';
$count = 0;

?>

<h1 class="mt-5">Incidents en traitement</h1>

<table id="datatable" class="display">
    <?php
    $query = "SELECT * FROM incident WHERE status = :statut";
    $pdostmt = $pdo->prepare($query);
    $pdostmt->execute(["statut" => "en cours"]);
    ?>
    <thead>
        <tr>
            <th>ID INCIDENT</th>
            <th>TITRE</th>
            <th>TYPE</th>
            <th>DESCRIPTION</th>
            <th>LOCAL</th>
            <th>PRIORITE</th>
            <th>STATUS</th>
            <th>DATE DE DECLARATION</th>
            <th>ID TECHNICIEN</th>
            <th>ACTION</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($ligne = $pdostmt->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
                <td> <?= $ligne["id_incident"] ?> </td>
                <td> <?= $ligne["titre"] ?> </td>
                <td> <?= $ligne["type_incident"] ?> </td>
                <td> <?= $ligne["description"] ?> </td>
                <td> <?= $ligne["local"] ?> </td>
                <td> <?= $ligne["priorite"] ?> </td>
                <td> <?= $ligne["status"] ?> </td>
                <td> <?= $ligne["date_creation"] ?> </td>
                <td> <?= $ligne["id_technicien"] ?> </td>
                <td class="d-flex">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#updateModal<?= $count1 ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-pencil-fill" viewBox="0 0 16 16">
                            <path
                                d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                        </svg>
                    </button>
                    <a href="update_incident2.php?id=<?= $ligne['id_incident'] ?>" class="btn btn-danger"
                        data-bs-toggle="modal" data-bs-target="#deleteModal<?= $count ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-trash-fill" viewBox="0 0 16 16">
                            <path
                                d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                        </svg>
                    </a>
                </td>
            </tr>
            <div class="modal fade" id="deleteModal<?= $count++ ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Suppression</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Voulez vous vraiment supprimer ce client?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <a href="delete_incident.php?id=<?= $ligne['id_incident'] ?>"
                                class="btn btn-danger">Supprimer</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </tbody>
</table>


</div>
</main>

<?php include_once 'footer.php'; ?>