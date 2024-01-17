<?php

session_start();

if ((!isset($_SESSION['autentificat']) || $_SESSION['autentificat'] !== true) || $_SESSION['role'] !== 'admin') {

    header("location: ../login.php");

    die();
}

require_once("../backend/config.php");

require_once("../backend/helper.php");

$title = $content = $id = "";

$titleError = $contentError = "";

if (isset($_GET['postId']) && is_numeric($_GET['postId'])) {

    $id = intval($_GET['postId']);

    $sql = "SELECT post_title, post_content, public FROM posts WHERE id = :id";

    if ($stmt = $connect->prepare($sql)) {

        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {

            $post = $stmt->fetch();

            if ($post == false) {

                header("location: add.php");

                die();
            }

            $title = $post['post_title'];

            $content = $post['post_content'];

            $public = $post['public'];
        }
    }

    $stmt = null;
} else {

    header("location: add.php");

    die();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $title = sanitize($_POST['title']);

    $content = str_replace("\n", "<br>", $_POST['content']);

    $public = $_POST['public'];

    if (empty($title)) {

        $titleError = "Te rog să introduci un titlu";
    } elseif (strlen($title) > 255) {

        $titleError = "Titlul nu trebuie să aibă mai mult de 255 de caractere";
    }

    if (empty($content)) {

        $contentError = "Nu ai introdus conținutul articolului";
    }

    if (empty($titleError) && empty($contentError)) {

        $sql = "UPDATE posts SET post_title = :post_title, post_content = :post_content, public = :public WHERE id = :id";

        if ($stmt = $connect->prepare($sql)) {

            $stmt->bindParam(":post_title", $title);

            $stmt->bindParam(":post_content", $content);

            $stmt->bindParam(":public", $public);

            $stmt->bindParam(":id", $id);

            if ($stmt->execute()) {

                header("location: ../post.php?id=" . $id);

                die();
            } else {

                $titleError = $contentError = "A apărut o eroare neprevăzută";

                $title = $content = $id = "";
            }

            $stmt = null;
        }
    }
}

$connect = null;
