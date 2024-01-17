<?php require_once("backend/resetPasswordBackend.php"); ?>

<html>

<head>

    <title>Schimbă parola</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="styles/registerStyles.css">
</head>

<body>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

        <h1>Schimbă parola</h1>

        <script>

            function span(id) {

                document.getElementById("span_" + id).style.display = "none";

                document.getElementById("input_" + id).focus();
            }
        </script>

        <input id="input_1" type="password" placeholder="New password" name="newPassword">

        <span id="span_1" onclick="span(1)"><?php echo $newPasswordError; ?></span>

        <input id="input_2" type="password" placeholder="Confirm password" name="confirmPassword">

        <span id="span_2" onclick="span(2)"><?php echo $confirmPasswordError; ?></span>

        <input type="submit" value="Schimbă parola">

        <a href="/user.php">Anulează</a>
    </form>
</body>

</html>