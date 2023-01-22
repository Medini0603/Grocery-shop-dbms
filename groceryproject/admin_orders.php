<?php

@include 'connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['update_order'])){

   $order_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   $update_payment = filter_var($update_payment, FILTER_SANITIZE_STRING);
   // $update_orders = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
   // $update_orders->execute([$update_payment, $order_id]);
   $upd="update orders set paystat='".$_POST['update_payment']."' where oid=$order_id";
   $update=mysqli_query($conn,$upd);

   $message[] = 'payment has been updated!';

};

if(isset($_GET['delete'])){

   // $delete_id = $_GET['delete'];
   // $delete_orders = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
   // $delete_orders->execute([$delete_id]);
   $delete_id = $_GET['delete'];
   $qu="delete from orders where oid=$delete_id";
   $del=mysqli_query($conn,$qu);
   header('location:admin_orders.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="placed-orders">

   <h1 class="title">placed orders</h1>

   <div class="box-container">

   <?php
$sql = "select oid,cid,odate,oamt,paystat from orders";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    ?>
      <div class="box">
         <p> user id : <span><?= $row['oid']; ?></span> </p>
         <p> placed on : <span><?= $row['odate']; ?></span> </p>
         
         <p> total price : <span>$<?= $row['oamt']; ?>/-</span> </p>
         <p> payment status : <span><?= $row['paystat']; ?></span> </p>
         <form action="" method="POST">
            <input type="hidden" name="order_id" value="<?= $row['oid']; ?>">
            <select name="update_payment" class="drop-down">
               <option value="" selected disabled><?= $row['paystat']; ?></option>
               <option value="pending">pending</option>
               <option value="complete">completed</option>
            </select>
            <div class="flex-btn">
               <input type="submit" name="update_order" class="option-btn" value="update">
               <a href="admin_orders.php?delete=<?= $row['oid']; ?>" class="delete-btn" onclick="return confirm('delete this order?');">delete</a>
            </div>
         </form>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">no orders placed yet!</p>';
      }
      ?>

   </div>

</section>












<!-- <script src="js/script.js"></script> -->

</body>
</html>