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
      <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Count Per Month</h5>

            <!-- Line Chart -->
            <div id="lineChart"></div>

            <script>
              document.addEventListener("DOMContentLoaded", () => {
                new ApexCharts(document.querySelector("#lineChart"), {
                  series: [{
                    name: "Desktops",
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
                      ?> <?= $row->count_per_month ?>,
                      <?php
                      }
                      ?>
                    ]
                  }],
                  chart: {
                    height: 350,
                    type: 'line',
                    zoom: {
                      enabled: false
                    }
                  },
                  dataLabels: {
                    enabled: false
                  },
                  stroke: {
                    curve: 'straight'
                  },
                  grid: {
                    row: {
                      colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                      opacity: 0.5
                    },
                  },
                  xaxis: {
                    categories: [
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
                  }
                }).render();
              });
            </script>
            <!-- End Line Chart -->

          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Count Per Division</h5>

            <!-- Bar Chart -->
            <div id="barChart"></div>

            <script>
              document.addEventListener("DOMContentLoaded", () => {
                new ApexCharts(document.querySelector("#barChart"), {
                  series: [{
                    data: [
                      <?php
                      $query = "SELECT
                  d.`Division`,
      COUNT(h.`DivisionID`) AS`count_per_division`
              FROM`helpdesks` h
                  LEFT JOIN`divisions` d ON h.`DivisionID` = d.`id`
              GROUP BY d.`Division`
              ORDER BY d.`Division`";
                      $result = $conn->execute_query($query);
                      while ($row = $result->fetch_object()) {
                      ?> <?= $row->count_per_division ?>,
                      <?php
                      }
                      ?>
                    ],
                  }],
                  chart: {
                    type: 'bar',
                    height: 380
                  },
                  plotOptions: {
                    bar: {
                      barHeight: '100%',
                      distributed: true,
                      horizontal: true,
                      dataLabels: {
                        position: 'bottom'
                      },
                    }
                  },
                  // colors: ['#33b2df', '#546E7A', '#d4526e', '#13d8aa', '#A5978B', '#2b908f', '#f9a3a4', '#90ee7e',
                  //   '#f48024', '#69d2e7'
                  // ],
                  dataLabels: {
                    enabled: true,
                    textAnchor: 'start',
                    style: {
                      colors: ['#fff']
                    },
                    formatter: function(val, opt) {
                      return opt.w.globals.labels[opt.dataPointIndex] + ":  " + val
                    },
                    offsetX: 0,
                    dropShadow: {
                      enabled: true
                    }
                  },
                  stroke: {
                    width: 1,
                    colors: ['#fff']
                  },
                  xaxis: {
                    categories: [
                      <?php
                      $query = "SELECT
                  d.`Division`,
    COUNT(h.`DivisionID`) AS`count_per_division`
              FROM`helpdesks` h
                  LEFT JOIN`divisions` d ON h.`DivisionID` = d.`id`
              GROUP BY d.`Division`
              ORDER BY d.`Division`";
                      $result = $conn->execute_query($query);
                      while ($row = $result->fetch_object()) {
                      ?> '<?= $row->Division ?>',
                      <?php
                      }
                      ?>
                    ],
                  },
                  yaxis: {
                    labels: {
                      show: false
                    }
                  },
                  
                  tooltip: {
                    theme: 'dark',
                    x: {
                      show: false
                    },
                    y: {
                      title: {
                        formatter: function() {
                          return ''
                        }
                      }
                    }
                  }
                }).render();
              });
            </script>
            <!-- End Bar Chart -->

          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Count Per Category</h5>

            <!-- Pie Chart -->
            <div id="pieChart"></div>

            <script>
              document.addEventListener("DOMContentLoaded", () => {
                new ApexCharts(document.querySelector("#pieChart"), {
                  series: [
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
                    ?> <?= $row->count_per_category ?>,
                    <?php
                    }
                    ?>
                  ],
                  chart: {
                    height: 350,
                    type: 'pie',
                    toolbar: {
                      show: true
                    }
                  },
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
                  ]
                }).render();
              });
            </script>
            <!-- End Pie Chart -->

          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Count Per Status</h5>

            <!-- Donut Chart -->
            <div id="donutChart"></div>

            <script>
              document.addEventListener("DOMContentLoaded", () => {
                new ApexCharts(document.querySelector("#donutChart"), {
                  series: [
                    <?php
                    $query = "SELECT
                                  Status,
                                  COUNT(Status) AS count_per_status
                              FROM helpdesks
                              GROUP BY `Status`
                              ORDER BY `Status`";
                    $result = $conn->execute_query($query);
                    while ($row = $result->fetch_object()) {
                    ?> <?= $row->count_per_status ?>,
                    <?php
                    }
                    ?>
                  ],
                  chart: {
                    height: 350,
                    type: 'donut',
                    toolbar: {
                      show: true
                    }
                  },
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
                }).render();
              });
            </script>
            <!-- End Donut Chart -->

          </div>
        </div>
      </div>
    </div>
  </section>

</main><!-- End #main -->
<?php
require_once "components/footer.php";
?>