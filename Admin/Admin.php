<?php
require_once("includes/DbAdmin.php");
?>
<?php
require_once("includes/SessionAdmin.php");
?>
<?php
require_once("includes/Functions.php");
?>
<?php
if(isset($_POST["Submit"])){
$ProductName=$_POST["Productname"];
$ProductDescription=$_POST["ProductDescription"];
$ProductPrice=$_POST["ProductPrice"];
$ProductImage=$_FILES["image"]["name"];
$Target= "Uploads/".basename($_FILES["image"]["name"]);

date_default_timezone_set("Africa/Cairo");
$CurrentTime=time();
$DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
if(empty($ProductName)||empty($ProductDescription)||empty($ProductPrice)){
  $_SESSION["ErrorMessage"]="Title cant be empty";
  Redirect_to("Admin.php");
}else{
global $ConnectingDB;
$sql="INSERT INTO products (datetime,productdescripe,productprice,productname,image)";
$sql .="VALUES(:dateTime,:ProductDescripe,:ProductPrice,:ProductName,:image)";
$stmt=$ConnectingDB->prepare($sql);
$stmt->bindValue(':dateTime',$DateTime);
$stmt->bindValue(':ProductDescripe',$ProductDescription);
$stmt->bindValue(':ProductPrice',$ProductPrice);
$stmt->bindValue(':ProductName',$ProductName);
$stmt->bindValue(':image',$ProductImage);
$Execute=$stmt->execute();
if($Execute){
move_uploaded_file($_FILES["image"]["tmp_name"],$Target);
Redirect_to("Admin.php");
}else{
  $_SESSION["ErrorMessage"]="Something went wrong. Try Again!";
  Redirect_to("Admin.php");
}

}

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            padding-bottom: 70px; /* Give space for the fixed footer */
        }

        footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#">Welcome Admin</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="#products" >Add New Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#orders" >Manage Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#users" >Manage Users</a>
                        </li>
                    </ul>
                    <div class="d-flex">
                        <a class="btn btn-primary me-2" href="logout.php">Sign Out</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <section id="products" class="container py-5">
        <?php
echo ErrorMessage();
echo SuccessMessage();
?>
      <!-- Fetching products from database -->
    
      <div class="container mt-5">
              <h1>Add New Product</h1>
              <form method="post" enctype="multipart/form-data">
                  <div class="mb-3">
                      <label for="productName" class="form-label">Product Name</label>
                      <input type="text" class="form-control" id="productName" placeholder="Enter product name" name="Productname">
                  </div>
                  <div class="mb-3">
                      <label for="productDescription" class="form-label">Product Description</label>
                      <textarea class="form-control" id="productDescription" rows="3" placeholder="Enter product description" name="ProductDescription"></textarea>
                  </div>
                  <div class="mb-3">
                      <label for="productPrice" class="form-label">Product Price</label>
                      <input type="text" class="form-control" id="productPrice" placeholder="Enter product price" name="ProductPrice">
                  </div>
                  <div class="mb-3">
                      <label for="productImage" class="form-label">Product Image</label>
                      <input type="file" class="form-control" id="productImage" name="image">
                  </div>
                  <button type="submit" class="btn btn-primary" name="Submit">Add Product</button>
              </form>
          
            </div>
      
          </section>
          <section id="orders" class="container py-5">
          <h2>Manage Products</h2>
        
        
          <div class="container mt-5 ">
              <table class="table table-striped table-hover">
                  <thead class="thead-dark">
                      <tr>
                          <th>Product Num</th>
                          <th>Product Image </th>
                          <th>Product Name</th>
                          <th>Description</th>
                          <th>Price</th>
                          <th>Actions</th>
                      </tr>
                
                </thead>

                  <?php
      global $ConnectingDB;
      $sql="SELECT productprice,productdescripe,productname,image,datetime FROM products ORDER BY id desc";
      $stmt=$ConnectingDB->query($sql);
    $SrNo=0;
      while($DataRows=$stmt->fetch()){
$ProductPrice=$DataRows["productprice"];
$ProductDescription=$DataRows["productdescripe"];
$ProductName=$DataRows["productname"];
$ProductImage=$DataRows["image"];

$SrNo++;
      ?>
                  <tbody>
                      <tr>
                          <td><?php echo htmlentities($SrNo);?> </td>
                          <td><img src="Uploads/<?php echo $ProductImage?>" alt="" style="width:50px; height:50px; border-radius
                      :50%; "></td>
                          <td><?php echo htmlentities($ProductName);?></td>
                          <td><?php echo htmlentities($ProductDescription);?></td>
                          <td>EGP <?php echo htmlentities($ProductPrice);?></td>
                          <td >
                              <button type="submit" name="Edit"  class="btn btn-primary mb-1">Edit</button>
                              <button type="submit" name="Delete" class="btn btn-danger">Delete</button>
                          
                            </td>

                      </tr>
             <!-- Add more product rows as needed -->
                  </tbody>
                  <?php }?>
              </table>
          </div>
        

        </section>
      
        <section id="users" class="container py-5">
            <!-- Content for managing users -->
        </section>
    </main>

    <footer>
        <p>Designed and developed by Mohamed Hany © 2024.</p>
    </footer>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- <script>
        function manageProducts() {
            document.getElementById("products").style.display = "block";
            document.getElementById("orders").style.display = "none";
            document.getElementById("users").style.display = "none";
        }

        function manageOrders() {
            document.getElementById("products").style.display = "none";
            document.getElementById("orders").style.display = "block";
            document.getElementById("users").style.display = "none";
        }

        function manageUsers() {
            document.getElementById("products").style.display = "none";
            document.getElementById("orders").style.display = "none";
            document.getElementById("users").style.display = "block";
        }
    </script> -->
</body>
</html>
