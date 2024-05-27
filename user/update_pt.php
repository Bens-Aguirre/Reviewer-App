<?php 
 require_once '../config.php';
 
 extract($_POST);


 $updExam = $conn->query("UPDATE pt_tbl SET id='$subId', pt_title='$ptTitle', pt_questlimit_display='$ptQuestDipLimit' , pt_desc='$ptDesc' WHERE  pt_id='$ptId' ");

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