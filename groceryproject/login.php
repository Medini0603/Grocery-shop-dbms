<?php

// include '../components/connect.php';
include 'connect.php';

session_start();

if(isset($_POST['submit'])){

   
      header('location:admin_login.php');
      $message[] = 'Login sucessfull';

}
if(isset($_POST['submit1'])){

   
      header('location:userlogin.php');
      $message[] = 'Login sucessfull';

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
      <!-- <p>default username = <span>admin</span> & password = <span>111</span></p>
      <input type="text" name="name" required placeholder="enter your username" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="enter your password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')"> -->
      <input type="submit" value="login as admin" class="btn" name="submit">
      <input type="submit" value="login as user" class="btn" name="submit1">
   </form>

</section>
   
</body>
</html>