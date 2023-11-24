<?php
$page = "Request Form";
require_once "includes/conn.php";
require_once "components/header.php";
?>
<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center">
            <img src="assets/img/logo.png" alt="">
            <span class="d-none d-lg-block">
                <?= $website ?>
            </span>
        </a>
    </div><!-- End Logo -->
    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <a class="btn btn-primary mx-3" href="login.php">Admin Login</a>
        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->
<main class="container-fluid mt-5 pt-5">

    <section class="section">
        <div class="row">
            <div class="col-lg-4">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Request Form</h5>
                        <form action="includes/process.php" method="post" onsubmit="return showLoading()" class="row g-3">
                            <div class="col-lg-12">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="Email" required>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" name="FirstName" required>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="LastName" required>
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label">Division/Office</label>
                                <select class="form-select" name="DivisionID" required>
                                    <option value="" selected disabled></option>
                                    <?php
                                    $result = $conn->query("SELECT * FROM divisions");
                                    while ($row = $result->fetch_object()) {
                                    ?>
                                        <option value="<?= $row->id ?>"><?= $row->Division ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label">Request Type</label>
                                <select class="form-select" name="RequestType" required>
                                    <option value="" selected disabled></option>
                                    <option value="ICT Helpdesk">ICT Helpdesk</option>
                                    <option value="ICT Maintenance">ICT Maintenance</option>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label">Property No</label>
                                <input type="text" class="form-control" name="PropertyNo" />
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label">Nature of Complaint/s</label>
                                <select class="form-select" id="CategoryID2" name="CategoryID" required>
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

                            <div class="col-lg-6">
                                <label class="form-label">Complaint/s Category</label>
                                <select class="form-select" id="SubCategoryID2" name="SubCategoryID" required>
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
                            <div class="col-lg-6">
                                <label class="form-label">Preferred Date</label>
                                <input type="date" class="form-control" name="DatePreferred" value="<?= date('Y-m-d') ?>">
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label">Preferred Time</label>
                                <input type="time" class="form-control" name="TimePreferred" value="<?= date('H:i') ?>">
                            </div>

                            <script>
                                $(document).ready(function() {
                                    function filterSubCategories(categoryId) {
                                        $('#SubCategoryID2 option').each(function() {
                                            if ($(this).data('categoryid') == categoryId || categoryId == "") {
                                                $(this).show();
                                            } else {
                                                $(this).hide();
                                            }
                                        });
                                        $('#SubCategoryID2').val('');
                                    }
                                    $('#CategoryID2').change(function() {
                                        var categoryId = $(this).val();
                                        filterSubCategories(categoryId);
                                    });
                                    $('#CategoryID2').trigger('change');
                                });
                            </script>
                            <div class="col-lg-12">
                                <label class="form-label">Defects/Complaints</label>
                                <textarea class="form-control" name="Complaints"></textarea>
                            </div>

                            <div class="col-lg-12">
                                <input type="hidden" name="Request" />
                                <button class="btn btn-primary w-100" type="submit">Submit Request</button>
                            </div>
                            <div class="col-lg-12">
                                <!-- <p class="small mb-0">
                                    <span>Have a request to view?</span>
                                    <a href="requestserviceview.php">View Request</a>
                                </p> -->
                                <p class="small mb-0">
                                    <span>Admin access needed?</span>
                                    <a href="login.php">Login as Admin</a>
                                </p>

                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <div class="col-lg-8">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Request Table</h5>
                        <form action="">
                            <div class="dataTables_filter text-end mb-1">
                                <label>Search: <input type="search" name="Email" placeholder="Enter Email" value="<?= $_GET['Email'] ?? '' ?>" aria-controls="table"> <button class="bg-primary text-white"><i class="bi bi-search"></i></button></label>
                            </div>
                        </form>
                        <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="ModalLabel">Request Overview</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row g-3">
                                            <div class="col-lg-6">
                                                <label for="DateRequested" class="form-label">DateRequested</label>
                                                <input type="date" class="form-control" id="DateRequested" name="DateRequested" disabled>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="RequestNo" class="form-label">Request No</label>
                                                <input type="text" class="form-control" id="RequestNo" name="RequestNo" disabled>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="CategoryID" class="form-label">Nature of Complaint/s</label>
                                                <select class="form-select" id="CategoryID" name="CategoryID" disabled>
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

                                            <div class="col-lg-6">
                                                <label for="SubCategoryID" class="form-label">Complaint/s Category</label>
                                                <select class="form-select" id="SubCategoryID" name="SubCategoryID" disabled>
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

                                            <div class="col-lg-12">
                                                <label for="Complaints" class="form-label">Defects/Complaints</label>
                                                <textarea class="form-control" id="Complaints" name="Complaints" disabled></textarea>
                                            </div>
                                            <hr>
                                            <div action="includes/process.php" method="POST" class="row m-0 p-0" id="Form">
                                                <input type="hidden" id="id" name="id">
                                                <div class="col-lg-12">
                                                    <label for="Status" class="form-label">Status</label>
                                                    <select class="form-select" id="Status" name="Status" disabled>
                                                        <option value="Pending" class="text-warning">Pending</option>
                                                        <option value="On Going" class="text-primary">On Going</option>
                                                        <option value="Completed" class="text-success">Completed</option>
                                                        <option value="Denied" class="text-danger">Denied</option>
                                                        <option value="Cancelled" class="text-secondary">Cancelled</option>
                                                        <option value="Unserviceable" class="text-info">Unserviceable</option>
                                                    </select>
                                                </div>

                                                <div class="col-lg-6">
                                                    <label for="DateReceived" class="form-label">DateReceived</label>
                                                    <input type="date" class="form-control" id="DateReceived" name="DateReceived" disabled>
                                                </div>

                                                <div class="col-lg-6">
                                                    <label for="ReceivedBy" class="form-label">ReceivedBy</label>
                                                    <select class="form-select" id="ReceivedBy" name="ReceivedBy" disabled>
                                                        <option value="" selected disabled>--</option>
                                                        <?php
                                                        $result = $conn->query("SELECT * FROM users");
                                                        while ($row = $result->fetch_object()) {
                                                        ?>
                                                            <option value="<?= $row->id ?>"><?= $row->FirstName ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-12">
                                                    <label for="DateScheduled" class="form-label">DateScheduled</label>
                                                    <input type="date" class="form-control" id="DateScheduled" name="DateScheduled" disabled>
                                                </div>
                                                <div class="col-lg-12">
                                                    <label for="RepairType" class="form-label">RepairType</label>
                                                    <select class="form-select" id="RepairType" name="RepairType" disabled>
                                                        <option value="Minor">Minor</option>
                                                        <option value="Major">Major</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-12">
                                                    <label for="RepairClassification" class="form-label">RepairClassification</label>
                                                    <select class="form-select" id="RepairClassification" name="RepairClassification" disabled>
                                                        <option value="Simple">Simple</option>
                                                        <option value="Medium">Medium</option>
                                                        <option value="Complex">Complex</option>
                                                        <option value="Highly Technical">Highly Technical</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="DatetimeStarted" class="form-label">DatetimeStarted</label>
                                                    <input type="datetime-local" class="form-control" id="DatetimeStarted" name="DatetimeStarted" disabled>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="DatetimeFinished" class="form-label">DatetimeFinished</label>
                                                    <input type="datetime-local" class="form-control" id="DatetimeFinished" name="DatetimeFinished" disabled>
                                                </div>
                                                <div class="col-lg-12">
                                                    <label for="Diagnosis" class="form-label">Diagnosis</label>
                                                    <textarea class="form-control" id="Diagnosis" name="Diagnosis" disabled></textarea>
                                                </div>
                                                <div class="col-lg-12">
                                                    <label for="Remarks" class="form-label">Remarks</label>
                                                    <textarea class="form-control" id="Remarks" name="Remarks" disabled></textarea>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="ServicedBy" class="form-label">ServicedBy</label>
                                                    <select class="form-select" id="ServicedBy" name="ServicedBy" disabled>
                                                        <option value="" selected disabled>--</option>
                                                        <?php
                                                        $result = $conn->query("SELECT * FROM users");
                                                        while ($row = $result->fetch_object()) {
                                                        ?>
                                                            <option value="<?= $row->id ?>"><?= $row->FirstName ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="ApprovedBy" class="form-label">ApprovedBy</label>
                                                    <select class="form-select" id="ApprovedBy" name="ApprovedBy" disabled>
                                                        <option value="" selected disabled>--</option>
                                                        <?php
                                                        $result = $conn->query("SELECT * FROM users WHERE Role='Admin'");
                                                        while ($row = $result->fetch_object()) {
                                                        ?>
                                                            <option value="<?= $row->id ?>"><?= $row->FirstName ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <input type="hidden" name="UpdateRequest" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" onclick="document.getElementById('Form').submit()">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="w-100" id="table" style="display: none">
                            <thead>
                                <tr>
                                    <th class="text-nowrap" scope="col">Request No.</th>
                                    <th class="text-nowrap" scope="col">Date</th>
                                    <th class="text-nowrap" scope="col">Category</th>
                                    <th class="text-nowrap" scope="col">Sub Category</th>
                                    <th class="text-nowrap" scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = isset($_GET['Email']) ? "SELECT * FROM helpdesks WHERE Email='" . $_GET['Email'] . "' ORDER BY id DESC" : "SELECT * FROM helpdesks WHERE Email='' ORDER BY id DESC";
                                $result = $conn->query($query);
                                while ($row = $result->fetch_object()) {
                                ?>
                                    <tr>
                                        <td class="text-nowrap" scope="row"><?= $row->RequestNo ?></td>
                                        <td class="text-nowrap"><?= $row->DateRequested ?></td>
                                        <td class="text-nowrap"><?= $conn->query("SELECT * FROM categories WHERE id='" . $row->CategoryID . "'")->fetch_object()->Category ?></td>
                                        <td class="text-nowrap"><?= $conn->query("SELECT * FROM subcategories WHERE id='" . $row->SubCategoryID . "'")->fetch_object()->SubCategory ?></td>
                                        <td class="<?= $row->Status == "Pending" ? 'text-warning' : ($row->Status == "On Going" ? 'text-primary' : ($row->Status == "Completed" ? 'text-success' : ($row->Status == "Denied" ? 'text-danger' : ($row->Status == "Unserviceable" ? 'text-secondary' : 'text-info')))) ?>"><?= $row->Status ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <script>
                            $(document).ready(function() {
                                var dataTable = new DataTable('#table', {
                                    responsive: true,
                                    aaSorting: [],
                                    searching: false,
                                });

                                $('#table').fadeIn(500);

                                $('#table tbody').on('click', 'tr', function() {
                                    var rowData = dataTable.row(this).data();

                                    var RequestNo = rowData[0];

                                    console.log('Request Number:', RequestNo);

                                    $.ajax({
                                        type: 'POST',
                                        url: 'includes/fetch.php',
                                        data: {
                                            RequestNo: RequestNo
                                        },
                                        dataType: 'json',
                                        success: function(response) {
                                            console.log('AJAX success:', response);
                                            $('#id').val(response.id);
                                            $('#DateRequested').val(response.DateRequested);
                                            $('#RequestNo').val(response.RequestNo);
                                            $('#CategoryID').val(response.CategoryID);
                                            $('#SubCategoryID').val(response.SubCategoryID);
                                            $('#RequestNo').val(response.RequestNo);
                                            $('#Complaints').val(response.Complaints);
                                            $('#Status').val(response.Status);
                                            $('#DateReceived').val(response.DateReceived);
                                            $('#ReceivedBy').val(response.ReceivedBy);
                                            $('#DateScheduled').val(response.DateScheduled);
                                            $('#RepairType').val(response.RepairType);
                                            $('#RepairClassification').val(response.RepairClassification);
                                            $('#DatetimeStarted').val(response.DatetimeStarted);
                                            $('#DatetimeFinished').val(response.DatetimeFinished);
                                            $('#Diagnosis').val(response.Diagnosis);
                                            $('#Remarks').val(response.Remarks);
                                            $('#ServicedBy').val(response.ServicedBy);
                                            $('#ApprovedBy').val(response.ApprovedBy);
                                            $('#Modal').modal('show');
                                        },
                                        error: function(error) {
                                            console.error('AJAX error:', error);
                                        }
                                    });
                                });
                            });
                        </script>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->
<?php
require_once "components/footer.php";
?>