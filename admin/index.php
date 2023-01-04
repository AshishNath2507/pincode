<?php session_start();
if (!isset($_SESSION['admin'])) {
    $_SESSION['alert_message'] = "You are Logged Out";
    header("Location: ./adminlogin.php");
}
require "../connect.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <script src="../library/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link rel="stylesheet" href="../library/fontawesome-free-6.1.1-web/css/all.css">
    <link rel="stylesheet" href="../library/fontawesome-free-6.1.1-web/css/brands.css">
    <link rel="stylesheet" href="../library/fontawesome-free-6.1.1-web/css/solid.css">

    <link rel="stylesheet" href="../library/fontawesome-free-6.1.1-web/css/v5-font-face.css">

    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
    <script src="../library/bootbox.all.min.js"></script>
    <script src="../library/popper.min.js"></script>
    <script src="../library/bootstrap-5.2.3-dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../library/bootstrap-5.2.3-dist/css/bootstrap.min.css">

    <style>
        thead {
            background-color: #024a74;
            color: white;
            text-align: center;
            font-size: .5 rem;
        }

        th,
        td,
        tr {
            padding: 15px;
            text-align: center;
        }

        .appr::before {
            display: inline-block;
            font: var(--fa-font-solid);
            content: "\e53e";
            font-weight: 600;
            text-rendering: auto;
            -webkit-font-smoothing: antialiased;
            color: green;
            border: 0;
        }
    </style>
</head>

<body>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Users Table</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">

            <?php
            if (isset($_SESSION['alert_message'])) {
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Alert!!!</strong>
                <?php echo $_SESSION['alert_message']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                unset($_SESSION['alert_message']);
            }
            ?>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered compact display" id="dataTable" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Gender</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $result = mysqli_query($con, "SELECT * FROM user");
                            while ($row = mysqli_fetch_array($result)) {
                            ?>
                            <tr>
                                <td>
                                    <img class="img-profile rounded" src="<?php echo $row["u_photo"]; ?>" alt="image"
                                        style="width:50px;">
                                </td>
                                <td>
                                    <?php echo $row["u_fname"] ?>
                                </td>
                                <td>
                                    <?php echo $row["u_lname"] ?>
                                </td>
                                <td>
                                    <?php echo $row["u_phno"] ?>
                                </td>
                                <td>
                                    <?php echo $row["u_addr"] ?>
                                </td>
                                <td>
                                    <?php echo $row["u_gender"] ?>
                                </td>
                                <td>
                                    <?php echo $row["u_email"] ?>
                                </td>
                                <td>
                                    <?php echo $row["u_pswd"] ?>
                                </td>

                                <td>
                                    <?php echo $row["u_status"] ?>
                                </td>

                                <td class="actions">
                                    <input type="hidden" class="approve_id_val" value="<?php echo $row["u_id"]; ?>">
                                    <button type="button" id="apprBtn" class="btn rounded-circle appr deletebtn m-1"
                                        value=""></button>
                                </td>
                            </tr>
                            <?php
                            }
                            ;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable();
        });

        $(document).ready(function () {
            $(document).on('click', '#apprBtn', function (e) {
                var approve_id = $(this).closest("tr").find(".approve_id_val").val();
                bootbox.confirm({
                    title: "Confirmation",
                    message: "Approve the user? It cannot be reverted back...",
                    buttons: {
                        confirm: {
                            label: 'Yes',
                            className: 'btn-success'
                        },
                        cancel: {
                            label: 'No',
                            className: 'btn-danger'
                        }
                    },
                    callback: function (result) {
                        $.ajax({
                            type: "POST",
                            url: "../backend/approveUser.php",
                            data: {
                                "approve_btn_set": 1,
                                "approve_id": approve_id,
                            },
                            success: function (response) {
                                bootbox.alert({
                                    size: "small",
                                    title: "Approval",
                                    message: "User approved successfully..."
                                });
                                
                            }
                        })
                    }
                });
            });
        });
    </script>
</body>

</html>