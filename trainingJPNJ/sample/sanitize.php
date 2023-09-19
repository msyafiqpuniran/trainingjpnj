<!DOCTYPE html>
<html>

<head>
    <title>Sanitize Input Example</title>
</head>

<body>
    <label for="textInput">Enter text:</label>
    <input type="text" id="textInput">

    <p id="output"></p>

    <script>
        var textInput = document.getElementById("textInput");
        var output = document.getElementById("output");

        textInput.onkeyup = function() {
            var sanitizedText = sanitizeInput(textInput.value);
            output.textContent = "Sanitized text: " + sanitizedText;
        };

        function sanitizeInput(input) {
            // Replace special symbols with an empty string
            var sanitized = input.replace(/[^\w\s]/gi, "");
            return sanitized;
        }
    </script>
</body>

</html>