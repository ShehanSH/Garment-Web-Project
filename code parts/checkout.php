<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
};

if (isset($_POST['order'])) {

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $method = $_POST['method'];
   $method = filter_var($method, FILTER_SANITIZE_STRING);
   $address = 'flat no. ' . $_POST['flat'] . ' ' . $_POST['street'] . ' ' . $_POST['city'] . ' ' . $_POST['state'] . ' ' . $_POST['country'] . ' - ' . $_POST['pin_code'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);
   $placed_on = date('d-M-Y');

   $cart_total = 0;
   $cart_products[] = '';

   $cart_query = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
   $cart_query->execute([$user_id]);
   if ($cart_query->rowCount() > 0) {
      while ($cart_item = $cart_query->fetch(PDO::FETCH_ASSOC)) {
         $cart_products[] = $cart_item['name'] . ' ( ' . $cart_item['quantity'] . ' )' . ' ( ' . $cart_item['size'] . ' )';
         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
         $cart_total += $sub_total;
      };
   };

   $total_products = implode(', ', $cart_products);

   $order_query = $conn->prepare("SELECT * FROM `orders` WHERE name = ? AND number = ? AND email = ? AND method = ? AND address = ? AND total_products = ? AND total_price = ?");
   $order_query->execute([$name, $number, $email, $method, $address, $total_products, $cart_total]);

   if ($cart_total == 0) {
      $message[] = 'your cart is empty';
   } elseif ($order_query->rowCount() > 0) {
      $message[] = 'order placed already!';
   } else {
      $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES(?,?,?,?,?,?,?,?,?)");
      $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $cart_total, $placed_on]);
      $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
      $delete_cart->execute([$user_id]);
      $message[] = 'order placed successfully!';
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

<body onload="hide()">

   <?php include 'header.php'; ?>

   <section class="display-orders">

      <?php
      $cart_grand_total = 0;
      $select_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
      $select_cart_items->execute([$user_id]);
      if ($select_cart_items->rowCount() > 0) {
         while ($fetch_cart_items = $select_cart_items->fetch(PDO::FETCH_ASSOC)) {
            $cart_total_price = ($fetch_cart_items['price'] * $fetch_cart_items['quantity']);
            $cart_grand_total += $cart_total_price;
      ?>
            <p><span><?= $fetch_cart_items['size'] ?></span> <?= $fetch_cart_items['name']; ?> <span>(<?= 'Rs' . $fetch_cart_items['price'] . '/- x ' . $fetch_cart_items['quantity']; ?>)</span> </p>
      <?php
         }
      } else {
         echo '<p class="empty">your cart is empty!</p>';
      }
      ?>
      <div class="grand-total" id="topic">grand total : <span>Rs.<?= $cart_grand_total; ?>/-</span></div>
   </section>

   <section class="checkout-orders">

      <form action="" method="POST">

         <h3>place your order</h3>

         <div class="flex" id="flex">
            <div class="inputBox">
               <span>your name :</span>
               <input type="text" name="name" placeholder="enter your name" class="box" required>
            </div>
            <div class="inputBox">
               <span>your number :</span>
               <input type="number" name="number" placeholder="enter your number" class="box" required>
            </div>
            <div class="inputBox">
               <span>your email :</span>
               <input type="email" name="email" placeholder="enter your email" class="box" required>
            </div>
            <div class="inputBox">
               <span>payment method :</span>
               <select name="method" class="box" required id="method" onchange="changemethod()">
                  <option value="cash on delivery">cash on delivery</option>
                  <option value="credit card">credit card</option>
               </select>
            </div>
            <div class="inputBox">
               <span>address line 01 :</span>
               <input type="text" name="flat" placeholder="e.g. flat number" class="box" required>
            </div>
            <div class="inputBox">
               <span>address line 02 :</span>
               <input type="text" name="street" placeholder="e.g. street name" class="box" required>
            </div>
            <div class="inputBox">
               <span>city :</span>
               <input type="text" name="city" placeholder="e.g. colombo" class="box" required>
            </div>
            <div class="inputBox">
               <span>state :</span>
               <input type="text" name="state" placeholder="e.g. Western" class="box" required>
            </div>
            <div class="inputBox">
               <span>country :</span>
               <input type="text" name="country" placeholder="e.g. Sri lanka" class="box" required>
            </div>
            <div class="inputBox">
               <span>pin code :</span>
               <input type="number" min="0" name="pin_code" placeholder="e.g. 123456" class="box" required>
            </div>
         </div>

         <div id="codorder">
            <input type="submit" id="codbtn1" name="order" class="btn <?= ($cart_grand_total > 1) ? '' : 'disabled'; ?>" value="place order">
         </div>
         <div id="cdorder">
            <input type="submit" id="cdbtn1" name="order" class="btn <?= ($cart_grand_total > 1) ? '' : 'disabled'; ?>" value="place order" onclick="show()">
         </div>


      </form>

   </section>

   <?php include 'footer.php'; ?>


   <script>
      function hide() {
         document.getElementById("cdorder").style.display = "none";
      }


      function changemethod() {
         var nam = document.getElementById("method").value;
         if (nam == "credit card") {
            document.getElementById("cdorder").style.display = "inline";
            document.getElementById("codorder").style.display = "none";

         }
      }

      document.getElementById("cdbtn1").addEventListener("click", function(event) {
         window.open(
            "visa.php", "_blank");
      });
   </script>

   <script src="js/script.js"></script>

</body>

</html>