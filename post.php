<?php 

require_once("backend/postBackend.php"); 

session_start();
?>

<html>

<head>

    <title>Vizualizare produs</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="styles/postStyles.css">
</head>

<body>

    <div name="menuBar">

        <a href="index.php">

            <!-- <h1 name="h1WebsiteName">E-Commerce<br>Website</h1> -->

            <img name="websiteLogo" src="artwork/websiteLogo.png" alt="E-Commerce Website">
        </a>

        <img name="bridgeLogo" src="artwork/bridgeLogoV2.png" alt="Bridge Logo">

        <a href="login.php" name="login">Intră în cont</a>

        <?php

        if (isset($_SESSION['autentificat']) && $_SESSION['autentificat'] === true) {

            echo '<a href="backend/logout.php" name="register">Deconectează-te</a>';
        } else {

            echo '<a href="register.php" name="register">Înregistrează-te</a>';
        }
        ?>
    </div>

    <div name="main">

        <div name="content">

            <h2><?php echo $title; ?></h2>

            <?php echo '<img name="productPicture" src="products/product' . $id . '.jpeg" onerror="this.src=\'products/error.jpeg\'"">'; ?>

            <p><?php echo $content ?></p>

            <?php

            if (isset($_SESSION["role"]) && $_SESSION["role"] == "admin") {

                echo '<a name="edit" href="dashboard/edit.php?postId=' . $id . '">Editează</a>';
            }
            ?>
        </div>
    </div>
</body>

</html>