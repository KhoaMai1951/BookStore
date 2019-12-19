<?php
include("database.php");
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from Form
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $sql = "SELECT id FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    // If result matched $username and $password, table row must be 1 row
    if ($count == 1) {
        $_SESSION['logged_in'] = 'YES'; // put session value here 
        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/bookstore/admin.php');
    } else {
        echo "Your Login Name or Password is invalid";
    }
}
?>
<html>
    <head>
        <title>Login</title>
        <style>
            body {
                margin: 0;
                padding: 0;
                font-family: sans-serif;
                background: #34495e;
            }

            .box {
                width: 300px;
                padding: 40px;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background: #191919;
                text-align: center;
            }

            .box h1{
                color: white;
                text-transform: uppercase;
                font-weight: 500;
            }

            .box input[type = "text"], .box input[type = "password"] {
                border:0;
                background: none;
                display: block;
                margin: 20px auto;
                text-align: center;
                border: 2px solid #3498db;
                padding: 14px 10px;
                width: 200px;
                outline: none;
                color: white;
                border-radius: 24px;
                transition: 0.25s;
            }

            .box input[type = "text"]:focus, .box input[type = "password"]:focus {
                width:280px;
                border-color: #2ecc71;
            }

            .box input[type = "submit"] {
                border:0;
                background: none;
                display: block;
                margin: 20px auto;
                text-align: center;
                border: 2px solid #2ecc71;
                padding: 14px 40px;
                outline: none;
                color: white;
                border-radius: 24px;
                transition: 0.25s;
                cursor: pointer;
            }

            .box input[type = "submit"]:hover {
                background: #2ecc71;
            }
        </style>
    </head>
    <body>
        <form class="box" action="login.php" method="post">
            <h1>Login</h1>
            <input type="text" name="username" placeholder="Username"/>
            <input type="password" name="password" placeholder="Password"/>
            <input type="submit" value="Login"/>
        </form> 
    </body>
</html>