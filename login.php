<?php
session_start(); // Start session to keep the user logged in
$conn = mysqli_connect("localhost", "root", "", "messages");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$swal_script = ""; // Variable to hold the SweetAlert script

if (isset($_POST["Login"])) {
    // Escape inputs to prevent basic SQL injection in procedural style
    $username = mysqli_real_escape_string($conn, $_POST["Username"]);
    $password = $_POST["Password"];

    // 1. Procedural query to find both Password and Email
    $query = "SELECT Password, Email FROM signin WHERE Username = '$username'";
    $result = mysqli_query($conn, $query);

    // 2. Check if the user exists
    if ($result && $row = mysqli_fetch_assoc($result)) {
        $stored_hash = $row["Password"];
        $email = $row["Email"]; // Get the email from the database

        // 3. Hash the entered password with MD5 and compare with stored hash
        if (md5($password) === $stored_hash) {
            // Password is correct! Set session variables
            $_SESSION['Username'] = $username;
            $_SESSION['Email'] = $email;

            // 4. Check if the email is the admin email
            $redirect_page = ($email === 'admin@gmail.com') ? 'admin.php' : 'product.html';

            $swal_script = "
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Welcome Back!',
                        text: 'Login successful',
                        confirmButtonText: 'Continue'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '$redirect_page'; 
                        }
                    });
                });
            </script>";
        } else {
            // Incorrect password
            $swal_script = "
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Login Failed',
                        text: 'Incorrect password',
                        confirmButtonText: 'Try Again'
                    });
                });
            </script>";
        }
    } else {
        // User not found
        $swal_script = "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'No account found with that username',
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
    <title>Login - M-Online Shop</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- SweetAlert2 CSS & JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f8f9fa;
        }
        .login-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }
        .login-card {
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            width: 100%;
            max-width: 420px;
        }
    </style>
</head>
<body>

  <!-- Header / Navigation -->
  <div class="header">
    <div class="M-Online">
        <h2><span>M-</span>Online Shop</h2>
    </div>

    <div class="menu">
        <a href="index.html">Home</a>
        <a href="about.html">About</a>
        <a href="product.html">Products</a>
        <a href="contact.html">Contact</a>
        <a href="login.php" style="color: #198754; font-weight: bold;">Login</a>
        <a href=""><i class="fa-solid fa-cart-shopping"></i></a>
    </div>
  </div> 

  <!-- Login Form Section -->
  <div class="login-container">
      <div class="login-card">
          <div class="text-center mb-4">
              <h2 style="font-size: 1.8em; font-weight: bold; color: #333;">Welcome Back</h2>
              <p class="text-muted">Please log in to your account</p>
          </div>

          <form method="POST" action="">
              <div class="mb-3">
                  <label for="Username" class="form-label">Username</label>
                  <div class="input-group">
                      <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                      <input type="text" class="form-control" id="Username" name="Username" placeholder="Enter username" required>
                  </div>
              </div>

              <div class="mb-3">
                  <label for="Password" class="form-label">Password</label>
                  <div class="input-group">
                      <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                      <input type="password" class="form-control" id="Password" name="Password" placeholder="Enter password" required>
                  </div>
              </div>

              <div class="d-flex justify-content-between align-items-center mb-3">
                  <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="remember">
                      <label class="form-check-label text-muted" for="remember" style="font-size: 0.9rem;">Remember me</label>
                  </div>
                  <a href="#" style="font-size: 0.9rem; color: #198754; text-decoration: none;">Forgot password?</a>
              </div>

              <button type="submit" name="Login" class="btn btn-success w-100 py-2" style="font-weight: 500;">Log In</button>
          </form>

          <div class="text-center mt-4">
              <p style="font-size: 0.9rem;" class="text-muted">Don't have an account? <a href="#" style="color: #198754; text-decoration: none; font-weight: 500;">Register here</a></p>
          </div>
      </div>
  </div>

  <!-- Footer -->
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

  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <!-- Output the SweetAlert script generated by PHP -->
  <?php echo $swal_script; ?>

</body>
</html>