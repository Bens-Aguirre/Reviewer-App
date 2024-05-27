<?php
session_start();
require_once '../config.php';
extract($_POST);

$user_id = null; // Initialize user_id as null

if (isset($_SESSION["user_id"])) {
    $conn = require __DIR__ . "/../config.php";

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

$selExAttempt = $conn->query("SELECT * FROM exam_attempt WHERE user_id='$user_id' AND ex_id='$ex_id'");

$selAns = $conn->query("SELECT * FROM exam_answers WHERE axmne_id='$user_id' AND ex_id='$ex_id'");

// Check if the exam attempt already exists
if (mysqli_num_rows($selExAttempt) > 0) {
    $res = array("res" => "alreadyTaken");
} else if (mysqli_num_rows($selAns) > 0) {
    // Update the previous answers to 'old' status
    $updLastAns = $conn->query("UPDATE exam_answers SET exans_status='old' WHERE axmne_id='$user_id' AND ex_id='$ex_id'");

    if ($updLastAns) {
        // Insert new answers
        foreach ($_REQUEST['answer'] as $key => $value) {
            $value = $value['correct'];
            $insAns = $conn->query("INSERT INTO exam_answers(axmne_id, ex_id, quest_id, exans_answer) VALUES('$user_id', '$ex_id', '$key', '$value')");
        }

        if ($insAns) {
            // Insert the exam attempt
            $insAttempt = $conn->query("INSERT INTO exam_attempt(user_id, ex_id) VALUES('$user_id', '$ex_id')");

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
        $insAns = $conn->query("INSERT INTO exam_answers(axmne_id, ex_id, quest_id, exans_answer) VALUES('$user_id', '$ex_id', '$key', '$value')");
    }
    if ($insAns) {
        $insAttempt = $conn->query("INSERT INTO exam_attempt(user_id, ex_id) VALUES('$user_id', '$ex_id')");
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
