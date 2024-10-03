<?php
$client = true;
include_once 'header.php';
include_once 'main.php';

$count = 0;
$count1 = 0;
?>

<h1 class="mt-5">Clients</h1>

<table id="datatable" class="display">
    <?php
    $query = "SELECT * FROM client";
    $pdostmt = $pdo->prepare($query);
    $pdostmt->execute();
    ?>
    <thead>
        <tr>
            <th>ID</th>
            <th>NOM</th>
            <th>Prenom</th>
            <th>TELEPHONE</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($ligne = $pdostmt->fetch(PDO::FETCH_ASSOC)):
            ?>
            <tr>
                <td><?= $ligne['id_client'] ?></td>
                <td><?= $ligne['nom'] ?></td>
                <td><?= $ligne['prenom'] ?></td>
                <td><?= $ligne['telephone'] ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>




</div>
</main>

<?php include_once 'footer.php'; ?>