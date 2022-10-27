<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_user = $conn->prepare("DELETE FROM `users` WHERE id = ?");
   $delete_user->execute([$delete_id]);
   $delete_orders = $conn->prepare("DELETE FROM `orders` WHERE user_id = ?");
   $delete_orders->execute([$delete_id]);
   $delete_messages = $conn->prepare("DELETE FROM `messages` WHERE user_id = ?");
   $delete_messages->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
   $delete_cart->execute([$delete_id]);
   $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE user_id = ?");
   $delete_wishlist->execute([$delete_id]);
   header('location:users_accounts.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>users accounts</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">
   <link rel="stylesheet" href="assets/dataTables.bootstrap4.min.css">
   <link rel="stylesheet" href="assets/bootstrap.min.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>


<section class="table-product" >
<h1 class="heading">user accounts</h1>
<div class="card " style="width: 100%;">

        <div class="card-header">
        <div class="card-body pr-2 pl-2">

          <table id="example" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                    <tr>
                      <th class="text-center">User id</th>
                      <th  class="text-center">Name</th>
                      <th  class="text-center">Email</th>
                      <th  class="text-center">Phone</th> 
                      <th  width='25%' class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                     $select_accounts = $conn->prepare("SELECT * FROM `users`");
                     $select_accounts->execute();
                     if($select_accounts->rowCount() > 0){
                        while($fetch_accounts = $select_accounts->fetch(PDO::FETCH_ASSOC)){   
                  ?>
                  
                  <tr class="text-center">
                  
                    <td><?php echo $fetch_accounts['id'];?></td>
                    <td><?php echo $fetch_accounts['name'];?></td>
                    
                    <td><?php echo $fetch_accounts['email']; ?></td>
                    <td><?php echo $fetch_accounts['phone']; ?></td>
                   
                    <td>
                     <a onclick="return confirm('Are you sure To Delete ? The user related information will also be delete!')" class="btn btn-danger btn-sm " href="users_accounts.php?delete=<?= $fetch_accounts['id']; ?>">Remove</a>     
                    </td>
                     
                  
                  <?php }?>
                  <?php }else{
                     echo '<p class="empty">no accounts available!</p>';
                  }?>
                  
                  
                  </tr>
                  </tbody>

                  
          </table>
        </div>
        </div>
</div>
</section>



<section class="table-product" >
<h1 class="heading">admin accounts</h1>
<div class="card " style="width: 100%;">

        <div class="card-header">
        <div class="card-body pr-2 pl-2">

          <table id="example" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                    <tr>
                      <th class="text-center">User id</th>
                      <th  class="text-center">Name</th>

                      <th  width='25%' class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                     $select_accounts = $conn->prepare("SELECT * FROM `admins`");
                     $select_accounts->execute();
                     if($select_accounts->rowCount() > 0){
                        while($fetch_accounts = $select_accounts->fetch(PDO::FETCH_ASSOC)){   
                  ?>
                  
                  <tr class="text-center">
                  
                    <td><?php echo $fetch_accounts['id'];?></td>
                    <td><?php echo $fetch_accounts['name'];?></td>
                    
                    
                   
                    <td>
                     <a onclick="return confirm('Are you sure To Delete ? The user related information will also be delete!')" class="btn btn-danger btn-sm " href="users_accounts.php?delete=<?= $fetch_accounts['id']; ?>">Remove</a>     
                    </td>
                     
                  
                  <?php }?>
                  <?php }else{
                     echo '<p class="empty">no accounts available!</p>';
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