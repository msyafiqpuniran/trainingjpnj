<!DOCTYPE html>
<html>

<head>
    <title>User Registration with Validation and Sanitization</title>
</head>

<body>
    <h1>User Registration</h1>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" onsubmit="return validateForm()">
        Name: <input type="text" name="name" id="name"><br>
        Email: <input type="text" name="email" id="email"><br>
        Password: <input type="password" name="password" id="password"><br>
        Confirm Password: <input type="password" name="confirm_password" id="confirm_password"><br>
        <input type="submit" value="Register">
    </form>

    <script>
        function validateForm() {
            var name = document.getElementById("name").value;
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirm_password").value;

            if (name === "" || email === "" || password === "" || confirmPassword === "") {
                window.alert("All fields are required");
                return false;
            }

            if (!isValidEmail(email)) {
                window.alert("Invalid email format");
                return false;
            }

            if (password !== confirmPassword) {
                window.alert("Passwords do not match");
                return false;
            }

            // You can add more custom validation here if needed

            return true;
        }

        function isValidEmail(email) {
            // A simple email validation regex pattern
            var pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return pattern.test(email);
        }
    </script>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = sanitizeInput($_POST['name']);
        $email = sanitizeInput($_POST['email']);
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];

        // Perform server-side validation and processing
        if (empty($name) || empty($email) || empty($password) || empty($confirmPassword)) {
            echo "<script>window.alert('All fields are required');</script>";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>window.alert('Invalid email format');</script>";
        } elseif ($password !== $confirmPassword) {
            echo "<script>window.alert('Passwords do not match');</script>";
        } else {
            // Registration successful, you can proceed with database insert or other actions
            echo "<script>window.alert('Registration successful');</script>";
        }
    }

    function sanitizeInput($input)
    {
        // Basic input sanitization using htmlspecialchars
        return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    }
    ?>
</body>

</html>