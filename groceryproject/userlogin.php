<?php

// include '../components/connect.php';
include 'connect.php';

session_start();

if(isset($_POST['submit'])){

   $sql=mysqli_query($conn,"Select * from customer where mail='".$_POST["name"]."' AND pass='".$_POST['pass']."'");
   $num=mysqli_num_rows($sql);
   if($num > 0){
     $row=mysqli_fetch_array($sql);
     $_SESSION['user_id'] = $row['cid'];
      header('location:home.php');
      $message[] = 'Login sucessfull';
   }else{
      $message[] = 'incorrect username or password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="component.css">

</head>
<body>

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

<section class="form-container">

   <form action="" method="post">
      <h3>login now</h3>
      <!-- <p>default username = <span>admin</span> & password = <span>111</span></p> -->
      <input type="text" name="name" required placeholder="enter your mail id" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="enter your password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="login now" class="btn" name="submit">
      <p>don't have an account? <a href="register.php">register now</a></p>
   </form>

</section>
   
</body>
</html>