<!-- 
    Register IDs:
    register_email = New Email Account of User
    register_password = New User's Password
 -->
 <?php
    session_start();
    
    $DBserver = "";
    $DBusername = "";
    $DBpassword = "";
    $DB = "";

    

    $conn = new mysqli($DBserver, $DBusername, $DBpassword, $DB);
    if ($conn->connection_error) {
        die("Failed to Connect: " . $conn->connection_error);
    }

    // echo "successfully connected";
    if (isset($_SESSION['email'])) {
        // If there is a current session:
        header('Location: https://venus.cs.qc.cuny.edu/~imjo9615/CS355/home.html?status=loggedin');
    } else {
        if (isset($_POST['createAccountBtn'])) {
            $regEmail = $_POST['register_email'];
            $regPass = $_POST['register_password'];

            // echo "Email: " . $regEmail;
            // echo "\nPass: " . $regPass . "\n";

            $errorMsg = array();
            $query = "SELECT * from CFAccount where email = '$regEmail';";

            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                array_push($errorMsg, "Email is already in use");
            }
            // echo "Count: " . count($errorMsg);
            if (count($errorMsg) == 0) {
                // Continue
                $insert_account = "INSERT INTO CFAccount (email, pass) VALUES ('$regEmail', '$regPass');";

                if ($conn->query($insert_account) == TRUE) {
                    // echo "Record Created Successfully";
                    header('Location: https://venus.cs.qc.cuny.edu/~imjo9615/CS355/login.php?status=registersuccess');
                } else {
                    foreach ($errorMsg as $e) {
                        // echo $e;
                    }
                }
            }
        }
    }
    mysqli_close($conn);
 ?>
<!DOCTYPE html>
<html lang="en" style="height: 100%;">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>I/O Register</title>
    <link rel="stylesheet" href="bs/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="bs/js/bootstrap.min.js"></script>

</head>
<body style="background-color: #312E2B; color: white; height: 100%;">
    <div id="navbar-bs">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center" style="margin-bottom: 20px;">Create New Account</h1>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card h-100 text-center mx-auto" style="background-color: #272522; border-radius: 20px; max-width: 85%;">
                    <div class="card-body d-flex flex-column mx-auto">
                        <form id="register-form" action="register" method="POST">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text" style="color: white; background-color: #312E2B; border-color: #22201E;">Email</span>
                                </div>
                                <input type="email" class="form-control" style="border-color: #22201E;" id="register_email" name="register_email" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text" style="color: white; background-color: #312E2B; border-color: #22201E;">Password&nbsp;</span>
                                </div>
                                <input type="password" class="form-control" style="border-color: #22201E;" id="register_password" name="register_password" required>
                            </div>
                            <input type="submit" class="btn btn-primary mt-auto" id="createAccountBtn" name="createAccountBtn" value="Create Account">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="footer" class="footer-wrapper"></div>
</body>
<script src="navbar_footer.js"></script>
<script>
    // Temp
</script>
</html>