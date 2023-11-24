<?php
$page = "Response Page";

// requires
require_once 'conn.php';
require_once "sendmail.php";

session_start();

$response = array();

$response['status'] = 'error';
$response['message'] = 'Something went wrong!';

if (isset($_POST['Login'])) {
    $Username = $conn->real_escape_string($_POST['Username']);
    $Password = $conn->real_escape_string($_POST['Password']);

    $query = "SELECT * FROM `users` where `Username`=?";

    try {
        $result = $conn->execute_query($query, [$Username]);

        if ($result && $result->num_rows === 1) {

            $row = $result->fetch_object();

            if (password_verify($Password, $row->Password)) {

                $_SESSION['id'] = $row->id;
                $_SESSION['Role'] = $row->Role;

                $response['status'] = 'success';
                $response['message'] = 'Login successful!';
                $response['redirect'] = '../dashboard.php';
            } else {

                $response['status'] = 'error';
                $response['message'] = 'Invalid Password!';
            }
        } else {

            $response['status'] = 'error';
            $response['message'] = 'Username not found!';
        }
    } catch (Exception $e) {
        $response['status'] = 'error';
        $response['message'] = $e->getMessage();
    }
}

if (isset($_POST['UpdateProfile'])) {
    $FirstName = $conn->real_escape_string($_POST['FirstName']);
    $MiddleName = $conn->real_escape_string($_POST['MiddleName']);
    $LastName = $conn->real_escape_string($_POST['LastName']);
    $Email = $conn->real_escape_string($_POST['Email']);
    $Phone = $conn->real_escape_string($_POST['Phone']);
    $Address = $conn->real_escape_string($_POST['Address']);

    $query = "UPDATE `users` SET `FirstName`=?,`MiddleName`=?,`LastName`=?,`Email`=?,`Phone`=?,`Address`=? WHERE `Username`=?";
    try {

        $result = $conn->execute_query($query, [$FirstName, $MiddleName, $LastName, $Email, $Phone, $Address, $_SESSION["Username"]]);

        if ($result) {

            $response['status'] = 'success';
            $response['message'] = 'Profile Updated!';
            $response['redirect'] = '../profile.php';
        } else {

            $response['status'] = 'error';
            $response['message'] = 'Failed Updating Profile!';
        }
    } catch (Exception $e) {
        $response['status'] = 'error';
        $response['message'] = $e->getMessage();
    }
}

if (isset($_POST['UpdatePassword'])) {
    $CurrentPassword = $conn->real_escape_string($_POST['CurrentPassword']);
    $NewPassword = $conn->real_escape_string($_POST['NewPassword']);
    $VerifyPassword = $conn->real_escape_string($_POST['VerifyPassword']);

    $query = "SELECT * FROM users where Username=?";

    try {
        $result = $conn->execute_query($query, [$_SESSION['Username']]);

        if ($result && $result->num_rows === 1) {

            $row = $result->fetch_object();

            if (password_verify($CurrentPassword, $row->Password)) {
                if ($NewPassword == $VerifyPassword) {
                    $HashedPassword = password_hash($NewPassword, PASSWORD_DEFAULT);
                    $query2 = "UPDATE `users` SET `Password`=? WHERE `Username`=?";
                    try {

                        $result2 = $conn->execute_query($query2, [$HashedPassword, $_SESSION["Username"]]);

                        if ($result2) {

                            $response['status'] = 'success';
                            $response['message'] = 'Password Changed!';
                            $response['redirect'] = '../profile.php';
                        } else {

                            $response['status'] = 'error';
                            $response['message'] = 'Failed changing password!';
                        }
                    } catch (Exception $e) {
                        $response['status'] = 'error';
                        $response['message'] = $e->getMessage();
                    }
                } else {

                    $response['status'] = 'error';
                    $response['message'] = 'Password don\'t match!';
                }
            } else {

                $response['status'] = 'error';
                $response['message'] = 'Invalid Password!';
            }
        } else {

            $response['status'] = 'error';
            $response['message'] = 'Username not found!';
        }
    } catch (Exception $e) {
        $response['status'] = 'error';
        $response['message'] = $e->getMessage();
    }
}

