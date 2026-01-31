<?php
session_start();
require "../db_connect.php";

if (!isset($_SESSION["role"]) || $_SESSION["role"] != "teacher") {
    header("Location: teacher_login.php");
    exit;
}

if (!isset($_GET["id"])) {
    die("No question selected.");
}

$id = $_GET["id"];

$sql = "DELETE FROM questions WHERE id = $id";

if (mysqli_query($conn, $sql)) {
    header("Location: view_questions.php");
    exit;
} else {
    echo "Failed to delete question.";
}
?>
<style>
    body {
    font-family: 'Poppins', sans-serif;
    background: #e0f0ff;
    margin: 0;
    padding: 40px;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    color: #2c3e50;
    text-align: center;
}

p, h2 {
    background: linear-gradient(135deg, #4a90e2, #1c6dd0);
    color: #fff;
    padding: 20px 35px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    font-size: 22px;
    max-width: 400px;
}

a {
    display: inline-block;
    margin-top: 20px;
    text-decoration: none;
    padding: 12px 20px;
    background: #4a90e2;
    color: #fff;
    border-radius: 8px;
    font-weight: 600;
    transition: 0.3s;
}

a:hover {
    background: #1c6dd0;
    transform: translateY(-2px);
}

</style>