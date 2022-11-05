<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>dashboard</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="dashboard">

   <h1 class="heading">dashboard</h1>

   <div class="box-container">

      <div class="box">
         <?php
            $select_users = $conn->prepare("SELECT * FROM `parcels` WHERE status='0'");
            $select_users->execute();
            $number_of_users = $select_users->rowCount()
         ?>
         <h3><?= $number_of_users; ?></h3>
         <p>Item Accepted by Courier</p>
         <a href="filter_parcel.php?status=0" class="normal-btn">view</a>
      </div>

      <div class="box">
         <?php
            $select_users = $conn->prepare("SELECT * FROM `parcels` WHERE status='1'");
            $select_users->execute();
            $number_of_users = $select_users->rowCount()
         ?>
         <h3><?= $number_of_users; ?></h3>
         <p>Collected</p>
         <a href="filter_parcel.php?status=1" class="normal-btn">view</a>
      </div>

      <div class="box">
         <?php
            $select_users = $conn->prepare("SELECT * FROM `parcels` WHERE status='2'");
            $select_users->execute();
            $number_of_users = $select_users->rowCount()
         ?>
         <h3><?= $number_of_users; ?></h3>
         <p>Shipped</p>
         <a href="filter_parcel.php?status=2" class="normal-btn">view</a>
      </div>

      <div class="box">
         <?php
            $select_users = $conn->prepare("SELECT * FROM `parcels` WHERE status='3'");
            $select_users->execute();
            $number_of_users = $select_users->rowCount()
         ?>
         <h3><?= $number_of_users; ?></h3>
         <p>In-Transit</p>
         <a href="filter_parcel.php?status=3" class="normal-btn">view</a>
      </div>

      <div class="box">
         <?php
            $select_users = $conn->prepare("SELECT * FROM `parcels` WHERE status='4'");
            $select_users->execute();
            $number_of_users = $select_users->rowCount()
         ?>
         <h3><?= $number_of_users; ?></h3>
         <p>Arrived At Destination</p>
         <a href="filter_parcel.php?status=4" class="normal-btn">view</a>
      </div>

      <div class="box">
         <?php
            $select_users = $conn->prepare("SELECT * FROM `parcels` WHERE status='5'");
            $select_users->execute();
            $number_of_users = $select_users->rowCount()
         ?>
         <h3><?= $number_of_users; ?></h3>
         <p>Out for Delivery</p>
         <a href="filter_parcel.php?status=5" class="normal-btn">view</a>
      </div>

      <div class="box">
         <?php
            $select_users = $conn->prepare("SELECT * FROM `parcels` WHERE status='6'");
            $select_users->execute();
            $number_of_users = $select_users->rowCount()
         ?>
         <h3><?= $number_of_users; ?></h3>
         <p>Ready to Pickup</p>
         <a href="filter_parcel.php?status=6" class="normal-btn">view</a>
      </div>

      <div class="box">
         <?php
            $select_users = $conn->prepare("SELECT * FROM `parcels` WHERE status='7'");
            $select_users->execute();
            $number_of_users = $select_users->rowCount()
         ?>
         <h3><?= $number_of_users; ?></h3>
         <p>Delivered</p>
         <a href="filter_parcel.php?status=7" class="normal-btn">view</a>
      </div>

      <div class="box">
         <?php
            $select_users = $conn->prepare("SELECT * FROM `parcels` WHERE status='8'");
            $select_users->execute();
            $number_of_users = $select_users->rowCount()
         ?>
         <h3><?= $number_of_users; ?></h3>
         <p>Picked-up</p>
         <a href="filter_parcel.php?status=8" class="normal-btn">view</a>
      </div>
      
      <div class="box">
         <?php
            $select_users = $conn->prepare("SELECT * FROM `parcels` WHERE status='9'");
            $select_users->execute();
            $number_of_users = $select_users->rowCount()
         ?>
         <h3><?= $number_of_users; ?></h3>
         <p>Unsuccessfull Delivery Attempt</p>
         <a href="filter_parcel.php?status=9" class="normal-btn">view</a>
      </div>

      

   </div>

</section>



<script src="../js/admin_script.js"></script>
   
</body>
</html>

