<?php
session_start();

if (!isset($_SESSION['id'])) {
    $_SESSION['alert_message'] = "You are Logged Out";
    header("Location: login.php?already_logged_out");
}
require "../connect.php";
$id = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Details</title>

    <!-- Bootbox -->
    <script src="../library/jquery.min.js"></script>
    <script src="../library/bootbox.all.min.js"></script>
    <script src="../library/popper.min.js"></script>
    <script src="../library/bootstrap-5.2.3-dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../library/bootstrap-5.2.3-dist/css/bootstrap.min.css">


    <!-- Bootstrap links -->
    <link rel="stylesheet" href="../library/css/bootstrap.min.css">
    <!-- Bootstrap script -->
    <script src="../library/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="../library/animate.min.css">
    <link href="../library/fontawesome-free-6.1.1-web/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="../library/fontawesome-free-6.1.1-web/js/all.min.js"></script>
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
        Edit Details
    </p>
    <div class="container">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                    <div class="d-flex">
                        <ol class="breadcrumb mb-0 flex-grow-1">
                            <li class="breadcrumb-item"><a href="./viewprofile.php">User Profile</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Profile Edit</li>
                        </ol>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a id="logout" href="../backend/logout.php">Logout</a></li>
                        </ol>
                    </div>
                </nav>
            </div>
        </div>
    </div>

    <?php
    $row = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM user WHERE u_id = '$id'"));

    //var_dump($row);

    echo $row['district'];

    ?>


    <!-- nnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnn -->
    <div class="container rounded bg-white mt-2 mb-5">
        <?php
        if (isset($_SESSION['alert_message'])) {
        ?>
        <div class="container">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Hey!!!</strong>
                <?php echo $_SESSION['alert_message']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        <?php
            unset($_SESSION['alert_message']);
        }
        ?>
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <img class="rounded-circle mt-5" width="150px" src="<?php echo '../uploads/' . $row["u_photo"]; ?>">
                    <span class="font-weight-bold">
                        <?php echo strtoupper($row['u_fname']); ?>
                    </span>
                    <span class="text-black-50">
                        <?php echo $row['u_email']; ?>
                    </span>
                </div>
            </div>


            <div class="col-md-5 border-right">
                <form action="../backend/editprofile1.php" method="post" enctype="multipart/form-data">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profile Settings</h4>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12"><label class="labels">First Name</label><input type="text"
                                    name="fname" class="form-control" placeholder="first name"
                                    value="<?php echo $row['u_fname']; ?>" required></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12"><label class="labels">Last Name</label><input type="text"
                                    name="lname" class="form-control" placeholder="Last name"
                                    value="<?php echo $row['u_lname']; ?>" required></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12 "><label class="labels">Gender</label><input type="text"
                                    class="form-control" value="<?php echo $row['u_gender']; ?>" disabled></div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <label class="labels">Email</label><input type="email" name="email" class="form-control"
                                placeholder="enter phone email" value="<?php echo $row['u_email']; ?>" required>
                        </div>
                        <div class="col-md-12 mt-3">
                            <label class="labels">Password</label><input type="text" name="pswd" class="form-control"
                                placeholder="enter password" value="<?php echo $row['u_pswd']; ?>" required>
                        </div>
                        <div class="col-md-12 mt-3">
                            <label class="labels">Mobile Number</label><input type="text" name="phone"
                                class="form-control" placeholder="enter phone number"
                                value="<?php echo $row['u_phno']; ?>" required>
                        </div>
                        <div class="col-md-12 mt-3">
                            <label class="labels">Address</label><input type="text" name="addr" class="form-control"
                                placeholder="enter address line 1" value="<?php echo $row['u_addr']; ?>" required>
                        </div>

                        <div class="col-md-12 mt-3">
                            <div class="input-group mb-1">
                                <label class="input-group-text" for="mainstate">State</label>
                                <select class="form-select" name="mainstate" id="mainstate" required>

                                    <option selected>
                                        <?php echo $row['state']; ?>
                                    </option>
                                    
                                    <?php
                                    $query = mysqli_query($con, "SELECT * FROM states ORDER BY name ASC");
                                    while ($row1  = mysqli_fetch_array($query)) {
                                        echo "<option value='" . $row1['name'] . "'>" . $row1['name'] . "</option>";
                                    }

                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <div class="input-group mb-1">
                                <label class="input-group-text" for="maindist">District</label>
                                <select class="form-select" name="maindist" id="maindist" required>

                                    <option selected>
                                        <?php echo $row['district']; ?>
                                    </option>
                                    <?php
                                    $query = mysqli_query($con, "SELECT * FROM cities ORDER BY city ASC");
                                    while ($row1 = mysqli_fetch_array($query)) {
                                        echo "<option value='" . $row1['city'] . "'>" . $row1['city'] . "</option>";
                                    }

                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <label class="labels">Add Photo</label><input type="file" name="photo" class="form-control"
                                accept="image/*" value="<?php echo '../uploads/' . $row["u_photo"]; ?>">
                        </div>
                    </div>
                    <div class="mt-2 text-center mb-4">
                        <button class="btn btn-primary profile-button" type="submit" name="userEdit">Save
                            Profile</button>
                    </div>
                </form>
            </div>



        </div>

    </div>
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
            });
        });
    </script>
</body>

</html>