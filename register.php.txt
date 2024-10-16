   <?php

   include 'config.php';

   if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = md5($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = md5($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   $select = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select->execute([$email]);


   if($select->rowCount() > 0){
      $message[] = 'user email already exist!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         $insert = $conn->prepare("INSERT INTO `users`(name, email, password, image) VALUES(?,?,?,?)");
         $insert->execute([$name, $email, $pass, $image]);

         if($insert){
            if($image_size > 2000000){
               $message[] = 'image size is too large!';
            }else{
               move_uploaded_file($image_tmp_name, $image_folder);
               $message[] = 'registered successfully!';
               header('location:login.php');
            }
         }

      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <title>Register Page</title>
</head>
<style>
    body {
    margin: 0;
    padding: 0;
    background-size: 100%;
    height: 100vh;
    font-family: sans-serif;
    background: url(minimoss.gif);
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

</style>
<body>
    <div class="input">
        <h1>REGISTER</h1>
        <form action="" enctype="multipart/form-data" method="POST">
            <div class="box-input">
                <i class="fas fa-user"></i>
                <input type="text" name="name" class="box" placeholder="your name" required>
            </div>
            <div class="box-input">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" class="box" placeholder="your email" required>
            </div>
            <div class="box-input">
                <i class="fas fa-lock"></i>
                <input type="password" name="pass" class="box" placeholder="your password" required>
            </div>
            <div class="box-input">
                <i class="fas fa-lock"></i>
                <input type="password" name="cpass" class="box" placeholder="confirm your password" required>
            </div>
            <div class="box-input">
                <i class="fas fa-lock"></i>
                <input type="file" name="image" class="box" required accept="image/jpg, image/jpeg, image/png">
            </div>
            <a href="login.php">
            <input type="submit" value="register now" class="btn-input" name="submit">
            </a>
            <div class="bottom">
                <p>Sudah punya akun?
                    <a href="login.html">Login disini</a>
                </p>
            </div>
        </form>
    </div>
</body>

</html>