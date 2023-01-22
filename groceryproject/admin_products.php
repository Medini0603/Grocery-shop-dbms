<?php

@include 'connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['add_product'])){

   $name = $_POST['name'];
   $price = $_POST['price'];
   $category = $_POST['category'];

    $ins="insert into products (pname,price,compid) values ('".$_POST['name']."','".$_POST['price']."','".$_POST['category']."')";
    $update=mysqli_query($conn,$ins);

}

if(isset($_GET['delete'])){

    $delete_id = $_GET['delete'];
    // echo $delete_id;
    $qu="delete from products where pid=$delete_id";
    $del=mysqli_query($conn,$qu);
//    $delete_products = $conn->prepare("DELETE FROM `products` WHERE id = ?");
//    $delete_products->execute([$delete_id]);
//    $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE pid = ?");
//    $delete_wishlist->execute([$delete_id]);
//    $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
//    $delete_cart->execute([$delete_id]);
   header('location:admin_products.php');


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="add-products">

   <h1 class="title">add new product</h1>

   <form action="" method="POST" enctype="multipart/form-data">
      <div class="flex">
         <div class="inputBox">
         <input type="text" name="name" class="box" required placeholder="enter product name">
         <input type="text" name="category" class="box" required placeholder="enter category number">
         <!-- <select name="category" class="box" required>
            <option value="" selected disabled>select category</option>
               <option value="vegitables">vegetables</option>
               <option value="fruits">fruits</option>
               <option value="meat">cereals and pulses</option>
               <option value="fish">snacks</option>
         </select> -->
         </div>
         <div class="inputBox">
         <input type="number" min="0" name="price" class="box" required placeholder="enter product price">
         <!-- <input type="file" name="image" required class="box" accept="image/jpg, image/jpeg, image/png"> -->
         </div>
      </div>
      <!-- <textarea name="details" class="box" required placeholder="enter product details" cols="30" rows="10"></textarea> -->
      <p>
        <h4>Category List</h4>
        <br>
        1- veggies<br>
        2- fruits<br>
        3- cereals and pulses<br>
        4- snacks<br>
      </p>
      <input type="submit" class="btn" value="add product" name="add_product">
   </form>

</section>

<section class="show-products">

   <h1 class="title">products added</h1>

   <div class="box-container">

<?php
$sql = "select pid,pname,price,compid from products";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    ?>
    <div class="box">
        <div class="details"><?= $row['pid']; ?></div>
      <div class="price">$<?= $row['price']; ?>/-</div>
      <div class="name"><?= $row['pname']; ?></div>


      <?php
        $sql1 = "select comname from company where comid='".$row['compid']."'";
        $r = mysqli_query($conn, $sql1);
        // $c=mysqli_fetch_assoc($r);
        $catt=mysqli_fetch_array($r);
      ?>


      <div class="cat"><?php echo $catt['comname']?></div>
      <div class="flex-btn">
         <a href="admin_update_product.php?update=<?= $row['pid']; ?>" class="option-btn">update</a>
         <a href="admin_products.php?delete=<?= $row['pid']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>
      </div>
   </div>
  
<?php
}
} else {
  echo "0 results";
}
?>
   </div>

</section>

</body>
</html>