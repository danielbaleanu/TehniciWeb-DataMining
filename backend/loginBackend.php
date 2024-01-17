<?php

session_start();

if (isset($_SESSION['autentificat']) && $_SESSION['autentificat'] === true) {

    header("location: ./user.php");

    die();
}

require_once("config.php");

require_once("helper.php");

$username = $password = "";

$usernameError = $passwordError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = sanitize($_POST['username']);

    $password = trim($_POST['password']);

    if (empty($username)) {

        $usernameError = "Nu ai introdus un nume de utilizator";
    }

    if (empty($password)) {

        $passwordError = "Nu ai introdus o parolă";
    }

    if (empty($usernameError) && empty($passwordError)) {

        $sql = "SELECT id, username, password, role FROM users WHERE username = :username";

        if ($stmt = $connect->prepare($sql)) {

            $stmt->bindParam(":username", $username);

            if ($stmt->execute()) {

                if ($stmt->rowCount() == 1) {

                    $user = $stmt->fetch();

                    if (password_verify($password, $user["password"])) {

                        session_start();

                        $_SESSION["autentificat"] = true;

                        $_SESSION["id"] = $user['id'];

                        $_SESSION["username"] = $user['username'];

                        $_SESSION["role"] = $user['role'];

                        header("location: ../user.php");
                    } else {

                        $usernameError = "Parola introdusă este greșită";

                        $username = "";

                        $password = "";
                    }
                } else {

                    $usernameError = "Username-ul este greșit";

                    $username = "";

                    $password = "";
                }
            }
        } else {

            $usernameError = $passwordError = "A apărut o eroare neprevăzută";

            $username = $password = "";
        }

        $stmt = null;
    }

    $connect = null;
}
