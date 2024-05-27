<?php
session_start();
require_once '../config.php';

// Ensure prac_id is set and not empty
if (isset($_POST['prac_id']) && !empty($_POST['prac_id'])) {
    $prac_id = $_POST['prac_id'];
} else {
    $res = array("res" => "failed", "error" => "prac_id not provided");
    echo json_encode($res);
    exit;
}


extract($_POST);

$user_id = null; // Initialize user_id as null

if (isset($_SESSION["user_id"])) {
    $sql = "SELECT * FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $_SESSION["user_id"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    if ($user) {
        $user_id = $user['user_id']; // Set user_id if user is found
    }
} else {
    $user = null;
}

$selExAttempt = $conn->query("SELECT * FROM pt_attempt WHERE user_id='$user_id' AND prac_id='$prac_id'");

$selAns = $conn->query("SELECT * FROM pt_answers WHERE ptaxmne_id='$user_id' AND prac_id='$prac_id'");

// Check if the exam attempt already exists
if (mysqli_num_rows($selExAttempt) > 0) {
    $res = array("res" => "alreadyTaken");
} else if (mysqli_num_rows($selAns) > 0) {
    // Update the previous answers to 'old' status
    $updLastAns = $conn->query("UPDATE pt_answers SET ptans_status='old' WHERE ptaxmne_id='$user_id' AND prac_id='$prac_id'");

    if ($updLastAns) {
        // Insert new answers
        foreach ($_REQUEST['answer'] as $key => $value) {
            $value = $value['correct'];
            $insAns = $conn->query("INSERT INTO pt_answers(ptaxmne_id, prac_id, ptquest_id, ptans_answer) VALUES('$user_id', '$prac_id', '$key', '$value')");
        }

        if ($insAns) {
            // Insert the exam attempt
            $insAttempt = $conn->query("INSERT INTO pt_attempt(user_id, prac_id) VALUES('$user_id', '$prac_id')");

            if ($insAttempt) {
                $res = array("res" => "success");
            } else {
                $res = array("res" => "failed");
            }
        } else {
            $res = array("res" => "failed");
        }
    }
} else {
    foreach ($_REQUEST['answer'] as $key => $value) {
        $value = $value['correct'];
        $insAns = $conn->query("INSERT INTO pt_answers(ptaxmne_id, prac_id, ptquest_id, ptans_answer) VALUES('$user_id', '$prac_id', '$key', '$value')");
    }
    if ($insAns) {
        $insAttempt = $conn->query("INSERT INTO pt_attempt(user_id, prac_id) VALUES('$user_id', '$prac_id')");
        if ($insAttempt) {
            $res = array("res" => "success");
        } else {
            $res = array("res" => "failed");
        }
    } else {
        $res = array("res" => "failed");
    }
}

echo json_encode($res);
?>
