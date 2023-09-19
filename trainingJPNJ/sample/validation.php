<!DOCTYPE html>
<html>

<head>
    <title>Form Validation without JavaScript</title>
</head>

<body>
    <?php
    $name = $email = "";
    $nameErr = $emailErr = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
        } else {
            $name = test_input($_POST["name"]);
        }

        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            }
        }
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        Name: <input type="text" name="name">
        <span style="color: red;"><?php echo $nameErr; ?></span><br>

        Email: <input type="text" name="email">
        <span style="color: red;"><?php echo $emailErr; ?></span><br>

        <input type="submit" name="submit" value="Submit">
    </form>
</body>

</html>