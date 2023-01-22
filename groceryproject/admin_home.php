<!-- <?php

//@include 'connect.php';
?> -->

<!-- <!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin_home</title>
</head>
<body>
   <h1>ADMIN PAGE</h1>
   <a href="logout.php">logout</a>
</body>
</html> -->

<?php

@include 'connect.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="admin_style.css">

</head>
<body>
   
   <?php include 'admin_header.php'; ?>



<section class="dashboard">

   <h1 class="title">dashboard</h1>

   <div class="box-container">

      <div class="box">
      <?php
         $total_pendings = 0;
         $qu="select sum(oamt) from orders where paystat='pending'";
         $select_pendings = mysqli_query($conn,$qu);
         $row=mysqli_fetch_array($select_pendings);

         // while($fetch_pendings = $row["oamt"]){
         //    $total_pendings += $fetch_pendings;
         // };
      ?>
      <h3><?php echo $row['sum(oamt)']?></h3>
      <p>total pendings</p>
      <a href="admin_orders.php" class="btn">see orders</a>
      </div>

      <div class="box">
      <?php
         $total_completed = 0;
         $qu1="select sum(oamt) from orders where paystat='complete'";
         $select_pendings = mysqli_query($conn,$qu1);
         $row1=mysqli_fetch_array($select_pendings);

      ?>
      <h3><?php echo $row1['sum(oamt)']?></h3>
      <p>completed orders</p>
      <a href="admin_orders.php" class="btn">see orders</a>
      </div>

      <div class="box">
      <?php
         $qu1="select count(*) from orders";
         $num= mysqli_query($conn,$qu1);
         $row2=mysqli_fetch_array($num);
      ?>
       <h3><?php echo $row2['count(*)']?></h3>
      <p>orders placed</p>
      <a href="admin_orders.php" class="btn">see orders</a>
      </div>

      <div class="box">
      <?php
         $qu1="select count(*) from products";
         $num= mysqli_query($conn,$qu1);
         $row2=mysqli_fetch_array($num);
      ?>
       <h3><?php echo $row2['count(*)']?></h3>
      <p>products added</p>
      <a href="admin_products.php" class="btn">see products</a>
      </div>

      <div class="box">
      <?php
        $qu1="select count(*) from customer";
        $num= mysqli_query($conn,$qu1);
        $row2=mysqli_fetch_array($num);
     ?>
      <h3><?php echo $row2['count(*)']?></h3>
      <p>total users</p>
      <a href="admin_users.php" class="btn">see accounts</a>
      </div>

      <div class="box">
      <?php
         $qu1="select count(*) from admins";
         $num= mysqli_query($conn,$qu1);
         $row2=mysqli_fetch_array($num);
      ?>
       <h3><?php echo $row2['count(*)']?></h3>
       <br><br>
      <p>total admins</p>
      <br><br>
      <!-- <a href="admin_users.php" class="btn">see accounts</a> -->
      </div>

      <div class="box">
      <?php
        $qu1="select count(*) from company";
        $num= mysqli_query($conn,$qu1);
        $row2=mysqli_fetch_array($num);
     ?>
      <h3><?php echo $row2['count(*)']?></h3>
      <br><br>
      <p>total company</p>
      <!-- <a href="admin_contacts.php" class="btn">see messages</a> -->
      <br><br>
      </div>

   </div>

</section>

<script src="script.js"></script>

</body>

</html> 

