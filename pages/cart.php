<?php require_once("../Includes/DB.php") ?>
<?php require_once("../Includes/Session.php") ?>
<?php $Subtotal=0; ?>
<?php


require_once("../Includes/DB.php");

// التحقق مما إذا كانت عربة التسوق موجودة في الجلسة. إذا لم تكن موجودة، نقوم بإنشاء عربة تسوق كمصفوفة فارغة.
if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}

if (isset($_POST['product_id'])) {
  $ProductID = $_POST['product_id'];
  global $ConnectingDB;
  $sql = "SELECT * FROM products WHERE id = :productID";
  $stmt = $ConnectingDB->prepare($sql);
  $stmt->bindValue(':productID', $ProductID);
  $stmt->execute();

  $Product = $stmt->fetch();

  // التحقق مما إذا كان المنتج موجوداً في قاعدة البيانات.
  if ($Product) {
    // إنشاء مصفوفة تحتوي على تفاصيل المنتج.
    $productArray = [
      'id' => $Product['id'],
      'name' => $Product['productname'],
      'price' => $Product['productprice'],
      'image' => $Product['image'],
      'quantity' => 1
    ];

    // متحول للتحقق مما إذا كان المنتج موجوداً بالفعل في عربة التسوق.
    $isProductInCart = false;

    // التحقق مما إذا كان المنتج موجوداً بالفعل في عربة التسوق. إذا كان موجوداً، نزيد الكمية.
    foreach ($_SESSION['cart'] as &$cartItem) {
      if ($cartItem['id'] == $ProductID) {
        $cartItem['quantity']++;
        $isProductInCart = true;
        break;
      }
    }
    // إذا لم يكن المنتج موجوداً في عربة التسوق، نضيفه إلى المصفوفة.
    if (!$isProductInCart) {
      $_SESSION['cart'][] = $productArray;
    }
  }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_ids'])) {
  $ProductID = $_POST['product_ids'];

  foreach ($_SESSION['cart'] as &$cartItem) {
    if ($cartItem['id'] == $ProductID) {
      if (isset($_POST['increase'])) {
        $cartItem['quantity']++;
      } elseif (isset($_POST['decrease'])) {
        if ($cartItem['quantity'] > 1) {
          $cartItem['quantity']--;
        }
      }
      break;
    }
  }
}

if(isset($_POST['clear'])){
session_unset();


}
?>
<?php
if (isset($_POST['product-trash'])) {
  $ProductTrash = $_POST['product-trash'];

  foreach ($_SESSION['cart'] as $key=> &$cartItem) {
    if ($cartItem['id'] == $ProductTrash) {
      if (isset($_POST['trash'])) {
        unset($_SESSION['cart'][$key]);
        $Subtotal=0;

        break;
      }
    }
  }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cart</title>
  <!-- ربط ملفات CSS -->
  <link rel="stylesheet" href="../css/global.css" />
  <link rel="stylesheet" href="../css/header.css" />
  <link rel="stylesheet" href="../css/footer.css" />
  <!-- ربط مكتبة Font Awesome للأيقونات -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- أيقونة الموقع -->
  <link rel="shortcut icon" href="../images/bag-shopping-solid.svg" type="image/x-icon" />
  <!-- ربط ملف CSS خاص بصفحة العربة -->
  <link rel="stylesheet" href="../css/pages/cart.css" />
</head>

<body style="
      height: 100vh;
      display: grid;
      align-items: center;
      grid-template-rows: auto 1fr auto;
    ">
  <!-- رأس الصفحة الثابت -->
  <header class="flex">
    <!-- الشعار والروابط -->
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
        Sign out</a>
      <!-- <a class="register" href="./register.html">
          <i class="fa-solid fa-user-plus"></i>
          Register</a
        > -->
    </div>
  </header>

  <!-- محتوى الصفحة الرئيسي -->
  <main style="text-align: center">
    <!-- قسم العربة -->
    <section class="cart">

      <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) { ?>
        <?php $Subtotal = 0; ?>
        <?php foreach ($_SESSION['cart'] as $carItem) { ?>
          <!-- منتج في العربة -->
          <article class="product flex">
            <form method="post">
              <input type="hidden" name="product-trash" value="<?php echo $carItem['id']; ?>">
              <button type="submit" name="trash">
                <i class="fa-solid fa-trash-can"></i>
              </button>

            </form>

            <p class="price">EGP <?php echo $carItem['price'] * $carItem['quantity'];

                                  $Subtotal += $carItem['price'] * $carItem['quantity'];
                                  ?> </p>
            <form method="post">
              <input type="hidden" name="product_ids" value="<?php echo $carItem['id']; ?>">
              <div class="flex" style="margin-right: 1rem">
                <button type="submit" name="decrease" class="decrease">-</button>
                <div class="quantity flex"><?php echo $carItem['quantity']; ?></div>
                <button type="submit" name="increase" class="increase">+</button>
              </div>
            </form>


            <p class="title"><?php echo $carItem['name']; ?></p>
            <img style="border-radius: 0.22rem" width="70" height="70" alt="" src="../Admin/Uploads/<?php echo $carItem["image"]; ?>" />
          </article>
        <?php } ?>
      <?php } else { ?>
        <p>No items in the cart </p>
      <?php } ?>
    </section>

    <!-- زر مسح العربة -->
  <form method="POST">
  <button type="submit" name="clear" class="clear">
      <i style="color: #fff; margin-right: 0.2rem" class="fa-solid fa-trash-can icon">
      </i>
      Clear Cart
    </button>


  </form>


    <!-- ملخص العربة -->

    <section class="summary">
      <h1>Cart Summary</h1>
      <div class="flex">
        <p class="Subtotal">Subtotal</p>
        <p><?php
          
          echo $Subtotal;

            ?></p>

      </div>
      <button class="checkout">CHECKOUT</button>
    </section>
  </main>

  <!-- تذييل الصفحة -->
  <footer class="">
    Designed and developed by
    <span> Mohamed hany </span>
    © 2024.
  </footer>
</body>

</html>