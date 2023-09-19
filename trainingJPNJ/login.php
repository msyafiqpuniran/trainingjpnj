<?php
session_start();

// Check if the user is already logged in, redirect to the dashboard if so
if (isset($_SESSION["username"])) {
    header("Location: index.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    include('db_config.php');

    // Retrieve user's hashed password from the database based on username
    $username = $_POST["username"];
    $sql = "SELECT username, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($dbUsername, $hashedPassword);

    if ($stmt->fetch() && password_verify($_POST["password"], $hashedPassword)) {
        // Password is correct, start a session and store the username
        $_SESSION["username"] = $dbUsername;
        $stmt->close();
        $conn->close();
        header("Location: index.php"); // Redirect to the dashboard
        exit();
    } else {
        // $loginError = "Invalid username or password";

        echo "<script>
            alert('Invalid username or password');
        </script>";
    }
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
</head>

<body>
    <h1>Login</h1>

    <?php
    if (isset($loginError)) {
        // echo "<p style='color: red;'>$loginError</p>";
    }
    ?>

    <form method="post" action="login.php">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <input type="submit" value="Login">
    </form>
</body>

</html>