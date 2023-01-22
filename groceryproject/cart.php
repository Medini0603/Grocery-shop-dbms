<?php

@include 'connect.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_GET['delete'])){
   
   $pro_id = $_GET['delete'];
   $sql = mysqli_query($conn,"SELECT bid FROM basket WHERE cid = '".$_SESSION['user_id']."'");
   $row = mysqli_fetch_assoc($sql);
   $basket_id=$row['bid'];


   $delete_cart_item = "delete from pro_list where pid=$pro_id and bid=$basket_id";
   $del=mysqli_query($conn,$delete_cart_item);
   header('location:cart.php');
}

if(isset($_GET['delete_all'])){
   $sql = mysqli_query($conn,"SELECT bid FROM basket WHERE cid = '".$_SESSION['user_id']."'");
   $row = mysqli_fetch_assoc($sql);
   $basket_id=$row['bid'];

   $delete_cart_item = "delete from pro_list where bid=$basket_id";
   $del=mysqli_query($conn,$delete_cart_item);
   header('location:cart.php');
}

if(isset($_POST['update_qty'])){
   $bas_id = $_POST['bas_id'];
   $pro_id = $_POST['pro_id'];
   $p_qty = $_POST['p_qty'];
   $p_qty = filter_var($p_qty, FILTER_SANITIZE_STRING);
   $update_qty = "update pro_list set qnty=$p_qty where bid=$bas_id and pid=$pro_id";
   $up=mysqli_query($conn,$update_qty);
   $message[] = 'cart quantity updated';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shopping cart</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="styles.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="shopping-cart">

   <h1 class="title">products added</h1>

   <div class="box-container">

   <?php
      $grand_total = 0;
      $sql = mysqli_query($conn,"SELECT bid FROM basket WHERE cid = '".$_SESSION['user_id']."'");
      $row = mysqli_fetch_assoc($sql);
      $bidtemp=$row['bid'];
      // echo $bidtemp;
   
      $sql2 = mysqli_query($conn,"SELECT * FROM pro_list WHERE bid='".$bidtemp."'");
      $num=mysqli_num_rows($sql2);
    //   $row = mysqli_fetch_assoc($sql);
      if($num > 0){
         while($fetch_cart = mysqli_fetch_assoc($sql2)){ 
   ?>
   <form action="" method="POST" class="box">
      <a href="cart.php?delete=<?= $fetch_cart['pid']; ?>" class="fas fa-times" onclick="return confirm('delete this from cart?');"></a>
<?php
      $sql = "select pid,pname,price,compid from products where pid='".$fetch_cart['pid']."'";
      $result = mysqli_query($conn, $sql);

      $pro = mysqli_fetch_assoc($result)

?>


        <div class="details"><?= $pro['pid']; ?></div>
      <div class="price"><?= $pro['price']; ?>/-</div>
      <div class="name"><?= $pro['pname']; ?></div>


      <?php
        $sql1 = "select comname from company where comid='".$pro['compid']."'";
        $r = mysqli_query($conn, $sql1);
        // $c=mysqli_fetch_assoc($r);
        $catt=mysqli_fetch_array($r);
      ?>


      <div class="cat"><?php echo $catt['comname']?></div>

       <input type="hidden" name="bas_id" value="<?= $row['bid']; ?>"> 
       <input type="hidden" name="pro_id" value="<?= $pro['pid']; ?>">
      <div class="flex-btn">
         <input type="number" min="1" value="<?= $fetch_cart['qnty']; ?>" class="qty" name="p_qty">
         <input type="submit" value="update" name="update_qty" class="option-btn">
      </div>
      <div class="sub-total"> sub total : <span><?= $sub_total = ($pro['price'] * $fetch_cart['qnty']); ?>/-</span> </div>
         </form>
   <?php
       $grand_total += $sub_total;
      }
   }else{
      echo '<p class="empty">your cart is empty</p>';
   }
   ?>
  
</div>
   <div class="cart-total">
      <p>grand total : <span><?= $grand_total; ?>/-</span></p>
      <a href="shop.php" class="option-btn">continue shopping</a>
      <a href="cart.php?delete_all" class="delete-btn <?= ($grand_total > 1)?'':'disabled'; ?>">delete all</a>
      <a href="checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">proceed to checkout</a>
   </div>

</section>








<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>