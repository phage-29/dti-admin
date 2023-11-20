<?php
$page = "Accomplishments";
require_once "includes/session.php";
require_once "components/header.php";
require_once "components/topbar.php";
require_once "components/sidebar.php";
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>
            <?= $page ?>
        </h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Pages</li>
                <li class="breadcrumb-item active">Accomplishment</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Helpdesks</h5>

                        <!-- Table with stripped rows -->
                        <table class="table w-100" id="table">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-nowrap">Date</th>
                                    <th scope="col" class="text-nowrap">Division</th>
                                    <th scope="col" class="text-nowrap">Requestor</th>
                                    <th scope="col" class="text-nowrap">Task</th>
                                    <th scope="col" class="text-nowrap">Category</th>
                                    <th scope="col" class="text-nowrap">Request Type</th>
                                    <th scope="col" class="text-nowrap">Diagnosis/Action</th>
                                    <th scope="col" class="text-nowrap">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $result = $conn->query("SELECT * FROM helpdesks WHERE ServicedBy=$acc->id ORDER BY DateRequested ASC");
                                while ($row = $result->fetch_object()) {
                                ?>
                                    <tr>
                                        <td class="text-nowrap">
                                            <?= date_format(date_create($row->CreatedAt), 'd/m/Y') ?>
                                        </td>
                                        <td class="text-nowrap">
                                            <?= $conn->query("SELECT * FROM divisions WHERE id='" . $row->DivisionID . "'")->fetch_object()->Division ?>
                                        </td>
                                        <td class="text-nowrap">
                                            <?= $row->LastName ?>, <?= $row->FirstName ?>
                                        </td>
                                        <td class="text-wrap">
                                            <?= $row->Remarks ?>
                                        </td>
                                        <td class="text-nowrap">
                                            <?= $conn->query("SELECT * FROM categories WHERE id='" . $row->CategoryID . "'")->fetch_object()->Category ?>
                                        </td>
                                        <td class="text-nowrap">
                                            <?= $conn->query("SELECT * FROM subcategories WHERE id='" . $row->SubCategoryID . "'")->fetch_object()->SubCategory ?>
                                        </td>
                                        <td class="text-wrap">
                                            <?= $row->Diagnosis ?>
                                        </td>
                                        <td class="text-nowrap <?= $row->Status == "Pending" ? 'text-warning' : ($row->Status == "On Going" ? 'text-primary' : ($row->Status == "Completed" ? 'text-success' : ($row->Status == "Denied" ? 'text-danger' : ($row->Status == "Unserviceable" ? 'text-secondary' : 'text-info')))) ?>">
                                            <?= $row->Status ?>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                var datatable = $('#table').DataTable({
                                    aaSorting: [],
                                    dom: 'Bfrtip',
                                    buttons: [
                                        'excel', 'pdf', 'print'
                                    ],
                                    scrollX: true,
                                });
                            });
                        </script>

                    </div>
                </div>

            </div>
        </div>
    </section>

</main>

<?php
require_once "components/footer.php";
?>