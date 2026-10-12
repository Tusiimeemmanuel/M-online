<?php
$conn = mysqli_connect("localhost", "root", "", "messages");

$swal_script = ""; // Variable to hold the SweetAlert script

if (isset($_POST["Submit"])) {
    $name = $_POST["full_name"];
    $email = $_POST["email"];
    $phone = $_POST["Phone"];
    $message = $_POST["Message"];

    $insert = mysqli_query($conn, "INSERT INTO registry(Name, Email, Phone, Message) VALUES('$name','$email', '$phone', '$message')");

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
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- SweetAlert2 CSS & JS CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="header">
    <div class="M-Online">
        <h2><span>M-</span>Online Shop</h2>
    </div>

    <div class="menu">
        <a href="index.htm">Home</a>
        <a href="about.html">About</a>
        <a href="product.html">Products</a>
        <a href="contact.php">Contact</a>
        
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Register
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" style="color: black;" id="exampleModalLabel">Register</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="mb-3">
                  <label for="regEmail" class="form-label">Email address</label>
                  <input type="email" class="form-control" id="regEmail" placeholder="Enter Email address">
                </div>
                <div class="mb-3">
                  <label for="regUser" class="form-label">Username</label>
                  <input type="text" class="form-control" id="regUser" placeholder="Enter Username">
                </div>
                <div class="mb-3">
                  <label for="regPass" class="form-label">Password</label>
                  <input type="password" class="form-control" id="regPass" placeholder="Enter password">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Register</button>
              </div>
            </div>
          </div>
        </div>

        <a href=""><i class="fa-solid fa-cart-shopping"></i></a>
    </div>
  </div> 

<div style="padding-top: 80px;"></div>

<div class="form">
    <h2 style="text-align: center; margin: 8px; font-size: 1.5em;">Try To Contact Us</h2>
    <form action="" method="post">
        <label for="full_name">Name</label><br>
        <input class="form-control" id="full_name" name="full_name" type="text" placeholder="Enter your name" required><br>
        
        <label for="email">Email</label><br>
        <input class="form-control" id="email" name="email" type="email" placeholder="abc@gmail.com" required><br>
        
        <label for="phone">Phone Number</label><br>
        <input class="form-control" id="phone" name="Phone" type="number" required><br>
        
        <label for="message">Message</label><br>
        <textarea class="form-control" id="message" name="Message" required></textarea><br>
        
        <button type="submit" name="Submit" class="btn btn-success w-100">Send Message</button><br>
    </form>
</div>

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

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- Render SweetAlert JS script if present -->
<?php echo $swal_script; ?>

</body>
</html>