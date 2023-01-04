<?php
session_start();
require "./connect.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>

    <script src="./library/jquery.min.js"></script>
    <script src="./library/jquery.validate.min.js"></script>


    <script src="./library/bootbox.all.min.js"></script>
    <script src="./library/popper.min.js"></script>
    <script src="./library/bootstrap-5.2.3-dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./library/bootstrap-5.2.3-dist/css/bootstrap.min.css">


    <!-- Bootstrap links -->
    <link rel="stylesheet" href="./library/css/bootstrap.min.css">
    <script src="./library/bootstrap-5.2.3-dist/js/bootstrap.min.js"></script>
    <!-- Fontawesome -->
    <link href="./library/fontawesome-free-6.1.1-web/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="./library/fontawesome-free-6.1.1-web/js/all.min.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Iceberg&display=swap');

        @font-face {
            font-family: anurati;
            src: url('./library/fonts/anurati/ANURATI/Anurati-Regular.otf');

        }

        .anurati {
            font-family: 'Iceberg', cursive;
        }

        body {
            background-color: #337171;
            color: white;
        }

        .c-font {
            font-family: 'Jost', sans-serif;

        }

        .form input {
            background-color: #e5e9b8;
        }

        .error-form {
            color: #c00909;
        }

        .error {
            color: red;
            font-style: italic;
        }
    </style>
</head>

