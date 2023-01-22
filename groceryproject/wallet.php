<?php

@include 'connect.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};



if(isset($_POST['add_to_wallet'])){

   $amt = $_POST['wallet'];
   $oldamt = $_POST['oldamt'];

   $bal=$amt+$oldamt;
   $q="update wallet set amt=$bal where cid='".$_SESSION['user_id']."'";
   $r=mysqli_query($conn,$q);

   $message[]="Wallet updated";

   
   }


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>wishlist</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="styles.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="wishlist">

   <h1 class="title">YOUR WALLET</h1>

   <div class="box-container">

   <?php
    $q="select * from wallet where cid='".$_SESSION['user_id']."'";
    $res=mysqli_query($conn,$q);
    $num=mysqli_num_rows($res);
    if($num==0)
    {
      $q1="insert into wallet set cid='".$_SESSION['user_id']."'";
      $r=mysqli_query($conn,$q1);
      $q2="select * from wallet where cid='".$_SESSION['user_id']."'";
      $res1=mysqli_query($conn,$q2);
      $row=mysqli_fetch_array($res1);
    }
    else{
    $row=mysqli_fetch_array($res);
    }
   ?>
   <form action="" method="POST" class="box">
      <div class="name">Wallet amount : <span><?php echo $row['amt']?></span></div>
   </form>
   <div>
   <form action="" method="POST" class="box">
      <!-- <input type="number" min="1" value="1" class="qty" name="p_qty"> -->
      <input type="textarea" name="wallet" class="box" placeholder="enter the amount to topup" required>
      <input type="hidden" name="oldamt" value="<?= $row['amt']; ?>">
      <!-- <a href="wallet.php?update_wal" class="option-btn">Add amount to wallet</a> -->
      <input type="submit" value="add to wallet" name="add_to_wallet" class="btn">
      
     
   </form>
   </div>
   <?php
    //   $grand_total += $fetch_wishlist['price'];

   ?>
   </div>

  

</section>








<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>