<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['add_to_wishlist'])){

   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $p_name = $_POST['p_name'];
   $p_name = filter_var($p_name, FILTER_SANITIZE_STRING);
   $p_price = $_POST['p_price'];
   $p_price = filter_var($p_price, FILTER_SANITIZE_STRING);
   $p_image = $_POST['p_image'];
   $p_image = filter_var($p_image, FILTER_SANITIZE_STRING);

   $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
   $check_wishlist_numbers->execute([$p_name, $user_id]);

   $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
   $check_cart_numbers->execute([$p_name, $user_id]);

   if($check_wishlist_numbers->rowCount() > 0){
      $message[] = 'already added to wishlist!';
   }elseif($check_cart_numbers->rowCount() > 0){
      $message[] = 'already added to cart!';
   }else{
      $insert_wishlist = $conn->prepare("INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES(?,?,?,?,?)");
      $insert_wishlist->execute([$user_id, $pid, $p_name, $p_price, $p_image]);
      $message[] = 'added to wishlist!';
   }

}

if(isset($_POST['add_to_cart'])){

   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $p_name = $_POST['p_name'];
   $p_name = filter_var($p_name, FILTER_SANITIZE_STRING);
   $p_price = $_POST['p_price'];
   $p_price = filter_var($p_price, FILTER_SANITIZE_STRING);
   $p_image = $_POST['p_image'];
   $p_image = filter_var($p_image, FILTER_SANITIZE_STRING);
   $p_qty = $_POST['p_qty'];
   $p_qty = filter_var($p_qty, FILTER_SANITIZE_STRING);

   $p_size = $_POST['p_size'];
   $p_size = filter_var($p_size, FILTER_SANITIZE_STRING);

   $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
   $check_cart_numbers->execute([$p_name, $user_id]);

   if($check_cart_numbers->rowCount() > 0){
      $message[] = 'already added to cart!';
   }else{

      $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
      $check_wishlist_numbers->execute([$p_name, $user_id]);

      if($check_wishlist_numbers->rowCount() > 0){
         $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE name = ? AND user_id = ?");
         $delete_wishlist->execute([$p_name, $user_id]);
      }

      $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, size, image) VALUES(?,?,?,?,?,?,?)");
      $insert_cart->execute([$user_id, $pid, $p_name, $p_price, $p_qty, $p_size, $p_image]);
      $message[] = 'added to cart!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <script src="https://unpkg.com/scrollreveal"></script>
</head>
<body>

<?php include 'header.php'; ?>



<!-- <div class="home-bg">

   <section class="home">
  
      <div class="content">
         <span>SR Garment (Pvt) Ltd</span>
         <h3>Style Your Kids with Loads of Cuteness</h3>
         <p>Welcome to our cute and comfortable page of Kids clothes. The perfect items to get them prepped for nursery or a cozy evening at home, our Kids clothes online shopping for girls and boys are crafted from breathable cotton to provide soft comfort on delicate skin.</p>
         <a href="about.php" class="btn">about us</a>
      </div>
   </section>

</div>
<div> -->
<dic class="home-bg">
   <div class="img-slider">
         <div class="slide active">
               <img src="images/h3.jpg" alt="" class="imgsize">
               <div class="info">
               <a href="category.php?category=Boys" class="btncv">Shop for Boys</a>
               </div>
         </div>
         <div class="slide">
            <img src="images/h2.jpg" alt="" class="imgsize">
            <div class="info">
            <a href="category.php?category=Girls" class="btncv">Shop for Girls</a>
            </div>
         </div>
         <div class="slide">
            <img src="images/h1.jpg" alt="" class="imgsize">
            <div class="info">
            <a href="category.php?category=Footwear" class="btncv" style="width:250px">Shop for Footwear</a>
            </div>
         </div>
         <div class="slide">
            <img src="images/c4.jpg" alt="" class="imgsize">
            <div class="info">
            <a href="category.php?category=Toys" class="btncv">Shop for Toys</a>
            </div>
         </div>
   
   </div>
</div>


<div class = "div1"> 
<section class="home-category">

   <h1 class="title" id="topic">shop by category</h1>

   <div class="box-container">

         <div class="box" id="boxhv">
               <img src="images/ct-1.png" alt="" >
               <h3>Boys</h3>
               <p>You can't compare me to the others, I'm one of a kind. I'm not perfect, but I'm unique. Life is too short to blend in.</p>
               <a href="category.php?category=Boys" class="btn">Boys</a>
         </div>

         <div class="box" id="boxhv">
               <img src="images/ct-2.jpg" alt="" class="ct">
               <h3>Toys</h3>
               <p>Good toys for young children need to match their stages of development and emerging abilities.</p>
               <a href="category.php?category=Toys" class="btn">Toys</a>
         </div>


         <div class="box" id="boxhv">
            <img src="images/ct-3.png" alt="" >
            <h3>Girls</h3>
            <p>"All little girls should be told they are pretty, even if they aren't", "A girl should be two things classy and fabulous".</p>
            <a href="category.php?category=Girls" class="btn">Girls</a>
         </div>

         <div class="box" id="boxhv">
            <img src="images/ct-4.png" alt="" class="ct">
            <h3>Footwear</h3>
            <p>Shoes not only help our feet to heal but can also aid in support and stability of our foot.</p>
            <a href="category.php?category=Footwear" class="btn">Footwear</a>
         </div>


   </div>

</section>

<section class="products">

   <h1 class="title" id="topic">latest products</h1>
   <div>
         <div class="box-container">

         <?php
            $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6");
            $select_products->execute();
            if($select_products->rowCount() > 0){
               while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
         ?>
         <form action="" class="box" method="POST">
            <div class="price">Rs.<span><?= $fetch_products['price']; ?></span>/-</div>
            <a href="view_page.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
            <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
            <div class="name"><?= $fetch_products['name']; ?></div>
            <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
            <input type="hidden" name="p_name" value="<?= $fetch_products['name']; ?>">
            <input type="hidden" name="p_price" value="<?= $fetch_products['price']; ?>">
            <input type="hidden" name="p_image" value="<?= $fetch_products['image']; ?>">
            <input type="number" min="1" value="1" name="p_qty" class="qty">
            <select class="qty" name="p_size">
            <option><B>Small</B></option>
            <option><B>Medium</B></option>
            <option><B>Large</B></option>
            </select>
            <input type="submit" value="add to wishlist" class="option-btn" name="add_to_wishlist">
            <input type="submit" value="add to cart" class="btn" name="add_to_cart">
         </form>
         <?php
            }
         }else{
            echo '<p class="empty">no products added yet!</p>';
         }
         ?>

         </div>

</section>

</div>

<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>