<?php require_once("Includes/DB.php")?>
<?php require_once("Includes/Functions.php")?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home Page</title>

    <link rel="stylesheet" href="./css/global.css" />
    <link rel="stylesheet" href="./css/header.css" />
    <link
      rel="shortcut icon"
      href="./images/bag-shopping-solid.svg"
      type="image/x-icon"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
      integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="./css/pages/index.css" />
    <link rel="stylesheet" href="./css/footer.css" />
  
  </head>
  <body>
    <div class="top-img" style="background: url(images/man.jpg);">
      <header id="headerElement" class="flex">
      <a href="Entrance.php" class="logo" >
        
          <i class="fa-solid fa-bag-shopping"></i>
          <span style="font-weight: bold">MH</span>
          <p style="letter-spacing: 0.5px">Shopping</p>
        </a>

        <div class="links">
          <a style="position: relative" class="cart" href="pages/cart.php">
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

      <section class="content">
        <p class="lifestyle">Lifestyle collection</p>
        <p class="men">MEN</p>
        <p class="sale">SALE UP TO <span>30% OFF</span></p>
        <p class="free-shipping">Get Free Shipping on orders over EGP 800</p>
        <button id="shop-now">>Shop Now</button>
      </section>
    </div>

    <main class="">
      <h1 class="recommended" id="recommended">
        <i class="fa-solid fa-check"></i>
        Recommended for you
      </h1>

      <section class="products flex">
      <?php
global $ConnectingDB;
$sql="SELECT * FROM products ORDER BY id desc";
$stmt=$ConnectingDB->query($sql);
while($DataRows=$stmt->fetch()){
$ProductPrice=$DataRows["productprice"];
$ProductDescription=$DataRows["productdescripe"];
$ProductName=$DataRows["productname"];
$ProductImage=$DataRows["image"];
$Id=$DataRows["id"];



?>
  <article class="card" style="width: 266px; height:310px">
    <a href="pages/product-details.php?id=<?php echo $Id; ?>">
      <img width="266" height="150px" src="Admin/Uploads/<?php echo $ProductImage;?> " alt="" srcset="" />
    </a>

    <div style="width: 266px; height:180px;" class="content">
      <h1 class="title"><?php echo htmlentities($ProductName);?></h1>
      <p class="description" style="height: 70px;">
<?php echo htmlentities($ProductDescription);?>      

</p>

      <div
        class="flex"
        style="justify-content: space-between; padding-bottom: 0.7rem;
        width:266px; height:50px;
        "
      >
        <div class="price">EGP <?php echo htmlentities($ProductPrice);?>      
</div>
<form action="pages/cart.php" method="post">

<button class="add-to-cart flex">
<input type="hidden" name="product_id" value="<?php echo $Id; ?>">
<i class="fa-solid fa-cart-plus"></i>
          Add To Cart
        </button>
</form>
      
      </div>
    </div>
  </article>
  <?php } ?>

</section>

    </main>

    <footer>
      Designed and developed by
      <span> Mohamed hany </span>
      © 2024.
    </footer>
<script>
  document.querySelector('#shop-now').addEventListener('click', function() {

document.querySelector('#recommended').scrollIntoView({ behavior: 'smooth' });
});


</script>
<script src="./js/main.js"></script>
  </body>
</html>
