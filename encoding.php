<?php
$page = "Encoding";
require_once "includes/session.php";
require_once "components/header.php";
require_once "components/topbar.php";
require_once "components/sidebar.php";
?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1><?= $page ?></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item active"><?= $page ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-5">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Request Form</h5>
                        <form action="includes/process.php" method="post" class="row g-3 overflow-auto" style="height: 75vh">
                            <div class="col-lg-12">
                                <label for="DateRequested" class="form-label">Date Requested</label>
                                <input type="date" class="form-control" id="DateRequested" name="DateRequested" value="<?= date('Y-m-d') ?>" required>
                            </div>
                            <div class="col-lg-12">
                                <label for="Email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="Email" name="Email" value="misr6.dti@gmail.com" required>
                            </div>
                            <div class="col-lg-6">
                                <label for="FirstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="FirstName" name="FirstName" required>
                            </div>
                            <div class="col-lg-6">
                                <label for="LastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="LastName" name="LastName" required>
                            </div>
                            <div class="col-lg-12">
                                <label for="DivisionID" class="form-label">Division/Office</label>
                                <select class="form-select" id="DivisionID" name="DivisionID" required>
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
                            <div class="col-lg-12">
                                <label for="RequestType" class="form-label">Request Type</label>
                                <select class="form-select" id="RequestType" name="RequestType" required>
                                    <option value="" selected disabled></option>
                                    <option value="ICT Helpdesk">ICT Helpdesk</option>
                                    <option value="ICT Maintenance">ICT Maintenance</option>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label for="CategoryID" class="form-label">Nature of Complaint/s</label>
                                <select class="form-select" id="CategoryID" name="CategoryID" required>
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
                                <select class="form-select" id="SubCategoryID" name="SubCategoryID" required>
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
                                <label for="DatePreferred" class="form-label">Preferred Date</label>
                                <input type="date" class="form-control" id="DatePreferred" name="DatePreferred" value="<?= date('Y-m-d') ?>">
                            </div>
                            <div class="col-lg-6">
                                <label for="TimePreferred" class="form-label">Preferred Time</label>
                                <input type="time" class="form-control" id="TimePreferred" name="TimePreferred" value="<?= date('H:i') ?>">
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
                            <div class="col-lg-12">
                                <label for="Complaints" class="form-label">Defects/Complaints</label>
                                <textarea class="form-control" id="Complaints" name="Complaints"></textarea>
                            </div>
                            <hr>
                            <div class="col-lg-12">
                                <label for="Status" class="form-label">Status</label>
                                <select class="form-select" id="Status" name="Status">
                                    <option value="Pending" class="text-warning">Pending</option>
                                    <option value="On Going" class="text-primary">On Going</option>
                                    <option value="Completed" class="text-success">Completed</option>
                                    <option value="Denied" class="text-danger">Denied</option>
                                    <option value="Cancelled" class="text-secondary">Cancelled</option>
                                    <option value="Unserviceable" class="text-info">Unserviceable</option>
