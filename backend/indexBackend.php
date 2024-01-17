<?php

require_once("config.php");

$postsPerPage = 5;

$pageNumber = 1;

if (isset($_GET['page']) && is_numeric($_GET['page'])) {

    $pageNumber = $_GET['page'];
}

$offset = $postsPerPage * $pageNumber - $postsPerPage;

session_start();

if (isset($_SESSION['role']) && $_SESSION['role'] = "admin") {

    $allPosts = "";
} else {

    $allPosts = "WHERE posts.public = 1 ";
}

$sql = "SELECT
        posts.id,
        posts.post_title,
        posts.post_content,
        posts.public,
        posts.created_at,
        users.username
        FROM posts LEFT JOIN users ON posts.author_id = users.id " . $allPosts . "ORDER BY posts.id DESC LIMIT :postsPerPage OFFSET :offset";

if ($stmt = $connect->prepare($sql)) {

    $stmt->bindParam(":postsPerPage", $postsPerPage, PDO::PARAM_INT);

    $stmt->bindParam(":offset", $offset, PDO::PARAM_INT);

    if ($stmt->execute()) {

        $posts = $stmt->fetchAll();

        if ($posts == false) {

            header("location: index.php");

            die();
        }
    }
}

$stmt = null;

$connect = null;
