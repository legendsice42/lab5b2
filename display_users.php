<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "lab_5b");

$sql = "SELECT matric, name, accessLevel FROM users";
$result = $conn->query($sql);

echo "<table border='1'>";
echo "<tr><th>Matric</th><th>Name</th><th>Access Level</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr><td>{$row['matric']}</td><td>{$row['name']}</td><td>{$row['accessLevel']}</td></tr>";
}
echo "</table>";
?>
