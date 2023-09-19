<?php
// Database connection
include('db_config.php');

// Initialize variables
$username = $password = "";
$usernameError = $passwordError = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username
    if (empty($_POST["username"])) {
        $usernameError = "Username is required";
    } else {
        $username = $_POST["username"];
        // Check if the username already exists in the database
        $checkUsernameQuery = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($checkUsernameQuery);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $usernameError = "Username is already taken";
        }
        $stmt->close();
    }

    // Validate password
    if (empty($_POST["password"])) {
        $passwordError = "Password is required";
    } else {
        $password = $_POST["password"];
    }

    // If there are no validation errors, hash the password and insert into the database
    if (empty($usernameError) && empty($passwordError)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $insertUserQuery = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $conn->prepare($insertUserQuery);
        $stmt->bind_param("ss", $username, $hashedPassword);
        if ($stmt->execute()) {
            // Registration successful, redirect to login page
            echo "<script>
            alert('Record successfully created');
            window.location.href = 'login.php';
        </script>";
            // header("Location: login.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Registration</title>
</head>

<body>
    <h1>Registration</h1>
    <form method="post" action="register.php">
        <div>
            <label for="username">Username:</label>
            <input type="text" name="username" value="<?php echo $username; ?>" required>
            <span style="color: red;"><?php echo $usernameError; ?></span>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" required>
            <span style="color: red;"><?php echo $passwordError; ?></span>
        </div>
        <div>
            <input type="submit" value="Register">
        </div>
    </form>
</body>

</html>