<?php
$page = "Response Page";

// requires
require_once 'conn.php';
require_once "sendmail.php";

session_start();

$response = array();
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