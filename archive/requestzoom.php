<?php
$page = "Dashboard";
require_once "components/header.php";
require_once "components/topbar.php";
require_once "components/sidebar.php";
?>
<main class="main mt-5 pt-5">
    <div class="container-fluid">
        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Request Form</h5>
                            <form class="row g-3 needs-validation ajax-form" novalidate>
                                <div class="col-md-6">
                                    <label for="Requestor" class="form-label">Your Name</label>
                                    <input type="text" class="form-control" id="Requestor" name="Requestor"
                                        autocomplete="off" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="Email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="Email" name="Email" autocomplete="off"
                                        required>
                                </div>
                                <div class="col-md-12">
                                    <label for="Title" class="form-label">Topic</label>
                                    <textarea class="form-control" id="Title" name="Title" autocomplete="off"
                                        required></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="OfficeID" class="form-label">Provincial Office</label>
                                    <select class="form-select" id="OfficeID" name="OfficeID"
                                        autocomplete="off" required>
                                        <option value="" selected disabled>--</option>
                                        <?php
                                        $query = "SELECT * FROM offices";
                                        $result = $conn->execute_query($query, []);
                                        while ($row = $result->fetch_object()) {
                                            ?>
                                            <option value="<?= $row->id ?>">
                                                <?= $row->Office ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="DivisionID" class="form-label">Division</label>
                                    <select class="form-select" id="DivisionID" name="DivisionID" autocomplete="off"
                                        required>
                                        <option value="" selected disabled>--</option>
                                        <?php
                                        $query = "SELECT * FROM divisions";
                                        $result = $conn->execute_query($query, []);
                                        while ($row = $result->fetch_object()) {
                                            ?>
                                            <option value="<?= $row->id ?>">
                                                <?= $row->Division ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="Schedule" class="form-label">Schedule</label>
                                    <input type="date" class="form-control" value="<?= date('Y-m-d') ?>" id="Schedule"
                                        name="Schedule" autocomplete="off" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="TimeStart" class="form-label">Time Start</label>
                                    <input type="time" class="form-control" id="TimeStart" name="TimeStart"
                                        onchange="TimeEnd.min=this.value" autocomplete="off" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="TimeEnd" class="form-label">Time End</label>
                                    <input type="time" class="form-control" id="TimeEnd" name="TimeEnd"
                                        onchange="TimeStart.max=this.value" autocomplete="off" required>
                                </div>
                                <div class="text-end">
                                    <input type="hidden" name="Request" />
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Request Tracker</h5>
                                    <div class="calendar" id="ScheduledMeetingsCalendar"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
<?php
require_once "components/footer.php";
?>