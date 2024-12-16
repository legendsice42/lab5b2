<?php
session_start();
$conn = new mysqli("localhost", "root", "", "Lab_5b");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric = $_POST['matric'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE matric = '$matric'";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['logged_in'] = true;
        $_SESSION['accessLevel'] = $user['accessLevel'];
        header("Location: display_users.php");
    } else {
        echo "Invalid login credentials.";
    }
}
?>

<!-- Login Form -->
<form action="" method="POST">
    <label for="matric">Matric:</label>
    <input type="text" name="matric" required><br>
    <label for="password">Password:</label>
    <input type="password" name="password" required><br>
    <button type="submit">Login</button>
</form>
