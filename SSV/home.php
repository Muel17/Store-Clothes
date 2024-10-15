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

      $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
      $insert_cart->execute([$user_id, $pid, $p_name, $p_price, $p_qty, $p_image]);
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

</head>
<style>
   /* Home background styles */
   @import url('https://fonts.googleapis.com/css2?family=Pixelify+Sans:wght@400..700&display=swap');
    :root {
  font-size: 16px;
  font-family: 'Pixelify Sans';
  --transition-speed: 600ms;
}
.home-bg {
    background-image: url('snow.gif');
    background-size: cover;
    background-position: center ;
    padding: 100px 0;
    text-align: center;
    color: white;
}

.btn {
    display: inline-block;
    padding: 10px 20px;
    background-color: #333;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.btn:hover {
    background-color: skyblue;
}


.home-bg .content {
    max-width: 800px;
    margin: 0 auto;
}


.home-bg h3 {
    font-size: 60px;
    margin-bottom: 20px;
}

.home-bg p {
    font-size: 35px;
    margin-bottom: 20px;
}

/* Home category styles */
.home-category {
    background-color: pink;
    padding: 50px 0;
}

.home-category .title {
    text-align: center;
    margin-bottom: 50px;
    color: #333;
}

.home-category .box-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.home-category .box {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    text-align: center;
}



.home-category .box img {
    width: 100%;
    height: auto;
    border-radius: 5px;
    margin-bottom: 20px;
}

.home-category .box h3 {
    margin-bottom: 10px;
}

.home-category .box p {
    margin-bottom: 20px;
}

/* Products styles */
.products {
    padding: 50px 0;
}

.products .title {
    text-align: center;
    margin-bottom: 50px;
    color: #333;
}


.products .box-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.products .box {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    text-align: center;
}

.products .box img {
    width: 100%;
    height: auto;
    border-radius: 5px;
    margin-bottom: 20px;
}

.products .box .price {
    font-weight: bold;
    font-size: 18px;
    color: #333;
    margin-bottom: 10px;
}

.products .box .qty {
    width: 50px;
    margin-bottom: 10px;
}

.products .box .option-btn,
.products .box .btn {
    padding: 5px 10px;
    background-color: #333;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 10px;
}

.products .box .option-btn:hover,
.products .box .btn:hover {
    background-color: #555;
}

   </style>
<body>
   
<?php include 'header.php'; ?>

<div class="home-bg">

   <section class="home">

      <div class="content">
         <h3>SooNa Store </h3>
         <p>Reach For A Present You With our Store Page</p>
         <a href="about.php" class="btn">about us</a>
      </div>

   </section>

</div>

<section class="home-category">

   <h1 class="title">shop by category</h1>

   <div class="box-container">

      <div class="box">
         <img src="n1 (1).png" alt="">
         <h3>Small</h3>
         <p>Our small gift box is perfect for those little surprises that mean so much. Whether it's a token of appreciation or a small gesture of love, this box is just the right size to make someone's day special.</p>
         <a href="category.php? category=Hoodie" class="btn">Small</a>
      </div>

      <div class="box">
         <img src="n1 (2).png" class="n">
         <h3>Medium</h3>
         <p>Our medium gift box is ideal for those occasions when you want to make a big impression. It's spacious enough to hold a variety of goodies, making it the perfect choice for birthdays, holidays, or any other celebration</p>
         <a href="category.php?category=Tshirt" class="btn">Medium</a>
      </div>

      <div class="box">
         <img src="n1 (3).png" alt="">
         <h3>Large</h3>
         <p>Our large gift box is designed for those extra-special moments that call for something truly magnificent. With plenty of room for all your favorite treats and treasures, this box is sure to delight anyone lucky enough to receive it.</p>
         <a href="category.php?category=sweather" class="btn">Large</a>
      </div>

      <div class="box">
         <img src="n1 (4).png" alt="">
         <h3>Custom</h3>
         <p>Our custom gift boxes are tailored to your exact specifications, ensuring that every detail is perfect. From the size and shape to the design and contents, we work closely with you to create a one-of-a-kind gift box that's as unique as the person you're giving it to.</p>
         <a href="category.php?category=sweather" class="btn">Custom</a>
      </div>

   </div>

</section>

<section class="products">

   <h1 class="title">latest products</h1>

   <div class="box-container">

   <?php
      $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6");
      $select_products->execute();
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" class="box" method="POST">
      <div class="price">$<span><?= $fetch_products['price']; ?></span>/-</div>
      <a href="view_page.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
      <div class="name"><?= $fetch_products['name']; ?></div>
      <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
      <input type="hidden" name="p_name" value="<?= $fetch_products['name']; ?>">
      <input type="hidden" name="p_price" value="<?= $fetch_products['price']; ?>">
      <input type="hidden" name="p_image" value="<?= $fetch_products['image']; ?>">
      <input type="number" min="1" value="1" name="p_qty" class="qty">
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







<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>