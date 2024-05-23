<?php
$host = "localhost";
$dbuser = "root";
$dbpassword = "";
$dbname = "student";

$con = new mysqli($host, $dbuser, $dbpassword, $dbname);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if (isset($_POST['update'])) {
    $id = htmlspecialchars($_POST['id']);
    $name = htmlspecialchars($_POST['name']);
    $age = htmlspecialchars($_POST['age']);
    $level = htmlspecialchars($_POST['level']);
    
    $stmt = $con->prepare("UPDATE customers SET name=?, age=?, level=? WHERE id=?");
    $stmt->bind_param("sisi", $name, $age, $level, $id);

    if ($stmt->execute()) {
        //echo 'Data updated successfully. <a href="read.php">View Users</a>';
        header("location: read.php");
    } else {
        die("Error: " . $stmt->error);
    }

    $stmt->close();
    $con->close();
} else {
    $id = htmlspecialchars($_GET['id']);
    $result = $con->query("SELECT * FROM customers WHERE id=$id");
    $row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Account</title>
</head>
<body>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo $row['name']; ?>" required><br><br>
        <label for="age">Age:</label>
        <input type="number" name="age" value="<?php echo $row['age']; ?>" required><br><br>
        <label for="level">Level:</label>
        <input type="text" name="level" value="<?php echo $row['level']; ?>" required><br><br>
        <input type="submit" name="update" value="Update">
    </form>
</body>
</html>

<?php
}
?>
