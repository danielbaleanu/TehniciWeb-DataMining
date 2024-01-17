<?php require_once("backend/registerBackend.php"); ?>

<html>

<head>

    <title>Înregistrează-te</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="styles/registerStyles.css">
</head>

<body>

    <!-- <h1>Register</h1> -->

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

        <h1>Creează un cont</h1>

        <script>

            function span(id) {

                document.getElementById("span_" + id).style.display = "none";

                document.getElementById("input_" + id).focus();
            }
        </script>

        <input id="input_1" type="text" placeholder="Username" name="username">

        <span id="span_1" onclick="span(1)"><?php echo $usernameError ?></span>

        <input id="input_2" type="password" placeholder="Password" name="password">

        <span id="span_2" onclick="span(2)"><?php echo $passwordError ?></span>

        <input id="input_3" type="password" placeholder="Password again" name="confirmPassword">

        <span id="span_3" onclick="span(3)"><?php echo $confirmPasswordError ?></span>

        <input type="submit" value="Înregistrează-te">

        <a href="login.php">Intră în cont</a>

        <a href="index.php">Anulează</a>
    </form>
</body>

</html>