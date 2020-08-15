<!DOCTYPE html>
<html lang="en" style="height: 100%;">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>I/O Password Recovery</title>
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
                <h1 class="text-center" style="margin-bottom: 20px;">Forgot Password</h1>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card h-100 text-center mx-auto" style="background-color: #272522; border-radius: 20px;max-width: 70%;">
                    <div class="card-body d-flex flex-column mx-auto">
                        <div style="margin-bottom: 10px;">Enter your email and a link will be sent to you to reset your password, if it exists.</div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" style="background-color: #312E2B; color:white; border-color: #22201E;" id="forgot_email">Email</span>
                            </div>
                            <input type="text" class="form-control" style="color:white; border-color: #22201E;">
                        </div>
                        <!-- SUBMIT BUTTON -> ACCOUNT RECOVERY -->
                        <a href="#" class="btn btn-primary mt-auto">Submit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div id="footer" class="footer-wrapper"></div>
</body>
<script src="navbar_footer.js"></script>
</html>

<!-- 
    Forgot Password IDs:
    forgot_email = User's email associated with the account
    Send an email to the user's email and send a temporary link to reset the password.
 -->