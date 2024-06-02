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
$UserName=$_POST["Username"];
$Password=$_POST["Password"];
$Email=$_POST["Email"];
date_default_timezone_set("Africa/Cairo");
$CurrentTime=time();
$DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
if(empty($UserName)||empty($Password)||empty($Email)){
$_SESSION["ErrorMessage"]="All field must be filled out";
}else{

global $ConnectingDB;
$sql="INSERT INTO admin(datetime,username,email,password)";
$sql.="VALUES(:dateTime,:userName,:email,:password)";
$stmt=$ConnectingDB->prepare($sql);
$stmt->bindValue(':dateTime',$DateTime);
$stmt->bindValue(':userName',$UserName);
$stmt->bindValue(':password',$Password);
$stmt->bindValue(':email',$Email);
$Execute=$stmt->execute();
if($Execute){
$_SESSION["SuccessMessage"]="You have been successfully registered! ". $UserName ." Thank you for signing up.";
Redirect_to("Register.php");
}else{
  $_SESSION["ErrorMessage"]="Something went wrong. Try again!";
}

}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
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
        <h1 class="mb-4">Register Admin</h1>
        <form method="post" action="Register.php">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" placeholder="Enter username" name="Username">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" placeholder="Enter Email" name="Email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Enter password" name="Password">
            </div>
            <button type="submit" name="Submit" class="btn btn-primary">Register</button>
        </form>
    </div>

    <footer>
        <p>Designed and developed by Mohamed Hany © 2024.</p>
    </footer>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
