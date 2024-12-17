<?php

require_once('../functions.php');
require_once('../db.php');

$error = '';

foreach ($_POST as $key => $value) {
    if (mb_strlen($value) == 0 && $key != 'role') {
        $error = 'Please fill in all required fields!';
        break;
    }
}

if (mb_strlen($error) > 0) {
    $_SESSION['flash']['message']['type'] = 'danger';
    $_SESSION['flash']['message']['text'] = $error;
    $_SESSION['flash']['data'] = $_POST;

    header('Location: ../index.php?page=register');
    exit;
} else {
    $names = trim($_POST['names']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $repeat_password = trim($_POST['repeat_password']);
    $role = trim($_POST['role']);

    if (!in_array($role, ['user', 'admin'])) {
        $error = 'Invalid role selected!';
        $_SESSION['flash']['message']['type'] = 'danger';
        $_SESSION['flash']['message']['text'] = $error;
        $_SESSION['flash']['data'] = $_POST;

        header('Location: ../index.php?page=register');
        exit;
    }

    $query = "SELECT id FROM users WHERE email = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        $error = 'This email is already registered!';
        $_SESSION['flash']['message']['type'] = 'danger';
        $_SESSION['flash']['message']['text'] = $error;
        $_SESSION['flash']['data'] = $_POST;

        header('Location: ../index.php?page=register');
        exit;
    }

    if ($password != $repeat_password) {
        $error = 'Passwords do not match!';
        $_SESSION['flash']['message']['type'] = 'danger';
        $_SESSION['flash']['message']['text'] = $error;
        $_SESSION['flash']['data'] = $_POST;

        header('Location: ../index.php?page=register');
        exit;
    } else {
        $password = password_hash($password, PASSWORD_ARGON2I);

        $query = "INSERT INTO users (names, email, `password`, role) VALUES (:names, :email, :password, :role)";
        $stmt = $pdo->prepare($query);
        $params = [
            ':names' => $names,
            ':email' => $email,
            ':password' => $password,
            ':role' => $role
        ];

        if ($stmt->execute($params)) {
            $_SESSION['flash']['message']['type'] = 'success';
            $_SESSION['flash']['message']['text'] = "Successfully registered!";
            header('Location: ../index.php?page=home');
            exit;
        } else {
            $error = 'An error occurred during registration!';
            $_SESSION['flash']['message']['type'] = 'danger';
            $_SESSION['flash']['message']['text'] = $error;
            $_SESSION['flash']['data'] = $_POST;

            header('Location: ../index.php?page=register');
            exit;
        }
    }
}
?>
