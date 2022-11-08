<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['update_payment'])){
   $order_id = $_POST['order_id'];
   $payment_status = $_POST['payment_status'];
   $payment_status = filter_var($payment_status, FILTER_SANITIZE_STRING);
   $update_payment = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
   $update_payment->execute([$payment_status, $order_id]);
   $message[] = 'payment status updated!';
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Orders</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="stylesheet" href="assets/dataTables.bootstrap4.min.css">
   <link rel="stylesheet" href="assets/bootstrap.min.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>



<section class="table-product" >
<h1 class="heading">Orders</h1>
<div class="card " style="width: 100%;">

        <div class="card-header">
        <div class="card-body pr-2 pl-2">

          <table id="example" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                    <tr>
                      <th class="text-center">Reference Number</th>
                      <th  class="text-center">Name</th>
                      <th  class="text-center">Email</th>
                      <th  class="text-center">Phone</th> 
                      <th  class="text-center">Total_products</th> 
                      <th  class="text-center">Total_price</th> 
                      <th  class="text-center">Status</th> 
                      <th  class="text-center">Placed_on</th>
                      <th  width='25%' class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                     $status = $_GET['status'];
                     $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE s_status LIKE '%{$status}%' ");
                     $select_orders->execute();
                     
                     if($select_orders->rowCount() > 0){
                        while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){  
                           $select_parcel= $conn->prepare("SELECT * FROM `parcels` WHERE reference_number LIKE '%{$fetch_orders['reference_number']}%'");
                           $select_parcel->execute(); 
                           $fetch_parcel = $select_parcel->fetch(PDO::FETCH_ASSOC)
                  ?>
                  
                  <tr class="text-center">
                  
                    <td><?php echo $fetch_orders['reference_number'];?></td>
                    <td><?php echo $fetch_orders['name'];?></td>
                    
                    <td><?php echo $fetch_orders['email']; ?></td>
                    <td><?php echo $fetch_orders['number']; ?></td>
                    <td><?php echo $fetch_orders['total_products']; ?></td>
                    <td><?php echo $fetch_orders['total_price']; ?></td>
                    <td><?php 
							switch ($fetch_parcel['status']) {
								case '1':
									echo "<span class='badge badge-pill badge-info'> Collected</span>";
									break;
								case '2':
									echo "<span class='badge badge-pill badge-info'> Shipped</span>";
									break;
								case '3':
									echo "<span class='badge badge-pill badge-primary'> In-Transit</span>";
									break;
								case '4':
									echo "<span class='badge badge-pill badge-primary'> Arrived At Destination</span>";
									break;
								case '5':
									echo "<span class='badge badge-pill badge-primary'> Out for Delivery</span>";
									break;
								case '6':
									echo "<span class='badge badge-pill badge-primary'> Ready to Pickup</span>";
									break;
								case '7':
									echo "<span class='badge badge-pill badge-success'>Delivered</span>";
									break;
								case '8':
									echo "<span class='badge badge-pill badge-success'> Picked-up</span>";
									break;
								case '9':
									echo "<span class='badge badge-pill badge-danger'> Unsuccessfull Delivery Attempt</span>";
									break;
								
								default:
									echo "<span class='badge badge-pill badge-info'> Item Accepted by Courier</span>";
									
									break;
							}

							?></td>
                    <td><span class="badge badge-lg badge-secondary text-white"><?php echo  $fetch_orders['placed_on'];  ?></span></td>
                   
                    <td>
                    <a class="btn btn-success btn-sm" href="update_parcel.php?order_id=<?php echo $fetch_orders['id'];?>">Update</a>
                    <a class="btn btn-info btn-sm" href="select_track.php?track_id=<?php echo $fetch_orders['reference_number'];?>">Traking</a>
                    </td>
                     
                  
                  <?php }?>
                  <?php }else{
                     echo '<p class="empty">no pracels placed yet!</p>';
                  }?>
                  
                  
                  </tr>
                  </tbody>

                  
          </table>
        </div>
        </div>
</div>
</section>












<script src="../js/admin_script.js"></script>
 <!-- Jquery script -->
 <script src="assets/jquery.min.js"></script>
  <script src="assets/bootstrap.min.js"></script>
  <script src="assets/jquery.dataTables.min.js"></script>
  <script src="assets/dataTables.bootstrap4.min.js"></script>
  <script>
      $(document).ready(function () {
          $("#flash-msg").delay(7000).fadeOut("slow");
      });

      $(document).ready(function() {
          $('#example').DataTable();
          
      } );
      
      
  </script>
   
</body>
</html>