<?php
session_start();
require "../connect.php";

if (isset($_POST['userEdit'])) {
    $fname = mysqli_real_escape_string($con, trim($_POST['fname']));
    $lname = mysqli_real_escape_string($con, trim($_POST['lname']));
    $email = mysqli_real_escape_string($con, trim($_POST['email']));
    $pswd = mysqli_real_escape_string($con, trim($_POST['pswd']));
    $phone = mysqli_real_escape_string($con, trim($_POST['phone']));
    $addr = mysqli_real_escape_string($con, trim($_POST['addr']));
    $mainstate = mysqli_real_escape_string($con, trim($_POST['mainstate']));
    $maindist = mysqli_real_escape_string($con, trim($_POST['maindist']));
    $photo = $_FILES['photo'];

    $allowed = array('jpg', 'jpeg', 'png');

    $filename = $photo['name'];
    $filesize = $photo['size'];
    $filetemp = $photo['tmp_name'];
    $fileExt = explode('.', $filename);
    $fileActualEXt = strtolower(end($fileExt));

    $check_query = mysqli_query($con, "SELECT * FROM user where u_email ='$email'");
    $rowCount = mysqli_num_rows($check_query);


    if (!in_array($fileActualEXt, $allowed)) {
        $_SESSION['alert_message'] = "Invalid image extension. Use jpg/jpeg/png only.";
        header("Location: ../user/editprofile.php?image=invalid");
    } else if (($filesize > 2000000)) {
        $_SESSION['alert_message'] = "File size is too large. Use file size of less than 2MB";
        header("Location: ../user/editprofile.php?imagesize=wrong");
    } else {
        $filenamenew = uniqid('', true) . "." . $fileActualEXt;
        $photo1 = '../uploads/' . $filenamenew;
        move_uploaded_file($filetemp, $photo1); //(filename, destination)

        $id = $_SESSION['id'];
        $query = mysqli_query($con, "UPDATE user SET u_fname = '$fname', u_lname = '$lname', u_addr = '$addr', u_email = '$email', u_pswd = '$pswd', u_phno = '$phone', u_photo = '$photo1', state='$mainstate', district='$maindist' WHERE u_id = '$id'");

        if ($query) {
            $_SESSION['alert_message'] = "Details Updated";
            header("Location: ../user/editprofile.php?details=updated");
        } else {
            mysqli_error($con);
        }
    }



}

?>