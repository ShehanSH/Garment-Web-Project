<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

</head>
<body>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
   AOS.init();
</script>
<?php include 'header.php'; ?>

<section class="about">

   <div class="row">
      <div class="box" style="margin-top:-650px; margin-left:-350px;" data-aos="fade-right" data-aos-duration="2000">
         <img src="images/abt4.gif" alt="" style="border-radius: 50%; width:450px; height:400px">
         <h3>why choose us?</h3>
         <p>With years of experience in the fashion and textile industries, we have earned the trust of many of the country's most prestigious and well-known brands. What distinguishes us from other apparel manufacturers is that we source everything within our company and below brands, all of which are owned by SR Textiles. This allows us to retain quality while also lowering clothing and fabric manufacturing costs, allowing us to offer competitive prices and good quality to our customers.</p>
         <a href="contact.php" class="btn">contact us</a>
      </div>

      <div class="box" style="margin-top:650px ; margin-right:-100px" data-aos="fade-left" data-aos-duration="2000">
         <img src="images/abt5.gif" alt="" style="border-radius: 50%;">
         <h3>what we provide?</h3>
         <p>Personalised Customer Service-we like to treat each of our clients as friends, going out of our way to ensure you get the best end product. We dedicate account managers for larger clients.
         <br>Quality Control System: we take quality control seriously, we often check our garments at several stages during production. We often wear the uniforms ourselves, testing uniforms in design phase before we are happy to bring to market.
         <br>Secure Online Shopping: take comfort in the knowledge you can shop for uniforms, apparel and merchandise on our SSL encrypted secure online shop. We can also place your organistions products for your customers or staff to purchase online</p>
         <a href="shop.php" class="btn">our shop</a>
      </div>

   </div>

</section>

<section class="reviews">

   <h1 class="title" id="topic">clients reivews</h1>

   <div class="box-container" data-aos="zoom-out-down" data-aos-duration="2000">

      <div class="box">
         <img src="images/pc1.jpg" alt="">
         <p>SR garments products quality is very good. The pricing here, the pricing is very good and the quality of the clothes here is very good. Clothes are available here at very low prices. Toys are also available here for your kids.Highly recommended.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Kaizer Kaize</h3>
      </div>

      <div class="box">
         <img src="images/pc2.webp" alt="">
         <p>We feel they offer a really high quality product,  and they are a very nice team to deal with.gd job guyz keep it up.The shirts are exactly what we requested and required and we will certainly return in the future for the next set of shirts.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Yohani Perera </h3>
      </div>

      <div class="box">
         <img src="images/pc3.jpg" alt="">
         <p>We are delighted with the quality of service and products we have received. Implementing the design was easy via the website and where help with the design was requested it was acted upon quickly and without any bother.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Anupa Fernando</h3>
      </div>

      <div class="box">
         <img src="images/pc4.jpg" alt="">
         <p>Excellent communication and service throughout, easy to use website, well design, and the resulting polo shirts were probably the best example of embroidery we had ever ordered from anywhere.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Dinesh Muthukumara</h3>
      </div>

      <div class="box">
         <img src="images/pc5.jpeg" alt="">
         <p>We have ordered uniforms from SR Garment several times now and have always been happy with the service - great customer service and good quality products delivered in a timely manner. Would highly recommend. Thank you.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Suranga Lakmal</h3>
      </div>

      <div class="box">
         <img src="images/pc6.jpg" alt="">
         <p>This is my very first order through site, and I am totally and completely satisfied! The fit is great and so are the prices. I will definitely return again and again.I completely love this site. Highly recommend.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Nirosha silva</h3>
      </div>

   </div>

</section>









<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>