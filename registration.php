<?php

$conn = new mysqli("localhost", "root", "", "lab_5b");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hashing password
    $accessLevel = $_POST['accessLevel'];

    $sql = "INSERT INTO users (matric, name, password, accessLevel) VALUES ('$matric', '$name', '$password', '$accessLevel')";
    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<form action="" method="POST">
    <label for="matric">Matric:</label>
    <input type="text" name="matric" required><br>
    <label for="name">Name:</label>
    <input type="text" name="name" required><br>
    <label for="password">Password:</label>
    <input type="password" name="password" required><br>
    <label for="accessLevel">Access Level:</label>
    <select name="accessLevel" required>
        <option value="lecturer">lecturer</option>
        <option value="student">student</option>
    </select><br>
    <button type="submit">Register</button>
</form>
