<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="orders">

   <h1 class="heading">placed orders</h1>

   <div class="box-container">

   <?php
      if($user_id == ''){
         echo '<p class="empty">please login to see your orders</p>';
      }else{
         $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
         $select_orders->execute([$user_id]);
         if($select_orders->rowCount() > 0){
            while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p>Reference No : <span><?= $fetch_orders['reference_number']; ?></span></p>
      <p>placed on : <span><?= $fetch_orders['placed_on']; ?></span></p>
      <p>name : <span><?= $fetch_orders['name']; ?></span></p>
      <p>email : <span><?= $fetch_orders['email']; ?></span></p>
      <p>number : <span><?= $fetch_orders['number']; ?></span></p>
      <p>address : <span><?= $fetch_orders['address']; ?></span></p>
      <p>payment method : <span><?= $fetch_orders['method']; ?></span></p>
      <p>your orders : <span><?= $fetch_orders['total_products']; ?></span></p>
      <p>total price : <span>RM<?= $fetch_orders['total_price']; ?>/-</span></p>
      <p>status : <span style="color:<?php if($fetch_orders['status'] == '1'){ echo 'green'; }else{ echo 'orange'; }; ?>"><?php if($fetch_orders['status'] == '1'){ echo 'Done'; }else{ echo 'Pending'; }; ?></span> </p>
      
      <?php $select_parcel = $conn->prepare("SELECT * FROM `parcels` WHERE reference_number = ? ");
		$select_parcel->execute([$fetch_orders['reference_number']]);
		$row = $select_parcel->fetch(PDO::FETCH_ASSOC);
		if($select_parcel->rowCount() > 0){
			
			$parcel_id=$row['id'];
			$history = $conn->prepare("SELECT * FROM parcel_tracks WHERE parcel_id LIKE '%{$parcel_id}%' ORDER BY status DESC ");
			$history->execute();
         $fetch_history = $history->fetch(PDO::FETCH_ASSOC)
      ?>
      
      <p>tracking parcel: <span><a href="user_select_track.php?track_id=<?php echo $fetch_orders['reference_number'];?>">
   
      <?php 
							switch ($fetch_history['status']) {
								case '0':
									echo " Item Accepted by Courier";
									break;
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
							}?>
   
   
   
   
   </a></span></p>
   </div>
   <?php
      }
      }
      }else{
         echo '<p class="empty">no orders placed yet</p>';
      }
      }
   ?>

   </div>

</section>













<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>