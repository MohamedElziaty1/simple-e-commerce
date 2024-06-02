<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Add your CSS links here -->
    <link rel="stylesheet" href="./css/global.css" />
    <link rel="stylesheet" href="./css/header.css" />
    <link rel="stylesheet" href="./css/footer.css" />
    <link rel="stylesheet" href="./css/pages/checkout.css" />
    <!-- ربط مكتبة Font Awesome للأيقونات -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- أيقونة الموقع -->
    <link rel="shortcut icon" href="../images/bag-shopping-solid.svg" type="image/x-icon" />
    <style>
        .checkout-form {
            text-align: left;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .btn-submit {
            background-color: #4CAF50;
            /* Green background */
            color: white;
            /* White text */
            padding: 15px 20px;
            /* Some padding */
            border: none;
            /* No borders */
            cursor: pointer;
            /* Pointer cursor on hover */
            border-radius: 5px;
            transition: background-color 0.3s ease;
            /* Add transition effect */
        }

        .btn-submit:hover {
            background-color: #45a049;
            /* Dark green background on hover */
        }
    </style>
</head>

<body>
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
        </div>
    </header>

    <main>
        <section class="checkout-form container">
            <h2>Checkout</h2>
            <!-- Add your checkout form here -->
            <form action="process_checkout.php" method="POST">
                <!-- Input fields for shipping and billing information -->
                <div class="form-group">
                    <label for="shipping_address">Shipping Address:</label>
                    <input type="text" id="shipping_address" name="shipping_address" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="billing_address">Billing Address:</label>
                    <input type="text" id="billing_address" name="billing_address" class="form-control" required>
                </div>

                <!-- Other input fields like name, email, etc. -->

                <!-- Button to submit the form -->
                <button type="submit" class="btn btn-submit">Complete Purchase</button>
            </form>
        </section>
    </main>

    <footer style=" position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    text-align: center;">
        Designed and developed by
        <span> Mohamed hany </span>
        © 2024.
    </footer>
    <!-- Add Bootstrap JS links -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
