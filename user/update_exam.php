<?php 
 require_once '../config.php';
 
 extract($_POST);


 $updExam = $conn->query("UPDATE exam_tbl SET id='$subId', ex_title='$examTitle', ex_time_limit='$examLimit', ex_questlimit_display='$examQuestDipLimit' , ex_desc='$examDesc' WHERE  exam_id='$examId' ");

 if($updExam)
 {
   $res = array("res" => "success", "msg" => $examTitle);
 }
 else
 {
   $res = array("res" => "failed");
 }

 echo json_encode($res);
 ?>