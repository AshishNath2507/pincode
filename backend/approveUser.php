<?php
session_start();
require "../connect.php";

if (isset($_POST['approve_btn_set'])) {
    $apr_id = $_POST['approve_id'];

    $query = "UPDATE user SET u_status = 'approved' WHERE u_id = '$apr_id'";
    $query_run = mysqli_query($con, $query);
}


?>