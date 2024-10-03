<?php
$index = true;
include_once 'header.php';
include_once 'main.php';

?>

<h1 class="mt-5">Nouveaux incidents</h1>

<table id="datatable" class="display">
    <?php
    $query = "SELECT * FROM incident WHERE status = :statut";
    $pdostmt = $pdo->prepare($query);
    $pdostmt->execute(["statut" => "ouvert"]);
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
            <th>DETAILS</th>
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
                <td>

                    <a href="details.php?id=<?= $ligne["id_incident"] ?>" class="btn btn-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-three-dots" viewBox="0 0 16 16">
                            <path
                                d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3" />
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