<?php
$conn = mysqli_connect("localhost", "root", "", "messages");

$swal_script = ""; // Variable to hold the SweetAlert script

if (isset($_POST["Signin"])) {
    $email = $_POST["Email"];
    $username = $_POST["Username"];
    $password = $_POST["Password"];
    $encrypted_password =md5($password);

    $insert = mysqli_query($conn, "INSERT INTO signin(Email, Username, Password) VALUES('$email','$username', '$encrypted_password')");

    if ($insert) {
        $swal_script = "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Successfully registered',
                    confirmButtonText: 'OK'
                });
            });
        </script>";
    } else {
        $swal_script = "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error registering account',
                    confirmButtonText: 'Try Again'
                });
            });
        </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M-Online</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
   <!-- SweetAlert2 CSS & JS CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
      .cart-link { position: relative; display: inline-block; }
      #cart-count {
        position: absolute; top: -10px; right: -14px;
        min-width: 20px; height: 20px; padding: 0 4px;
        border-radius: 999px; background: #ef4444; color: #fff;
        font-size: 12px; line-height: 20px; text-align: center;
      }
    </style>
</head>



<body>
  <div class="header">
    <div class="M-Online">
        <h2><span>M-</span>Online Shop</h2>
    </div>

    <div class="menu">
         <a href="index.php">Home</a>
        <a href="about.html">About</a>
        <a href="product.html">Products</a>
        <a href="contact.php">Contact</a>
<!-- Button trigger modal -->
<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Sign Up
</button>
<a href="login.php"><button type="button" class="btn btn-primary">
  Sign In
</button></a>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" style="color: black;" id="exampleModalLabel">Sign Up</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
     <form method="post">
       <div class="modal-body">
        <div class="mb-3">
  <label for="su-email" class="form-label">Email address</label>
  <input type="email" name="Email" class="form-control" id="su-email" placeholder="Enter Email address">
</div>
<div class="mb-3">
  <label for="su-username" class="form-label">Username</label>
  <input type="text" name="Username" class="form-control" id="su-username" placeholder="Enter Username">
</div>

<div class="mb-3">
  <label for="su-password" class="form-label">Password</label>
  <input type="password" name="Password" class="form-control" id="su-password" placeholder="Enter password">
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="Signin" class="btn btn-primary">Sign Up</button>
      </div>
     </form>
    </div>
  </div>
</div>

        <a href="cart.html" class="cart-link"><i class="fa-solid fa-cart-shopping"></i><span id="cart-count">0</span></a>
    </div>
  </div> 



  <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="pic/banner1.png" class="d-block w-100" alt="Fashion collection at M-Online" style="height: 90vh;">
      <div class="carousel-caption d-none d-md-block">
        <h5>Welcome to M-Online</h5>
        <p>Quality fashion and accessories at prices you'll love.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="pic/banner2.png" class="d-block w-100" alt="Shoes, shirts and trousers" style="height: 90vh;">
      <div class="carousel-caption d-none d-md-block">
        <h5>Step Out in Style</h5>
        <p>Shoes, shirts and trousers for class, work and weekends.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="pic/banner3.png" class="d-block w-100" alt="Watches, belts, ties and caps" style="height: 90vh;">
      <div class="carousel-caption d-none d-md-block">
        <h5>Finish Your Look</h5>
        <p>Watches, belts, ties and caps to complete every outfit.</p>
      </div>
    </div>
</div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>


    <div class="two-col">
        <section class="Left">
        <h1>Dress Sharp. Shop Easy. Only at M-Online.</h1>
        <p>From everyday shoes, shirts and T-shirts to watches, belts, ties and caps, M-Online brings you quality fashion at prices that make sense. Pick what you love, add it to your cart, and complete your look in a few clicks. Whether you're heading to class, work or a weekend out, we've got you covered.</p>
        <a href="#products" class="btn btn-primary">Shop Now</a>
        </section>
        <section class="Right">
            <img src="shopping.png" alt="Your Choice">
        </section>
    </div>
    <div class="four-col">
    <div class="left"></div>
    <div class="left-center"></div>
    <div class="right-center"></div>
    <div class="right"></div>
  </div>

