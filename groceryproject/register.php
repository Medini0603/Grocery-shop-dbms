<?php

include 'connect.php';

if(isset($_POST['submit'])){

   $name = $_POST['name'];
//    $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
//    $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = md5($_POST['pass']);
//    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = md5($_POST['cpass']);
//    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);
   $add = $_POST['add'];
   $num = $_POST['num'];

   $sql = mysqli_query($conn,"SELECT * FROM customer WHERE mail = '".$_POST['email']."'");
   $num=mysqli_num_rows($sql);

   if($num > 0){
      $message[] = 'user email already exist!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
        $query = mysqli_query($conn,"INSERT INTO customer SET cname='". $_POST["name"] . "',mail = '". $_POST["email"] . "',address='". $_POST["add"] . "', numbers= '". $_POST["num"] . "',pass='". $_POST["pass"] . "'");

        $q=mysqli_query($conn,"SELECT cid from customer where mail='".$_POST['email']."'");
        $n=mysqli_num_rows($q);
        $row = mysqli_fetch_assoc($q);
        $cidtemp=$row['cid'];
        $query2 = mysqli_query($conn,"INSERT INTO basket SET cid=$cidtemp");
               $message[] = 'registered successfully!';
               echo("Registered successfully");
               header('location:userlogin.php');
            }
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
      <h3>register now</h3>
      <input type="text" name="name" class="box" placeholder="enter your name" required>
      <input type="email" name="email" class="box" placeholder="enter your email" required>
      <input type="password" name="pass" class="box" placeholder="enter your password" required>
      <input type="password" name="cpass" class="box" placeholder="confirm your password" required>
      <input type="text" name="add" class="box" placeholder="enter your address" required>
      <input type="text" name="num" class="box" placeholder="enter your phone number" required>
      <input type="submit" value="register now" class="btn" name="submit">
      <p>already have an account? <a href="userlogin.php">login now</a></p>
   </form>

</section>


</body>
</html>