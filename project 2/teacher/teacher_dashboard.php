<?php
session_start();

if (!isset($_SESSION["role"]) || $_SESSION["role"] != "teacher") {
    header("Location: t_login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Teacher Dashboard</title>
</head>
<body>

<h2>Welcome, Teacher <?php echo $_SESSION["username"]; ?></h2>

<ul>
    <li><a href="add_question.php">Add Question</a></li>
    <li><a href="view_questions.php">View All Questions</a></li>
    <li><a href="teacher_logout.php">Logout</a></li>
</ul>

</body>
<style>
    body {
    font-family: 'Poppins', sans-serif;
    background: #e0f0ff;
    margin: 0;
    padding: 40px;
    display: flex;
    flex-direction: column;
    align-items: center;
    color: #2c3e50;
}

h2 {
    background: linear-gradient(135deg, #4a90e2, #1c6dd0);
    color: #fff;
    padding: 20px 40px;
    border-radius: 12px;
    font-size: 26px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    margin-bottom: 30px;
    text-align: center;
}

ul {
    list-style: none;
    padding: 0;
    margin-top: 20px;
    background: #fff;
    padding: 25px 35px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    width: 300px;
}

ul li {
    margin: 15px 0;
}

ul li a {
    text-decoration: none;
    color: #1c6dd0;
    font-size: 18px;
    font-weight: 600;
    transition: 0.3s;
}

ul li a:hover {
    color: #4a90e2;
}

</style>
</html>
