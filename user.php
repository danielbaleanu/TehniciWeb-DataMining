<?php

session_start();

if (!isset($_SESSION['autentificat']) || $_SESSION['autentificat'] !== true) {

    header("location: login.php");

    die();
}

?>

<html>

<head>

    <title>Dashboard</title>

    <!-- <h1>Salut <?php echo $_SESSION["username"] ?></h1> -->

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="styles/registerStyles.css">
</head>

<body>
    <form action="">

        <h1>Dashboard</h1>

        <a href="index.php">Înapoi în site</a>

        <?php

        session_start();

        if (isset($_SESSION["role"]) && $_SESSION["role"] == "admin") {

            echo '<a href="dashboard/add.php">Adaugă un produs</a>';
        }
        ?>

        <a href="resetPassword.php">Schimbă parola</a>

        <a href="backend/logout.php">Deconectare</a>
    </form>
</body>

</html>