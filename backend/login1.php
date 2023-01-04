<?php

session_start();
require "../connect.php";

if (isset($_POST['loginSubmit'])) {
    $email = mysqli_real_escape_string($con, trim($_POST['email']));
    $password = mysqli_real_escape_string($con, trim($_POST['password']));
    $sql = "SELECT * FROM user WHERE u_email = '$email'";
    $query = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($query);
    $email_count = mysqli_num_rows($query);

    $_SESSION['id'] = $row['u_id'];

    if ($email_count) 
    {
        if($row['u_status'] == 'approved')
        {
            if ($email == $row['u_email']) 
            {
                if ($password == $row['u_pswd']) 
                {
                    
                    header("Location: ../user/viewprofile.php");
                } else {
                    $_SESSION['alert_message'] = "Incorrect Password";
                    header("Location: ../user/login.php");
                }
            } else {
                $_SESSION['alert_message'] = "Invalid Email";
                header("Location: ../user/login.php");
            }
        }
        else{
            $_SESSION['alert_message'] = "Email is not approved";
            header("Location: ../user/login.php");    
        }
    } else {
        $_SESSION['alert_message'] = "Email doesn't exist";
        header("Location: ../user/login.php");
    }
}



?>