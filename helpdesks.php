<?php
$page = "Helpdesks";
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
          <!-- All Widget -->
          <div class="col-lg-3 col-md-6" style="cursor: pointer;" onclick="location='?'">
            <div class="widget card text-center">
              <div class="card-body">
                <h5 class="card-title"><?= $conn->query("SELECT * FROM helpdesks")->num_rows ?></h5>
                <p class="card-text"><strong>All</strong></p>
              </div>
            </div>
          </div>

          <!-- Pending Widget -->
          <div class="col-lg-3 col-md-6" style="cursor: pointer;" onclick="location='?FilterStatus=Pending'">
            <div class="widget card text-center">
              <div class="card-body">
                <h5 class="card-title"><?= $conn->query("SELECT * FROM helpdesks WHERE Status='Pending'")->num_rows ?></h5>
                <p class="card-text text-warning"><strong>Pending</strong></p>
              </div>
            </div>
          </div>

          <!-- On Going Widget -->
          <div class="col-lg-3 col-md-6" style="cursor: pointer;" onclick="location='?FilterStatus=On Going'">
            <div class="widget card text-center">
              <div class="card-body">
                <h5 class="card-title"><?= $conn->query("SELECT * FROM helpdesks WHERE Status='On Going'")->num_rows ?></h5>
                <p class="card-text text-primary"><strong>On Going</strong></p>
              </div>
            </div>
          </div>

          <!-- Completed Widget -->
          <div class="col-lg-3 col-md-6" style="cursor: pointer;" onclick="location='?FilterStatus=Completed'">
            <div class="widget card text-center">
              <div class="card-body">
                <h5 class="card-title"><?= $conn->query("SELECT * FROM helpdesks WHERE Status='Completed'")->num_rows ?></h5>
                <p class="card-text text-success"><strong>Completed</strong></p>
              </div>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Helpdesks List</h5>
            <table class="w-100" id="table" style="display: none">
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
                $query = isset($_GET['FilterStatus']) ? "SELECT * FROM helpdesks WHERE Status='" . $_GET['FilterStatus'] . "' ORDER BY RequestNo DESC" : "SELECT * FROM helpdesks ORDER BY RequestNo DESC";
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
                    <td class="text-nowrap"><?= $conn->query("SELECT * FROM subcategories WHERE id='" . $row->CategoryID . "'")->fetch_object()->SubCategory ?></td>
                    <td class="text-nowrap <?= $row->Status == "Pending" ? 'text-warning' : ($row->Status == "On Going" ? 'text-primary' : ($row->Status == "Completed" ? 'text-success' : ($row->Status == "Denied" ? 'text-danger' : ($row->Status == "Unserviceable" ? 'text-secondary' : 'text-info')))) ?>"><?= $row->Status ?></td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
            </table>

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
                      <form action="includes/process.php" method="POST" class="row m-0 p-0" id="Form">
                        <input type="hidden" id="id" name="id">
                        <div class="col-lg-12">
                          <label for="Status" class="form-label">Status</label>
                          <select class="form-select" id="Status" name="Status" required>
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
                          <input type="date" class="form-control" id="DateReceived" name="DateReceived" required>
                        </div>

                        <div class="col-lg-6">
                          <label for="ReceivedBy" class="form-label">ReceivedBy</label>
                          <select class="form-select" id="ReceivedBy" name="ReceivedBy" required>
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
                          <input type="date" class="form-control" id="DateScheduled" name="DateScheduled" required>
                        </div>
                        <div class="col-lg-12">
                          <label for="RepairType" class="form-label">RepairType</label>
                          <select class="form-select" id="RepairType" name="RepairType" required>
                            <option value="Minor">Minor</option>
                            <option value="Major">Major</option>
                          </select>
                        </div>
                        <div class="col-lg-6">
                          <label for="DatetimeStarted" class="form-label">DatetimeStarted</label>
                          <input type="datetime-local" class="form-control" id="DatetimeStarted" name="DatetimeStarted" required>
                        </div>
                        <div class="col-lg-6">
                          <label for="DatetimeFinished" class="form-label">DatetimeFinished</label>
                          <input type="datetime-local" class="form-control" id="DatetimeFinished" name="DatetimeFinished">
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
                        <input type="hidden" name="UpdateRequest" />
                      </form>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="document.getElementById('Form').submit()">Save changes</button>
                  </div>
                </div>
              </div>
            </div>

            <script>
              $(document).ready(function() {
                var dataTable = new DataTable('#table', {
                  responsive: true,
                  aaSorting: [],
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