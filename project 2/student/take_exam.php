<?php
session_start();
require "../db_connect.php";

// Check student login
if (!isset($_SESSION["role"]) || $_SESSION["role"] != "student") {
    header("Location: student_login.php");
    exit;
}

// Fetch all questions from the table
$sql = "SELECT * FROM questions ORDER BY id ASC";
$result = mysqli_query($conn, $sql);

// Check if any questions exist
if (!$result || mysqli_num_rows($result) == 0) {
    echo "<p>No questions available yet. Please ask the teacher to add some.</p>";
    echo '<p><a href="student_dashboard.php">Back to Dashboard</a></p>';
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Take Exam</title>
</head>
<style>
    /* take_exam.css */
body {
    font-family: 'Poppins', sans-serif;
    background: #e0f0ff;
    color: #2c3e50;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px;
    margin: 0;
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

form {
    background: #fff;
    padding: 30px 40px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    display: flex;
    flex-direction: column;
    width: 600px;
    max-width: 90%;
    gap: 25px;
}

p {
    font-weight: 600;
    margin: 0 0 10px 0;
}

.choice {
    display: flex;
    align-items: center;
    margin-bottom: 8px;
}

.choice input[type="radio"] {
    margin-right: 10px;
    cursor: pointer;
}

.choice label {
    cursor: pointer;
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
    color: #1c6dd0;
    text-decoration: none;
    font-weight: 500;
}

a:hover {
    text-decoration: underline;
}

</style>
<body>

<h2>Exam</h2>

<form method="POST" action="submit_exam.php">

<?php
$q_num = 1;
while ($row = mysqli_fetch_assoc($result)) {
?>
    <p><strong><?php echo $q_num . ". (" . htmlspecialchars($row["subject"]) . ") " . htmlspecialchars($row["question_text"]); ?></strong></p>

    <input type="radio" name="answer_<?php echo $row["id"]; ?>" value="A" required> <?php echo htmlspecialchars($row["option_a"]); ?><br>
    <input type="radio" name="answer_<?php echo $row["id"]; ?>" value="B" required> <?php echo htmlspecialchars($row["option_b"]); ?><br>
    <input type="radio" name="answer_<?php echo $row["id"]; ?>" value="C" required> <?php echo htmlspecialchars($row["option_c"]); ?><br>
    <input type="radio" name="answer_<?php echo $row["id"]; ?>" value="D" required> <?php echo htmlspecialchars($row["option_d"]); ?><br><br>

<?php
    $q_num++;
}
?>

<button type="submit">Submit Exam</button>

</form>

</body>
</html>
