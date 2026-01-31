<?php
session_start();
require "../db_connect.php";

if (!isset($_SESSION["role"]) || $_SESSION["role"] != "teacher") {
    header("Location: teacher_login.php");
    exit;
}

$sql = "SELECT * FROM questions ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Questions</title>
</head>
<body>

<h2>All Questions</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Subject</th>
        <th>Question</th>
        <th>A</th>
        <th>B</th>
        <th>C</th>
        <th>D</th>
        <th>Correct</th>
        <th>Actions</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row["id"]; ?></td>
            <td><?php echo $row["subject"]; ?></td>
            <td><?php echo $row["question_text"]; ?></td>
            <td><?php echo $row["option_a"]; ?></td>
            <td><?php echo $row["option_b"]; ?></td>
            <td><?php echo $row["option_c"]; ?></td>
            <td><?php echo $row["option_d"]; ?></td>
            <td><?php echo $row["correct_option"]; ?></td>
            <td>
                <a href="edit_question.php?id=<?php echo $row['id']; ?>">Edit</a> |
                <a href="delete_question.php?id=<?php echo $row['id']; ?>">Delete</a>
            </td>
        </tr>
    <?php } ?>

</table>

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

table {
    width: 1000px;
    border-collapse: collapse;
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
}

table th {
    background: #4a90e2;
    color: #fff;
    padding: 12px;
    text-align: left;
}

table td {
    padding: 12px;
    border-bottom: 1px solid #ddd;
}

table tr:hover {
    background: #f2f6ff;
}

a {
    text-decoration: none;
    color: #1c6dd0;
    font-weight: 600;
    transition: 0.3s;
}

a:hover {
    color: #4a90e2;
}

a.back {
    margin-top: 25px;
    font-size: 18px;
}

</style>
</html>
