<?php 
require_once '../config.php';

// Ensure the POST data is available
if(isset($_POST['question'], $_POST['answer'], $_POST['subSelected'])) {
    // Extract variables from POST
    $question = $_POST['question'];
    $answer = $_POST['answer'];
    $subjectId = $_POST['subSelected']; // New line to get subject ID

    // Check if the question already exists for the selected subject
    $stmt = $conn->prepare("SELECT * FROM fc_tbl WHERE question = ? AND id = ?");
    $stmt->bind_param("si", $question, $subjectId);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        $res = array("res" => "existQuestion", "question" => $question);
    } else {
        // Check if the answer already exists (this might not be necessary if only the question uniqueness is important)
        $stmt = $conn->prepare("SELECT * FROM fc_tbl WHERE answer = ?");
        $stmt->bind_param("s", $answer);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0) {
            $res = array("res" => "existAnswer", "answer" => $answer);
        } else {
            // Insert the new question, answer, and subject ID
            $stmt = $conn->prepare("INSERT INTO fc_tbl (question, answer, id) VALUES (?, ?, ?)");
            $stmt->bind_param("ssi", $question, $answer, $subjectId);

            if($stmt->execute()) {
                $res = array("res" => "success", "question" => $question);
            } else {
                $res = array("res" => "failed", "question" => $question);
            }
        }
    }

    // Close the statement
    $stmt->close();
} else {
    $res = array("res" => "missingData");
}

// Output the response as JSON
echo json_encode($res);

// Close the connection
$conn->close();
?>
