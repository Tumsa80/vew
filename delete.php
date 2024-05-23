<?php
$host = "localhost";
$dbuser = "root";
$dbpassword = "";
$dbname = "student";

$con = new mysqli($host, $dbuser, $dbpassword, $dbname);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if (isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
    
    $stmt = $con->prepare("DELETE FROM customers WHERE id=?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
       // echo 'Data deleted successfully. <a href="read.php">View Users</a>';
        header("location:read.php");
    } else {
        die("Error: " . $stmt->error);
    }

    $stmt->close();
    $con->close();
}
?>
