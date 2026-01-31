<?php
session_start();
require "../db_connect.php";

if (!isset($_SESSION["role"]) || $_SESSION["role"] != "teacher") {
    header("Location: t_login.php");
    exit;
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subject = $_POST["subject"];
    $question = $_POST["question"];
    $a = $_POST["option_a"];
    $b = $_POST["option_b"];
    $c = $_POST["option_c"];
    $d = $_POST["option_d"];
    $correct = $_POST["correct_answer"];

    $sql = "INSERT INTO questions ( subject, question_text, option_a, option_b, option_c, option_d, correct_option)
            VALUES ('$subject', '$question', '$a', '$b', '$c', '$d', '$correct')";

    if (mysqli_query($conn, $sql)) {
        $message = "Question added successfully!";
    } else {
        $message = "Failed to add question.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Question</title>
</head>
<body>

<h2>Add New Question</h2>

<?php if ($message != "") echo "<p style='color:green;'>$message</p>"; ?>

<form method="POST">
    <input type="text" name="subject" placeholder="Subject" required><br><br>

    <textarea name="question" placeholder="Enter question text" required></textarea><br><br>

    <input type="text" name="option_a" placeholder="Option A" required><br><br>
    <input type="text" name="option_b" placeholder="Option B" required><br><br>
    <input type="text" name="option_c" placeholder="Option C" required><br><br>
    <input type="text" name="option_d" placeholder="Option D" required><br><br>

    <input type="text" name="correct_answer" placeholder="Correct Answer (A/B/C/D)" required><br><br>

    <button type="submit">Add Question</button>
</form>

<br>
<a href="teacher_dashboard.php">Back to Dashboard</a>

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

p {
    color: green;
    font-size: 18px;
    font-weight: 500;
    margin-bottom: 20px;
}

form {
    background: #fff;
    padding: 30px 40px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    width: 350px;
    display: flex;
    flex-direction: column;
    gap: 20px;
}

input[type="text"],
textarea {
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 16px;
    width: 100%;
    outline: none;
    transition: 0.3s;
}

textarea {
    height: 100px;
    resize: none;
}

input:focus,
textarea:focus {
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

a {
    margin-top: 20px;
    text-decoration: none;
    font-size: 18px;
    font-weight: 500;
    color: #1c6dd0;
}

a:hover {
    color: #4a90e2;
}

</style>
</html>
