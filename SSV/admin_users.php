<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_users = $conn->prepare("DELETE FROM `users` WHERE id = ?");
   $delete_users->execute([$delete_id]);
   header('location:admin_users.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>users</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<style>
   /* User accounts section styles */
.user-accounts {
    background-color: #fff;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 5px;
}

.user-accounts .title {
    margin-bottom: 20px;
    color: #333;
}

.user-accounts .box-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
}

.user-accounts .box {
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 10px;
    box-sizing: border-box;
}

.user-accounts img {
    width: 100%;
    height: auto;
    border-radius: 5px;
    margin-bottom: 10px;
}

.user-accounts p {
    margin-bottom: 20px;
}

.user-accounts p span {
    font-weight: bold;
}

.user-accounts p span.admin {
    color: orange;
}

.user-accounts .delete-btn {
    padding: 5px 10px;
    background-color: #333;
    color: #fff;
    text-decoration: none;
    border-radius: 10px;
    cursor: pointer;
}

.user-accounts .delete-btn:hover {
    background-color: #555;
}

   </style>
<body>
   
<?php include 'admin_header.php'; ?>



<section class="user-accounts">

   <h1 class="title">user accounts</h1>

   <div class="box-container">

      <?php
         $select_users = $conn->prepare("SELECT * FROM `users`");
         $select_users->execute();
         while($fetch_users = $select_users->fetch(PDO::FETCH_ASSOC)){
      ?>
      <div class="box" style="<?php if($fetch_users['id'] == $admin_id){ echo 'display:none'; }; ?>">
         <img src="uploaded_img/<?= $fetch_users['image']; ?>" alt="">
         <p> user id : <span><?= $fetch_users['id']; ?></span></p>
         <p> username : <span><?= $fetch_users['name']; ?></span></p>
         <p> email : <span><?= $fetch_users['email']; ?></span></p>
         <p> user type : <span style=" color:<?php if($fetch_users['user_type'] == 'admin'){ echo 'orange'; }; ?>"><?= $fetch_users['user_type']; ?></span></p>
         <a href="admin_users.php?delete=<?= $fetch_users['id']; ?>" onclick="return confirm('delete this user?');" class="delete-btn">delete</a>
      </div>
      <?php
      }
      ?>
   </div>

</section>













<script src="js/script.js"></script>

</body>
</html>