<?php
$incident_c = true;
include_once 'header.php';
include_once 'main.php';
$count = 0;

?>

<h1 class="mt-5">Incidents clôturer</h1>

<table id="datatable" class="display">
    <?php
    $query = "SELECT * FROM incident WHERE status = :statut";
    $pdostmt = $pdo->prepare($query);
    $pdostmt->execute(["statut" => "cloture"]);
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
            <th>RAPPORT</th>
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
                <td class="d-flex justify-content-between">
                    <a href="../agent_side/rapport.php?id=<?= $ligne['id_incident'] ?>" class="btn btn-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-file-earmark-arrow-down" viewBox="0 0 16 16">
                            <path
                                d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293z" />
                            <path
                                d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                        </svg>
                    </a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>


</div>
</main>

<?php include_once 'footer.php'; ?>