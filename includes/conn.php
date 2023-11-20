<?php
$servername = "localhost";

//localhost
$username = "root";
$password = "DTIRegion6!+";

// //r6itbpm
// $username = "zoomrequestadmin";
// $password = "!r7TG4WuxCRJUgoo";

$database = "msgitdb";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");

$website = "MSG-IT";

$prefix = "REQ";
$date = date("ym");
$result = $conn->query("SELECT COUNT(*) AS RequestCount FROM helpdesks WHERE DATE_FORMAT(CreatedAt, '%y%m') = '$date'");
$row = $result->fetch_assoc();
$requestCount = str_pad($row['RequestCount'] + 1, 5, '0', STR_PAD_LEFT);
$GenerateRequestNo = $prefix . '-' . $date . '-' . $requestCount;
