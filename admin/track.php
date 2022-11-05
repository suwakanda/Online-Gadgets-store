<?php include '../components/connect.php';


session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <title>Tracking</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  
  <!-- Theme style -->
  <link rel="stylesheet" href="../css/admin_style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="assets/bootstrap.min.css">
  
</head>



<body>
<?php include '../components/admin_header.php'; ?>

<section class="table-product">

   <h1 class="heading">Tracking parcel</h1>


<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-body">
			<div class="d-flex w-100 px-1 py-2 justify-content-center align-items-center">
				<label for="">Enter Tracking Number</label>
				<div class="input-group col-sm-5">
				<form action="" method="post">
                    <input type="search" id="ref_no" name="ref_no" class="form-control form-control-sm" placeholder="Type the tracking number here">
                    
                        <button type="submit"  class="btn btn-sm btn-primary btn-gradient-primary " name="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    
				</form>
                </div>
			</div>
		</div>
	</div>
	
</div>

				<div class="container ">
				<div class="row">
				<div class="col-md-8 offset-md-2">
				<div class="timeline">
				<?php

if(isset($_POST['submit'])){
		$ref_no = $_POST['ref_no'];
		$select_parcel = $conn->prepare("SELECT * FROM `parcels` WHERE reference_number = ? ");
		$select_parcel->execute([$ref_no]);
		$row = $select_parcel->fetch(PDO::FETCH_ASSOC);
		if($select_parcel->rowCount() > 0){
			
			$id=$row['id'];
			$history = $conn->prepare("SELECT * FROM parcel_tracks where parcel_id LIKE '%{$id}%' ORDER BY status ASC ");
			$history->execute();
			
			if($history->rowCount() > 0){
			while($fetch_history = $history->fetch(PDO::FETCH_ASSOC)){
				?>
				<div class="iitem">
				<!-- Before each timeline item corresponds to one icon on the left scale -->
					<i class="fas fa-box bg-blue"></i>
					<!-- Timeline item -->
					<div class="timeline-item">
					<!-- Time -->
					<span class="time"><i class="fas fa-clock"></i> <?php echo $fetch_history['date_created'] ?></span>
					
					<!-- Body -->
					<div class="timeline-body">

					
					<?php 
							switch ($fetch_history['status']) {
								case '0':
									echo "<span > Item Accepted by Courier</span>";
									break;
								case '1':
									echo "<span > Collected</span>";
									break;
								case '2':
									echo "<span > Shipped</span>";
									break;
								case '3':
									echo "<span > In-Transit</span>";
									break;
								case '4':
									echo "<span > Arrived At Destination</span>";
									break;
								case '5':
									echo "<span > Out for Delivery</span>";
									break;
								case '6':
									echo "<span > Ready to Pickup</span>";
									break;
								case '7':
									echo "<span >Delivered</span>";
									break;
								case '8':
										echo "<span > Picked-up</span>";
										break;
								case '9':
										echo "<span > Unsuccessfull Delivery Attempt</span>";
										break;
								
								default:
									echo "<span> Item Accepted by Courier</span>";
									
									break;
							}?>
					<!-- close timeline-body-->
					</div>
					
					<!-- close timeline-item-->
					</div>
					
					<!-- close iitem-->
				</div>
				<?php
									}
								}
								

								}else{
									echo '<p class="empty">No pracel found !</p>';
								}
						?>
							
							<?php }?>
				
				
	  
		</div>
						
				</div>
				
				
						</div>
						
				</div>

				
	  
</section>