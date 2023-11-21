<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link collapsed" href="dashboard.php">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="profile.php">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Profile Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="accomplishments.php">
                <i class="bi bi-check-circle"></i>
                <span>Accomplishments</span>
            </a>
        </li><!-- End Profile Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="encoding.php">
                <i class="bi bi-file-earmark-code"></i>
                <span>Encoding</span>
            </a>
        </li><!-- End Profile Page Nav -->
        <?php
        if ($acc->Role == "Admin") {
        ?>

            <li class="nav-item">
                <a class="nav-link collapsed" href="reports.php">
                    <i class="bi bi-check-circle"></i>
                    <span>Reports</span>
                </a>
            </li><!-- End Profile Page Nav -->
        <?php
        }
        ?>

        <li class="nav-heading">Pages</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="helpdesks.php">
                <i class="bi bi-person"></i>
                <span>Helpdesks</span>
            </a>
        </li><!-- End helpdesks Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="meetings.php">
                <i class="bi bi-calendar"></i>
                <span>Meetings</span>
            </a>
        </li><!-- End meetings Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="equipment.php">
                <i class="bi bi-laptop"></i>
                <span>Equipment</span>
            </a>
        </li><!-- End equipment Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="logsheet.php">
                <i class="bi bi-journal-text"></i>
                <span>Logsheet</span>
            </a>
        </li><!-- End logsheet Page Nav -->

    </ul>

</aside><!-- End Sidebar-->

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get the current URL
        var currentURL = window.location.href.split('/');
        currentURL = currentURL[currentURL.length - 1].split('?');
        currentURL = currentURL[0];

        // Get all anchor elements in the navigation
        var navLinks = document.querySelectorAll('.nav-link');

        // Loop through each anchor element
        navLinks.forEach(function(link) {
            // Check if the href attribute matches the current URL
            if (link.getAttribute('href') === currentURL) {
                // Remove "collapsed" class and add "active" class
                link.classList.remove('collapsed');
                link.classList.add('active');
            }

        });
    });
</script>