<?php

$token = $_POST["token"];

$token_hash = hash("sha256", $token);

$conn = require __DIR__ . "/config.php";

$sql = "SELECT * FROM users
        WHERE reset_token_hash = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("s", $token_hash);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

if ($user === null) {
    die("token not found");
}

if (strtotime($user["reset_token_expires_at"]) <= time()) {
    die("token has expired");
}

if (strlen($_POST["pass"]) < 8) {
    die("Password must be at least 8 characters");
}

if ( ! preg_match("/[a-z]/i", $_POST["pass"])) {
    die("Password must contain at least one letter");
}

if ( ! preg_match("/[0-9]/", $_POST["pass"])) {
    die("Password must contain at least one number");
}

if ($_POST["pass"] !== $_POST["pass_confirmation"]) {
    die("Passwords must match");
}

$password_hash = password_hash($_POST["pass"], PASSWORD_DEFAULT);

$sql = "UPDATE users
        SET password_hash = ?,
            reset_token_hash = NULL,
            reset_token_expires_at = NULL
        WHERE id = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("ss", $password_hash, $user["id"]);

$stmt->execute();

echo '<div style="display: flex; justify-content: center; align-items: center; height: 100vh;">';
echo '<div style="text-align: center;">';
echo '<p style="color: green; font-size: 30px;">Password updated. You can now login.</p>';
echo '<a href="signin.php" style="text-decoration: none; color: #007BFF; font-size: 30px;">Go back to Sign In Form</a>';
echo '</div>';
echo '</div>';