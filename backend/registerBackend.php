<?php

require_once("config.php");

require_once("helper.php");

$username = $password = $confirmPassword = "";

$usernameError = $passwordError = $confirmPasswordError = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = sanitize($_POST['username']);

    $password = trim($_POST['password']);

    $confirmPassword = trim($_POST['confirmPassword']);

    if (empty($username)) {

        $usernameError = "Te rog să introduci un nume de utilizator";
    } else {

        $sql = "SELECT id FROM users WHERE username = :username";

        if ($stmt = $connect->prepare($sql)) {

            $stmt->bindParam(":username", $username);

            if ($stmt->execute()) {

                if ($stmt->rowCount() == 1) {

                    $usernameError = "Încearcă alt nume de utilizator";

                    $username = "";
                }
            }
        }

        $stmt = null;
    }

    if (empty($password)) {

        $passwordError = "Nu ai introdus o parolă";
    } elseif (strlen($password) < 8) {

        $passwordError = "Parola trebuie să aibă minim 8 caractere";

        $password = "";
    }

    if (empty($confirmPassword)) {

        $confirmPasswordError = "Nu ai introdus parola";
    } else {

        if ($password != $confirmPassword) {

            $confirmPasswordError = "Parolele diferă";

            $password = "";

            $confirmPassword = "";
        }
    }

    if (empty($usernameError) && empty($passwordError) && empty($confirmPasswordError)) {

        $sql = "INSERT INTO users(username, password) VALUES(:username, :password)";

        if ($stmt = $connect->prepare($sql)) {

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt->bindParam(":username", $username);

            $stmt->bindParam(":password", $hashedPassword);

            if ($stmt->execute()) {

                header("location: login.php");
            } else {

                $usernameError = $passwordError = $confirmPasswordError = "A apărut o eroare neprevăzută";

                $username = $password = $confirmPassword = "";
            }

            $stmt = null;
        }
    }
}

$connect = null;
