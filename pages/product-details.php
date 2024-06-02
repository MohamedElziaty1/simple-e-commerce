<?php require_once("../Includes/DB.php");
?>

<?php

$SearchQueryParamater=$_GET["id"];

?>
<?php


?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Product details</title>
    <link rel="stylesheet" href="../css/global.css" />
    <link rel="stylesheet" href="../css/header.css" />
    <link rel="stylesheet" href="../css/footer.css" />

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
    <link rel="stylesheet" href="../css/pages/product-details.css">
  </head>
  <body
    style="
      height: 100vh;
      display: grid;
      align-items: center;
      grid-template-rows: auto 1fr auto;
    "

  >
    <header class="flex ">
      <a href="../Entrance.php" class="logo">
        <i class="fa-solid fa-bag-shopping"></i>
        <span style="font-weight: bold">MH</span>
        <p style="letter-spacing: 0.5px">Shopping</p>
      </a>

      <div class="links">
          <a style="position: relative" class="cart" href="cart.php">
            <i class="fa-solid fa-cart-shopping"></i>
            $0.00
            <span class="products-number">2</span>
          </a>
          <a class="sign-in" href="signout.php">
            <i class="fa-solid fa-sign-out-alt"></i>
            Sign out</a
          >
        
        </div>
    </header>
<?php
global $ConnectingDB;
$sql="SELECT * FROM products WHERE id=$SearchQueryParamater";
$stmt=$ConnectingDB->query($sql);
while($DataRows=$stmt->fetch()){
$ProductDescripe=$DataRows["productdescripe"];
$ProductPrice=$DataRows["productprice"];
$ProductImage=$DataRows["image"];
$ProductName=$DataRows["productname"];



?>

    <main style="text-align: center;" class="flex">
    
      <img alt="" src="../Admin/Uploads/<?php echo $ProductImage?>" />

      <div class="product-details">
        <div style="justify-content: space-between" class="flex">
          <h2><?php echo $ProductName;?></h2>
          <p class="price">EGP <?php echo $ProductPrice;?></p>
        </div>

        <p class="description">
        <?php echo $ProductDescripe; ?>
        </p>
<form action="cart.php" method="post">
<button class="flex add-to-cart">
<input type="hidden" name="product_id" value="<?php echo $SearchQueryParamater;?>">
<i class="fa-solid fa-cart-plus"></i>
          Add To Cart
        </button>
</form>
      </div>

    </main>
<?php }?>
    <footer class="">
      Designed and developed by
      <span> Mohamed Hany </span>
      © 2024.
    </footer>
  </body>
</html>
