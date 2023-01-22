<?php

@include 'connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
//    $delete_id = $_GET['delete'];
   // echo $delete_id;
   $qu="delete from customer where cid=$delete_id";
   $del=mysqli_query($conn,$qu);
   header('location:admin_users.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>users</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="user-accounts">

   <h1 class="title">user accounts</h1>

   <div class="box-container">

   <?php
$sql = "select cid,cname,mail,address,numbers from customer";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    ?>
      <div class="box">
         <!-- <img src="uploaded_img/<?= $fetch_users['image']; ?>" alt=""> -->
         <p> user id : <span><?= $row['cid']; ?></span></p>
         <p> username : <span><?= $row['cname']; ?></span></p>
         <p> email : <span><?= $row['mail']; ?></span></p>
         <p> address : <span><?= $row['address']; ?></span></p>
         <p> number : <span><?= $row['numbers']; ?></span></p>
         <!-- <p> email : <span><?= $row['mail']; ?></span></p> -->
         
         <a href="admin_users.php?delete=<?= $row['cid']; ?>" onclick="return confirm('delete this user?');" class="delete-btn">delete</a>
      </div>
      <?php
}
} else {
  echo "0 results";
}
?>
   </div>

</section>













<script src="js/script.js"></script>

</body>
</html>