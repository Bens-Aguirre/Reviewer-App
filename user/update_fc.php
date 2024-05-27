<?php
require_once '../config.php'; // Include the database connection

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve data from POST request
    $fc_id = mysqli_real_escape_string($conn, $_POST['fc_id']);
    $subId = mysqli_real_escape_string($conn, $_POST['subId']);
    $question = mysqli_real_escape_string($conn, $_POST['question']);
    $answer = mysqli_real_escape_string($conn, $_POST['answer']);

    // Debugging: Log received data
    error_log("fc_id: $fc_id, subId: $subId, question: $question, answer: $answer");

    // Perform the update process
    $updateQuery = "UPDATE fc_tbl SET id='$subId', question='$question', answer='$answer' WHERE fc_id='$fc_id'";
    if (mysqli_query($conn, $updateQuery)) {
        $response['res'] = "success";
        $response['msg'] = "Flashcard updated successfully.";
    } else {
        $response['res'] = "failed";
        $response['msg'] = "Error: " . mysqli_error($conn);
        // Debugging: Log error
        error_log("MySQL error: " . mysqli_error($conn));
    }
} else {
    $response['res'] = "failed";
    $response['msg'] = "Invalid request method";
}

// Return response as JSON
echo json_encode($response);
?>
