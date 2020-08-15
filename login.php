<!-- 
    Login IDs:
    login_email = Email Account of User
    login_password = User's Password
    Verify whether the password and email is correct and allow personal match history to show in game history.
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

    // echo "SC to DB";
    if (isset($_SESSION['email'])) {
        // If there is a current session:

        // header('Location: https://venus.cs.qc.cuny.edu/~imjo9615/CS355/home.html?status=loggedin');
    } else {
        if (isset($_POST['loginBtn'])) {
            $logEmail = $_POST['login_email'];
            $logPass = $_POST['login_password'];

            // echo "Email: " . $logEmail;
            // echo "\nPass: " . $logPass . "\n";

            $errorMsg = array();
            $query = "SELECT * from CFAccount where email = '$logEmail' AND pass = '$logPass';";

            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) <= 0) {
                array_push($errorMsg, "Account does not exist or wrong username and password.");
            }
            // echo "Count: " . count($errorMsg);
            if (count($errorMsg) == 0) {
                $_SESSION['email'] = $logEmail;
                $query2 = "SELECT accountID FROM CFAccount WHERE email = '$logEmail';";
                $result2 = mysqli_query($conn, $query2);
                $row = mysqli_fetch_assoc($result2);
                $value = $row['accountID'];
                $_SESSION['actID'] = $value;

                header('Location: https://venus.cs.qc.cuny.edu/~imjo9615/CS355/home.html?status=loginsuccess');
            } else {
                foreach ($errorMsg as $e) {
                    echo $e;
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
    <title>I/O Login</title>
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
                <h1 class="text-center" style="margin-bottom: 20px;">Login</h1>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card h-100 text-center mx-auto" style="background-color: #272522; border-radius: 20px; max-width: 40%;">
                    <div class="card-body d-flex flex-column mx-auto">
                        <form id="login-form" action="login" method="POST">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text" style="color: white; background-color: #312E2B; border-color: #22201E;">Email</span>
                                </div>
                                <input type="email" class="form-control" style="border-color: #22201E;" id="login_email" name="login_email" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="color: white; background-color: #312E2B; border-color: #22201E;">Password&nbsp;</span>
                                </div>
                                <input type="password" class="form-control" style="border-color: #22201E;" id="login_password" name="login_password" required>
                            </div>
                            <input type="submit" class="btn btn-primary mt-auto" id="loginBtn" name="loginBtn" value="Login">
                            <span>
                                <div>Don't have an account? <a href="register.php" class="">Sign Up</a></div>
                                <a href="forgotpassword.php" class="">Forgot your password?</a>
                            </span>
                        </form>                
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="footer" class="footer-wrapper"></div>
</body>
<script src="navbar_footer.js"></script>
</html>