<option value="Pre-Repair">Pre-Repair</option>
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <label for="Medium" class="form-label">Medium</label>
                                <select class="form-select" id="Medium" name="Medium">
                                    <option value="ICT System">ICT System</option>
                                    <option value="Phone">Phone</option>
                                    <option value="Memorandum">Memorandum</option>
                                    <option value="Intercom">Intercom</option>
                                    <option value="Email">Email</option>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label for="DateReceived" class="form-label">DateReceived</label>
                                <input type="date" class="form-control" id="DateReceived" name="DateReceived" value="<?= date('Y-m-d') ?>">
                            </div>

                            <div class="col-lg-6">
                                <label for="ReceivedBy" class="form-label">ReceivedBy</label>
                                <select class="form-select" id="ReceivedBy" name="ReceivedBy">
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
                                <input type="date" class="form-control" id="DateScheduled" name="DateScheduled" value="<?= date('Y-m-d') ?>">
                            </div>
                            <div class="col-lg-12">
                                <label for="ServicePriority" class="form-label">Priority</label>
                                <select class="form-select" id="ServicePriority" name="ServicePriority">
                                    <option value="Low">Low</option>
                                    <option value="Medium">Medium</option>
                                    <option value="High">High</option>
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <label for="RepairType" class="form-label">RepairType</label>
                                <select class="form-select" id="RepairType" name="RepairType">
                                    <option value="Minor">Minor</option>
                                    <option value="Major">Major</option>
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <label for="RepairClassification" class="form-label">RepairClassification</label>
                                <select class="form-select" id="RepairClassification" name="RepairClassification">
                                    <option value="Simple">Simple</option>
                                    <option value="Medium">Medium</option>
                                    <option value="Complex">Complex</option>
                                    <option value="Highly Technical">Highly Technical</option>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label for="DatetimeStarted" class="form-label">DatetimeStarted</label>
                                <input type="datetime-local" class="form-control" id="DatetimeStarted" name="DatetimeStarted" value="<?= date('Y-m-d H:i') ?>">
                            </div>
                            <div class="col-lg-6">
                                <label for="DatetimeFinished" class="form-label">DatetimeFinished</label>
                                <input type="datetime-local" class="form-control" id="DatetimeFinished" name="DatetimeFinished" value="<?= date('Y-m-d H:i') ?>">
                            </div>
                            <div class="col-lg-12">
                                <label for="Diagnosis" class="form-label">Diagnosis</label>
                                <textarea class="form-control" id="Diagnosis" name="Diagnosis"></textarea>
                            </div>
                            <div class="col-lg-12">
                                <label for="Remarks" class="form-label">Remarks</label>
                                <textarea class="form-control" id="Remarks" name="Remarks"></textarea>
                            </div>
                            <div class="col-lg-6">
                                <label for="ServicedBy" class="form-label">ServicedBy</label>
                                <select class="form-select" id="ServicedBy" name="ServicedBy">
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
                                <select class="form-select" id="ApprovedBy" name="ApprovedBy">
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
                            <div class="col-lg-12">
                                <input type="hidden" name="Encode" />
                                <button class="btn btn-primary w-100" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <div class="col-lg-7">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Request Table</h5>
                        <!-- <form action="">
                            <div class="dataTables_filter text-end mb-1">
                                <label>Search: <input type="search" name="Email" placeholder="Enter Email" value="<?= $_GET['Email'] ?? '' ?>" aria-controls="table"> <button class="bg-primary text-white"><i class="bi bi-search"></i></button></label>
                            </div>
                        </form> -->
                        <table class="w-100" id="table">
                            <thead>
                                <tr>
                                    <th class="text-nowrap" scope="col">Request No.</th>
                                    <th class="text-nowrap" scope="col">Requestor</th>
                                    <th class="text-nowrap" scope="col">Email</th>
                                    <th class="text-nowrap" scope="col">Division/Office</th>
                                    <th class="text-nowrap" scope="col">Date</th>
                                    <th class="text-nowrap" scope="col">Category</th>
                                    <th class="text-nowrap" scope="col">Sub Category</th>
                                    <th class="text-nowrap" scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = isset($_GET['FilterStatus']) ? "SELECT * FROM helpdesks WHERE Status='" . $_GET['FilterStatus'] . "' ORDER BY id DESC" : "SELECT * FROM helpdesks ORDER BY id DESC";
                                $result = $conn->query($query);
                                while ($row = $result->fetch_object()) {
                                ?>
                                    <tr>
                                        <td class="text-nowrap" scope="row"><?= $row->RequestNo ?></td>
                                        <td class="text-nowrap"><?= $row->FirstName . ' ' . $row->LastName ?></td>
                                        <td class="text-nowrap"><?= $row->Email ?></td>
                                        <td class="text-nowrap"><?= $conn->query("SELECT * FROM divisions WHERE id='" . $row->DivisionID . "'")->fetch_object()->Division ?></td>
                                        <td class="text-nowrap"><?= $row->DateRequested ?></td>
                                        <td class="text-nowrap"><?= $conn->query("SELECT * FROM categories WHERE id='" . $row->CategoryID . "'")->fetch_object()->Category ?></td>
                                        <td class="text-nowrap"><?= $conn->query("SELECT * FROM subcategories WHERE id='" . $row->SubCategoryID . "'")->fetch_object()->SubCategory ?></td>
                                        <td class="text-nowrap <?= $row->Status == "Pending" ? 'text-warning' : ($row->Status == "On Going" ? 'text-primary' : ($row->Status == "Completed" ? 'text-success' : ($row->Status == "Denied" ? 'text-danger' : ($row->Status == "Unserviceable" ? 'text-secondary' : 'text-info')))) ?>"><?= $row->Status ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <script>
                            $(document).ready(function() {
                                var dataTable = new DataTable('#table', {
                                    aaSorting: [],
                                    scrollX: true,
                                });

                                // $('#table').fadeIn(500);
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