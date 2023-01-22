<?php

if(isset($_POST['prof'])){

   
   header('location:prof.php');
   // $message[] = 'Login sucessfull';

}

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
<!-- <script src="script.js"></script> -->
   <div class="flex">

      <a href="admin_home.php" class="logo">Admin<span>Panel</span></a>

      <nav class="navbar">
         <a href="admin_home.php">home</a>
         <a href="admin_products.php">products</a>
         <a href="admin_orders.php">orders</a>
         <a href="admin_users.php">users</a>
         <!-- <a href="admin_contacts.php">messages</a> -->
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user" onclick="toggleContent()"></div>
         <!-- <button onclick="myFunction()" id="user-btn">View profile</button> -->
      </div>

      <div id= "content" class="profile" >
      <?php
            // include 'connect.php';
            $sql=mysqli_query($conn,"Select * from admins where id='".$_SESSION['admin_id']."'");
   $num=mysqli_num_rows($sql);
   if($num > 0){

     $row=mysqli_fetch_array($sql);
     }
     ?>
     <p>Name: <?php echo $row['aname']; ?></p>
         <a href="admin_update.php" class="btn">update profile</a>
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

</header>