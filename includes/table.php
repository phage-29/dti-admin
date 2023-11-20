<?php
// requires
require_once 'conn.php';

session_start();
?>
<tbody>
    <?php
    $query = isset($_GET['FilterStatus']) ? ($_GET['FilterStatus'] == 'All' ? "SELECT * FROM helpdesks ORDER BY id DESC" : "SELECT * FROM helpdesks WHERE Status='" . $_GET['FilterStatus'] . "' ORDER BY id DESC") : "SELECT * FROM helpdesks ORDER BY id DESC";
    $result = $conn->query($query);
    while ($row = $result->fetch_object()) {
    ?>
        <tr>
            <td scope="row"><?= $row->RequestNo ?></td>
            <td><?= $row->FirstName . ' ' . $row->LastName ?></td>
            <td><?= $row->Email ?></td>
            <td><?= $conn->query("SELECT * FROM divisions WHERE id='" . $row->DivisionID . "'")->fetch_object()->Division ?></td>
            <td><?= $row->DateRequested ?></td>
            <td><?= $conn->query("SELECT * FROM Categories WHERE id='" . $row->CategoryID . "'")->fetch_object()->Category ?></td>
            <td><?= $conn->query("SELECT * FROM SubCategories WHERE id='" . $row->CategoryID . "'")->fetch_object()->SubCategory ?></td>
            <td class="<?= $row->Status == "Pending" ? 'text-warning' : ($row->Status == "On Going" ? 'text-primary' : ($row->Status == "Completed" ? 'text-success' : ($row->Status == "Denied" ? 'text-danger' : ($row->Status == "Unserviceable" ? 'text-secondary' : 'text-info')))) ?>"><?= $row->Status ?></td>
        </tr>
    <?php
    }
    ?>
</tbody>