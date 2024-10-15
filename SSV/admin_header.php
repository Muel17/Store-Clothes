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

@import url('https://fonts.googleapis.com/css2?family=Pixelify+Sans:wght@400..700&display=swap');
    :root {
  font-size: 16px;
  font-family: 'Pixelify Sans';
  --text-primary: #b6b6b6;
  --text-secondary: #ececec;
  --bg-primary: #23232e;
  --bg-secondary: #141418;
  --transition-speed: 600ms;
}
.header {
   position: fixed;
   top: 0;
   left: 0;
   width: 100%;
   background-color: #333;
   color: #fff;
   padding: 10px 0;
   z-index: 1000;
}

.flex {
   display: flex;
   justify-content: space-between;
   align-items: center;
}

.logo {
   color: #fff;
   font-size: 24px;
   text-decoration: none;
}

.logo span {
   font-weight: bold;
}

.navbar {
   display: flex;
}

.navbar a {
   color: #fff;
   text-decoration: none;
   margin-right: 20px;
}

.icons {
   display: flex;
   align-items: center;
}

.icons .fas {
   color: #fff;
   font-size: 24px;
   margin-right: 20px;
   cursor: pointer;
}

.menu {
   display: none;
   position: absolute;
   top: calc(100% + 10px);
   left: 50%;
   transform: translateX(-50%);
   background-color: #333;
   padding: 10px;
   border-radius: 5px;
   box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
   z-index: 1001;
   max-height: 200px;
   overflow-y: auto;
}


.menu-btn,
.user-btn {
   display: block;
   color: #fff;
   text-decoration: none;
   margin: 5px 0;
}

.user-profile {
   display: none;
   position: absolute;
   top: 60px;
   right: 10px;
   background-color: #fff;
   color: #000;
   padding: 10px;
   border-radius: 5px;
   box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.user-profile .user-btn {
   margin-bottom: 10px;
}

.btn {
   background-color: #3498db;
   color: #fff;
   padding: 5px 10px;
   text-decoration: none;
   border-radius: 3px;
   margin-right: 10px;
}

.delete-btn {
   color: #e74c3c;
   text-decoration: none;
}

.flex-btn {
   display: flex;
   justify-content: space-between;
   margin-top: 10px;
}

.option-btn {
   color: #3498db;
   text-decoration: none;
}



   </style>

<header class="header">

   <div class="flex">

      <a href="admin_page.php" class="logo">Admin Store</a>

      <nav class="navbar">
         <a href="admin_page.php">home</a>
         <a href="admin_products.php">products</a>
         <a href="admin_orders.php">orders</a>
         <a href="admin_users.php">users</a>
         <a href="admin_contacts.php">messages</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars" onclick="toggleMenu()"></div>
      </div>
      <div id="menu" class="menu">
         <a href="register.php" class="menu-btn">Register</a>
         <a href="logout.php" class ="menu-btn">logout</a>
         <a href="admin_update_profile.php" class="menu-btn">Update User</a>
      </div>
      <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
      </div>
   </div>
</div>

         <script>
function toggleMenu() {
   var menu = document.getElementById("menu");
   if (menu.style.display === "block") {
      menu.style.display = "none";
   } else {
      menu.style.display = "block";
      var menuBtn = document.getElementById("menu-btn");
      var rect = menuBtn.getBoundingClientRect();
      menu.style.left = rect.left + "px";
   }
}

function toggleUser() {
   var userProfile = document.getElementById("user-profile");
   if (userProfile.style.display === "block") {
      userProfile.style.display = "none";
   } else {
      userProfile.style.display = "block";
   }
}
</script>

</header>