<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit();
}

// Database connection
$conn = new mysqli("localhost", "root", "", "Lab_5b");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['delete'])) {
    $matric = $conn->real_escape_string($_GET['delete']);
    $conn->query("DELETE FROM users WHERE matric = '$matric'");
    header("Location: users.php");
    exit();
}

$sql = "SELECT matric, name, accessLevel FROM users";
$result = $conn->query($sql);

echo "<table border='1'>";
echo "<tr><th>Matric</th><th>Name</th><th>Access Level</th><th>Actions</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['matric']}</td>
            <td>{$row['name']}</td>
            <td>{$row['accessLevel']}</td>
            <td>
                <a href='update_user.php?matric={$row['matric']}'>Update</a> | 
                <a href='users.php?delete={$row['matric']}' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a>
            </td>
          </tr>";
}
echo "</table>";

$conn->close();
?>
