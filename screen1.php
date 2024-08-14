<?php
error_reporting(E_ALL);
session_start();

if (isset($_SESSION['userid'])) {
    header('Location: screen4.php');
    exit();
}

$msg = null;
include 'dbconfig.php';

if (isset($_POST['submit'])) {
    // Retrieve submitted user data
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $msg = "<span class='danger'>All fields are required</span>";
    } else {
        // Prepare and execute the SQL query using prepared statements
        $stmt = $conn->prepare("SELECT id, password FROM createacctbl WHERE username = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($userID, $hashedPassword);

        if ($stmt->num_rows < 1) {
            $msg = "<span class='danger'>No record found...</span>";
        } else {
            $stmt->fetch();
            // Verify the password
            if (password_verify($password, $hashedPassword)) {
                $_SESSION['username'] = $username;
                $_SESSION['userid'] = $userID;
                $msg = "<span class='success'>You signed in successfully.</span>";
                header('Location: screen4.php');
                exit();
            } else {
                $msg = "<span class='danger'>Login failed. Please try again...</span>";
            }
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Justice Space</title>
    <style type="text/css">
        body {
            background-color: #F5F5F5;
            text-align: center;
            font-family: Arial, sans-serif;
        }
        #pic {
            width: 200px;
            height: 200px;
            margin-bottom: 20px;
        }
        input[type="text"], input[type="password"] {
            border-radius: 100px;
            width: 200px;
            height: 40px;
            text-align: center;
            margin: 10px 0;
            border: 1px solid #ccc;
            padding: 0 10px;
        }
        input[type="submit"] {
            border-radius: 100px;
            width: 200px;
            height: 50px;
            background-color: #FE914B;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
            margin: 10px 0;
        }
        .button {
            display: inline-block;
            border-radius: 100px;
            width: 200px;
            height: 50px;
            text-align: center;
            color: white;
            text-decoration: none;
            line-height: 50px;
            font-size: 16px;
            margin: 10px;
            cursor: pointer;
        }
        .google {
            background-color: #FFC107;
        }
        .facebook {
            background-color: #1877F2;
        }
        .success {
            color: green;
        }
        .danger {
            color: red;
        }
    </style>
</head>
<body>
    <img src="images/log.png" id="pic" alt="Logo">
    <br>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <br>
        <input type="password" name="password" placeholder="Password" required>
        <br>
        <input type="submit" name="submit" value="Submit">
        <br>
        <?php if ($msg): ?>
            <div><?php echo $msg; ?></div>
        <?php endif; ?>
        <br>
        <a href="https://www.google.com" target="_blank" class="button google">Sign in with Google</a>
        <br>
        <a href="https://www.facebook.com" target="_blank" class="button facebook">Continue with Facebook</a>
    </form>
</body>
</html>
