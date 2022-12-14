<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:user_login.php');
};

if(isset($_POST['order'])){
   $ref = sprintf("%'012d",mt_rand(0, 999999999999));
   
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $method = $_POST['method'];
   $method = filter_var($method, FILTER_SANITIZE_STRING);
   $address = $_POST['flat'] .', '. $_POST['street'] .', '. $_POST['city'] .', '. $_POST['state'] .', '. $_POST['country'] .' ， '. $_POST['pin_code'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);
   $total_products = $_POST['total_products'];
   $total_price = $_POST['total_price'];

   $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
   $check_cart->execute([$user_id]);
   


   if($check_cart->rowCount() > 0){

      $insert_order = $conn->prepare("INSERT INTO `orders`(user_id,reference_number, name, number, email, method, address, total_products, total_price) VALUES(?,?,?,?,?,?,?,?,?)");
      $insert_order->execute([$user_id,$ref, $name, $number, $email, $method, $address, $total_products, $total_price]);

      $insert_parcel = $conn->prepare("INSERT INTO `parcels`(reference_number, status) VALUES(?,0)");
      $insert_parcel->execute([$ref]);
      $check_parcels = $conn->prepare("SELECT * FROM `parcels` WHERE reference_number = ?");
      $check_parcels->execute([$ref]);
      $fetch_parcels= $check_parcels->fetch(PDO::FETCH_ASSOC);
      $insert_tracking = $conn->prepare("INSERT INTO `parcel_tracks`(parcel_id, status) VALUES(?,0)");
      $insert_tracking->execute([$fetch_parcels['id']]);

      $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
      $delete_cart->execute([$user_id]);

      $message[] = 'order placed successfully!';
   }else{
      $message[] = 'your cart is empty';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">



</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="checkout-orders">

   <form action="" method="POST">

   <h3>your orders</h3>

      <div class="display-orders">
      <?php
         $total=0;
         $grand_total = 0;
         $discount_total = 0;
         $cart_items[] = '';
         $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
         $select_cart->execute([$user_id]);
         if($select_cart->rowCount() > 0){
            while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
               $discountRate = $fetch_cart['discount']/100;
               $cart_items[] = $fetch_cart['name'].' ('.$fetch_cart['price'].' x '. $fetch_cart['quantity'].') - ';
               $total_products = implode($cart_items);
               $total += ($fetch_cart['price'] * $fetch_cart['quantity']);
               $grand_total += (($fetch_cart['price']-($fetch_cart['price']* $discountRate)) * $fetch_cart['quantity']);
               $discount_total += (($fetch_cart['price']* $discountRate) * $fetch_cart['quantity']);
      ?>
         <p> <?= $fetch_cart['name']; ?> <span>(<?= '$'.($fetch_cart['price']).' x '. $fetch_cart['quantity']; ?>)- <?=$fetch_cart['discount'];?>% =(<?= ($fetch_cart['price']-($fetch_cart['price']* $discountRate)) ?>)</span> </p>
         
      <?php
      
      
            }
         }else{
            echo '<p class="empty">your cart is empty!</p>';
         }
      ?>
         <input type="hidden" name="total_products" value="<?= $total_products; ?>">
         <input type="hidden" name="total_price" value="<?= $grand_total; ?>" value="">
         
         <div class="grand-total">total : <span>$<?= $total; ?></span> discount : <span>$<?= $discount_total; ?></span> grand total : <span>$<?= $grand_total; ?></span></div>
      </div>

      <h3>place your orders</h3>

<?php
$select_user = $conn->prepare("SELECT * FROM `users` WHERE id = ? ");
$select_user->execute([$user_id]);
$fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);


$address = $fetch_user['address'];
list($flat, $street, $city, $state, $country, $pin_code) = explode(", ", $address);


?>

      <div class="flex">
         <div class="inputBox">
            <span>your name :</span>
            <input type="text" name="name" value="<?php echo $fetch_user['name'];?>" placeholder="enter your name" class="box" maxlength="20" required>
         </div>
         <div class="inputBox">
            <span>your number :</span>
            <input type="number" name="number" value="<?php echo $fetch_user['phone'];?>" placeholder="enter your number" class="box" min="0" max="9999999999" onkeypress="if(this.value.length == 10) return false;" required>
         </div>
         <div class="inputBox">
            <span>your email :</span>
            <input type="email" name="email" value="<?php echo $fetch_user['email'];?>" placeholder="enter your email" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>payment method :</span>
            <select name="method" class="box" required>
               <option value="cash on delivery">cash on delivery</option>
               
            </select>
         </div>
         <div class="inputBox">
            <span>address line 01 :</span>
            <input type="text" name="flat" value="<?php echo $flat;?>" placeholder="e.g. flat number" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>address line 02 :</span>
            <input type="text" name="street" value="<?php echo $street;?>" placeholder="e.g. street name" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>city :</span>
            <input type="text" name="city" value="<?php echo $city;?>" placeholder="e.g. gelugor" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>state :</span>
            <input type="text" name="state" value="<?php echo $state;?>" placeholder="e.g. penang" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>country :</span>
            <input type="text" name="country" value="<?php echo $country;?>" placeholder="e.g. malaysia" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>post code :</span>
            <input type="number" min="0" name="pin_code" value="<?php echo $pin_code;?>" placeholder="e.g. 123456" min="0" max="999999" onkeypress="if(this.value.length == 6) return false;" class="box" required>
         </div>
      </div>
      
      <input type="submit" name="order" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>" value="place order">

   </form>

</section>













<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>


</body>
</html>