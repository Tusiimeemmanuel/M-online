<?php
$conn = mysqli_connect("localhost", "root", "", "messages");

$id = (int) $_POST["id"];

mysqli_query($conn, "DELETE FROM registry WHERE id = $id");

header("Location: admin.php");
?>