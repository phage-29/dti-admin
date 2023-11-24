<?php
require_once "includes/conn.php";

if (isset($_GET['RequestNo'])) {
    $query = "UPDATE `helpdesks` SET `Csf` = ? WHERE `RequestNo` = ?";
    $result = $conn->execute_query($query,['Done', $_GET['RequestNo']]);

    header('Location: https://forms.office.com/r/tBGKen7rG6');
}