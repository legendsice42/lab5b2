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


if (isset($_GET['matric'])) {
    $matric = $conn->real_escape_string($_GET['matric']);
    $result = $conn->query("SELECT * FROM users WHERE matric = '$matric'");
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "User not found!";
        exit();
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $matric = $conn->real_escape_string($_POST['matric']);
    $name = $conn->real_escape_string($_POST['name']);
    $accessLevel = $conn->real_escape_string($_POST['accessLevel']);

    $conn->query("UPDATE users SET name = '$name', accessLevel = '$accessLevel' WHERE matric = '$matric'");
    header("Location: users.php"); 
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update User</title>
</head>
<body>
    <h1>Update User Information</h1>
    <form method="POST" action="update_user.php">
        <input type="hidden" name="matric" value="<?php echo $user['matric']; ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo $user['name']; ?>" required><br><br>
        <label for="accessLevel">Access Level:</label>
        <input type="text" name="accessLevel" id="accessLevel" value="<?php echo $user['accessLevel']; ?>" required><br><br>
        <button type="submit">Update</button>
    </form>
    <br>
    <a href="users.php">Back to Users</a>
</body>
</html>
