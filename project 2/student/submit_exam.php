<?php
session_start();
require "../db_connect.php";

if (!isset($_SESSION["role"]) || $_SESSION["role"] != "student") {
    header("Location: student_login.php");
    exit;
}

// Fetch all questions
$sql = "SELECT * FROM questions ORDER BY id ASC";
$result = mysqli_query($conn, $sql);

$total_questions = mysqli_num_rows($result);
$score = 0;
$answers_feedback = []; // store each question feedback

while ($row = mysqli_fetch_assoc($result)) {
    $q_id = $row["id"];
    $correct_answer = $row["correct_option"]; 
    $student_answer = $_POST["answer_$q_id"] ?? '';

    $is_correct = ($student_answer === $correct_answer);
    if ($is_correct) $score++;

    $answers_feedback[] = [
        'question' => $row["question_text"],
        'subject' => $row["subject"],
        'student_answer' => $student_answer,
        'correct_answer' => $correct_answer,
        'is_correct' => $is_correct,
        'options' => [
            'A' => $row["option_a"],
            'B' => $row["option_b"],
            'C' => $row["option_c"],
            'D' => $row["option_d"]
        ]
    ];
}

// Save score
$student_username = $_SESSION["username"];
$insert_sql = "INSERT INTO exam_results (username, score, total) VALUES (?, ?, ?)";
$stmt = mysqli_prepare($conn, $insert_sql);
mysqli_stmt_bind_param($stmt, "sii", $student_username, $score, $total_questions);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Exam Result</title>
    <style>
        .correct { color: green; }
        .wrong { color: red; }

        /* exam_result.css */
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
    margin-bottom: 20px;
}

p.score {
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 30px;
}

h3 {
    margin-bottom: 15px;
    color: #1c6dd0;
}

.feedback-question {
    font-weight: 600;
    margin-bottom: 8px;
}

.feedback-options span {
    display: block;
    margin-bottom: 5px;
}

.feedback-options .correct {
    color: green;
    font-weight: bold;
}

.feedback-options .wrong {
    color: red;
}

hr {
    border: 0;
    border-top: 1px solid #ccc;
    margin: 15px 0;
}

a {
    margin-top: 20px;
    color: #1c6dd0;
    text-decoration: none;
    font-weight: 500;
}

a:hover {
    text-decoration: underline;
}

    </style>
</head>
<body>
<h2>Exam Submitted!</h2>
<p>Your Score: <?php echo $score; ?> / <?php echo $total_questions; ?></p>

<h3>Answer Feedback:</h3>

<?php foreach ($answers_feedback as $fb): ?>
    <p><strong>(<?php echo htmlspecialchars($fb['subject']); ?>) <?php echo htmlspecialchars($fb['question']); ?></strong></p>
    <?php foreach ($fb['options'] as $key => $text): ?>
        <?php
        $style = '';
        if ($key === $fb['correct_answer']) $style = 'color: green; font-weight:bold;';
        elseif ($key === $fb['student_answer'] && !$fb['is_correct']) $style = 'color: red;';
        ?>
        <span style="<?php echo $style; ?>"><?php echo $key . ": " . htmlspecialchars($text); ?></span><br>
    <?php endforeach; ?>
    <hr>
<?php endforeach; ?>

<a href="student_dashboard.php">Back to Dashboard</a>
</body>
</html>
