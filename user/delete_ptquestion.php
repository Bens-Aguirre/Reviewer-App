<?php 
 require_once '../config.php';


extract($_POST);

$delExam = $conn->query("DELETE FROM pt_question_tbl WHERE eqt_id='$id'  ");
if($delExam)
{
	$res = array("res" => "success");
}
else
{
	$res = array("res" => "failed");
}


	echo json_encode($res);
 ?>