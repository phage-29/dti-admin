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
                                    <p class="text-center small">Enter the details of your service request.</p>

                                </div>

                                <form action="includes/process.php" method="post" class="row g-3">
                                    <div class="col-lg-6">
                                        <label for="DateRequested" class="form-label">DateRequested</label>
                                        <input type="date" class="form-control" id="DateRequested" name="DateRequested" value="<?= date('Y-m-d') ?>" readonly>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="RequestNo" class="form-label">Request No</label>
                                        <input type="text" class="form-control" id="RequestNo" name="RequestNo" value="<?= $GenerateRequestNo ?>" readonly>
                                    </div>
                                    <div class="col-lg-12">
                                        <label for="Email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="Email" name="Email" required>
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
                                            $result = $conn->query("SELECT * FROM Divisions");
                                            while ($row = $result->fetch_object()) {
                                            ?>
                                                <option value="<?= $row->id ?>"><?= $row->Division ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="RequestType" class="form-label">Request Type</label>
                                        <select class="form-select" id="RequestType" name="RequestType" required>
                                            <option value="" selected disabled></option>
                                            <option value="ICT Helpdesk">ICT Helpdesk</option>
                                            <option value="ICT Maintenance">ICT Maintenance</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="PropertyNo" class="form-label">Property No</label>
                                        <input type="text" class="form-control" id="PropertyNo" name="PropertyNo" />
                                    </div>
                                    <div class="col-lg-12">
                                        <label for="CategoryID" class="form-label">Nature of Complaint/s</label>
                                        <select class="form-select" id="CategoryID" name="CategoryID" required>
                                            <option value="" selected disabled>--</option>
                                            <?php
                                            $result = $conn->query("SELECT * FROM Categories");
                                            while ($row = $result->fetch_object()) {
                                            ?>
                                                <option value="<?= $row->id ?>"><?= $row->Category ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-lg-12">
                                        <label for="SubCategoryID" class="form-label">Complaint/s Category</label>
                                        <select class="form-select" id="SubCategoryID" name="SubCategoryID" required>
                                            <option id="" value="" selected disabled>--</option>
                                            <?php
                                            $result = $conn->query("SELECT * FROM SubCategories");
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
                                    <div class="col-lg-12">
                                        <label for="Complaints" class="form-label">Defects/Complaints</label>
                                        <textarea class="form-control" id="Complaints" name="Complaints"></textarea>
                                    </div>
                                    <!-- <div class="col-lg-12">
                                        <label for="FileUpload" class="form-label">Attached additional Information</label>
                                        <input type="file" id="FileUpload" name="files[]" class="form-control" multiple>
                                        <div id="fileHelp" class="form-text text-muted">Select multiple files with the CTRL or SHIFT key.</div>
                                    </div> -->

                                    <div class="col-lg-12">
                                        <input type="hidden" name="AddRequest" />
                                        <button class="btn btn-primary w-100" type="submit">Submit Request</button>
                                    </div>
                                    <div class="col-lg-12">
                                        <p class="small mb-0">
                                            <!-- Don't have account? <a href="pages-register.html">Create an account</a> -->
                                        </p>
                                    </div>
                                </form>

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