<?php
$page = "Login Page";
require_once "includes/conn.php";
require_once "components/header.php";

if (isset($_GET["Request"])) {
    $query = "SELECT
        h.`id`,
        h.`RequestNo`,
        h.`FirstName`,
        h.`LastName`,
        h.`Email`,
        d.Division as `Division`,
        h.`DateRequested`,
        h.`RequestType`,
        h.`PropertyNo`,
        c.Category as `Category`,
        sc.SubCategory as `SubCategory`,
        h.`Complaints`,
        h.`DateReceived`,
        CONCAT(u1.FirstName, ' ', u1.LastName) as `ReceivedBy`,
        h.`DateScheduled`,
        h.`RepairType`,
        h.`DatetimeStarted`,
        h.`DatetimeFinished`,
        h.`Diagnosis`,
        h.`Remarks`,
        CONCAT(u2.FirstName, ' ', u2.LastName) as `ServicedBy`,
        CONCAT(u3.FirstName, ' ', u3.LastName) as `ApprovedBy`,
        h.`Status`,
        h.`CreatedAt`,
        h.`UpdatedAt`,
        h.`DatePreferred`,
        h.`TimePreferred`
    FROM helpdesks h
        LEFT JOIN divisions d ON h.`DivisionID` = d.id
        LEFT JOIN categories c ON h.`CategoryID` = c.id
        LEFT JOIN subcategories sc ON h.`SubCategoryID` = sc.id
        LEFT JOIN users u1 ON h.`ReceivedBy` = u1.id
        LEFT JOIN users u2 ON h.`ServicedBy` = u2.id
        LEFT JOIN users u3 ON h.`ApprovedBy` = u3.id WHERE RequestNo=?";
    $result = $conn->execute_query($query, [$_GET["Request"]]);
    if ($result->num_rows == 0) {
?>
        <script>
            alert('Invalid Request No.');
            window.location.href = 'requestservice.php';
        </script>
    <?php
    }
    $req = $result->fetch_object();
    ?>
    <main>
        <div class="container">

            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-md-10 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <img src="assets/img/logo.png" alt="">
                                    <span class="d--block">
                                        <?= $website ?>
                                    </span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">REQUEST FOR ICT TECHNICAL ASSISTANCE AND SERVICING FORM</h5>
                                        <p class="text-center small">Overview details of your service request.</p>
                                    </div>
                                    <h1 class="mb-3 text-center">STATUS: <?= $req->Status == "Pending" ? "<span class='text-warning'>PENDING</span>" : ($req->Status == "On Going" ? "<span class='text-primary'>ON GOING</span>" : ($req->Status == "Completed" ? "<span class='text-success'>COMPLETED</span>" : ($req->Status == "Denied" ? "<span class='text-danger'>DENIED</span>" : ($req->Status == "Cancelled" ? "<span class='text-secondary'>CANCELLED</span>" : "<span class='text-info'>UNSERVICEABLE</span>")))) ?></h1>
                                    <div class="row g-3">
                                        <div class="col-lg-6">
                                            <label for="DateRequested" class="form-label">DateRequested</label>
                                            <input type="date" class="form-control" id="DateRequested" name="DateRequested" value="<?= $req->DateRequested ?>" disabled>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="RequestNo" class="form-label">Request No</label>
                                            <input type="text" class="form-control" id="RequestNo" name="RequestNo" value="<?= $req->RequestNo ?>" disabled>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="CategoryID" class="form-label">Nature of Complaint/s</label>
                                            <input type="text" class="form-control" id="CategoryID" name="CategoryID" value="<?= $req->Category ?>" disabled>
                                        </div>

                                        <div class="col-lg-6">
                                            <label for="SubCategoryID" class="form-label">Sub Category</label>
                                            <input type="text" class="form-control" id="SubCategoryID" name="SubCategoryID" value="<?= $req->SubCategory ?>" disabled>
                                        </div>
                                        <div class="col-lg-12">
                                            <label for="Complaints" class="form-label">Defects/Complaints</label>
                                            <textarea class="form-control" id="Complaints" name="Complaints" disabled><?= $req->Complaints ?></textarea>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="DatePreferred" class="form-label">Preferred Date</label>
                                            <input type="date" class="form-control" id="DatePreferred" name="DatePreferred" value="<?= $req->DatePreferred ?>" disabled>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="TimePreferred" class="form-label">Preferred Time</label>
                                            <input type="time" class="form-control" id="TimePreferred" name="TimePreferred" value="<?= $req->TimePreferred ?>" disabled>
                                        </div>
                                        <hr>

                                        <div class="col-lg-6">
                                            <label for="DateReceived" class="form-label">DateReceived</label>
                                            <input type="date" class="form-control" id="DateReceived" name="DateReceived" value="<?= $req->DateReceived ?>" disabled>
                                        </div>

                                        <div class="col-lg-6">
                                            <label for="ReceivedBy" class="form-label">ReceivedBy</label>
                                            <input type="text" class="form-control" id="ReceivedBy" name="ReceivedBy" value="<?= $req->ReceivedBy ?>" disabled>
                                        </div>
                                        <div class="col-lg-12">
                                            <label for="DateScheduled" class="form-label">DateScheduled</label>
                                            <input type="date" class="form-control" id="DateScheduled" name="DateScheduled" value="<?= $req->DateScheduled ?>" disabled>
                                        </div>
                                        <div class="col-lg-12">
                                            <label for="RepairType" class="form-label">RepairType</label>
                                            <input type="text" class="form-control" id="RepairType" name="RepairType" value="<?= $req->RepairType ?>" disabled>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="DatetimeStarted" class="form-label">DatetimeStarted</label>
                                            <input type="datetime-local" class="form-control" id="DatetimeStarted" name="DatetimeStarted" value="<?= $req->DatetimeStarted ?>" disabled>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="DatetimeFinished" class="form-label">DatetimeFinished</label>
                                            <input type="datetime-local" class="form-control" id="DatetimeFinished" name="DatetimeFinished" value="<?= $req->DatetimeFinished ?>" disabled>
                                        </div>
                                        <div class="col-lg-12">
                                            <label for="Diagnosis" class="form-label">Diagnosis</label>
                                            <textarea class="form-control" id="Diagnosis" name="Diagnosis" disabled><?= $req->Diagnosis ?></textarea>
                                        </div>
                                        <div class="col-lg-12">
                                            <label for="Remarks" class="form-label">Remarks</label>
                                            <textarea class="form-control" id="Remarks" name="Remarks" disabled><?= $req->Remarks ?></textarea>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="ServicedBy" class="form-label">ServicedBy</label>
                                            <input type="text" class="form-control" id="ServicedBy" name="ServicedBy" value="<?= $req->ServicedBy ?>" disabled>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="ApprovedBy" class="form-label">ApprovedBy</label>
                                            <input type="text" class="form-control" id="ApprovedBy" name="ApprovedBy" value="<?= $req->ApprovedBy ?>" disabled>
                                        </div>

                                        <div class="col-lg-12">
                                            <input type="hidden" name="AddRequest" />
                                            <a class="btn btn-primary w-100" href="request.php">Submit Another Request</a>
                                        </div>
                                        <div class="col-lg-12">
                                            <p class="small mb-0">
                                                <!-- Don't have account? <a href="pages-register.html">Create an account</a> -->
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->
<?php
} else {
?>
    <!-- Change Password Modal -->
    <div class="modal fade" id="RequestNoModal" tabindex="-1" aria-labelledby="RequestNoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="RequestNoModalLabel">View Request</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="GET">
                        <div class="row">
                            <div class=" col-lg-12">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Request No.</span>
                                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="Request">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 text-end">
                            <input type="hidden" name="View" />
                            <button class="btn btn-secondary" onclick="history.back()">Back</button>
                            <button type="submit" class="btn btn-primary">View</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var RequestNoModal = new bootstrap.Modal(document.getElementById('RequestNoModal'));
            RequestNoModal.show();
        });
    </script>
<?php
}

require_once "components/footer.php";
?>