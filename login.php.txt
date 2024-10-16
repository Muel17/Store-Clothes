<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = md5($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $sql = "SELECT * FROM `users` WHERE email = ? AND password = ?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$email, $pass]);
   $rowCount = $stmt->rowCount();  

   $row = $stmt->fetch(PDO::FETCH_ASSOC);

   if($rowCount > 0){

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_id'] = $row['id'];
         header('location:admin_page.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_id'] = $row['id'];
         header('location:home.php');

      }else{
         $message[] = 'no user found!';
      }

   }else{
      $message[] = 'incorrect email or password!';
   }

}

?>
<!DOCTYPE php>
<php lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <title>Login Page</title>
</head>
<body>
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
  --transition-speed: 600ms;
}
    body {
    margin: 0;
    padding: 0;
    background: url(minimoss.gif);
    background-size: 100%;
    height: 60vw;
}

.input {
    position: fixed;
    top: 50%;
    left: 600px;
    transform: translate(-30%, -50%);
    background: rgba(21, 26, 24, 0.9);
    padding: 50px;
    width: 320px;
    box-shadow: 0px 0px 25px 10px black;
    border-radius: 15px;
}

.input h1 {
    text-align: center;
    color: white;
    font-size: 30px;
    font-family: sans-serif;
    letter-spacing: 3px;
    padding-top: 0;
    margin-top: -20px;
}

.box-input {
    display: flex;
    justify-content: space-between;
    margin: 10px;
    border-bottom: 2px solid white;
    padding: 8px 0;
}

.box-input i {
    font-size: 23px;
    color: white;
    padding: 5px 0;
}

.box-input input {
    width: 85%;
    padding: 5px 0;
    background: none;
    border: none;
    outline: none;
    color: white;
    font-size: 18px;
}

.box-input input::placeholder {
    color: white;
}

.btn-input .box-input input:hover {
    background: rgba(10, 10, 10, s 0.5);
}

.btn-input {
    margin-left: 10px;
    margin-bottom: 20px;
    background: none;
    border: 1px solid white;
    width: 92.5%;
    padding: 10px;
    color: white;
    font-size: 18px;
    letter-spacing: 3px;
    cursor: pointer;
    transition: all .2s;
    border-radius: 10px;
}

.btn-input:hover {
    background: black
}
.bottom {
    margin-left: 10px;
    margin-right: 10px;
    margin-bottom: -20px;
}

.bottom p {
    color: white;
    font-size: 15px;
    text-decoration: none;
}

.bottom a {
    color: lightgreen;
    font-size: 15px;
    text-decoration: none;
}

.bottom a:hover {
    text-decoration: underline;
}

</style>
    <div class="input">
        <h1>LOGIN</h1>
        <form action="" method="POST">
            <div class="box-input">
                <i class="fas fa-envelope-open-text"></i>
                <input type="text" name="email" placeholder="Email" required>
            </div>
            <div class="box-input">
                <i class="fas fa-lock"></i>
                <input type="password" name="pass" placeholder="Password" required>
            </div>
            <a href="home.php">
                <button type="submit" name="submit" class="btn-input">Login</button>
            </a>
            <div class="bottom">
                <p>Belum punya akun?
                    <a href="register.php">Register disini</a>
                </p>
            </div>
        </form>
    </div>
</body>


</body>
</html>