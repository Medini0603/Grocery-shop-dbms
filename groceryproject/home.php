<?php

@include 'connect.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};


if(isset($_POST['add_to_basket'])){

   $pid = $_POST['pid'];
   $price = $_POST['price'];
   // $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $p_qty = $_POST['p_qty'];
   // $p_qty = filter_var($p_qty, FILTER_SANITIZE_STRING);

   $sql = mysqli_query($conn,"SELECT bid FROM basket WHERE cid = '".$_SESSION['user_id']."'");
   $row = mysqli_fetch_assoc($sql);
   $bidtemp=$row['bid'];
   // echo $bidtemp;

   $sql2 = mysqli_query($conn,"SELECT * FROM pro_list WHERE bid=$bidtemp and pid='".$_POST['pid']."'");
   $num=mysqli_num_rows($sql2);

   $r = mysqli_fetch_assoc($sql2);
   $qt;
   if($num > 0 ){
      $qt=$r['qnty'];
      if($qt>$p_qty){
      $message[] = 'product already exists in the basket';}
   
   elseif($qt<$p_qty){
      $pt=$r['cost'];
      $p=$p_qty*$price;
      $query = mysqli_query($conn,"UPDATE pro_list set qnty=$p_qty, cost=$p where bid=$bidtemp and pid='".$_POST['pid']."'");
      $message[] ='Updating the quantity of the product';
   }
}
   else{
      // $query = mysqli_query($conn,"INSERT INTO pro_list SET bid=$bidtemp");
      $p=$p_qty*$price;
      $query = mysqli_query($conn,"INSERT INTO pro_list SET bid=$bidtemp, pid ='".$_POST["pid"]."',qnty ='".$_POST["p_qty"]."',cost=$p");
      $message[]='Product added to basket';

   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="styles.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="home-bg">

   <section class="home">

      <div class="content">
         <span>don't panic, go organic</span>
         <h3>Reach For A Healthier You With Organic Foods</h3>
         <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto natus culpa officia quasi, accusantium explicabo?</p>
         <a href="about.php" class="btn">about us</a>
      </div>

   </section>

</div>

<section class="home-category">

   <h1 class="title">shop by category</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/cat-1.png" alt="">
         <h3>fruits</h3>
         <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem, quaerat.</p>
         <a href="category.php?category=fruits" class="btn">fruits</a>
      </div>

      <div class="box">
         <img src="images/cat-2.png" alt="">
         <h3>vegetables</h3>
         <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem, quaerat.</p>
         <a href="category.php?category=veggies" class="btn">Vegetables</a>
      </div>

      <div class="box">
         <img src="images/cat-3.jpg" alt="">
         <h3>cereals and pulses</h3>
         <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem, quaerat.</p>
         <a href="category.php?category=pulses" class="btn">Cereals</a>
      </div>

      <div class="box">
         <img src="images/cat-4.jpg" alt="">
         <h3>Snacks</h3>
         <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem, quaerat.</p>
         <a href="category.php?category=snacks" class="btn">Snacks</a>
      </div>

   </div>

</section>

<section class="products">

   <h1 class="title">latest products</h1>

   <div class="box-container">

   <?php
$sql = "select pid,pname,price,compid from products";
$result = mysqli_query($conn, $sql);
$c=1;
if (mysqli_num_rows($result) > 0 ) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result) and $c<=3) {
    // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    $c++;
    ?>
       <form action="" class="box" method="POST">
    <div class="box">
        <div class="details"><?= $row['pid']; ?></div>
      <div class="price"><?= $row['price']; ?>/-</div>
      <div class="name"><?= $row['pname']; ?></div>


      <?php
        $sql1 = "select comname from company where comid='".$row['compid']."'";
        $r = mysqli_query($conn, $sql1);
        // $c=mysqli_fetch_assoc($r);
        $catt=mysqli_fetch_array($r);
      ?>
      <div class="cat"><?php echo $catt['comname']?></div>

      
      <input type="hidden" name="pid" value="<?= $row['pid']; ?>">
      <input type="hidden" name="price" value="<?= $row['price']; ?>">
      <input type="number" min="1" value="1" name="p_qty" class="qty">
      <input type="submit" value="add to basket" class="btn" name="add_to_basket">
      </form>
   </div>
  
<?php
}
} else {
  echo "0 results";
}?>
  </div>
</section>







<?php include 'footer.php'; ?>

<!-- <script src="js/script.js"></script> -->

</body>
</html>