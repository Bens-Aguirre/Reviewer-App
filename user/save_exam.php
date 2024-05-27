<?php
require_once '../config.php';

// Check if the required variables are set
if (isset($_POST['subSelected'], $_POST['timeLimit'], $_POST['examQuestDipLimit'], $_POST['examDesc'], $_POST['examTitle'])) {
    // Extract variables from $_POST array
    extract($_POST);

    // Check if exam title already exists
    $stmt = $conn->prepare("SELECT * FROM exam_tbl WHERE ex_title = ?");
    $stmt->bind_param("s", $examTitle);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($subSelected == "0") {
        $res = array("res" => "noSelectedSub");
    } elseif ($timeLimit == "0") {
        $res = array("res" => "noSelectedTime");
    } elseif ($examQuestDipLimit == "" && $examQuestDipLimit == null) {
        $res = array("res" => "noDisplayLimit");
    } elseif ($result->num_rows > 0) {
        $res = array("res" => "exist", "examTitle" => $examTitle);
    } else {
        // Insert new exam
        $stmt = $conn->prepare("INSERT INTO exam_tbl (id, ex_title, ex_time_limit, ex_questlimit_display, ex_desc) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issis", $subSelected, $examTitle, $timeLimit, $examQuestDipLimit, $examDesc);
        if ($stmt->execute()) {
            $res = array("res" => "success", "examTitle" => $examTitle);
        } else {
            $res = array("res" => "failed", "examTitle" => $examTitle);
        }
    }
} else {
    $res = array("res" => "missingData");
}

echo json_encode($res);
?>
