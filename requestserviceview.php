<?php
$page = "Login Page";
require_once "includes/conn.php";
require_once "components/header.php";
?>
<main>
    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-6 d-flex flex-column align-items-center justify-content-center">

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
                                        <input type="text" class="form-control" id="CategoryID" name="CategoryID" disabled>
                                    </div>

                                    <div class="col-lg-6">
                                        <label for="SubCategoryID" class="form-label">Complaint/s Category</label>
                                        <input type="text" class="form-control" id="SubCategoryID" name="SubCategoryID" disabled>
                                    </div>
                                    <div class="col-lg-12">
                                        <label for="Complaints" class="form-label">Defects/Complaints</label>
                                        <textarea class="form-control" id="Complaints" name="Complaints" disabled></textarea>
                                    </div>
                                    <hr>
                                    <div class="col-lg-12">
                                        <label for="Status" class="form-label">Status</label>
                                        <input type="text" class="form-control" id="Status" name="Status" disabled>
                                    </div>

                                    <div class="col-lg-6">
                                        <label for="DateReceived" class="form-label">DateReceived</label>
                                        <input type="date" class="form-control" id="DateReceived" name="DateReceived" disabled>
                                    </div>

                                    <div class="col-lg-6">
                                        <label for="ReceivedBy" class="form-label">ReceivedBy</label>
                                        <input type="text" class="form-control" id="ReceivedBy" name="ReceivedBy" disabled>
                                    </div>
                                    <div class="col-lg-12">
                                        <label for="DateScheduled" class="form-label">DateScheduled</label>
                                        <input type="date" class="form-control" id="DateScheduled" name="DateScheduled" disabled>
                                    </div>
                                    <div class="col-lg-12">
                                        <label for="RepairType" class="form-label">RepairType</label>
                                        <input type="text" class="form-control" id="RepairType" name="RepairType" disabled>
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
                                        <input type="text" class="form-control" id="ServicedBy" name="ServicedBy" disabled>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="ApprovedBy" class="form-label">ApprovedBy</label>
                                        <input type="text" class="form-control" id="ApprovedBy" name="ApprovedBy" disabled>
                                    </div>

                                    <div class="col-lg-12">
                                        <input type="hidden" name="AddRequest" />
                                        <a class="btn btn-primary w-100" href="requestservice.php">Submit Another Request</a>
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
require_once "components/footer.php";
?>