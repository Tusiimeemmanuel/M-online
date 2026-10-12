<?php
session_start(); // Start or resume the session

// Check if the user is logged in and if their email is the admin email
if (!isset($_SESSION['Email']) || $_SESSION['Email'] !== 'admin@gmail.com') {
    header("Location: login.php"); // Redirect back to login if not authorized
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - M-Online Shop</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light px-4 py-3 mb-4">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#"><span style="color: #198754;">M-</span>Online Admin</a>
            <div class="d-flex align-items-center">
                <span class="me-3 text-muted">Welcome, <strong><?php echo htmlspecialchars($_SESSION['Username']); ?></strong></span>
                <a href="login.php" class="btn btn-outline-danger btn-sm"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
            </div>
        </div>
    </nav>

    <!-- Main Content Container -->
    <div class="container py-3">
        <div class="row mb-4">
            <div class="col">
                <h2 class="fw-bold text-dark">Customer Messages / Registry</h2>
                <p class="text-muted">Manage incoming messages and user submissions.</p>
            </div>
        </div>

        <div class="card p-4">
            <div class="table-responsive">
                <?php
                $conn = mysqli_connect("localhost", "root", "", "messages");
                $sql = mysqli_query($conn, "SELECT * FROM registry");
                
                if ($sql && mysqli_num_rows($sql) > 0) {
                    echo "<table class='table table-hover align-middle'>";
                    echo "<thead class='table-success'>
                            <tr>
                                <th>ID</th>    
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Message</th>
                                <th>Action</th>
                              </tr>
                          </thead>";
                    echo "<tbody>";
                    while ($row = mysqli_fetch_assoc($sql)) {
                        echo "<tr>";
                        echo "<td><strong>#" . $row['id'] . "</strong></td>";
                        echo "<td>" . htmlspecialchars($row['Name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Phone']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Message']) . "</td>";
                        echo "<td>
                                <form action='delete.php' method='POST' onsubmit=\"return confirm('Are you sure you want to delete this message?');\" style='margin:0;'>
                                    <input type='hidden' name='id' value='" . $row['id'] . "'>
                                    <button type='submit' class='btn btn-danger btn-sm'><i class='fa-solid fa-trash'></i> Delete</button>
                                </form>
                              </td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                } else {
                    echo "<div class='text-center py-4 text-muted'>No records found.</div>";
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>