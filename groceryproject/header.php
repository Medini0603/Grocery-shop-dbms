<?php

if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}

?>

<header class="header">

   <div class="flex">

      <a href="home.php" class="logo">Groco<span>.</span></a>

      <nav class="navbar">
         <a href="home.php">home</a>
         <a href="shop.php">shop</a>
         <a href="orders.php">orders</a>
         <a href="wallet.php">wallet</a>
         <a href="about.php">about</a>
         <a href="contact.php">contact</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user" onclick="toggleContent()"></div>
         <!-- <a href="search_page.php" class="fas fa-search"></a> -->

         <?php
         $sql = mysqli_query($conn,"SELECT bid FROM basket WHERE cid = '".$_SESSION['user_id']."'");
         $row = mysqli_fetch_assoc($sql);
         $bidtemp=$row['bid'];
         
            $qu="select count(*) from pro_list where bid=$bidtemp";
            $select_pendings = mysqli_query($conn,$qu);
            $row=mysqli_fetch_array($select_pendings);
         ?>
         <a href="cart.php"><i class="fas fa-shopping-cart"></i><span><?php echo $row['count(*)']?></span></a>
      </div>

     
      <div id= "content" class="profile" >
      <?php
            // include 'connect.php';
            $sql=mysqli_query($conn,"Select * from customer where cid='".$_SESSION['user_id']."'");
   $num=mysqli_num_rows($sql);
   if($num > 0){

     $row=mysqli_fetch_array($sql);
     }
     ?>
     <p>Name: <?php echo $row['cname']; ?></p>
         <a href="update.php" class="btn">update profile</a>
         <a href="logout.php" class="delete-btn">logout</a>
         <div class="flex-btn">
            <a href="login.php" class="option-btn">login</a>
            <a href="register.php" class="option-btn">register</a>
         </div>
      </div>

      <script>
   function toggleContent() {
  // Get the DOM reference
  var contentId = document.getElementById("content");
  // Toggle 
  contentId.style.display == "block" ? contentId.style.display = "none" : 
contentId.style.display = "block"; 
}
</script>
      <!-- <input type="submit" value="View profile" class="btn" name="prof"> -->
   </div>

   </div>

</header>