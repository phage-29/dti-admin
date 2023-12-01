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
                    <div class="col-lg-2 col-md-6" style="cursor: pointer;" onclick="location='?status=Pending&Filter='">
                        <div class="widget card text-center">
                            <div class="card-body">
                                <h5 class="card-title"><?= $conn->query("SELECT * FROM helpdesks WHERE Status='Pending'")->num_rows ?></h5>
                                <p class="card-text text-warning"><strong>Pending</strong></p>
                            </div>
                        </div>
                    </div>

                    <!-- On Going Widget -->
                    <div class="col-lg-2 col-md-6" style="cursor: pointer;" onclick="location='?status=On Going&Filter='">
                        <div class="widget card text-center">
                            <div class="card-body">
                                <h5 class="card-title"><?= $conn->query("SELECT * FROM helpdesks WHERE Status='On Going'")->num_rows ?></h5>
                                <p class="card-text text-primary"><strong>On Going</strong></p>
                            </div>
                        </div>
                    </div>

                    <!-- Completed Widget -->
                    <div class="col-lg-2 col-md-6" style="cursor: pointer;" onclick="location='?status=Completed&Filter='">
                        <div class="widget card text-center">
                            <div class="card-body">
                                <h5 class="card-title"><?= $conn->query("SELECT * FROM helpdesks WHERE Status='Completed'")->num_rows ?></h5>
                                <p class="card-text text-success"><strong>Completed</strong></p>
                            </div>
                        </div>
                    </div>

                    <!-- Denied Widget -->
                    <div class="col-lg-2 col-md-6" style="cursor: pointer;" onclick="location='?status=Denied&Filter='">
                        <div class="widget card text-center">
                            <div class="card-body">
                                <h5 class="card-title"><?= $conn->query("SELECT * FROM helpdesks WHERE Status='Denied'")->num_rows ?></h5>
                                <p class="card-text text-danger"><strong>Denied</strong></p>
                            </div>
                        </div>
                    </div>

                    <!-- Cancelled Widget -->
                    <div class="col-lg-2 col-md-6" style="cursor: pointer;" onclick="location='?status=Cancelled&Filter='">
                        <div class="widget card text-center">
                            <div class="card-body">
                                <h5 class="card-title"><?= $conn->query("SELECT * FROM helpdesks WHERE Status='Cancelled'")->num_rows ?></h5>
                                <p class="card-text text-secondary"><strong>Cancelled</strong></p>
                            </div>
                        </div>
                    </div>

                    <!-- Unserviceable Widget -->
                    <div class="col-lg-2 col-md-6" style="cursor: pointer;" onclick="location='?status=Unserviceable&Filter='">
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
                        <div class=" mb-3 text-end">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#filterModal">
                                Filter Table
                            </button>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="filterModalLabel">Filter Form</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <!-- Modal Body -->
                                    <div class="modal-body">
                                        <form class="small">
                                            <div class="mb-3">
                                                <label for="s tartDate" class="form-label">From Date:</label>
                                                <input type="date" class="form-control" id="startDate" name="startDate" placeholder="Select From Date" autocomplete="off">
                                            </div>

                                            <div class="mb-3">
                                                <label for="endDate" class="form-label">To Date:</label>
                                                <input type="date" class="form-control" id="endDate" name="endDate" placeholder="Select To Date" autocomplete="off">
                                            </div>
                                            <div class="mb-3">
                                                <label for="category" class="form-label">Category:</label>
                                                <select class="form-select" id="category" name="category">
                                                    <option value="" selected disabled>--</option>
                                                    <?php
                                                    $result = $conn->query("SELECT * FROM categories");
                                                    while ($row = $result->fetch_object()) {
                                                    ?>
                                                        <option value="<?= $row->id ?>"><?= $row->Category ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="subCategory" class="form-label">Sub Category:</label>
                                                <select class="form-select" id="subCategory" name="subCategory">
                                                    <option id="" value="" selected disabled>--</option>
                                                    <?php
                                                    $result = $conn->query("SELECT * FROM subcategories");
                                                    while ($row = $result->fetch_object()) {
                                                    ?>
                                                        <option data-categoryid="<?= $row->CategoryID ?>" value="<?= $row->id ?>"><?= $row->SubCategory ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <script>
                                                $(document).ready(function() {
                                                    function filterSubCategories(categoryId) {
                                                        $('#SubCategoryID option').each(function() {
                                                            if ($(this).data('categoryid') == categoryId || categoryId == "") {
                                                                $(this).show();
                                                            } else {
                                                                $(this).hide();
                                                            }
                                                        });
                                                        $('#SubCategoryID').val('');
                                                    }
                                                    $('#CategoryID').change(function() {
                                                        var categoryId = $(this).val();
                                                        filterSubCategories(categoryId);
                                                    });
                                                    $('#CategoryID').trigger('change');
                                                });
                                            </script>
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Status:</label>
                                                <select class="form-select" id="status" name="status">
                                                    <option id="" value="" selected disabled>--</option>
                                                    <option value="Pending" class="text-warning">Pending</option>
                                                    <option value="On Going" class="text-primary">On Going</option>
                                                    <option value="Completed" class="text-success">Completed</option>
                                                    <option value="Denied" class="text-danger">Denied</option>
                                                    <option value="Cancelled" class="text-secondary">Cancelled</option>
                                                    <option value="Unserviceable" class="text-info">Unserviceable</option>
<option value="Pre-Repair">Pre-Repair</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="endDate" class="form-label"></label>
                                                <input type="hidden" name="Filter" />
                                                <button type="submit" class="form-control btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <table class="w-100 small" id="table">
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
                                    <th scope="col" class="text-nowrap">CSF</th>
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
                            END AS TurnAroundTime FROM helpdesks ";
                                if (isset($_GET['Filter'])) {
                                    $where = [];
                                    if (!empty($_GET['startDate']) and !empty($_GET['endDate'])) {
                                        array_push($where, "DateRequested BETWEEN '" . $_GET['startDate'] . "' AND '" . $_GET['endDate'] . "'");
                                    }
                                    if (!empty($_GET['category'])) {
                                        array_push($where, " CategoryID = " . $_GET['category']);
                                    }
                                    if (!empty($_GET['subCategory'])) {
                                        array_push($where, "SubCategoryID = " . $_GET['subCategory']);
                                    }
                                    if (!empty($_GET['status'])) {
                                        array_push($where, "Status = '" . $_GET['status']."'");
                                    }
                                    $query .= "WHERE " . implode(" AND ", $where);
                                    // echo $query;
                                }
                                $query .= " ORDER BY id DESC";
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
                                        <td class="text-nowrap"><?= $conn->query("SELECT * FROM subcategories WHERE id='" . $row->SubCategoryID . "'")->fetch_object()->SubCategory ?? null ?></td>
                                        <td class="text-nowrap"><?= $row->Complaints ?></td>
                                        <td class="text-nowrap"><?= $row->RepairType ?></td>
                                        <td class="text-nowrap"><?= $row->DateReceived ?></td>
                                        <td class="text-nowrap"><?= $row->DateScheduled ?></td>
                                        <td class="text-nowrap"><?= $row->DatetimeStarted ?></td>
                                        <td class="text-nowrap"><?= $row->DatetimeFinished ?></td>
                                        <td class="text-nowrap"><?= $row->TurnAroundTime ?></td>
                                        <td class="text-nowrap"><?= $conn->query("SELECT * FROM users WHERE id='" . $row->ReceivedBy . "'")->fetch_object()->FirstName ?? null ?></td>
                                        <td class="text-nowrap"><?= $conn->query("SELECT * FROM users WHERE id='" . $row->ServicedBy . "'")->fetch_object()->FirstName ?? null ?></td>
                                        <td class="text-nowrap"><?= $conn->query("SELECT * FROM users WHERE id='" . $row->ApprovedBy . "'")->fetch_object()->FirstName ?? null ?></td>
                                        <td class="text-nowrap"><?= $row->Diagnosis ?></td>
                                        <td class="text-nowrap"><?= $row->Remarks ?></td>
                                        <td class="text-nowrap <?= $row->Status == "Pending" ? 'text-warning' : ($row->Status == "On Going" ? 'text-primary' : ($row->Status == "Completed" ? 'text-success' : ($row->Status == "Denied" ? 'text-danger' : ($row->Status == "Unserviceable" ? 'text-secondary' : 'text-info')))) ?>"><?= $row->Status ?></td>
                                        <td class="text-nowrap <?= $row->Csf == "Pending" ? 'text-warning' : 'text-primary' ?>"><?= $row->Csf ?></td>
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