<body>

    <div class="container-lg c-font">
        <p class="text-center mt-3 mb-5 fs-1">Register Here!!! or <a href="./user/login.php">Login</a></p>
        <div class="container-lg">

            <?php
            if (isset($_SESSION['alert_message'])) {
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Hey!!!</strong>
                <?php echo $_SESSION['alert_message']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                unset($_SESSION['alert_message']);
            }
            ?>

            <form class="row g-3 w-75 mb-4 mx-auto form" id="registerForm" action="./backend/register1.php"
                method="POST" enctype="multipart/form-data">

                <div class="col-md-6 mb-1 ">
                    <label for="name" class="form-label w-25">First Name</label>
                    <input type="text" class="form-control" id="fname" name="fname" aria-describedby="nameHelp"
                        accept="text" autofocus required>
                    <span class="error-form text-shadow" id="fname_error_message"></span>
                </div>

                <div class="col-md-6 mb-1 ">
                    <label for="name" class="form-label w-25">Last Name</label>
                    <input type="text" class="form-control" id="lname" name="lname" aria-describedby="nameHelp"
                        accept="text" required>
                    <span class="error-form text-shadow" id="lname_error_message"></span>
                </div>

                <div class="mb-1 col-md-6">
                    <label for="phone" class="form-label w-25">Phone No.</label>
                    <input type="tel" class="form-control" id="phone" name="phone" aria-describedby="telHelp"
                        onchange="validatePhone()" required>
                    <span class="error-form text-shadow" id="phone_error_message"></span>
                </div>

                <div class="mb-1 col-md-6">
                    <label for="addr" class="form-label w-25">Address</label>
                    <input type="text" class="form-control" id="addr" name="addr" aria-describedby="addrHelp" required>
                </div>



                <div class="mb-1 col-md-4">
                    <div class="input-group mb-1">
                        <label class="input-group-text" for="gender">Gender</label>
                        <select class="form-select" name="gender" id="gender" required>
                            <option selected>Choose...</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="others">Others</option>
                        </select>
                    </div>
                </div>

                <div class="mb-1 col-md-6">
                    <div class="input-group mb-1">
                        <label class="input-group-text" for="pincode">Pin Code</label>
                        <input type="text" class="form-control w-50" id="pincode" name="pincode"
                            onchange="handlePinChange()" aria-describedby="pincodeHelp" required><span class="error-form text-info" id="pcity"></span>
                    </div>
                </div>

                <div class="mb-1 col-md-6">
                    <div class="input-group mb-1">
                        <label class="input-group-text" for="mainstate">State</label>
                        <select class="form-select" name="mainstate" id="mainstate" required>
                            <?php
                            $selected = 'Choose...';
                            $query = mysqli_query($con, "SELECT * FROM states ORDER BY name ASC");
                            ?>
                            <option selected>Choose...</option>
                            <?php
                            while ($row = mysqli_fetch_array($query)) {
                                echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
                            }

                            ?>
                        </select>
                    </div>
                </div>

                <div class="mb-1 col-md-6">
                    <div class="input-group mb-1">
                        <label class="input-group-text" for="maindist">District</label>
                        <select class="form-select" name="maindist" id="maindist" required>

                            <option selected>Choose...</option>
                            <?php
                            $query = mysqli_query($con, "SELECT * FROM cities ORDER BY city ASC");
                            while ($row = mysqli_fetch_array($query)) {
                                echo "<option value='" . $row['city'] . "'>" . $row['city'] . "</option>";
                            }

                            ?>
                        </select>
                    </div>
                </div>

                <hr>

                <div class="mb-1 mt-4 flex-column">
                    <div class="input-group">
                        <label for="email" class="form-label w-25">Email address</label>
                        <!-- <div class="col"> -->
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp"
                            onkeyup="validateEmail()" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                        <span class="error-form text-shadow mx-4" id="email_error_message"></span>

                    </div>
                </div>

                <div class="mb-1 flex-column">
                    <div class="input-group">
                        <label for="password" class="form-label w-25">Password</label>
                        <span class="input-group-text" id="inputGroupPrepend">*</span>
                        <input type="password" name="password" id="password" class="form-control"
                            aria-describedby="passwordHelpBlock" onchange="checkPass();" required>
                        <!-- <span class="error-form text-shadow mx-4" id="password_error_message"></span> -->
                    </div>
                </div>
                <div class="mb-1 flex-column">
                    <div class="input-group">
                        <label for="password" class="form-label w-25">Confirm Password</label>
                        <span class="input-group-text" id="inputGroupPrepend">*</span>
                        <input type="password" name="cpassword" id="cpassword" class="form-control"
                            aria-describedby="passwordHelpBlock" onchange="checkPass();" required>
                        <span class="error-form text-shadow mx-4" id="password_error_message"></span>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" name="regSubmit" id="regSubmit" class="btn w-50 fs-3"
                        style="background-color: #337171; color: white">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <script type="text/javascript">
        function checkPasswordMatch() {
            var password = $("#password").val();
            var confirmPassword = $("#cpassword").val();
            if (password != confirmPassword) {
                $("#password_error_message").html("Passwords does not match!").css('color', '#b60909');
                document.getElementById('regSubmit').disabled = true;
            }
            else {
                $("#password_error_message").html("Passwords match.").css("color", "#45fc3c")
                document.getElementById('regSubmit').disabled = false;

            }
        }
        $(document).ready(function () {
            $("#cpassword").keyup(checkPasswordMatch);
        });

        function handlePinChange() {
            var pincode = $('#pincode').val();
            if (pincode == '') {
                $('#city').val('')
                $('#state').val('')
            } else {
                $.ajax({
                    url: 'backend/pcode.php',
                    type: 'post',
                    data: 'pincode=' + pincode,
                    success: function (data) {
                        console.log(data)
                        if (data == "no") {
                            alert("Wrong Pincode format");
                            // bootbox.alert({
                            //     // size: "small",
                            //     title: "Wrong Pincode",
                            //     message: "Wrong Pincode format..."
                            // })
                            $('#pincode').val('')
                            $('#pcity').val('')
                        } else {
                            var getData = $.parseJSON(data)
                            console.log(getData.city)
                            console.log(getData.state)
                            $('#pcity').html(getData.city + "," + getData.state)
                        }
                    }
                })
            }
        }

        $(document).ready(function () {

            $("#fname_error_message").hide();
            var error_name = false;
            $("#lname_error_message").hide();
            var error_name = false;

            $("#fname").focusout(function () {
                check_fname();
            });
            $("#lname").focusout(function () {
                check_lname();
            });

            function check_fname() {
                var pattern = /^[a-zA-Z]*$/;
                var name = $("#fname").val();
                if (pattern.test(name) && name !== '') {
                    $("#fname_error_message").hide();
                    $("#fname").css("border-bottom", "3px solid green");
                } else {
                    $("#fname_error_message").html("Should contain only Characters");
                    $("#fname_error_message").show();
                    $("#fname").css("border-bottom", "2px solid #c00909");
                    error_name = true;
                }
            }
            function check_lname() {
                var pattern = /^[a-zA-Z]*$/;
                var name = $("#lname").val();
                if (pattern.test(name) && name !== '') {
                    $("#lname_error_message").hide();
                    $("#lname").css("border-bottom", "3px solid green");
                } else {
                    $("#lname_error_message").html("Should contain only Characters");
                    $("#lname_error_message").show();
                    $("#lname").css("border-bottom", "2px solid #c00909");
                    error_name = true;
                }
            }
        })

    </script>
    <script src="./backend/validate.js"></script>

</body>

</html>