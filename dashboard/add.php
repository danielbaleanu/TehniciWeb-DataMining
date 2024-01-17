<?php

require_once("backend/addBackend.php");

if ((!isset($_SESSION['autentificat']) || $_SESSION['autentificat'] !== true) || $_SESSION['role'] !== 'admin') {

    header("location: ../login.php");

    die();
}

?>

<html>

<head>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <title>Adăugare produs</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="../styles/dashboardStyles/addStyles.css">
</head>

<body>



    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

        <h1>Adaugă un produs nou</h1>

        <input type="text" name="title" placeholder="Product name" value="<?php if (isset($title) && !empty($title)) echo $title; ?>"><br>

        <span><?php echo $titleError; ?></span><br>

        <label>Produsul va fi afișat pe pagina cu produse a site-ului (Public):</label>

        <select name="public">

            <option value="0">Nu</option>

            <option value="1">Da</option>
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

                $('#content').keyup();
            });
        </script>

        <span><?php echo $contentError; ?></span><br>

        <input value="Trimite" type="submit">

        <a href="../user.php">Anulează</a>
    </form>
</body>

</html>