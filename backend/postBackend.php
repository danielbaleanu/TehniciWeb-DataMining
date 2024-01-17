<?php

require_once("config.php");

session_start();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {

    $id = intval($_GET['id']);

    $sql = "SELECT posts.post_title,
                    posts.post_content,
                    posts.public,
                    users.username FROM posts LEFT JOIN users ON posts.author_id = users.id WHERE posts.id = :id";

    if ($stmt = $connect->prepare($sql)) {

        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {

            $post = $stmt->fetch();

            if (($post == false || $post['public'] == 0) && !isset($_SESSION['role']) && $_SESSION["role"] != 'admin') {

                header("location: index.php");

                die();
            }

            $title = $post['post_title'];

            $content = $post['post_content'];

            $author = $post['username'];
        }
    }
} else {

    header("location: index.php");

    die();
}
