<?php require_once("backend/loginBackend.php") ?>

<html>

<head>

    <title>Login</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="styles/registerStyles.css">
</head>

<body>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

        <h1>Intră în cont</h1>

        <script>

            function span(id) {

                document.getElementById("span_" + id).style.display = "none";

                document.getElementById("input_" + id).focus();
            }
        </script>

        <input id="input_1" type="text" placeholder="Username" name="username">

        <span id="span_1" onclick="span(1)"><?php echo $usernameError; ?></span>

        <input id="input_2" type="password" placeholder="Password" name="password">

        <span id="span_2" onclick="span(2)"><?php echo $passwordError; ?></span>

        <input type="submit" value="Conectează-te">

        <a href="register.php">Creează un cont</a>

        <a href="index.php">Anulează</a>
    </form>
</body>

</html>