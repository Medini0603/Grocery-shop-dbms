<?php
@include 'connect.php';

session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login.php');
 };

 if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $old = $_POST['old'];
    $pass = md5($_POST['pass']);
    $cpass = md5($_POST['cpass']);
    $mail=$_POST['email'];
    $addr=$_POST['add'];
    $num=$_POST['num'];

 $sql=mysqli_query($conn,"Select * from customer where cid='".$_SESSION['user_id']."'");
$num=mysqli_num_rows($sql);
$row=mysqli_fetch_array($sql);
$old_pass = $row["pass"];
    if($old != $old_pass){
       $message[] = 'old password not matched!';
    }elseif($pass != $cpass){
       $message[] = 'confirm password not matched!';
    }else{
      $update=mysqli_query($conn,"UPDATE customer set cname='".$_POST['name']."', pass='".$_POST['cpass']."',mail='".$_POST['email']."',address='".$_POST['add']."',numbers='".$_POST['num']."' where cid='".$_SESSION['user_id']."'");
       $message[] = 'password updated successfully!';
    }


 }

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
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

   <form action="" enctype="multipart/form-data" method="POST">
      <h3>update now</h3>
      <input type="text" name="name" class="box" placeholder="enter your name" required>
      <input type="password" name="old" class="box" placeholder="enter your old password" required>
      <input type="password" name="pass" class="box" placeholder="enter your new password" required>
      <input type="password" name="cpass" class="box" placeholder="confirm your password" required>
      <input type="email" name="email" class="box" placeholder="enter your email" required>
      <input type="text" name="add" class="box" placeholder="enter your address" required>
      <input type="text" name="num" class="box" placeholder="enter your phone number" required>
      <input type="submit" value="UPDATE PROFILE" class="btn" name="submit">
      <!-- <p>GO BACK <a href="userlogin.php">login now</a></p> -->
      <div class="flex-btn">
         <!-- <input type="submit" class="btn" value="update profile" name="update_profile"> -->
         <a href="admin_home.php" class="option-btn">go back</a>
      </div>
   </form>

</section>


</body>
</html>