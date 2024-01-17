<?php

require_once("backend/editBackend.php");

if ((!isset($_SESSION['autentificat']) || $_SESSION['autentificat'] !== true) || $_SESSION['role'] !== 'admin') {

    header("location: ../login.php");

    die();
}

?>

<html>

<head>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <title>Editare produs</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="../styles/dashboardStyles/editStyles.css">
</head>

<body>

    <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="POST">

        <h1>Editare produs</h1>

        <input type="text" name="title" placeholder="Post title" value="<?php if (isset($title) && !empty($title)) echo $title; ?>"><br>

        <span><?php echo $titleError; ?></span><br>

        <label>Produsul va fi afișat pe pagina cu produse a site-ului (Public):</label>

        <select name="public">

            <option value="0" <?php if ($public == 0) echo "selected"; ?>>Nu</option>

            <option value="1" <?php if ($public == 1) echo "selected"; ?>>Da</option>
        </select>

        <textarea id="content" name="content" placeholder="Product description" cols="30" rows="10" maxlength="1100" minlength="100"><?php if (isset($content) && !empty($content)) $content = str_replace("<br>", "\n", $content); echo $content; ?></textarea>

        <div id="charNum"></div>

        <script>
            $(document).ready(function() {

                var text_max = 1100;

                $('#charNum').html('0 / ' + text_max);

                $('#content').keyup(function() {

                    var text_length = $('#content').val().length;

                    var text_remaining = text_max - text_length;

                    $('#charNum').html(text_length + ' / ' + text_max);
                });

                // Get the textarea element
                var textarea = document.getElementById("content");

                // Listen for keydown events
                textarea.addEventListener("keydown", function(event) {

                    // Check if the Enter key was pressed
                    if (event.key === "Enter") {

                        // Get the cursor position
                        var cursorPos = textarea.selectionStart;

                        // Insert a new line at the cursor position
                        var textBeforeCursor = textarea.value.substring(0, cursorPos);

                        var textAfterCursor = textarea.value.substring(cursorPos, textarea.value.length);

                        textarea.value = textBeforeCursor + "\n" + textAfterCursor;

                        // Move the cursor to the position after the new line
                        textarea.selectionStart = cursorPos + 1;
                        
                        textarea.selectionEnd = cursorPos + 1;

                        // Prevent the default action to avoid double new lines
                        event.preventDefault();
                    }
                });

                $('#content').keyup();
            });
        </script>

        <span><?php echo $contentError; ?></span><br>

        <input type="submit" value="Trimite">

        <a href="javascript:window.history.back();">Anulează</a>
    </form>
</body>

</html>