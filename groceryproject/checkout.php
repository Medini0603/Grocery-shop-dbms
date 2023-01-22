<?php

@include 'connect.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['order'])){

   $cid=$_SESSION['user_id'];
   $name = $_POST['name'];
   // $name = filter_var($name, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   // $number = filter_var($number, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   // $email = filter_var($email, FILTER_SANITIZE_STRING);
   $method = $_POST['method'];
   // $method = filter_var($method, FILTER_SANITIZE_STRING);
   $address = $_POST['address'];
   // $address = filter_var($address, FILTER_SANITIZE_STRING);
   // $placed_on = date('d-M-Y');

   $total = $_POST['total'];
   $q="insert into orders (cid,oamt) values ($cid,$total)";
   $qe=mysqli_query($conn,$q);

   $tq="select oid from orders where cid=$cid and oamt=$total and odate='".date("Y-m-d")."'";
   $qe1=mysqli_query($conn,$tq);
   $r=mysqli_fetch_array($qe1);
   $oid=$r['oid'];



      $sql = mysqli_query($conn,"SELECT bid FROM basket WHERE cid = '".$_SESSION['user_id']."'");
      $row = mysqli_fetch_assoc($sql);
      $bidtemp=$row['bid'];
   
      $sql2 = mysqli_query($conn,"SELECT * FROM pro_list WHERE bid='".$bidtemp."'");
      $num=mysqli_num_rows($sql2);
      if($num > 0){
         while($fetch_cart = mysqli_fetch_assoc($sql2)){ 


      $sql = "select pname,price from products where pid='".$fetch_cart['pid']."'";
      $result = mysqli_query($conn, $sql);
      $pro = mysqli_fetch_assoc($result);

      $q1="insert into orderitem values ($oid,'".$pro['pname']."','".$fetch_cart['qnty']."','".$pro['price']."')";
      $qe1=mysqli_query($conn,$q1);
      }

   }else{
      echo '<p class="empty">your cart is empty</p>';
   }

   $q2="insert into odetails values ($oid,'".$_POST['name']."','".$_POST['email']."','".$_POST['method']."','".$_POST['address']."')";
   $qe2=mysqli_query($conn,$q2);
   $message[] = 'order placed successfully!';

   $delete_cart_item = "delete from pro_list where bid=$bidtemp";
   $del=mysqli_query($conn,$delete_cart_item);


// aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
   

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="styles.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="display-orders">
<!-- <section class="shopping-cart"> -->
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
<?php
      $sql = "select pid,pname,price,compid from products where pid='".$fetch_cart['pid']."'";
      $result = mysqli_query($conn, $sql);

      $pro = mysqli_fetch_assoc($result)

?>

      <?php
        $sql1 = "select comname from company where comid='".$pro['compid']."'";
        $r = mysqli_query($conn, $sql1);
        $catt=mysqli_fetch_array($r);
      ?>

<p> <?= $pro['pname']; ?> <span>(<?= $pro['price'].'/- x '. $fetch_cart['qnty']; ?>)</span> </p>
      <div class="sub-total"> sub total : <span><?= $sub_total = ($pro['price'] * $fetch_cart['qnty']); ?>/-</span> </div>
         </form>
         
   <?php
       $grand_total += $sub_total;
      }

   }else{
      echo '<p class="empty">your cart is empty</p>';
   }
   ?>

<div class="grand-total">grand total : <span><?= $grand_total; ?>/-</span></div> 
</section>

<section class="checkout-orders">

   <form action="" method="POST">

      <h3>place your order</h3>
<?php
$qu = mysqli_query($conn,"SELECT * FROM customer WHERE cid = '".$_SESSION['user_id']."'");
$ro = mysqli_fetch_assoc($qu);
?>
      <div class="flex">
         <div class="inputBox">
            <span>your name :</span>
            <input type="text" name="name" value=<?=$ro['cname']?> class="box" required>
         </div>
         <div class="inputBox">
            <span>your number :</span>
            <input type="number" name="number" value=<?=$ro['numbers']?> class="box" required>
         </div>
         <div class="inputBox">
            <span>your email :</span>
            <input type="email" name="email" value=<?=$ro['mail']?> class="box" required>
         </div>
         <div class="inputBox">
            <span>payment method :</span>
            <select name="method" class="box" required>
               <option value="cash on delivery">cash on delivery</option>
               <option value="credit card">credit card</option>
               <option value="paytm">wallet</option>
            </select>
         </div>
         <div class="inputBox">
            <span>address :</span>
            <input type="textarea" name="address" value=<?=$ro['address']?> class="box" required>
         </div>
      </div>
      <input type="hidden" name="total" value="<?= $grand_total; ?>">
      <input type="submit" name="order" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>" value="place order">

   </form>

</section>








<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>