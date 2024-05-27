<?php
 require_once '../config.php';
 
 extract($_POST);

$updSub = $conn->query("UPDATE exam_question_tbl SET exam_question='$question', exam_ch1='$exam_ch1', exam_ch2='$exam_ch2', exam_ch3='$exam_ch3', exam_ch4='$exam_ch4', exam_answer='$exam_answer' WHERE eqt_id='$question_id' ");
if($updSub)
{
	   $res = array("res" => "success");
}
else
{
	   $res = array("res" => "failed");
}



 echo json_encode($res);	
?>