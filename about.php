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
   <title>about</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="about">

   <div class="row">

      <div class="image">
         <img src="images/about-img.svg" alt="">
      </div>

      <div class="content">
         <h3>why choose us?</h3>
         <p>GadgetHub is a One Stop Gadget Shop for all your gadgets and gifting needs , with some of products handpicked by our team .</p>
         
         <p>" Launched in 2023 , GadgetHub  is everything related to gadgets , gizmos , and cutting - edge consumer electronics . 
            Our aim has always been to provide first class customer service with value for money innovative products that completely satisfy even the most demanding customer .</p>

         <p>GadgetHub  started as a way to serve a market that is passionate about technology . 
            We have always loved unique and innovative products so dedicating the time and resources to develop the business and make it a reality has been a joy instead of a burden . 
            As we grow , expand , and nurture the business , we realize everyday how lucky we are to do something we love .</p> 

         <p>We take your satisfaction seriously . We provide a professional , dedicated service for every single customer regardless of order size .
         Our online catalog is constantly expanding with the very latest and the coolest gadgets added every day to ensure you get your tech fix .</p>
         <a href="contact.php" class="btn">contact us</a>
      </div>

   </div>

</section>


<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".reviews-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
        slidesPerView:1,
      },
      768: {
        slidesPerView: 2,
      },
      991: {
        slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>