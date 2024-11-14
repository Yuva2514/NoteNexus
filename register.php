<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
    try {
        $stmt->execute(['username' => $username, 'password' => $password]);
        header("Location: login.php");
    } catch (Exception $e) {
        echo "Username already taken.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h2>Register</h2>
    <form action="register.php" method="POST">
        <label>Username:</label>
        <input type="text" name="username" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Register</button>
    </form>
</body>
</html>
