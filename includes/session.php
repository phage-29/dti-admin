<?php
require_once "conn.php";

session_start();

if (isset($_SESSION["id"]) && !empty($_SESSION["id"])) {
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit();
    }

    $_SESSION['last_activity'] = time();

    $query = "SELECT * FROM `users` WHERE `id`=?";
    $result = $conn->execute_query($query, [$_SESSION["id"]]);

    if ($result && $result->num_rows > 0) {
        $acc = $result->fetch_object();
    } else {
        header("Location: login.php");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}
