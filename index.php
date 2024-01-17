<?php require_once("backend/indexBackend.php"); ?>

<html>

<head>

    <title>E-Commerce Website</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="styles/indexStyles.css">
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

        session_start();

        if (isset($_SESSION['autentificat']) && $_SESSION['autentificat'] === true) {

            echo '<a href="backend/logout.php" name="register">Deconectează-te</a>';
        } else {

            echo '<a href="register.php" name="register">Înregistrează-te</a>';
        }
        ?>
    </div>

    <div name="main">

        <?php

        for ($i = 0; $i < count($posts); $i++) {

            echo '
        
        <div name="content">

            <a href="post.php?id=' . $posts[$i]['id'] . '">

                <h2>' . $posts[$i]['post_title'] . '</h2>
            </a>

            <img name="productPicture" src="products/product' . $posts[$i]['id'] . '.jpeg" onerror="this.src=\'products/error.jpeg\'"">

            <p name="limitedRows">' . mb_strimwidth($posts[$i]['post_content'], 0, 255, " ...") . '</p>

            <p>&bull; Adăugat la: ' . date('d/m/Y', strtotime($posts[$i]['created_at'])) . '</p>
            
            <a href="post.php?id=' . $posts[$i]['id'] . '">

                <button name="seeMore">Mai mult</button>
            </a>

            <hr>
        </div>
        ';
        }
        ?>
    </div>

    <div name="pageNumbering" class="vertical-center">

        <a href="index.php?page=<?php echo $pageNumber - 1; ?>" name="previousNextPage">

            <button <?php if ($pageNumber - 1 <= 0) echo "disabled"; ?>>

                <?php echo '<' ?>
            </button>
        </a>

        <a href="index.php?page=<?php echo $pageNumber; ?>">

            <button>

                <?php echo $pageNumber; ?>
            </button>
        </a>

        <a href="index.php?page=<?php echo $pageNumber + 1; ?>" name="previousNextPage">

            <button>

                <?php echo '>' ?>
            </button>
        </a>
    </div>
</body>

</html>