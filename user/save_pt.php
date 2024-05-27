<?php
require_once '../config.php';

// Check if the required variables are set
if (isset($_POST['subSelected'], $_POST['ptQuestDipLimit'], $_POST['ptDesc'], $_POST['ptTitle'])) {
    // Extract variables from $_POST array
    extract($_POST);

    // Check if exam title already exists
    $stmt = $conn->prepare("SELECT * FROM pt_tbl WHERE pt_title = ?");
    $stmt->bind_param("s", $ptTitle);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($subSelected == "0") {
        $res = array("res" => "noSelectedSub");
    } elseif ($ptQuestDipLimit == "" && $ptQuestDipLimit == null) {
        $res = array("res" => "noDisplayLimit");
    } elseif ($result->num_rows > 0) {
        $res = array("res" => "exist", "ptTitle" => $ptTitle);
    } else {
        // Insert new exam
        $stmt = $conn->prepare("INSERT INTO pt_tbl (id, pt_title, pt_questlimit_display, pt_desc) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isis", $subSelected, $ptTitle, $ptQuestDipLimit, $ptDesc);
        if ($stmt->execute()) {
            $res = array("res" => "success", "ptTitle" => $ptTitle);
        } else {
            $res = array("res" => "failed", "ptTitle" => $ptTitle);
        }
    }
} else {
    $res = array("res" => "missingData");
}

echo json_encode($res);
?>
