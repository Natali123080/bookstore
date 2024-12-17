<?php

require_once('../functions.php');
require_once('../db.php');

// Get email and password from the form submission
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Check if the user exists
$query = "SELECT * FROM users WHERE email = :email";
$stmt = $pdo->prepare($query);
$stmt->execute([':email' => $email]);
$user = $stmt->fetch();

if (!$user) {
    // Redirect with an error if the user doesn't exist
    header('Location: ../index.php?page=login&error=Грешен имейл или парола');
    exit;
}

// Verify the user's password
if (!password_verify($password, $user['password'])) {
    // Redirect with an error if the password is incorrect
    header('Location: ../index.php?page=login&error=Грешен имейл или парола');
    exit;
}

// Start the session
session_start();

// Set session variables
$_SESSION['user_name'] = $user['names'];
$_SESSION['user_email'] = $user['email'];
$_SESSION['user_id'] = $user['id'];
$_SESSION['user_role'] = $user['role']; // Save the user's role in the session

// Optionally set a cookie
setcookie('user_email', $user['email'], time() + 3600, '/', 'localhost', false, true);

// Redirect to the appropriate page based on the user's role
if ($user['role'] === 'admin') {
    header('Location: ../index.php');
} else {
    header('Location: ../index.php');
}
exit;

?>
