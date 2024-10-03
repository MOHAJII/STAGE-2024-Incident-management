<?php
$incident = true;
include_once 'header.php';
include_once 'main.php';
$count = 0;

?>

<h1 class="mt-5">Incidents terminer en attente de confirmation</h1>

<table id="datatable" class="display">
    <?php
    $query = "SELECT * FROM incident WHERE status = :statut";
    $pdostmt = $pdo->prepare($query);
    $pdostmt->execute(["statut" => "terminer"]);
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
            <th>SUIVI</th>
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
                    <a href="check.php?id=<?= $ligne['id_incident'] ?>" class="btn btn-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-check" viewBox="0 0 16 16">
                            <path
                                d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z" />
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