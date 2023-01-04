<?php
session_start();

if (!isset($_SESSION['id'])) {
    $_SESSION['alert_message'] = "You are Logged Out";
    header("Location: login.php?already_logged_out");
}
require "../connect.php";


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Details</title>

    <script src="../library/jquery.min.js"></script>

    <!-- Bootstrap links -->
    <link rel="stylesheet" href="../library/css/bootstrap.min.css">
    <!-- Bootstrap script -->
    <script src="../library/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="../library/animate.min.css">
    <link href="../library/fontawesome-free-6.1.1-web/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="../library/fontawesome-free-6.1.1-web/js/all.min.js"></script>

    <script src="../library/bootbox.all.min.js"></script>
    <script src="../library/popper.min.js"></script>
    <script src="../library/bootstrap-5.2.3-dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../library/bootstrap-5.2.3-dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #eee8e8;
        }

        .details {
            font-size: 30px;
            background-color: #15156c;
            color: white;
            padding: 1rem;
        }

        .details input {
            border: none;
        }
    </style>
</head>

<body>
    <p class="text-center details">
        Details & Informations
    </p>


    <!-- nnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnn -->
    <section style="background-color: #eee;">
        <?php
        $id = $_SESSION['id'];
        $row = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM user where u_id = '$id'"));

        ?>
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">

                        <div class="d-flex">
                            <ol class="breadcrumb mb-0 flex-grow-1">
                                <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                                <li class="breadcrumb-item"><a href="./editprofile.php">Profile Edit</a></li>
                            </ol>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="../backend/logout.php" id="logout">Logout</a></li>
                            </ol>
                        </div>
                    </nav>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <?php
                            if (isset($_SESSION['alert_message'])) {
                            ?>
                            <div class="container">
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>Hey!!!</strong>
                                    <?php echo $_SESSION['alert_message']; ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            </div>
                            <?php
                                unset($_SESSION['alert_message']);
                            }
                            ?>
                            <img src="<?php echo '../uploads/' . $row["u_photo"]; ?>" alt="avatar"
                                class="rounded-circle img-fluid" style="width: 150px;">
                            <h5 class="my-3">
                                <?php echo strtoupper($row['u_fname']); ?>
                            </h5>

                        </div>

                    </div>

                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">First Name</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">
                                        <?php echo strtoupper($row['u_fname']); ?>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Last Name</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">
                                        <?php echo strtoupper($row['u_lname']); ?>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Gender</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">
                                        <?php echo strtoupper($row['u_gender']); ?>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">
                                        <?php echo $row['u_email']; ?>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Phone</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">
                                        <?php echo strtoupper($row['u_phno']); ?>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Address</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">
                                        <?php echo strtoupper($row['u_addr']); ?>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Status</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">
                                        <?php echo strtoupper($row['u_status']); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function () {
            $(document).on('click', '#logout', function (e) {
                e.preventDefault();
                bootbox.confirm({
                    title: "Logout",
                    size: "small",
                    message: "Are you sure?",
                    callback: function (result) {
                        if (result == true) {
                            console.log("Logged Out")
                            location.href = './login.php';
                        }
                    }
                })
            })
        });
    </script>


</body>

</html>