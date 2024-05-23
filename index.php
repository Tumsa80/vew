<?php
$host = "localhost";
$dbuser = "root";
$dbpassword = "";
$dbname = "student";

$con = new mysqli($host, $dbuser, $dbpassword, $dbname);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if (isset($_POST['submit'])) {
    $name = htmlspecialchars($_POST['name']);
    $age = htmlspecialchars($_POST['age']);
    $level = htmlspecialchars($_POST['level']);

    $stmt = $con->prepare("INSERT INTO customers (name, age, level) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $name, $age, $level);

    if ($stmt->execute()) {
        echo 'Data inserted successfully. <a href="read.php">View Users</a>';
    } else {
        die("Error: " . $stmt->error);
    }
    $stmt->close();
    $con->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <style>
        body { background-color: blueviolet; color: white; font-family: Arial, sans-serif; }
        center { font-size: 18px; }
        input[type=text], input[type=number] {
            width: 100%; padding: 12px; margin: 8px 0; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;
        }
        input[type=submit] {
            width: 100%; background-color: #4CAF50; color: white; padding: 14px 20px; margin: 8px 0; border: none; border-radius: 4px; cursor: pointer;
        }
        input[type=submit]:hover { background-color: #45a049; }
    </style>
</head>
<body>
    <center>
        <h1>Online Application</h1>
        <h2>Fill out this form to continue</h2>
        <form action="" method="post">
            <label for="name">Name:</label>
            <input type="text" name="name" placeholder="Enter your name" required><br><br>
            <label for="age">Age:</label>
            <input type="number" name="age" placeholder="Enter your age" required><br><br>
            <label for="level">Level:</label>
            <input type="text" name="level" placeholder="Enter your level" required><br><br>
            <input type="submit" name="submit" value="Submit">
        </form>
    </center>
</body>
</html>
