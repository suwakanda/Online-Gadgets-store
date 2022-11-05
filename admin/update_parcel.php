<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['update'])){
   $order_reference = $_POST['order_reference'];
   $parcel_id = $_POST['parcel_id'];
   $status = $_POST['status'];
   $status = filter_var($status, FILTER_SANITIZE_STRING);
   $update_parcels = $conn->prepare("UPDATE `parcels` SET status = ? WHERE reference_number = ?");
   $update_parcels->execute([$status, $order_reference]);

   $update_track = $conn->prepare("INSERT INTO parcel_tracks set status = ?,parcel_id = ?");
   $update_track->execute([$status, $parcel_id]);

   $update_order = $conn->prepare("UPDATE `orders` SET s_status = ? WHERE reference_number = ?");
   $update_order->execute([$status, $order_reference]);

   $message[] = 'status updated!';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>placed orders</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">
   


</head>
<body>
<?php include '../components/admin_header.php'; ?>

<section class="orders">

<h1 class="heading">Details orders</h1>

<div class="box-container">

   <?php
      $order_id = $_GET['order_id'];
      $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE id LIKE '%{$order_id}%' ");
      $select_orders->execute();
      if($select_orders->rowCount() > 0){
         $fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC);

      $select_parcel = $conn->prepare("SELECT * FROM `parcels` WHERE reference_number LIKE '%{$fetch_orders['reference_number']}%' ");
      $select_parcel->execute();
      $fetch_parcel = $select_parcel->fetch(PDO::FETCH_ASSOC)
         
   ?>
   <div class="box">
      <p> Reference No : <span><?= $fetch_orders['reference_number']; ?></span> </p>
      <p> placed on : <span><?= $fetch_orders['placed_on']; ?></span> </p>
      <p> name : <span><?= $fetch_orders['name']; ?></span> </p>
      <p> number : <span><?= $fetch_orders['number']; ?></span> </p>
      <p> address : <span><?= $fetch_orders['address']; ?></span> </p>
      <p> total products : <span><?= $fetch_orders['total_products']; ?></span> </p>
      <p> total price : <span>RM<?= $fetch_orders['total_price']; ?>/-</span> </p>
      <p> payment method : <span><?= $fetch_orders['method']; ?></span> </p>
      <form action="" method="post">
         <input type="hidden" name="order_reference" value="<?= $fetch_orders['reference_number']; ?>">
         <input type="hidden" name="parcel_id" value="<?= $fetch_parcel['id']; ?>">
			<select name="status" id="" class="select" required>
         <option selected disabled><?php 
							switch ($fetch_parcel['status']) {
								case '1':
									echo " Collected";
									break;
								case '2':
									echo " Shipped";
									break;
								case '3':
									echo " In-Transit";
									break;
								case '4':
									echo " Arrived At Destination";
									break;
								case '5':
									echo " Out for Delivery";
									break;
								case '6':
									echo " Ready to Pickup";
									break;
								case '7':
									echo " Delivered";
									break;
								case '8':
									echo " Picked-up";
									break;
								case '9':
									echo " Unsuccessfull Delivery Attempt";
									break;
								
								default:
									echo " Item Accepted by Courier";
									
									break;
							}

							?></option>
               <option value="0" >  Item Accepted by Courier </option>
					<option value="1" >  Collected </option>
               <option value="2" >  Shipped </option>
               <option value="3" >  In-Transit </option>
               <option value="4" >  Arrived At Destination </option>
               <option value="5" >  Out for Delivery </option>
               <option value="6" >  Ready to Pickup </option>
               <option value="7" >  Delivered </option>
               <option value="8" >  Picked-up </option>
               <option value="9" >  Unsuccessfull </option>
			</select>
        <div class="flex-btn">
         <input type="submit" value="update" class="option-btn" name="update">
         <a href="placed_orders.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('delete this order?');">delete</a>
        </div>
      </form>
   </div>
   <?php
         
      }else{
         echo '<p class="empty">order not found!!!</p>';
      }
   ?>

</div>

</section>


<script src="../js/admin_script.js"></script>

   
</body>
</html>