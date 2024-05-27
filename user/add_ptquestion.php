<?php
require_once '../config.php';

extract($_POST);

$selQuestResult = $conn->query("SELECT * FROM pt_question_tbl WHERE prac_id='$examId' AND exam_question='$question'");
if ($selQuestResult) {
    if ($selQuestResult->num_rows > 0) {
        $res = array("res" => "exist", "msg" => $question);
    } else {
        $insQuest = $conn->query("INSERT INTO pt_question_tbl(prac_id,exam_question,exam_ch1,exam_ch2,exam_ch3,exam_ch4,exam_answer) VALUES('$examId','$question','$choice_A','$choice_B','$choice_C','$choice_D','$correctAnswer') ");
        if ($insQuest) {
            $res = array("res" => "success", "msg" => $question);
        } else {
            $res = array("res" => "failed");
        }
    }
} else {
    // Handle error if query fails
    $res = array("res" => "failed");
}

echo json_encode($res);
?>
