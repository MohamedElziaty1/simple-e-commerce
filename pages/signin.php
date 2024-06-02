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
if (isset($_POST["Submit"])) {
  $email = $_POST["email"];
  $Password = $_POST["Password"];
  if (empty($email)||empty($Password)) {
    $_SESSION["ErrorMessage"]= "All fields must be filled out";
  }else {
    // code for checking email and password from Database
    $Found_Account=Login_Attempt($email,$Password);
    if ($Found_Account) {
      $_SESSION["UserId"]=$Found_Account["id"];
      $_SESSION["email"]=$Found_Account["email"];
      $_SESSION["username"]=$Found_Account["username"];
      // $_SESSION["SuccessMessage"]= "Wellcome ".$_SESSION["username"]."!";
    Redirect_to("../Entrance.php");

    }else {
      $_SESSION["ErrorMessage"]="Incorrect Username/Password";
      Redirect_to("signin.php");
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign in</title>

  

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
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <link rel="stylesheet" href="../css/global.css" />
    <link rel="stylesheet" href="../css/footer.css" />
    
    <link rel="stylesheet" href="../css/header.css" />

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
      <a href="signin.php" class="logo">
        <i class="fa-solid fa-bag-shopping"></i>
        <span style="font-weight: bold">MH</span>
        <p style="letter-spacing: 0.5px">Shopping</p>
      </a>

      <div class="links">
        <!-- <a style="position: relative" class="cart" href="./cart.html">
          <i class="fa-solid fa-cart-shopping"></i>
          $0.00
          <span class="products-number">2</span> -->
        </a>
        <a class="sign-in border" href="./signin.php">
          <i class="fa-solid fa-right-to-bracket"></i>
          Sign in</a
        >
        <a class="register " href="./register.php">
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

      <form style="text-align: left" method="post">


        <div class="mb-4">
          <label for="exampleInputEmail1" class="form-label"
            >Email address</label
          >
          <input
            type="email"
            class="form-control"
            id="exampleInputEmail1"
            aria-describedby="emailHelp"
            name="email";
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
      
        <button type="submit" class="btn btn-primary" name="Submit">Sign in</button>
      </form>
    </main>

    <footer class="lead">
      Designed and developed by
      <span> Mohamed Hany </span>
      © 2024.
    </footer>
  </body>
</html>
