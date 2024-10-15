<?php

if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}

?>
<style>
   /* Header styles */
   @import url('https://fonts.googleapis.com/css2?family=Pixelify+Sans:wght@400..700&display=swap');
    :root {
  font-size: 16px;
  font-family: 'Pixelify Sans';
  --transition-speed: 600ms;
}
.header {
    background-color: pink;
    color: black;
    padding: 10px 10px;
}

.header .flex {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header .logo {
    font-size: 24px;
    font-weight: bold;
    text-decoration: none;
    color: black;
}

.header .logo span {
    color: #ff5733;
}

.header .navbar a {
    margin-right: 20px;
    text-decoration: none;
    color: black;
}

.header .icons {
    display: flex;
    align-items: center;
}

.header .icons a {
    margin-right: 10px;
    color: black;
}

.header .icons span {
    margin-left: 5px;
}

.header .profile {
    display: flex;
    align-items: center;
}

.header .profile img {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    margin-right: 10px;
}

.header .profile p {
    margin-right: 10px;
}

.header .flex-btn {
    display: flex;
}

.header .btn {
    padding: 5px 10px;
    background-color: white;
    color: black;
    text-decoration: none;
    border-radius: 5px;
    margin-right: 10px;
}

.header .btn:hover {
    background-color: grey;
}

.header .delete-btn {
    padding: 5px 10px;
    background-color: white;
    color: black;
    text-decoration: none;
    border-radius: 5px;
    margin-right: 10px;
}

.header .delete-btn:hover {
    background-color: grey;
}

.header .option-btn {
    padding: 5px 10px;
    background-color: white;
    color: black;
    text-decoration: none;
    border-radius: 5px;
    margin-right: 10px;
}

.header .option-btn:hover {
    background-color: grey;
}

   </style>

<header class="header">

   <div class="flex">

      <a href="home.php" class="logo">SooNa Store<span>.</span></a>

      <nav class="navbar">
         <a href="home.php">home</a>
         <a href="shop.php">shop</a>
         <a href="orders.php">orders</a>
         <a href="about.php">about</a>
         <a href="contact.php">contact</a>
      </nav>

      <div class="icons">
         <a href="search_page.php" class="fas fa-search"></a>
         <?php
            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
            $count_wishlist_items->execute([$user_id]);
         ?>
         <a href="wishlist.php"><i class="fas fa-heart"></i><span>(<?= $count_wishlist_items->rowCount(); ?>)</span></a>
         <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $count_cart_items->rowCount(); ?>)</span></a>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <img src="uploaded_img/<?= $fetch_profile['image']; ?>" alt="">
         <p><?= $fetch_profile['name']; ?></p>
         <a href="user_profile_update.php" class="btn">update profile</a>
         <a href="logout.php" class="delete-btn">logout</a>
         <div class="flex-btn">
            <a href="login.php" class="option-btn">login</a>
            <a href="register.php" class="option-btn">register</a>
         </div>
      </div>

   </div>

</header>