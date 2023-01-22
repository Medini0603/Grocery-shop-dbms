<?php

@include 'connect.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
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
   <link rel="stylesheet" href="styles.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="placed-orders">

   <h1 class="title">placed orders</h1>

   <div class="box-container">

   <?php
$sql = "select oid,cid,odate,oamt,paystat from orders where cid=$user_id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    ?>
      <div class="box">
         <p> user id : <span><?= $row['oid']; ?></span> </p>
         <p> placed on : <span><?= $row['odate']; ?></span> </p>  
         <p> total price : <span>$<?= $row['oamt']; ?>/-</span> </p>
         <p> delivery status : <span><?= $row['paystat']; ?></span> </p>
         <p>Placed items :-</p>
         <?php
       $sql2 = mysqli_query($conn,"SELECT * FROM orderitem WHERE oid='".$row['oid']."'");
        $num=mysqli_num_rows($sql2);
      if($num > 0){
         while($fetch_cart = mysqli_fetch_assoc($sql2)){ 
      ?>


<p> <?= $fetch_cart['pname']; ?> <span>(<?= $fetch_cart['cost'].'/- x '. $fetch_cart['qty']; ?>)</span> </p>
<?php
}
}
?>
</div>

<?php
}}
else{
   echo '<p class="empty">no orders placed yet!</p>';
}
?>

   </div>
</section>

<?php include 'footer.php'; ?>












<!-- <script src="js/script.js"></script> -->

</body>
</html>