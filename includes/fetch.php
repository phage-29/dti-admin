<?php
// requires
require_once 'conn.php';

session_start();

$response = array();

if (isset($_POST['RequestNo'])) {
    $RequestNo = $conn->real_escape_string($_POST['RequestNo']);

    $query = "SELECT * FROM `helpdesks` where `RequestNo`=?";

    try {
        $result = $conn->execute_query($query, [$RequestNo]);

        while ($row = $result->fetch_object()) {
            $response = $row;
        }
    } catch (Exception $e) {
        $response['status'] = 'error';
        $response['message'] = $e->getMessage();
    }
}


$responseJSON = json_encode($response);

echo $responseJSON;

$conn->close();
?>