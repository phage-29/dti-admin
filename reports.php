<?php
$page = "Reports";
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
                <li class="breadcrumb-item active"><?= $page ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <style>
                    .widget {
                        transform: scale(1.0);
                        transition: transform 0.1s ease-in-out;
                    }

                    .widget:hover {
                        transform: scale(1.05);
                        transition: transform 0.1s ease-in-out;
                    }
                </style>
                <div class="row">

                    <!-- Pending Widget -->
                    <div class="col-lg-2 col-md-6" style="cursor: pointer;" onclick="location='?FilterStatus=Pending'">
                        <div class="widget card text-center">
                            <div class="card-body">
                                <h5 class="card-title"><?= $conn->query("SELECT * FROM helpdesks WHERE Status='Pending'")->num_rows ?></h5>
                                <p class="card-text text-warning"><strong>Pending</strong></p>
                            </div>
                        </div>
                    </div>

                    <!-- On Going Widget -->
                    <div class="col-lg-2 col-md-6" style="cursor: pointer;" onclick="location='?FilterStatus=On Going'">
                        <div class="widget card text-center">
                            <div class="card-body">
                                <h5 class="card-title"><?= $conn->query("SELECT * FROM helpdesks WHERE Status='On Going'")->num_rows ?></h5>
                                <p class="card-text text-primary"><strong>On Going</strong></p>
                            </div>
                        </div>
                    </div>

                    <!-- Completed Widget -->
                    <div class="col-lg-2 col-md-6" style="cursor: pointer;" onclick="location='?FilterStatus=Completed'">
                        <div class="widget card text-center">
                            <div class="card-body">
                                <h5 class="card-title"><?= $conn->query("SELECT * FROM helpdesks WHERE Status='Completed'")->num_rows ?></h5>
                                <p class="card-text text-success"><strong>Completed</strong></p>
                            </div>
                        </div>
                    </div>

                    <!-- Denied Widget -->
                    <div class="col-lg-2 col-md-6" style="cursor: pointer;" onclick="location='?FilterStatus=Denied'">
                        <div class="widget card text-center">
                            <div class="card-body">
                                <h5 class="card-title"><?= $conn->query("SELECT * FROM helpdesks WHERE Status='Denied'")->num_rows ?></h5>
                                <p class="card-text text-danger"><strong>Denied</strong></p>
                            </div>
                        </div>
                    </div>

                    <!-- Cancelled Widget -->
                    <div class="col-lg-2 col-md-6" style="cursor: pointer;" onclick="location='?FilterStatus=Cancelled'">
                        <div class="widget card text-center">
                            <div class="card-body">
                                <h5 class="card-title"><?= $conn->query("SELECT * FROM helpdesks WHERE Status='Cancelled'")->num_rows ?></h5>
                                <p class="card-text text-secondary"><strong>Cancelled</strong></p>
                            </div>
                        </div>
                    </div>

                    <!-- Unserviceable Widget -->
                    <div class="col-lg-2 col-md-6" style="cursor: pointer;" onclick="location='?FilterStatus=Unserviceable'">
                        <div class="widget card text-center">
                            <div class="card-body">
                                <h5 class="card-title"><?= $conn->query("SELECT * FROM helpdesks WHERE Status='Unserviceable'")->num_rows ?></h5>
                                <p class="card-text text-info"><strong>Unserviceable</strong></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Helpdesks</h5>

                        <!-- Table with stripped rows -->
                        <div class="row">
                            <div class="row col-lg-6 mb-3">
                                <div class="col-lg-6">
                                    <label for="DateFrom" class="form-label">Date From</label>
                                    <input type="date" class="form-control" id="DateFrom" name="DateFrom">
                                </div>
                                <div class="col-lg-6">
                                    <label for="DateTo" class="form-label">Date To</label>
                                    <input type="date" class="form-control" id="DateTo" name="DateTo">
                                </div>
                            </div>
                        </div>
                        <table class="table w-100" id="table">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-nowrap">Request No.</th>
                                    <th scope="col" class="text-nowrap">Requestor</th>
                                    <th scope="col" class="text-nowrap">Email</th>
                                    <th scope="col" class="text-nowrap">Division/Office</th>
                                    <th scope="col" class="text-nowrap">Date Requested</th>
                                    <th scope="col" class="text-nowrap">Request Type</th>
                                    <th scope="col" class="text-nowrap">Property No.</th>
                                    <th scope="col" class="text-nowrap">Category</th>
                                    <th scope="col" class="text-nowrap">Sub Category</th>
                                    <th scope="col" class="text-nowrap">Complaint</th>
                                    <th scope="col" class="text-nowrap">Repair Type</th>
                                    <th scope="col" class="text-nowrap">Date Received</th>
                                    <th scope="col" class="text-nowrap">Date Scheduled</th>
                                    <th scope="col" class="text-nowrap">Date and Time Started</th>
                                    <th scope="col" class="text-nowrap">Date and Time Finished</th>
                                    <th scope="col" class="text-nowrap">Turn Around Time</th>
                                    <th scope="col" class="text-nowrap">Received By</th>
                                    <th scope="col" class="text-nowrap">Serviced By</th>
                                    <th scope="col" class="text-nowrap">Approved By</th>
                                    <th scope="col" class="text-nowrap">Diagnosis/Action</th>
                                    <th scope="col" class="text-nowrap">Remarks/Recommendation</th>
                                    <th scope="col" class="text-nowrap">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = isset($_GET['FilterStatus']) ? "SELECT *, CASE
                                WHEN DAYOFWEEK(`DatetimeStarted`) > DAYOFWEEK(`DatetimeFinished`) THEN (
                                    DATE_SUB(
                                        TIME(
                                            DATE_SUB( (
                                                    TIMEDIFF(
                                                        `DatetimeFinished`,
                                                        `DatetimeStarted`
                                                    )
                                                ),
                                                INTERVAL (
                                                    15 * DATEDIFF(
                                                        `DatetimeFinished`,
                                                        `DatetimeStarted`
                                                    )
                                                ) HOUR
                                            )
                                        ),
                                        INTERVAL (18) HOUR
                                    )
                                )
                                ELSE (
                                    TIME(
                                        DATE_SUB( (
                                                TIMEDIFF(
                                                    `DatetimeFinished`,
                                                    `DatetimeStarted`
                                                )
                                            ),
                                            INTERVAL (
                                                15 * DATEDIFF(
                                                    `DatetimeFinished`,
                                                    `DatetimeStarted`
                                                )
                                            ) HOUR
                                        )
                                    )
                                )
                            END AS TurnAroundTime FROM helpdesks WHERE Status='" . $_GET['FilterStatus'] . "' ORDER BY id DESC" : "SELECT *, CASE
                                WHEN DAYOFWEEK(`DatetimeStarted`) > DAYOFWEEK(`DatetimeFinished`) THEN (
                                    DATE_SUB(
                                        TIME(
                                            DATE_SUB( (
                                                    TIMEDIFF(
                                                        `DatetimeFinished`,
                                                        `DatetimeStarted`
                                                    )
                                                ),
                                                INTERVAL (
                                                    15 * DATEDIFF(
                                                        `DatetimeFinished`,
                                                        `DatetimeStarted`
                                                    )
                                                ) HOUR
                                            )
                                        ),
                                        INTERVAL (18) HOUR
                                    )
                                )
                                ELSE (
                                    TIME(
                                        DATE_SUB( (
                                                TIMEDIFF(
                                                    `DatetimeFinished`,
                                                    `DatetimeStarted`
                                                )
                                            ),
                                            INTERVAL (
                                                15 * DATEDIFF(
                                                    `DatetimeFinished`,
                                                    `DatetimeStarted`
                                                )
                                            ) HOUR
                                        )
                                    )
                                )
                            END AS TurnAroundTime FROM helpdesks ORDER BY id DESC";
                                $result = $conn->query($query);
                                while ($row = $result->fetch_object()) {
                                ?>
                                    <tr>
                                        <td scope="row" class="text-nowrap"><?= $row->RequestNo ?></td>
                                        <td class="text-nowrap"><?= $row->FirstName . ' ' . $row->LastName ?></td>
                                        <td class="text-nowrap"><?= $row->Email ?></td>
                                        <td class="text-nowrap"><?= $conn->query("SELECT * FROM divisions WHERE id='" . $row->DivisionID . "'")->fetch_object()->Division ?? null ?></td>
                                        <td class="text-nowrap"><?= $row->DateRequested ?></td>
                                        <td class="text-nowrap"><?= $row->RequestType ?></td>
                                        <td class="text-nowrap"><?= $row->PropertyNo ?></td>
                                        <td class="text-nowrap"><?= $conn->query("SELECT * FROM categories WHERE id='" . $row->CategoryID . "'")->fetch_object()->Category ?? null ?></td>
                                        <td class="text-wrap"><?= $conn->query("SELECT * FROM subcategories WHERE id='" . $row->SubCategoryID . "'")->fetch_object()->SubCategory ?? null ?></td>
                                        <td class="text-wrap"><?= $row->Complaints ?></td>
                                        <td class="text-nowrap"><?= $row->RepairType ?></td>
                                        <td class="text-nowrap"><?= $row->DateReceived ?></td>
                                        <td class="text-nowrap"><?= $row->DateScheduled ?></td>
                                        <td class="text-nowrap"><?= $row->DatetimeStarted ?></td>
                                        <td class="text-nowrap"><?= $row->DatetimeFinished ?></td>
                                        <td class="text-nowrap"><?= $row->TurnAroundTime ?></td>
                                        <td class="text-nowrap"><?= $conn->query("SELECT * FROM users WHERE id='" . $row->ReceivedBy . "'")->fetch_object()->FirstName ?? null ?></td>
                                        <td class="text-nowrap"><?= $conn->query("SELECT * FROM users WHERE id='" . $row->ServicedBy . "'")->fetch_object()->FirstName ?? null ?></td>
                                        <td class="text-nowrap"><?= $conn->query("SELECT * FROM users WHERE id='" . $row->ApprovedBy . "'")->fetch_object()->FirstName ?? null ?></td>
                                        <td class="text-wrap"><?= $row->Diagnosis ?></td>
                                        <td class="text-wrap"><?= $row->Remarks ?></td>
                                        <td class="text-nowrap <?= $row->Status == "Pending" ? 'text-warning' : ($row->Status == "On Going" ? 'text-primary' : ($row->Status == "Completed" ? 'text-success' : ($row->Status == "Denied" ? 'text-danger' : ($row->Status == "Unserviceable" ? 'text-secondary' : 'text-info')))) ?>"><?= $row->Status ?></td>
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
                                    buttons: ['excel', 'pdf', 'print'],
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