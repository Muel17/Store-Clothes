<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['send'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $msg = $_POST['msg'];
   $msg = filter_var($msg, FILTER_SANITIZE_STRING);

   $select_message = $conn->prepare("SELECT * FROM `message` WHERE name = ? AND email = ? AND number = ? AND message = ?");
   $select_message->execute([$name, $email, $number, $msg]);

   if($select_message->rowCount() > 0){
      $message[] = 'already sent message!';
   }else{

      $insert_message = $conn->prepare("INSERT INTO `message`(user_id, name, email, number, message) VALUES(?,?,?,?,?)");
      $insert_message->execute([$user_id, $name, $email, $number, $msg]);

      $message[] = 'sent message successfully!';

   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<style>
         @import url('https://fonts.googleapis.com/css2?family=Pixelify+Sans:wght@400..700&display=swap');
    :root {
  font-size: 16px;
  font-family: 'Pixelify Sans';
  --transition-speed: 600ms;
}
 .contact {
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 10px;
}

.contact .title {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

.contact form {
    max-width: 500px;
    margin: 0 auto;
}

.contact .input-group {
    margin-bottom: 15px;
}

.contact label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
    color: #555;
}

.contact .box {
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ddd;
    font-size: 14px;
}

.contact textarea {
    resize: vertical;
}

.contact .btn {
    display: block;
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 5px;
    background-color: grey;
    color: #fff;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.contact .btn:hover {
    background-color: green;
}

   </style>
<body>
   
<?php include 'header.php'; ?>

<section class="contact">

   <h1 class="title">Get in Touch</h1>

   <form action="" method="POST">
      <div class="input-group">
         <label for="name">Your Name:</label>
         <input type="text" name="name" id="name" class="box" required placeholder="Enter your name">
      </div>
      <div class="input-group">
         <label for="email">Your Email:</label>
         <input type="email" name="email" id="email" class="box" required placeholder="Enter your email">
      </div>
      <div class="input-group">
         <label for="number">Your Number:</label>
         <input type="number" name="number" id="number" min="0" class="box" required placeholder="Enter your number">
      </div>
      <div class="input-group">
         <label for="msg">Your Message:</label>
         <textarea name="msg" id="msg" class="box" required placeholder="Enter your message" cols="30" rows="10"></textarea>
      </div>
      <input type="submit" value="Send Message" class="btn" name="send">
   </form>

</section>








<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>