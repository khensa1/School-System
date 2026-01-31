<?php
session_start();
require "../db_connect.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

   $sql = "SELECT * FROM users WHERE username=? AND password=? AND role='teacher'";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ss", $username, $password);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 1) {
    $_SESSION["role"] = "teacher";
    $_SESSION["username"] = $username;
    header("Location: teacher_dashboard.php");
    exit;
} else {
    $error = "Wrong username or password";
}

}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Teacher Login</title>
</head>
<body>
    <h2>Teacher Login</h2>

    <?php if ($error != "") echo "<p style='color:red;'>$error</p>"; ?>

    <form method="POST">
        <input type="text" name="username" placeholder="Username" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit">Login</button>
    </form>
</body>
<style>
    body {
    font-family: 'Poppins', sans-serif;
    background: #e0f0ff;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    margin: 0;
    padding: 20px;
    color: #2c3e50;
}

h2 {
    background: linear-gradient(135deg, #4a90e2, #1c6dd0);
    color: #fff;
    padding: 20px 40px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    font-size: 28px;
    text-align: center;
    margin-bottom: 30px;
}

p {
    color: #e74c3c;
    font-weight: 500;
    margin-bottom: 15px;
    text-align: center;
}

form {
    background: #fff;
    padding: 30px 40px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    display: flex;
    flex-direction: column;
    width: 300px;
    gap: 20px;
}

input[type="text"],
input[type="password"] {
    padding: 12px 15px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 16px;
    outline: none;
    transition: 0.3s;
}

input[type="text"]:focus,
input[type="password"]:focus {
    border-color: #4a90e2;
    box-shadow: 0 0 8px rgba(74,144,226,0.3);
}

button {
    padding: 12px;
    border: none;
    border-radius: 8px;
    background: #4a90e2;
    color: #fff;
    font-weight: 600;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    background: #1c6dd0;
    transform: translateY(-2px);
}

</style>
</html>
