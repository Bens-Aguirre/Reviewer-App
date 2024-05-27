<?php 
require_once '../config.php';
session_start();

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
 

extract($_POST);

 $selExamAttmpt = $conn->query("SELECT * FROM exam_attempt WHERE user_id='$user_id' AND ex_id='$thisId' ");

 if ($selExamAttmpt->num_rows > 0) {
    $res = array("res" => "alreadyExam", "msg" => $thisId);
} else {
    $res = array("res" => "takeNow");
}


 echo json_encode($res);
 ?>