<?php

session_start();

if ((!isset($_SESSION['autentificat']) || $_SESSION['autentificat'] !== true) || $_SESSION['role'] !== 'admin') {

    header("location: ../login.php");

    die();
}

require_once("../backend/config.php");

require_once("../backend/helper.php");

$title = $content = $public = "";

$titleError = $contentError = "";

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

        $sql = "INSERT INTO posts(post_title, post_content, author_id, public) VALUES(:post_title, :post_content, :author_id, :public)";

        if ($stmt = $connect->prepare($sql)) {

            $stmt->bindParam(":post_title", $title);

            $stmt->bindParam(":post_content", $content);

            $stmt->bindParam(":author_id", $_SESSION['id']);

            $stmt->bindParam(":public", $public);

            if ($stmt->execute()) {

                header("location: ../index.php");
            } else {

                $titleError = $contentError = "A apărut o eroare neprevăzută";

                $title = $content = $public = "";
            }

            $stmt = null;
        }
    }
}

$connect = null;
