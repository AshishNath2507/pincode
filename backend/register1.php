<?php
session_start();
require "../connect.php";


if (isset($_POST['regSubmit'])) {
    $fname = mysqli_real_escape_string($con, trim($_POST['fname']));
    $lname = mysqli_real_escape_string($con, trim($_POST['lname']));
    $phone = mysqli_real_escape_string($con, trim($_POST['phone']));
    $addr = mysqli_real_escape_string($con, trim($_POST['addr']));
    $gender = mysqli_real_escape_string($con, trim($_POST['gender']));
    $email = mysqli_real_escape_string($con, trim($_POST['email']));
    $password = mysqli_real_escape_string($con, trim($_POST['password']));
    $cpassword = mysqli_real_escape_string($con, trim($_POST['cpassword']));
    $mainstate = mysqli_real_escape_string($con, trim($_POST['mainstate']));
    $maindist = mysqli_real_escape_string($con, trim($_POST['maindist']));
    $pincode = mysqli_real_escape_string($con, trim($_POST['pincode']));

    $check_query = mysqli_query($con, "SELECT * FROM user where u_email ='$email'");
    $rowCount = mysqli_num_rows($check_query);

    if ($rowCount > 0) {
        $_SESSION['alert_message'] = "Email already exist";
        header("Location: ../register.php?registration_failed+email_exist");
    } else {
        if ($cpassword == $password) {
            $query = mysqli_query($con, "INSERT INTO user VALUES (null, '$fname', '$lname', '$addr', '$email', '$password', '$phone', '$gender', DEFAULT, DEFAULT, '$mainstate', '$maindist', '$pincode' )");
            if ($query) {
                $_SESSION['alert_message'] = "Successfully Registered";
                header("Location: ../user/login.php?admin+approval+required");
            } else {
                $_SESSION['alert_message'] = "Registration Failed";
                header("Location: ../register.php?registration+failed");
            }
        } else {
            $_SESSION['alert_message'] = "Incorrect Confirm Password";
            header("Location: ../register.php?registration+failed+wrong+password+combinations");
        }
    }

}
?>