<!DOCTYPE html>
<html>

<head>
    <title>Form Validation with JavaScript</title>
    <script>
        function validateForm() {
            var name = document.forms["myForm"]["name"].value;
            var email = document.forms["myForm"]["email"].value;

            if (name === "") {
                alert("Name must be filled out");
                return false;
            }

            if (email === "") {
                alert("Email must be filled out");
                return false;
            }
        }
    </script>
</head>

<body>
    <form name="myForm" onsubmit="return validateForm()" method="post">
        Name: <input type="text" name="name"><br>
        Email: <input type="text" name="email"><br>
        <input type="submit" value="Submit">
    </form>
</body>

</html>