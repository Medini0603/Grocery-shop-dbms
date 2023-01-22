<?php

@include 'connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};
$update_id = $_GET['update'];
if(isset($_POST['update_product'])){

//  $pid = $_POST['pid'];
   $name = $_POST['name'];
//    $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
//    $price = filter_var($price, FILTER_SANITIZE_STRING);
   $category = $_POST['category'];
//    $category = filter_var($category, FILTER_SANITIZE_STRING);

$upd="update products set pname='".$_POST['name']."', price='".$_POST['price']."' ,compid='".$_POST['category']."' where pid=$update_id";
$update=mysqli_query($conn,$upd);

   $message[] = 'product updated successfully!';

         }
  

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update products</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="update-product">

   <h1 class="title">update product</h1>   

   <!-- <?php
    $update_id = $_GET['update'];
   ?> -->
   <form action="" method="post" enctype="multipart/form-data">

      <input type="text" name="name" class="box" placeholder="enter product name" required>
      <input type="number" name="price" class="box" placeholder="enter product price" required>
      <input type="number" name="category" class="box" placeholder="enter product category" required>
      <p>
        <h4>Category List</h4>
        <br>
        1- veggies<br>
        2- fruits<br>
        3- cereals and pulses<br>
        4- snacks<br>
      </p>
      <div class="flex-btn">
         <input type="submit" class="btn" value="update product" name="update_product">
         <a href="admin_products.php" class="option-btn">go back</a>
      </div>
   </form>
   <?php
   ?>

</section>

</body>
</html>