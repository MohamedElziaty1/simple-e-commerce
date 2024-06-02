<?php
require_once("includes/DbAdmin.php")
?>
<?php
require_once("includes/SessionAdmin.php")
?>
<?php
require_once("includes/Functions.php")
?>
<?php
if(isset($_POST["Submit"])){
$Email=$_POST["Email"];
$Password=$_POST["Password"];
if(empty($Email)||empty($Password)){
  $_SESSION["ErrorMessage"]="All Field must be Filled Out !.";
}else{
// Code for checking an email and password from Database
$Found_Account=Login_Attempt($Email,$Password);
if($Found_Account){
$_SESSION["UserId"]=$Found_Account["id"];
$_SESSION["email"]=$Found_Account["email"];
$_SESSION["password"]=$Found_Account["password"];
Redirect_to("Admin.php");

}else{
  $_SESSION["ErrorMessage"]="Incorrect Username/Password";
      Redirect_to("login.php");
}
}


}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
            padding-top: 60px; /* Space for the fixed header */
        }

        .form-container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-container h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-container label {
            font-weight: bold;
        }

        .form-container button[type="submit"] {
            width: 100%;
            margin-top: 20px;
        }

        .register-link {
            text-align: center;
            margin-top: 10px;
        }

        .header {
            width: 100%;
            padding: 10px 0;
            background-color: #333;
            color: #fff;
            text-align: center;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        footer {
            width: 100%;
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            left: 0;
        }
    </style>
</head>
<body>
    <header class="header">
        <h2>Admin Portal</h2>
    </header>
    <?php
    echo ErrorMessage();
    echo SuccessMessage();
    ?>
    <div class="form-container">
        <h1 class="mb-4">Login Admin</h1>
        <form method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Enter Email" name="Email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label" >Password</label>
                <input type="password" class="form-control" name="Password" id="password" placeholder="Enter password" >
            </div>
            <button type="submit" class="btn btn-primary" name="Submit">Login</button>
            <div class="register-link mt-3">
                <a href="register.html" class="btn btn-secondary">Register</a>
            </div>
        </form>
    </div>

    <footer>
        <p>Designed and developed by Mohamed Hany © 2024.</p>
    </footer>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
