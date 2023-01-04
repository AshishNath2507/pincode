<?php
session_start();
require "../connect.php";
if (isset($_POST['adminLogin'])) {
    $name = mysqli_real_escape_string($con, trim($_POST['name']));
    $password = mysqli_real_escape_string($con, trim($_POST['password']));
    // $pvt_email = "ashishnath905@gmail.com";

    $sql = "SELECT * FROM admin WHERE name = '$name'";
    $query = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($query);

    $_SESSION['admin'] = $row['name'];

    if ($name == $row['name']) {
        if ($password == $row['pswd']) {
            header("Location: ../admin/index.php");
        } else {            
            $_SESSION['alert_message'] = "Incorrect Password";
            header("Location: ../admin/adminlogin.php");
        }
    } else {        
        $_SESSION['alert_message'] = "Invalid Admin Email";
        header("Location: ../admin/adminlogin.php");
    }
}
