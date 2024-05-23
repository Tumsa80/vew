<?php
$host = "localhost";
$dbuser = "root";
$dbpassword = "";
$dbname = "student";

$con = new mysqli($host, $dbuser, $dbpassword, $dbname);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$sql = "SELECT * FROM customers";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='10'><tr><th>ID</th><th>Name</th><th>Age</th><th>Level</th><th>Actions</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row["id"]."</td>
                <td>".$row["name"]."</td>
                <td>".$row["age"]."</td>
                <td>".$row["level"]."</td>
                <td>
                    <a href='update.php?id=".$row["id"]."'>Edit</a> | 
                    <a href='delete.php?id=".$row["id"]."' onclick=\"return confirm('Are you sure you want to delete this record?');\">Delete</a>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$con->close();
?>
