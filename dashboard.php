<?php
$page = "Dashboard";
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
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Announcements</h5>
            <p>No Announcements.</p>
          </div>
        </div>

      </div>
      <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Line Chart</h5>

            <!-- Line Chart -->
            <canvas id="lineChart" style="max-height: 400px;"></canvas>
            <script>
              document.addEventListener("DOMContentLoaded", () => {
                new Chart(document.querySelector('#lineChart'), {
                  type: 'line',
                  data: {
                    labels: [
                      <?php
                      $query = "SELECT
    LEFT(MONTHNAME(`DateRequested`), 3) AS `month`,
    COUNT(*) AS `count_per_month`
FROM
    `helpdesks`
WHERE
    YEAR(`DateRequested`) = YEAR(CURDATE())
GROUP BY
    `month`
ORDER BY
    `month`";
                      $result = $conn->execute_query($query);
                      while ($row = $result->fetch_object()) {
                      ?> '<?= $row->month ?>',
                      <?php
                      }
                      ?>
                    ],
                    datasets: [{
                      label: 'Count per month',
                      data: [
                        <?php
                        $query = "SELECT
    LEFT(MONTHNAME(`DateRequested`), 3) AS `month`,
    COUNT(*) AS `count_per_month`
FROM
    `helpdesks`
WHERE
    YEAR(`DateRequested`) = YEAR(CURDATE())
GROUP BY
    `month`
ORDER BY
    `month`";
                        $result = $conn->execute_query($query);
                        while ($row = $result->fetch_object()) {
                        ?> '<?= $row->count_per_month ?>',
                        <?php
                        }
                        ?>
                      ],
                      fill: false,
                      borderColor: 'rgb(75, 192, 192)',
                      tension: 0.1
                    }]
                  },
                  options: {
                    scales: {
                      y: {
                        beginAtZero: true
                      }
                    }
                  }
                });
              });
            </script>
            <!-- End Line CHart -->

          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Bar CHart</h5>

            <!-- Bar Chart -->
            <canvas id="barChart" style="max-height: 400px;"></canvas>
            <script>
              document.addEventListener("DOMContentLoaded", () => {
                new Chart(document.querySelector('#barChart'), {
                  type: 'bar',
                  data: {
                    labels: [
                      <?php
                      $query = "SELECT
                        d.`Division`,
                        COUNT(h.`DivisionID`) AS `count_per_division`
                    FROM `helpdesks` h
                        LEFT JOIN `divisions` d ON h.`DivisionID` = d.`id`
                    GROUP BY d.`Division`
                    ORDER BY d.`Division`";
                      $result = $conn->execute_query($query);
                      while ($row = $result->fetch_object()) {
                      ?> '<?= $row->Division ?>',
                      <?php
                      }
                      ?>
                    ],
                    datasets: [{
                      label: 'Count per Division',
                      data: [
                        <?php
                        $query = "SELECT
                        d.`Division`,
                        COUNT(h.`DivisionID`) AS `count_per_division`
                    FROM `helpdesks` h
                        LEFT JOIN `divisions` d ON h.`DivisionID` = d.`id`
                    GROUP BY d.`Division`
                    ORDER BY d.`Division`";
                        $result = $conn->execute_query($query);
                        while ($row = $result->fetch_object()) {
                        ?> '<?= $row->count_per_division ?>',
                        <?php
                        }
                        ?>
                      ],
                      backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)'
                      ],
                      borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)'
                      ],
                      borderWidth: 1
                    }]
                  },
                  options: {
                    scales: {
                      y: {
                        beginAtZero: true
                      }
                    }
                  }
                });
              });
            </script>
            <!-- End Bar CHart -->

          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Pie Chart</h5>

            <!-- Pie Chart -->
            <canvas id="pieChart" style="max-height: 400px;"></canvas>
            <script>
              document.addEventListener("DOMContentLoaded", () => {
                new Chart(document.querySelector('#pieChart'), {
                  type: 'pie',
                  data: {
                    labels: [
                      <?php
                      $query = "SELECT
                      c.Category,
                      COUNT(h.CategoryID) AS count_per_category
                  FROM helpdesks h
                      LEFT JOIN categories c ON h.`CategoryID` = c.id
                  GROUP BY c.Category
                  ORDER BY c.Category";
                      $result = $conn->execute_query($query);
                      while ($row = $result->fetch_object()) {
                      ?> '<?= $row->Category ?>',
                      <?php
                      }
                      ?>
                    ],
                    datasets: [{
                      label: 'My First Dataset',
                      data: [
                        <?php
                        $query = "SELECT
                      c.Category,
                      COUNT(h.CategoryID) AS count_per_category
                  FROM helpdesks h
                      LEFT JOIN categories c ON h.`CategoryID` = c.id
                  GROUP BY c.Category
                  ORDER BY c.Category";
                        $result = $conn->execute_query($query);
                        while ($row = $result->fetch_object()) {
                        ?> '<?= $row->count_per_category ?>',
                        <?php
                        }
                        ?>
                      ],
                      backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)'
                      ],
                      hoverOffset: 4
                    }]
                  }
                });
              });
            </script>
            <!-- End Pie CHart -->

          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Doughnut Chart</h5>

            <!-- Doughnut Chart -->
            <canvas id="doughnutChart" style="max-height: 400px;"></canvas>
            <script>
              document.addEventListener("DOMContentLoaded", () => {
                new Chart(document.querySelector('#doughnutChart'), {
                  type: 'doughnut',
                  data: {
                    labels: [
                      <?php
                      $query = "SELECT
    Status,
    COUNT(Status) AS count_per_status
FROM helpdesks
GROUP BY `Status`
ORDER BY `Status`";
                      $result = $conn->execute_query($query);
                      while ($row = $result->fetch_object()) {
                      ?> '<?= $row->Status ?>',
                      <?php
                      }
                      ?>
                    ],
                    datasets: [{
                      label: 'My First Dataset',
                      data: [
                        <?php
                        $query = "SELECT
    Status,
    COUNT(Status) AS count_per_status
FROM helpdesks
GROUP BY `Status`
ORDER BY `Status`";
                        $result = $conn->execute_query($query);
                        while ($row = $result->fetch_object()) {
                        ?> '<?= $row->count_per_status ?>',
                        <?php
                        }
                        ?>
                      ],
                      backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)'
                      ],
                      hoverOffset: 4
                    }]
                  }
                });
              });
            </script>
            <!-- End Doughnut CHart -->

          </div>
        </div>
      </div>
    </div>
  </section>

</main><!-- End #main -->
<?php
require_once "components/footer.php";
?>