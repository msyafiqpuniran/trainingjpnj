<!DOCTYPE html>
<html>

<head>
    <title>User Registration with Validation</title>
</head>

<body>
    <h1>User Registration</h1>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" onsubmit="return validateForm()">
        Name: <input type="text" name="name" id="name">
        <br>
        Email: <input type="text" name="email" id="email">
        <br>
        Password: <input type="password" name="password" id="password">
        <br>
        Confirm Password: <input type="password" name="confirm_password" id="confirm_password">
        <br>
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

            if (password !== confirmPassword) {
                window.alert("Passwords do not match");
                return false;
            }

            // You can add more custom validation here if needed

            return true;
        }
    </script>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Perform server-side validation and processing
        // ...
        // For this example, we'll just show a success message
        echo "<script>window.alert('Registration successful');</script>";
    }
    ?>
</body>

</html>