<?php
session_start();

if (!isset($_SESSION["role"]) || $_SESSION["role"] != "student") {
    header("Location: student_login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
     <style>
        /* Basic Reset & Font */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Comic Sans MS', 'Chalkboard SE', 'Segoe UI', sans-serif;
            background-color: #f0f9ff;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            text-align: center;
        }

        .container {
            background-color: #ffffff;
            padding: 40px 30px;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            max-width: 400px;
            width: 90%;
        }

        h2 {
            color: #6366f1;
            margin-bottom: 10px;
            font-size: 28px;
        }

        .container p {
            color: #64748b;
            margin-bottom: 30px;
        }

        ul {
            list-style-type: none;
        }

        li {
            margin-bottom: 15px;
        }

        li a {
            display: block;
            text-decoration: none;
            color: white;
            background-color: #6366f1;
            padding: 15px 25px;
            border-radius: 50px;
            font-weight: bold;
            font-size: 16px;
            transition: all 0.3s ease;
            border: 3px solid transparent;
        }

        li:last-child a {
            background-color: #f87171;
        }

        li a:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(99, 102, 241, 0.3);
        }

        li:last-child a:hover {
            box-shadow: 0 5px 15px rgba(248, 113, 113, 0.3);
        }
    </style>

</head>
<body>

<h2>Welcome, <?php echo $_SESSION["username"]; ?></h2>

<ul>
    <li><a href="take_exam.php">Take Exam</a></li>
    <li><a href="student_logout.php">Logout</a></li>
</ul>

</body>
</html>
