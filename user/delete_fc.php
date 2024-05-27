<?php
require_once '../config.php';

// Initialize response array
$response = array();

if (isset($_POST['id'])) {
    $fc_id = $_POST['id'];
    // Prepare and execute the query to delete the flashcard
    $stmt = $conn->prepare("DELETE FROM fc_tbl WHERE fc_id = ?");
    $stmt->bind_param('i', $fc_id);
    if ($stmt->execute()) {
        // If deletion is successful, set success message
        $response['status'] = 'success';
        $response['message'] = 'Flashcard has been deleted.';
    } else {
        // If deletion fails, set error message
        $response['status'] = 'error';
        $response['message'] = 'Failed to delete flashcard.';
    }
    // Close the statement
    $stmt->close();
} else {
    // If ID is not set in POST data, set error message
    $response['status'] = 'error';
    $response['message'] = 'ID not provided.';
}

// Return JSON response
echo json_encode($response);
?>
