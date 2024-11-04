<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Club Admin Login</title>
    <link rel="stylesheet" href="login_styles.css">
   
    <script src="https://kit.fontawesome.com/1ab94d0eba.js" crossorigin="anonymous"></script>
    <style>
        .error {
            color: #f44336; /* Red color for error */
            font-size: 14px; /* Font size */
            margin-top: 10px; /* Space between the message and the submit button */
            text-align: center; /* Center the message */
            display: block; /* Make it a block element */
        }
    </style>
</head>
<body>
<main class="container">
    <h2>Club Admin Login</h2>
    <form action="admin_login.php" method="POST">
        <div class="input-field">
            <input type="text" name="username" id="username" placeholder="Enter Your Username" required>
            <div class="underline"></div>
        </div>
        <div class="input-field">
            <input type="password" name="password" id="password" placeholder="Enter Your Password" required>
            <div class="underline"></div>
        </div>

        <input type="submit" value="Continue">

        <?php
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Check admin credentials
            if ($username === 'clubadmin' && $password === 'clubadmin') {
                $_SESSION['admin_logged_in'] = true;
                header('Location: admin_panel.php');
                exit();
            } else {
                echo "<div class='error'>Invalid username or password.</div>";
            }
        }
        ?>
    </form>
</main>
</body>
</html>
