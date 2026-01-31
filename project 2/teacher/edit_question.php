<?php
session_start();
require "../db_connect.php";

if (!isset($_SESSION["role"]) || $_SESSION["role"] != "teacher") {
    header("Location: t_login.php");
    exit;
}

if (!isset($_GET["id"])) {
    die("No question selected.");
}

$id = $_GET["id"];

$sql = "SELECT * FROM questions WHERE id = $id";
$result = mysqli_query($conn, $sql);
$question = mysqli_fetch_assoc($result);

if (!$question) {
    die("Question not found.");
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subject = $_POST["subject"];
    $text = $_POST["question"];
    $a = $_POST["option_a"];
    $b = $_POST["option_b"];
    $c = $_POST["option_c"];
    $d = $_POST["option_d"];
    $correct = $_POST["correct_answer"];

    $update = "UPDATE questions 
               SET subject='$subject', question_text='$text', 
                   option_a='$a', option_b='$b', option_c='$c', option_d='$d',
                   correct_option='$correct'
               WHERE id=$id";

    if (mysqli_query($conn, $update)) {
        $message = "Updated successfully!";
       
        $result = mysqli_query($conn, $sql);
        $question = mysqli_fetch_assoc($result);
    } else {
        $message = "Update failed.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Question</title>
</head>
<body>

<h2>Edit Question</h2>

<?php if ($message != "") echo "<p style='color:green;'>$message</p>"; ?>

<form method="POST">

    <input type="text" name="subject" value="<?php echo $question['subject']; ?>" required><br><br>

    <textarea name="question" required><?php echo $question['question_text']; ?></textarea><br><br>

    <input type="text" name="option_a" value="<?php echo $question['option_a']; ?>" required><br><br>
    <input type="text" name="option_b" value="<?php echo $question['option_b']; ?>" required><br><br>
    <input type="text" name="option_c" value="<?php echo $question['option_c']; ?>" required><br><br>
    <input type="text" name="option_d" value="<?php echo $question['option_d']; ?>" required><br><br>

    <input type="text" name="correct_answer" value="<?php echo $question['correct_answer']; ?>" required><br><br>

    <button type="submit">Update Question</button>
</form>

<br>
<a href="view_questions.php">Back</a>

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

</style>
</html>