<div class="Products" id="products">
    <h1>Our products</h1>
    <div class="Cards container">
        <div class="card">
            <img src="pic/shoes.png" class="img-fluid" alt="">
            <p>Shoes</p>
            <h4>70,000UGSh</h4>
            <button class="btn btn-primary add-to-cart" data-name="Shoes" data-price="70000">ADD TO CART</button>

        </div>
        <div class="card">
            <img src="pic/shirt1.png" class="img-fluid" alt="Watches">
            <p>Shirts</p>
            <h4>30,000UGSh</h4>
            <button class="btn btn-primary add-to-cart" data-name="Shirts" data-price="30000">ADD TO CART</button>

        </div><div class="card">
            <img src="pic/watch.png" class="img-fluid" alt="Watches">
            <p>Watches</p>
            <h4>170,000UGSh</h4>
            <button class="btn btn-primary add-to-cart" data-name="Watches" data-price="170000">ADD TO CART</button>

        </div><div class="card">
            <img src="pic/trauser.png" class="img-fluid" alt="Trausers">
            <p>Trausers</p>
            <h4>60,000UGSh</h4>
            <button class="btn btn-primary add-to-cart" data-name="Trousers" data-price="60000">ADD TO CART</button>

        </div>
        <div class="card">
            <img src="pic/caps.png" class="img-fluid" alt="Caps">
            <p>Caps</p>
            <h4>25,000UGSh</h4>
            <button class="btn btn-primary add-to-cart" data-name="Caps" data-price="25000">ADD TO CART</button>

        </div>
         <div class="card">
            <img src="pic/tshirts.png" class="img-fluid" alt="">
            <p>Tshirts</p>
            <h4>25,000UGSh</h4>
            <button class="btn btn-primary add-to-cart" data-name="T-shirts" data-price="25000">ADD TO CART</button>

        </div>
         <div class="card">
            <img src="pic/belts.png" class="img-fluid" alt="Caps">
            <p>belts</p>
            <h4>25,000UGSh</h4>
            <button class="btn btn-primary add-to-cart" data-name="Belts" data-price="25000">ADD TO CART</button>

        </div>
         <div class="card">
            <img src="pic/ties.png" class="img-fluid" alt="Ties">
            <p>Ties</p>
            <h4>25,000UGSh</h4>
            <button class="btn btn-primary add-to-cart" data-name="Ties" data-price="25000">ADD TO CART</button>

        </div>

        
    </div>
</div>


  

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


<!-- Render SweetAlert JS script if present -->
<footer>
  <h3>Contact us</h3>
  <p>We reply fastest on WhatsApp.</p>

  <div class="links">
    <a href="https://wa.me/256784523211" target="_blank" rel="noopener">WhatsApp: +256 784 523 211</a>
    <a href="https://x.com/m-online" target="_blank" rel="noopener">X: @m-online</a>
    <a href="https://facebook.com/M-Online" target="_blank" rel="noopener">Facebook: M-Online</a>
  </div>

  <small>&copy; 2026 M-Online</small>
</footer>

<!-- cart script: runs last, so the buttons and the count already exist -->
<script>
  const countEl = document.getElementById("cart-count");
  let cart = JSON.parse(localStorage.getItem("cart")) || [];

  function updateCartIcon() {
    countEl.textContent = cart.length;
  }

  document.querySelectorAll(".add-to-cart").forEach(btn => {
    btn.addEventListener("click", () => {
      cart.push({ name: btn.dataset.name, price: Number(btn.dataset.price) });
      localStorage.setItem("cart", JSON.stringify(cart));
      updateCartIcon();
    });
  });

  updateCartIcon();
</script>

<?php echo $swal_script; ?>
</body>





</html>