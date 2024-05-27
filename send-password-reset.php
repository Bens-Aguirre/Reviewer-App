<?php

$email = $_POST["email"];

$token = bin2hex(random_bytes(16));

$token_hash = hash("sha256", $token);

$expiry = date("Y-m-d H:i:s", time() + 60 * 30);

$conn = require __DIR__ . "/config.php";

$sql = "UPDATE users
        SET reset_token_hash = ?,
            reset_token_expires_at = ?
        WHERE email = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("sss", $token_hash, $expiry, $email);

$stmt->execute();

if ($conn->affected_rows) {

    $mail = require __DIR__ . "/mailer.php";

    $mail->setFrom("noreply@example.com");
    $mail->addAddress($email);
    $mail->Subject = "Password Reset";
    $mail->Body = <<<END

    Click <a href="http://localhost:8080/Reviewer App/reset-password.php?token=$token">here</a> 
    to reset your password.

    END;

    try {

        $mail->send();

    } catch (Exception $e) {

        echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";

    }

}

echo '<div style="display: flex; justify-content: center; align-items: center; height: 100vh;">';
echo '<div style="text-align: center;">';
echo '<p style="color: green; font-size: 30px;">Message sent, please check your inbox.</p>';
echo '<a href="signin.php" style="text-decoration: none; color: #007BFF; font-size: 30px;">Go back to Sign In Form</a>';
echo '</div>';
echo '</div>';