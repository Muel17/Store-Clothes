<style>
             @import url('https://fonts.googleapis.com/css2?family=Pixelify+Sans:wght@400..700&display=swap');
    :root {
  font-size: 16px;
  font-family: 'Pixelify Sans';
  --transition-speed: 600ms;
}
   /* Footer styles */
.footer {
    background-color: #333;
    color: #fff;
    padding: 20px 0;
}

.footer .box-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.footer .box {
    padding: 10px;
    border-radius: 10px;
    background-color: #444;
}

.footer h3 {
    margin-bottom: 10px;
}

.footer a {
    color: #fff;
    text-decoration: none;
    display: block;
    margin-bottom: 10px;
}

.footer a:hover {
    color: #ff5733;
}

.footer p {
    margin-bottom: 10px;
}

.footer i {
    margin-right: 10px;
}

   </style>

<footer class="footer">

   <section class="box-container">

      <div class="box">
         <h3>quick links</h3>
         <a href="home.php"> <i class="fas fa-angle-right"></i> home</a>
         <a href="shop.php"> <i class="fas fa-angle-right"></i> shop</a>
         <a href="about.php"> <i class="fas fa-angle-right"></i> about</a>
         <a href="contact.php"> <i class="fas fa-angle-right"></i> contact</a>
      </div>

      <div class="box">
         <h3>extra links</h3>
         <a href="cart.php"> <i class="fas fa-angle-right"></i> cart</a>
         <a href="wishlist.php"> <i class="fas fa-angle-right"></i> wishlist</a>
         <a href="login.php"> <i class="fas fa-angle-right"></i> login</a>
         <a href="register.php"> <i class="fas fa-angle-right"></i> register</a>
      </div>

      <div class="box">
         <h3>contact info</h3>
         <p> <i class="fas fa-phone"></i> 088888</p>
         <p> <i class="fas fa-phone"></i> +621232131</p>
         <p> <i class="fas fa-envelope"></i> applelie@gmail.com</p>
         <p> <i class="fas fa-map-marker-alt"></i> Indonesia - Indonesia</p>
      </div>

      <div class="box">
         <h3>follow us</h3>
         <a href="#"> <i class="fab fa-facebook-f"></i> facebook </a>
         <a href="#"> <i class="fab fa-twitter"></i> twitter </a>
         <a href="#"> <i class="fab fa-instagram"></i> instagram </a>
         <a href="#"> <i class="fab fa-linkedin"></i> linkedin </a>
      </div>

   </section>



</footer>