if (isset($_POST['ForgotPassword'])) {
    $Email = $conn->real_escape_string($_POST['Email']);

    $query = "SELECT * FROM users WHERE `Email` = ?";
    $result = $conn->execute_query($query, [$Email]);

    if ($result->num_rows > 0) {
        $ChangePassword = substr(strtoupper(uniqid()), 0, 8);
        $HashedPassword = password_hash($ChangePassword, PASSWORD_DEFAULT);

        $query2 = "UPDATE users SET `Password` = ?, `ChangePassword` = ? WHERE `Email` = ?";
        $result2 = $conn->execute_query($query2, [$HashedPassword, $ChangePassword, $Email]);

        if ($result2) {
            while ($row = $result->fetch_object()) {
                $Subject = "ISDS | Password Reset Request";
                $Message = "Hello " . $row->FirstName . " " . $row->LastName . ",<br><br>";
                $Message .= "We received a request to reset your password. If you didn't make this request, you can ignore this email. Otherwise, please login using the provided password to reset your previous password:<br><br>";
                $Message .= "Reset Password: " . $ChangePassword . "<br><br>";
                $Message .= "The password will expire in 120 seconds.<br><br>";
                $Message .= "If you have any questions or need further assistance, please don't hesitate to contact us.<br><br>";
                $Message .= "Thank you for choosing our service!<br><br>";
                $Message .= "Sincerely, Admin<br>";
                sendEmail($row->Email, $Subject, $Message);

                $response['status'] = 'success';
                $response['message'] = 'Temporary Password Sent!';
                $response['redirect'] = '../login.php';
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Password update failed!';
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Email does not exist!';
    }
}

if (isset($_POST['ChangePassword'])) {
    $NewPassword = $conn->real_escape_string($_POST['NewPassword']);
    $VerifyPassword = $conn->real_escape_string($_POST['VerifyPassword']);

    $query = "SELECT * FROM users where Username=?";

    try {
        $result = $conn->execute_query($query, [$_SESSION['Username']]);

        if ($result && $result->num_rows === 1) {
            if ($NewPassword == $VerifyPassword) {
                $HashedPassword = password_hash($NewPassword, PASSWORD_DEFAULT);
                $query2 = "UPDATE `users` SET `Password` = ?, `ChangePassword` = NULL WHERE `Username` = ?";
                try {

                    $result2 = $conn->execute_query($query2, [$HashedPassword, $_SESSION["Username"]]);

                    if ($result2) {

                        $response['status'] = 'success';
                        $response['message'] = 'Password Changed!';
                        $response['redirect'] = '../dashboard.php';
                    } else {

                        $response['status'] = 'error';
                        $response['message'] = 'Failed changing password!';
                    }
                } catch (Exception $e) {
                    $response['status'] = 'error';
                    $response['message'] = $e->getMessage();
                }
            } else {

                $response['status'] = 'error';
                $response['message'] = 'Password don\'t match!';
            }
        } else {

            $response['status'] = 'error';
            $response['message'] = 'Username not found!';
        }
    } catch (Exception $e) {
        $response['status'] = 'error';
        $response['message'] = $e->getMessage();
    }
}

if (isset($_POST['ContactUs'])) {
    $Name = $conn->real_escape_string($_POST['Name']);
    $Email = $conn->real_escape_string($_POST['Email']);
    $Subject = $conn->real_escape_string($_POST['Subject']);
    $Message = $conn->real_escape_string($_POST['Message']);

    if (sendEmail('dace.phage@gmail.com', $Subject, 'Senders Name: ' . $Name . '<br>Senders Email: ' . $Email . '<br><br>' . $Message)) {
        $response['status'] = 'success';
        $response['message'] = 'Email Sent!';
        $response['redirect'] = '../index.html';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Unable to Send Email!';
    }
}

if (isset($_POST['Request'])) {
    $DateRequested = date('Y-m-d');

    $Ym = date_format(date_create($DateRequested), "Ym");
    $result = $conn->query("SELECT COUNT(*) AS RequestCount FROM helpdesks WHERE DATE_FORMAT(DateRequested, '%Y%m') = '$Ym'");
    $row = $result->fetch_object();
    $RequestNo = 'REQ-' . $Ym . '-' . str_pad($row->RequestCount + 1, 5, '0', STR_PAD_LEFT);
    $Email = $conn->real_escape_string($_POST['Email']);
    $FirstName = $conn->real_escape_string($_POST['FirstName']);
    $LastName = $conn->real_escape_string($_POST['LastName']);
    $DivisionID = $conn->real_escape_string($_POST['DivisionID']);
    $RequestType = $conn->real_escape_string($_POST['RequestType']);
    $PropertyNo = $conn->real_escape_string($_POST['PropertyNo']);
    $CategoryID = $conn->real_escape_string($_POST['CategoryID']);
    $SubCategoryID = $conn->real_escape_string($_POST['SubCategoryID']);
    $Complaints = $conn->real_escape_string($_POST['Complaints']);
    $DatePreferred = $conn->real_escape_string($_POST['DatePreferred']);
    $TimePreferred = $conn->real_escape_string($_POST['TimePreferred']);

    $query = "INSERT INTO
            `helpdesks` (`DateRequested`, `RequestNo`, `Email`, `FirstName`, `LastName`, `DivisionID`, `RequestType`, `PropertyNo`, `CategoryID`, `SubCategoryID`, `Complaints`, `DatePreferred`, `TimePreferred`)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $result = $conn->execute_query($query, [$DateRequested, $RequestNo, $Email, $FirstName, $LastName, $DivisionID, $RequestType, $PropertyNo, $CategoryID, $SubCategoryID, $Complaints, $DatePreferred, $TimePreferred]);

    $Subject = 'Ticket Confirmation - Request No. ' . $RequestNo;
    $Message = "Dear " . $FirstName . " " . $LastName . ",<br><br>";
    $Message .= "Thank you for submitting your request to the ICT Service Desk System. Here are the details of your request:<br><br>";
    $Message .= "<strong>Request No.:</strong> " . $RequestNo . "<br>";
    $Message .= "<strong>Your Email:</strong> " . $Email . "<br>";
    $Message .= "<strong>Full Name:</strong> " . $FirstName . " " . $LastName . "<br>";
    $Message .= "<strong>Division:</strong> " . $conn->query("SELECT * FROM divisions WHERE id='" . $DivisionID . "'")->fetch_object()->Division . "<br>";
    $Message .= "<strong>Request Type:</strong> " . $RequestType . "<br>";
    $Message .= "<strong>Category/Nature of Request:</strong> " . $conn->query("SELECT * FROM categories WHERE id='" . $CategoryID . "'")->fetch_object()->Category . " / " . $conn->query("SELECT * FROM subcategories WHERE id='" . $SubCategoryID . "'")->fetch_object()->SubCategory . "<br>";
    $Message .= "<strong>Description of Assistance Requested:</strong> " . $Complaints . "<br>";
    $Message .= "<strong>Preferred Schedule:</strong> " . date_format(date_create($DatePreferred), "d/m/Y") . " " . date_format(date_create($TimePreferred), "H:i a") . "<br><br>";
    $Message .= "<strong>Click the link below to view your request</strong><br>";
    $Message .= "<a href='http://r6itbpm.site/dti-isds/requestserviceview.php?Request=$RequestNo'>View Request</a><br><br>";
    $Message .= "Our team will review your request and address it as soon as possible. You will receive further communication regarding the status and resolution of your request.<br><br>";
    $Message .= "Thank you for choosing our services.<br><br>";
    $Message .= "Best regards,<br><strong>ICT Service Desk Team</strong>";

    sendEmail($Email, $Subject, $Message);

    $response['status'] = 'success';
    $response['message'] = 'Your request has been received';
    $response['redirect'] = '../request.php?Email=' . $Email;
}

if (isset($_POST['Encode'])) {
    $DateRequested = $conn->real_escape_string($_POST['DateRequested']);

    $Ym = date_format(date_create($DateRequested), "Ym");
    $result = $conn->query("SELECT COUNT(*) AS RequestCount FROM helpdesks WHERE DATE_FORMAT(DateRequested, '%Y%m') = '$Ym'");
    $row = $result->fetch_object();
    $RequestNo = 'REQ-' . $Ym . '-' . str_pad($row->RequestCount + 1, 5, '0', STR_PAD_LEFT);
    $Email = $conn->real_escape_string($_POST['Email']);
    $FirstName = $conn->real_escape_string($_POST['FirstName']);
    $LastName = $conn->real_escape_string($_POST['LastName']);
    $DivisionID = $conn->real_escape_string($_POST['DivisionID']);
    $RequestType = $conn->real_escape_string($_POST['RequestType']);
    // $PropertyNo = $conn->real_escape_string($_POST['PropertyNo']);
    $CategoryID = $conn->real_escape_string($_POST['CategoryID']);
    $SubCategoryID = $conn->real_escape_string($_POST['SubCategoryID']);
    $Complaints = $conn->real_escape_string($_POST['Complaints']);
    $DatePreferred = $conn->real_escape_string($_POST['DatePreferred']);
    $TimePreferred = $conn->real_escape_string($_POST['TimePreferred']);
    $Status = $conn->real_escape_string($_POST['Status']);
    $DateReceived = $conn->real_escape_string($_POST['DateReceived']);
    $ReceivedBy = $conn->real_escape_string($_POST['ReceivedBy']);
    $DateScheduled = $conn->real_escape_string($_POST['DateScheduled']);
    $RepairType = $conn->real_escape_string($_POST['RepairType']);
    $RepairClassification = $conn->real_escape_string($_POST['RepairClassification']);
    $Medium = $conn->real_escape_string($_POST['Medium']);
    $ServicePriority = $conn->real_escape_string($_POST['ServicePriority']);
    $DatetimeStarted = $conn->real_escape_string($_POST['DatetimeStarted']);
    $DatetimeFinished = $conn->real_escape_string($_POST['DatetimeFinished']);
    $Diagnosis = $conn->real_escape_string($_POST['Diagnosis']);
    $Remarks = $conn->real_escape_string($_POST['Remarks']);
    $ServicedBy = $conn->real_escape_string($_POST['ServicedBy']);
    $ApprovedBy = $conn->real_escape_string($_POST['ApprovedBy']);

    $query = "INSERT INTO
            `helpdesks` (`DateRequested`, `RequestNo`, `Email`, `FirstName`, `LastName`, `DivisionID`, `RequestType`, `CategoryID`, `SubCategoryID`, `Complaints`, `DatePreferred`, `TimePreferred`,`Status`,`DateReceived`,`ReceivedBy`,`DateScheduled`,`RepairType`,`DatetimeStarted`,`DatetimeFinished`,`Diagnosis`,`Remarks`,`ServicedBy`,`ApprovedBy`,`RepairClassification`,`Medium`,`ServicePriority`)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $result = $conn->execute_query($query, [$DateRequested, $RequestNo, $Email, $FirstName, $LastName, $DivisionID, $RequestType, $CategoryID, $SubCategoryID, $Complaints, $DatePreferred, $TimePreferred, $Status, $DateReceived, $ReceivedBy, $DateScheduled, $RepairType, $DatetimeStarted, $DatetimeFinished, $Diagnosis, $Remarks, $ServicedBy, $ApprovedBy,$RepairClassification,$Medium,$ServicePriority]);

    $response['status'] = 'success';
    $response['message'] = 'Encoded Successfully';
}

if (isset($_POST['UpdateRequest'])) {
    $id = $conn->real_escape_string($_POST['id']);
    $Status = $conn->real_escape_string($_POST['Status']);
    $DateReceived = !empty($_POST['DateReceived']) ? date('Y-m-d', strtotime($_POST['DateReceived'])) : null;
    $ReceivedBy = $_POST['ReceivedBy'] ?? null;
    $DateScheduled = !empty($_POST['DateScheduled']) ? date('Y-m-d H:i:s', strtotime($_POST['DateScheduled'])) : null;
    $RequestType = $conn->real_escape_string($_POST['RequestType']);
    $RepairType = $conn->real_escape_string($_POST['RepairType']);
    $RepairClassification = $conn->real_escape_string($_POST['RepairClassification']);
    $ServicePriority = $conn->real_escape_string($_POST['ServicePriority']);
    $DatetimeStarted = !empty($_POST['DatetimeStarted']) ? date('Y-m-d H:i:s', strtotime($_POST['DatetimeStarted'])) : null;
    $DatetimeFinished = !empty($_POST['DatetimeFinished']) ? date('Y-m-d H:i:s', strtotime($_POST['DatetimeFinished'])) : null;
    $Diagnosis = $conn->real_escape_string($_POST['Diagnosis']);
    $Remarks = $conn->real_escape_string($_POST['Remarks']);
    $ServicedBy = $_POST['ServicedBy'] ?? null;
    $ApprovedBy = $_POST['ApprovedBy'] ?? null;

    try {
        $query = "SELECT
                    *,
                    CONCAT(u1.FirstName, ' ', u1.LastName) as `ReceivedBy`,
                    CONCAT(u2.FirstName, ' ', u2.LastName) as `ServicedBy`,
                    CONCAT(u3.FirstName, ' ', u3.LastName) as `ApprovedBy`
                FROM helpdesks h
                    LEFT JOIN divisions d ON h.`DivisionID` = d.id
                    LEFT JOIN categories c ON h.`CategoryID` = c.id
                    LEFT JOIN subcategories sc ON h.`SubCategoryID` = sc.id
                    LEFT JOIN users u1 ON h.`ReceivedBy` = u1.id
                    LEFT JOIN users u2 ON h.`ServicedBy` = u2.id
                    LEFT JOIN users u3 ON h.`ApprovedBy` = u3.id WHERE h.id=?";
        $result = $conn->execute_query($query, [$id]);

        if ($result->num_rows) {
            try {
                $updateQuery = "UPDATE helpdesks SET `Status`=?, `DateReceived`=?, `ReceivedBy`=?, `RequestType`=?, `DateScheduled`=?, `RepairType`=?, `RepairClassification`=?, `ServicePriority`=?, `DatetimeStarted`=?, `DatetimeFinished`=?, `Diagnosis`=?, `Remarks`=?, `ServicedBy`=?, `ApprovedBy`=? WHERE `id`=?";
                $updateResult = $conn->execute_query($updateQuery, [$Status, $DateReceived, $ReceivedBy, $RequestType, $DateScheduled, $RepairType, $RepairClassification, $ServicePriority, $DatetimeStarted, $DatetimeFinished, $Diagnosis, $Remarks, $ServicedBy, $ApprovedBy, $id]);

                if ($updateResult) {
                    $query2 = "SELECT
                    *,
                    CONCAT(u1.FirstName, ' ', u1.LastName) as `ReceivedBy`,
                    CONCAT(u2.FirstName, ' ', u2.LastName) as `ServicedBy`,
                    CONCAT(u3.FirstName, ' ', u3.LastName) as `ApprovedBy`
                FROM helpdesks h
                    LEFT JOIN divisions d ON h.`DivisionID` = d.id
                    LEFT JOIN categories c ON h.`CategoryID` = c.id
                    LEFT JOIN subcategories sc ON h.`SubCategoryID` = sc.id
                    LEFT JOIN users u1 ON h.`ReceivedBy` = u1.id
                    LEFT JOIN users u2 ON h.`ServicedBy` = u2.id
                    LEFT JOIN users u3 ON h.`ApprovedBy` = u3.id WHERE h.id=?";
                    $result2 = $conn->execute_query($query2, [$id]);

                    while ($row = $result2->fetch_object()) {
                        $Subject = 'Ticket ' . $row->Status . ' - Request No. ' . $row->RequestNo;

                        $Message = "Dear " . $row->FirstName . " " . $row->LastName . ",<br><br>";

                        switch ($row->Status) {
                            case 'Pending':
                                $Message .= "Your request is currently pending review. Our team will assess it shortly.<br><br>";
                                break;
                            case 'On Going':
                                $Message .= "Your request is currently being addressed. Our team is actively working on resolving it.<br><br>";
                                break;
                            case 'Completed':
                                $Message .= "Good news! Your request has been successfully resolved. If you have any further questions, feel free to reach out.<br><br>";
                                break;
                            case 'Denied':
                                $Message .= "Unfortunately, your request has been denied. If you have any concerns or need further clarification, please contact us.<br><br>";
                                break;
                            case 'Unserviceable':
                                $Message .= "We regret to inform you that we are unable to service your request at this time. If you have any other inquiries, please let us know.<br><br>";
                                break;
                            default:
                                $Message .= "Your request is in an undefined status. Please contact our support team for further assistance.<br><br>";
                        }

                        $Message .= "Request details:<br><br>";
                        $Message .= "<strong>Request No.:</strong>" . $row->RequestNo . "<br>";
                        $Message .= "<strong>Your Email:</strong> " . $row->Email . "<br>";
                        $Message .= "<strong>First Name:</strong> " . $row->FirstName . "<br>";
                        $Message .= "<strong>Division:</strong> " . $row->Division . "<br>";
                        $Message .= "<strong>Category:</strong> " . $row->Category . "<br>";
                        $Message .= "<strong>Sub Category:</strong> " . $row->SubCategory . "<br>";
                        $Message .= "<strong>Request Type:</strong> " . $row->RequestType . "<br>";
                        $Message .= "<strong>Description of Assistance Requested:</strong> " . $row->Complaints . "<br><br>";
                        if ($row->Status == 'Completed') {
                            $Message .= "Kindly spare a moment to complete our Customer Satisfaction Form to provide feedback. <br><a href='http://r6itbpm.site/dti-isds/csf.php?Request=" . $row->RequestNo . "'>CSF Form</a><br><br>";
                        } else {
                            $Message .= "<strong>Click the link below to view your request</strong><br><a href='http://r6itbpm.site/dti-isds/requestserviceview.php?Request=" . $row->RequestNo . "'>View Request</a><br><br>";
                        }

                        $Message .= "Thank you for choosing our services.<br><br>";
                        $Message .= "Best regards,<br><strong>ICT Service Desk Team</strong>";

                        sendEmail($row->Email, $Subject, $Message);

                        $response['status'] = 'success';
                        $response['message'] = 'Request has been updated';
                        $response['redirect'] = '../helpdesks.php';
                    }
                } else {
                    $response['status'] = 'error';
                    $response['message'] = 'Error updating request record';
                }
            } catch (Exception $e) {
                $response['status'] = 'error';
                $response['message'] = 'Error: ' . $e->getMessage();
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Request record not found';
        }
    } catch (Exception $e) {
        $response['status'] = 'error';
        $response['message'] = 'Error: ' . $e->getMessage();
    }
}




$responseJSON = json_encode($response);

// echo $responseJSON;

$conn->close();
?>
<!DOCTYPE html>
<html>

<head>
    <title></title>
</head>

<body>
    <!-- Bootstrap core JavaScript-->
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?= $website . ' | ' ?>Response Page</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../assets/img/logo.png" rel="icon">
    <link href="../assets/img/logo.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body><!-- ======= Footer ======= -->
    <!-- Vendor JS Files -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>
    <script>
        // Parse the JSON response from PHP
        var response = <?php echo $responseJSON; ?>;

        // Display a SweetAlert notification based on the response
        if (response.status == 'success') {
            Swal.fire({
                title: 'Success',
                text: response.message,
                icon: 'success',
            }).then(function() {
                // Redirect to the specified URL
                if (response.redirect) {
                    window.location.href = response.redirect;
                } else {
                    history.back();
                }
            });
        } else if (response.status == 'error') {
            Swal.fire({
                title: 'Error',
                text: response.message,
                icon: 'error',
            }).then(function() {
                // Redirect to the specified URL
                history.back();
            });
        } else {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Something went wrong!"
            }).then(function() {
                // Redirect to the specified URL
                history.back();
            });
        }
    </script>

</body>

</html>