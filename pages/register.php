<?php
require_once("../Includes/DB.php");
?>
<?php
require_once("../Includes/Session.php");
?>
<?php
require_once("../Includes/Functions.php");
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
$sql="INSERT INTO customer(datetime,username,email,password)";
$sql.="VALUES(:dateTime,:userName,:email,:password)";
$stmt=$ConnectingDB->prepare($sql);
$stmt->bindValue(':dateTime',$DateTime);
$stmt->bindValue(':userName',$UserName);
$stmt->bindValue(':password',$Password);
$stmt->bindValue(':email',$Email);
$Execute=$stmt->execute();
if($Execute){
$_SESSION["SuccessMessage"]="You have been successfully registered! Thank you for signing up.";
Redirect_to("register.php");
}else{
  $_SESSION["ErrorMessage"]="Something went wrong. Try again!";
}

}
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>

    <link
      href="../css/bootstrap.min.css"
      rel="stylesheet"
    />

    <link
    rel="shortcut icon"
    href="../images/bag-shopping-solid.svg"
    type="image/x-icon"
  />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
      integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

    <link rel="stylesheet" href="../css/global.css" />
    <link rel="stylesheet" href="../css/header.css" />
    <link rel="stylesheet" href="../css/footer.css" />

    <style>
      .fa-solid {
        color: white;
      }

      body {
        text-shadow: 0 0.05rem 0.1rem rgba(0, 0, 0, 0.5);
        box-shadow: inset 0 0 5rem rgba(0, 0, 0, 0.5);
      }

      main {
        max-width: 500px;
      }

      footer{
        background-color: transparent;
      }
    </style>
  </head>

  <body
    style="
      height: 100vh;
      display: grid;
      grid-template-rows: auto 1fr auto;
      align-items: center;
    "
    class="text-center text-bg-dark"
  >
    <header class="flex">
      <a href="register.php" class="logo">
        <i class="fa-solid fa-bag-shopping"></i>
        <span style="font-weight: bold
        ">MH</span>
        <p style="letter-spacing: 0.5px">Shopping</p>
      </a>

      <div class="links">
      
        <a class="sign-in" href="./signin.php">
          <i class="fa-solid fa-right-to-bracket"></i>
          Sign in</a
        >
        <a class="register border" href="#">
          <i class="fa-solid fa-user-plus"></i>
          Register</a
        >
      </div>
    </header>

    <main class="px-3">
    <?php
       echo ErrorMessage();
       echo SuccessMessage();
       ?>
    <form style="text-align: left" method="post" action="register.php">
        <div class="mb-4">
          <label for="username" class="form-label">Username</label>
          <input
            type="text"
            class="form-control"
            id="username"
            aria-describedby="emailHelp"
            name="Username";
          />
        </div>

        <div class="mb-4">
          <label for="exampleInputEmail1" class="form-label"
            >Email address</label
          >
          <input
            type="email"
            class="form-control"
            id="exampleInputEmail1"
            aria-describedby="emailHelp"
            name="Email";
          />
        </div>

        <div class="mb-4">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input
            type="password"
            class="form-control"
            id="exampleInputPassword1"
            name="Password";
          />
        </div>
        
        <button type="submit" class="btn btn-primary" name="Submit">Create Account</button>
      </form>
    </main>

    <footer class="lead">
      Designed and developed by
      <span> Mohamed Hany </span>
      © 2024.
    </footer>
  </body>
</html>
