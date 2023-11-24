<?php
require_once "includes/conn.php";

if (isset($_GET['RequestNo'])) {
    $query = "UPDATE `helpdesks` SET `Csf` = ? WHERE `RequestNo` = ?";
    $result = $conn->execute_query($query, ['Done', $_GET['RequestNo']]);

?>
    <script>
        setTimeout(function() {
            window.location.href = "https://forms.office.com/r/tBGKen7rG6";
        }, 1000)
    </script>
<?php
}
