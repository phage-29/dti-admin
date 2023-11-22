<?php
$servername = "localhost";

//localhost
// $username = "root";
// $password = "DTIRegion6!+";

// //r6itbpm
$username = "zoomrequestadmin";
$password = "!r7TG4WuxCRJUgoo";

$database = "msgitdb";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");

$website = "MSG-IT";
