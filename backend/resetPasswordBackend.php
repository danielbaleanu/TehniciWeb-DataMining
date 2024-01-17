<?php

session_start();

if (!isset($_SESSION['autentificat']) || $_SESSION["autentificat"] !== true) {

    header("location: ../login.php");

    die();
}

require_once("config.php");

$newPassword = $confirmPassword = "";

$newPasswordError = $confirmPasswordError = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $newPassword = trim($_POST['newPassword']);

    $confirmPassword = trim($_POST['confirmPassword']);

    if (empty($newPassword)) {

        $newPasswordError = "Te rog să introduci o parolă";
    } elseif (strlen($newPassword) < 8) {

        $newPasswordError = "Parola trebuie să aibă minim 8 caractere";

        $newPassword = "";

        $confirmPassword = "";
    }

    if (empty($confirmPassword)) {

        $confirmPasswordError = "Te rog să rescrii parola";
    } else {

        if (empty($newPasswordError) && ($newPassword != $confirmPassword)) {

            $confirmPasswordError = "Parolele diferă";

            $newPassword = "";

            $confirmPassword = "";
        }
    }

    if (empty($newPasswordError) && empty($confirmPasswordError)) {

        $sql = "UPDATE users SET password = :password WHERE id = :id";

        if ($stmt = $connect->prepare($sql)) {

            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            $stmt->bindParam(":password", $hashedPassword);

            $stmt->bindParam(":id", $_SESSION["id"]);

            if ($stmt->execute()) {

                header("location: ../user.php");

                die();
            }

            $stmt = null;
        }
    }

    $connect = null;
}
